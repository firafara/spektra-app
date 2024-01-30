<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('extracurricular.index');
    }

    public function extraview()
    {
        $extracurricular = Extracurricular::all();
        $user = User::all();
        return view('extraview',['extracurricular'=>$extracurricular, 'user'=>$user]);
    }

    public function viewdetailextra($extracurricular_id){

        $extracurricular = Extracurricular::find($extracurricular_id);
        $user = User::all();
        return view('viewdetailextra',['extracurricular'=>$extracurricular, 'user'=>$user]);
    }

    public function datatable(){
        $data = DB::table('t_extracurricular')
        ->join('users', 't_extracurricular.user_id', '=', 'users.id')
        ->select('users.name as teacher_name','t_extracurricular.*')
        ->get();


        return Datatables::of($data)
            ->addColumn('action', function($data){
                $url_edit = url('extracurricular/edit/'.$data->extracurricular_id);
                $url_delete = url('extracurricular/delete/'.$data->extracurricular_id);
                $edit = "<a class='btn btn-warning btn-icon btn-sm' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>&nbsp;";
                $delete = "<button class='btn btn-danger btn-icon btn-sm' data-url='".$url_delete."' onclick='deleteData(this)' title='Delete'><i class='nav-icon fas fa-trash'></i></button>";

                return $edit.''.$delete;
            })
            ->editColumn('user_id',function($data){
                return str_ireplace("\r\n", "," , $data->user_id);
            })
            ->editColumn('name',function($data){
                return str_ireplace("\r\n", "," , $data->name);
            })
            ->editColumn('description',function($data){
                return str_ireplace("\r\n", "," , $data->description);
            })
            ->editColumn('picture',function($data){
                return str_ireplace("\r\n", "," , $data->picture);
            })


            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ubah join condition sesuai dengan struktur tabel dan kunci utama yang benar
        $data = DB::table('t_extracurricular')
            ->join('users', 't_extracurricular.user_id', '=', 'users.id')
            ->select('users.name', 't_extracurricular.*')
            ->first();

        // Pastikan bahwa 'id' adalah kunci utama yang benar untuk tabel 'users'
        $users = DB::table('users')->where('role', '=', 'Admin')->get();

        return view('extracurricular.create', ['data' => $data, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), Extracurricular::$createRules, Extracurricular::$customMessage);

    if ($request->hasFile('picture')) {
        $picture = $request->file('picture');
        $extension = $picture->getClientOriginalExtension();
        $pictureName = $request->name . '.' . $extension;

        $picture->move(public_path('upload/avatar/'), $pictureName);
    }

    if (!$validator->passes()) {
        return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
    } else {
        $values = [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'description' => $request->description,
            'picture'=> $pictureName
        ];

        // Pastikan nama tabel sesuai dengan tabel yang digunakan di database Anda
        $query = DB::table('t_extracurricular')->insert($values);

        if ($query) {
            return response()->json(['status' => 1, 'url' => '/extracurricular', 'message' => 'Extracurricular Created Successfully!']);
        }
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DB::table('t_extracurricular')
        ->join('users', 't_extracurricular.user_id', '=', 'users.id')
        ->select('users.name','t_extracurricular.*')
        ->where('extracurriculer_id','=',$id)->first();
        return view('extracurricular/view',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DB::table('t_extracurricular')
        ->join('users', 't_extracurricular.user_id', '=', 'users.id')
        ->select('t_extracurricular.*')
        ->where('extracurricular_id','=',$id)->first();


        $users = DB::table('users')->where('role','=','Admin')->get();

        return view('extracurricular/edit',['data'=>$data,'users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validasi input
    $validator = Validator::make($request->all(), Extracurricular::$editRules, Extracurricular::$customMessage);

    if ($validator->fails()) {
        return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
    }

    // Cek apakah ada file gambar yang diunggah
    if ($request->hasFile('picture')) {
        $picture = $request->file('picture');
        $extension = $picture->getClientOriginalExtension();
        $pictureName = $request->name . '.' . $extension;

        // Pindahkan file gambar ke direktori yang diinginkan
        $picture->move(public_path('upload/avatar/'), $pictureName);
    }

    // Update data ekstrakurikuler
    $extracurricular = Extracurricular::find($id);

    if (!$extracurricular) {
        return response()->json(['status' => 0, 'message' => 'Extracurricular not found.']);
    }

    $extracurricular->user_id = $request->user_id;
    $extracurricular->name = $request->name;
    $extracurricular->description = $request->description;

    // Update gambar hanya jika ada file gambar yang diunggah
    if (isset($pictureName)) {
        $extracurricular->picture = $pictureName;
    }

    // Simpan perubahan
    $extracurricular->save();

    return response()->json(['status' => 1, 'url' => '/extracurricular', 'message' => 'Extracurricular updated successfully.']);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $extracurricular = Extracurricular::find($id);

        if( $extracurricular->delete() ){
            return response()->json(['status'=>1, 'url'=>'/extracurricular','message'=>'Extracurricular Deleted Succesfully!']);
        }
    }
}
