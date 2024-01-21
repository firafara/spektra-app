<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index()
    {
        return view('teacher.index');
    }

    public function datatable(){
        $data = DB::table('t_teacher')
            ->join('users', 't_teacher.user_id', '=', 'users.id')
            ->select('users.name', 't_teacher.*')
            ->get();

        return Datatables::of($data)
            ->addColumn('action', function($data){
                $url_view = url('teacher/show/'.$data->teacher_id);
                $url_edit = url('teacher/edit/'.$data->teacher_id);
                $url_delete = url('teacher/delete/'.$data->teacher_id);

                $view = "<a class='btn btn-primary btn-icon btn-sm' href='".$url_view."' title='View ".$data->name."'><i class='nav-icon fas fa-search'></i></a>&nbsp;";
                $edit = "<a class='btn btn-warning btn-icon btn-sm' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>&nbsp;";
                $delete = "<button class='btn btn-danger btn-icon btn-sm' data-url='".$url_delete."' onclick='deleteData(this)' title='Delete'><i class='nav-icon fas fa-trash'></i></button>";

                return $view."".$edit."".$delete;
            })
            ->editColumn('nip',function($data){
                return str_ireplace("\r\n", "," , $data->nip);
            })
            ->editColumn('gender',function($data){
                return str_ireplace("\r\n", "," , $data->gender);
            })
            ->editColumn('phone_number',function($data){
                return str_ireplace("\r\n", "," , $data->phone_number);
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function create(){
        $data = DB::table('t_teacher')
            ->join('users', 't_teacher.user_id', '=', 'users.id')
            ->select('users.name', 't_teacher.*')
            ->first();

        $users = DB::table('users')->where('role','=','Admin')->get();

        return view('teacher.create', ['data' => $data, 'users' => $users]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),Teacher::$createRules,Teacher::$customMessage);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $values = [
                'nip'=>$request->nip,
                'user_id'=>$request->user_id,
                'gender'=>$request->gender,
                'phone_number'=>$request->phone_number,
            ];
            
            // $query = DB::table('users')->insert($values);//Dipake kalo ga ada proses lanjutan
            $query = Teacher::create($values);
            if( $query ){
                return response()->json(['status'=>1, 'url'=>'/teacher','message'=>'Teacher Created Succesfully!']);
            }
        }
       
    }
    public function show($id){
        $data = DB::table('t_teacher')
        ->join('users', 't_teacher.user_id', '=', 'users.id')
        ->select('users.name', 't_teacher.*')
        ->where('teacher_id','=',$id)->first();
        return view('teacher/view',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $data = DB::table('t_teacher')
        ->join('users', 't_teacher.user_id', '=', 'users.id')
        ->select('users.name', 't_teacher.*')
        ->where('teacher_id','=',$id)->first();
        $users = DB::table('users')->get();

        return view('teacher/edit',['data'=>$data,'users'=>$users]);
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), Teacher::$editRules, Teacher::$customMessage);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $data = Teacher::find($id);
            $data->update($request->all());
             if( $data->update($request->all()) ){
               return response()->json(['status'=>1, 'url'=>'/teacher','message'=>'Teacher Updated Succesfully!']);
           }
        }
    }

    public function destroy($id){
        $teacher = Teacher::find($id);

        if( $teacher->delete() ){
            return response()->json(['status'=>1, 'url'=>'/teacher','message'=>'Teacher Deleted Succesfully!']);
        }
    }
}
