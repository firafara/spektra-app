<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use CompressImage;
use Illuminate\Support\Facades\Validator;

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
                $url_view = url('user/show/'.$data->id);
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
        $validator = Validator::make($request->all(), User::$createRules, User::$customMessage);
    
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            $avatarName = "";
    
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $extension = $avatar->getClientOriginalExtension();
                $avatarName = $request->name . '.' . $extension;
    
                $avatar->move(public_path('upload/avatar/'), $avatarName);
            }
    
            $values = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => ($request->password == 0) ? bcrypt('mcp12345') : bcrypt($request->password),
                'role' => $request->role,
                'avatar' => $avatarName,
            ];

            $query = User::create($values);
            if ($query) {
                return response()->json(['status' => 1, 'url' => '/user', 'message' => 'User Created Successfully!']);
            }
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id){
        $data = DB::table('users')
                ->where('users.id','=',$id)->get();
        return view('user/view',['data'=>$data[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $data = User::where('id',$id)->get();
        return view('user/edit',['data'=>$data[0]]);
    }
    public function update(Request $request, $id)
{
    $data = User::find($id);

    $validator = Validator::make($request->all(), User::$editRules, User::$customMessage);

    if (!$validator->passes()) {
        return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
    }

    // Check if a new avatar is uploaded
    if ($request->hasFile('avatar')) {
        // Delete the old avatar
        if ($data->avatar) {
            unlink(public_path('/upload/avatar/' . $data->avatar));
        }

        // Save the new avatar
        $extension = $request->file('avatar')->getClientOriginalExtension();
        $avatar = $request->name . '.' . $extension;
        $request->file('avatar')->move(public_path('/upload/avatar/'), $avatar);

        $data->avatar = $avatar;
    }

    $data->name = $request->name;
    $data->email = $request->email;
    $data->role = $request->role;

    // Check if a password is provided
    if ($request->filled('password')) {
        $data->password = bcrypt($request->password);
    }

    // Save the changes
    if ($data->save()) {
        return response()->json(['status' => 1, 'url' => '/user', 'message' => 'User Updated Successfully!']);
    } else {
        return response()->json(['status' => 0, 'error' => 'Failed to update user.']);
    }
}

    




    public function destroy($id){
        $user = User::find($id);

        if( $user->delete() ){
            return response()->json(['status'=>1, 'url'=>'/user','message'=>'User Deleted Succesfully!']);
        }
    }

}
