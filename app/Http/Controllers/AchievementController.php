<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          return view('achievement.index');
    }

    public function datatable(){
        $data = DB::table('t_achievement')
        ->join('users', 't_achievement.user_id', '=', 'users.id')
        ->select('users.name', 't_achievement.*')
        ->get();


        return Datatables::of($data)
            ->addColumn('action', function($data){
                $url_edit = url('achievement/edit/'.$data->achievement_id);
                $url_delete = url('achievement/delete/'.$data->achievement_id);
                $edit = "<a class='btn btn-warning btn-icon btn-sm' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>&nbsp;";
                $delete = "<button class='btn btn-danger btn-icon btn-sm' data-url='".$url_delete."' onclick='deleteData(this)' title='Delete'><i class='nav-icon fas fa-trash'></i></button>";

                return $edit.''.$delete;
            })
            ->editColumn('user_id',function($data){
                return str_ireplace("\r\n", "," , $data->user_id);
            })
            ->editColumn('type',function($data){
                return str_ireplace("\r\n", "," , $data->type);
            })
            ->editColumn('description',function($data){
                return str_ireplace("\r\n", "," , $data->description);
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = DB::table('t_achievement')
        ->join('users', 't_achievement.user_id', '=', 'users.id')
        ->select('users.name','t_achievement.*')
        ->first();

        $users = DB::table('users')->where('role','=','Student')->get();

    return view('achievement.create', ['data' => $data, 'users'=>$users ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),Achievement::$createRules,Achievement::$customMessage);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $values = [
                 'user_id'=>$request->user_id,
                 'type'=>$request->type,
                 'description'=>$request->description,
            ];

            $query = DB::table('t_achievement')->insert($values);
            if( $query ){
                return response()->json(['status'=>1, 'url'=>'/achievement','message'=>'Achievement Created Succesfully!']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DB::table('t_achievement')
        ->join('users', 't_achievement.user_id', '=', 'users.id')
        ->select('users.name','t_achievement.*')
        ->where('achievement_id','=',$id)->first();
        return view('achievement/view',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    public function edit($id){
        $data = DB::table('t_achievement')
        ->join('users', 't_achievement.user_id', '=', 'users.id')
        ->select('t_achievement.*')
        ->where('achievement_id','=',$id)->first();
        // dd($data);
        
        $users = DB::table('users')->where('role','=','Student')->get();

        return view('achievement/edit',['data'=>$data,'users'=>$users]);
    }

    public function update(Request $request,$id){

        $validator = Validator::make($request->all(), Achievement::$editRules, Achievement::$customMessage);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $data = Achievement::find($id);
            $data->update($request->all());
             if( $data->update($request->all()) ){
               return response()->json(['status'=>1, 'url'=>'/achievement','message'=>'Student Updated Succesfully!']);
           }
        }
    }
    

    public function destroy(string $id)
    {
        $achievement = Achievement::find($id);

        if( $achievement->delete() ){
            return response()->json(['status'=>1, 'url'=>'/achievement','message'=>'Achievement Deleted Succesfully!']);
        }
    }
}
