<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.index');
    }

    public function datatable(){
        $data = DB::table('t_student')
            ->join('users', 't_student.user_id', '=', 'users.id')
            ->join('t_class', 't_student.class_id', '=', 't_class.class_id')
            ->select('users.name', 't_student.nis', DB::raw('CONCAT(t_class.grade, " ", t_class.major_name, " ", t_class.class_name) as class_details'), 't_student.phone_number', 't_student.student_id')
            ->get();

        return Datatables::of($data)
            ->addColumn('action', function($data){
                $url_view = url('student/show/'.$data->student_id);
                $url_edit = url('student/edit/'.$data->student_id);
                $url_delete = url('student/delete/'.$data->student_id);

                $view = "<a class='btn btn-primary btn-icon btn-sm' href='".$url_view."' title='View ".$data->name."'><i class='nav-icon fas fa-search'></i></a>&nbsp;";
                $edit = "<a class='btn btn-warning btn-icon btn-sm' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>&nbsp;";
                $delete = "<button class='btn btn-danger btn-icon btn-sm' data-url='".$url_delete."' onclick='deleteData(this)' title='Delete'><i class='nav-icon fas fa-trash'></i></button>";

                return $view."".$edit."".$delete;
            })
            ->addColumn('class_details', function($data){
                return str_ireplace("\r\n", ",", $data->class_details);
            })
            ->rawColumns(['action', 'class_details'])
            ->make(true);
    }

    public function create(){
        $data = Student::join('users','t_student.user_id','=','users.id')
        ->join('t_class','t_student.class_id','=','t_class.class_id')->get(['t_student.*','t_class.class_id','t_class.class_name']);
        $users = DB::table('users')->where('role','=','Student')->get();
        $class = DB::table('t_class')->select('class_id', DB::raw('CONCAT(t_class.grade, " ", t_class.major_name, " ", t_class.class_name) as class_details'))->get();
        return view('student.create', ['data' => $data, 'users' => $users,'class' => $class]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),Student::$createRules,Student::$customMessage);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $values = [
                'user_id'=>$request->user_id,
                'nis'=>$request->nis,
                'class_id'=>$request->class_id,
                'gender'=>$request->gender,
                'phone_number'=>$request->phone_number,
                'birthdate'=>$request->birthdate,
                'birthplace'=>$request->birthplace,
                'address'=>$request->address,
            ];

            // $query = DB::table('users')->insert($values);//Dipake kalo ga ada proses lanjutan
            $query = Student::create($values);
            if( $query ){
                return response()->json(['status'=>1, 'url'=>'/student','message'=>'User Created Succesfully!']);
            }
        }
    }
    public function show($id){
        $data = DB::table('t_student')
        ->join('users', 't_student.user_id', '=', 'users.id')
        ->join('t_class', 't_student.class_id', '=', 't_class.class_id')
        ->select('t_student.*', DB::raw('CONCAT(t_class.grade, " ", t_class.major_name, " ", t_class.class_name) as class_details'),'users.name')
        ->where('student_id','=',$id)->first();
        return view('student/view',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $data = DB::table('t_student')
        ->join('users', 't_student.user_id', '=', 'users.id')
        ->join('t_class', 't_student.class_id', '=', 't_class.class_id')
        ->select('t_student.*', 't_class.class_name')
        ->where('student_id','=',$id)->first();
        // dd($data);
        $users = DB::table('users')->where('role','=','Student')->get();
        $class = DB::table('t_class')->select('class_id', DB::raw('CONCAT(t_class.grade, " ", t_class.major_name, " ", t_class.class_name) as class_details'))->first();
        return view('student.edit', ['data' => $data, 'users' => $users,'class' => $class]);
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), Student::$editRules, Student::$customMessage);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $data = Student::find($id);
            $data->update($request->all());
             if( $data->update($request->all()) ){
               return response()->json(['status'=>1, 'url'=>'/student','message'=>'Student Updated Succesfully!']);
           }
        }
    }

    public function destroy($id){
        $student = Student::find($id);

        if( $student->delete() ){
            return response()->json(['status'=>1, 'url'=>'/student','message'=>'Student Deleted Succesfully!']);
        }
    }
}
