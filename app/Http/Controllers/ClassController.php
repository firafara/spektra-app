<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use Illuminate\Support\Facades\DB;
use Validator;
use Yajra\DataTables\DataTables;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('class.index');
    }
    public function datatable(){
        $data = DB::table('t_class')->get();

        return Datatables::of($data)
            ->addColumn('action', function($data){
                $url_edit = url('class/edit/'.$data->class_id);
                $url_delete = url('class/delete/'.$data->class_id);
                $edit = "<a class='btn btn-warning btn-icon btn-sm' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>&nbsp;";
                $delete = "<button class='btn btn-danger btn-icon btn-sm' data-url='".$url_delete."' onclick='deleteData(this)' title='Delete'><i class='nav-icon fas fa-trash'></i></button>";

                return $edit.''.$delete;
            })
            ->editColumn('major_name',function($data){
                return str_ireplace("\r\n", "," , $data->major_name);
            })
            ->editColumn('grade',function($data){
                return str_ireplace("\r\n", "," , $data->grade);
            })
            ->editColumn('class_name',function($data){
                return str_ireplace("\r\n", "," , $data->class_name);
            })

            ->rawColumns(['action'])
            ->make(true);
    }
    public function create()
    {
        //
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),ClassModel::$createRules,ClassModel::$customMessage);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $values = [
                 'major_name'=>$request->major_name,
                 'grade'=>$request->grade,
                 'class_name'=>$request->class_name,
            ];

            $query = DB::table('t_class')->insert($values);
            if( $query ){
                return response()->json(['status'=>1, 'url'=>'/class','message'=>'Class Created Succesfully!']);
            }
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $data = ClassModel::where('class_id',$id)->get();
        return view('class/edit',['data'=>$data[0]]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),ClassModel::$editRules,ClassModel::$customMessage);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $data = ClassModel::find($id);
            $data->update($request->all());
            if( $data->update($request->all()) ){
                return response()->json(['status'=>1, 'url'=>'/class','message'=>'Class Updated Succesfully!']);
            }
        }
    }

    public function destroy($id){
        $class = ClassModel::find($id);

        if( $class->delete() ){
            return response()->json(['status'=>1, 'url'=>'/class','message'=>'Class Deleted Succesfully!']);
        }
    }

}
