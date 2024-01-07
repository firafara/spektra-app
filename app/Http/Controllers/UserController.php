<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index');
    }

    

    public function datatable(){
            $data = DB::table('users')->get();

            return Datatables::of($data)
            ->addColumn('action', function($data){
                $url_view = url('user/'.$data->id);
                $url_edit = url('user/edit/'.$data->id);
                $url_delete = url('user/delete/'.$data->id);
                $view = "<a class='btn btn-primary btn-icon btn-sm' href='".$url_view."' title='View ".$data->name."'><i class='nav-icon fas fa-search'></i></a>&nbsp;";
                $edit = "<a class='btn btn-warning btn-icon btn-sm' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>&nbsp;";
                $delete = "<button class='btn btn-danger btn-icon btn-sm' data-url='".$url_delete."' onclick='deleteData(this)' title='Delete'><i class='nav-icon fas fa-trash'></i></button>";

                return $view."".$edit."".$delete;
            })
            ->editColumn('name',function($data){
                return str_ireplace("\r\n", ",", $data->name);
            })
            ->editColumn('email',function($data){
                return str_ireplace("\r\n", ",", $data->email);
            })
            ->editColumn('role',function($data){
                return str_ireplace("\r\n", ",", $data->role);
            })
            ->rawColumns(['action'])
            ->editColumn('id', 'ID:{{$id}}')
            ->make(true);
    }
    public function create(){
        $data = DB::table('users')->get();
        return view('user/create',['data' => $data]);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),User::$createRules,User::$customMessage);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $avatarname="";

            if($request->hasFile('avatar')){
                $extensionavatar = $request->file('avatar')->getClientOriginalExtension();
                $avatarname = $request->name.'.'.$extensionavatar;

                $ph = \CompressImage::make($request->avatar);
                $ph->resize(600,400);
                $ph->save(\public_path('/upload/avatar/'.$avatarname));
            }

            $values = [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> ($request->password == 0 ) ? bcrypt('mcp12345') : bcrypt($request->password),
                'role'=>$request->role,
                'avatar' => $avatarname,
            ];

            // $query = DB::table('users')->insert($values);//Dipake kalo ga ada proses lanjutan
            $query = User::create($values);
            if( $query ){
                return response()->json(['status'=>1, 'url'=>'/user','message'=>'User Created Succesfully!']);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
