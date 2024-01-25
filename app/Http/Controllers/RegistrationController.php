<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Registration;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('registration.index');
    }

    public function downloadApprovalLetter($id)
    {
        $registration = DB::table('t_registration')->where('registration_id', $id)->first();


        if ($registration) {
            $filePath = storage_path("app/public/{$registration->approval_letter}");

            if (file_exists($filePath)) {
                return response()->download($filePath, 'approval_letter_' . $registration->user_id . '.pdf');
            }
        }

        return redirect()->route('registration.index')->with('error', 'Approval Letter not found.');
    }

    public function datatable(){
        $data = DB::table('t_registration')
            ->join('users', 't_registration.user_id', '=', 'users.id')
            ->join('t_extracurricular', 't_registration.extracurricular_id', '=', 't_extracurricular.extracurricular_id')
            ->select('users.name', 't_registration.*','t_extracurricular.name as extra_name')
            ->get();

        return Datatables::of($data)
            ->addColumn('action', function($data){
                $url_view = url('registration/show/'.$data->registration_id);
                $url_edit = url('registration/edit/'.$data->registration_id);
                $url_delete = url('registration/delete/'.$data->registration_id);
                $url_download = url('registration/download/' . $data->registration_id);

                $view = "<a class='btn btn-primary btn-icon btn-sm' href='".$url_view."' title='View ".$data->name."'><i class='nav-icon fas fa-search'></i></a>&nbsp;";
                $edit = "<a class='btn btn-warning btn-icon btn-sm' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>&nbsp;";
                $delete = "<button class='btn btn-danger btn-icon btn-sm' data-url='".$url_delete."' onclick='deleteData(this)' title='Delete'><i class='nav-icon fas fa-trash'></i></button>";
                $download = "<a class='btn btn-info btn-icon btn-sm' href='" . $url_download . "' title='Download Approval Letter'><i class='nav-icon fas fa-download'></i></a>&nbsp;";
                return $view."".$edit."".$delete."".$download;
            })
            ->editColumn('user_id',function($data){
                return str_ireplace("\r\n", "," , $data->user_id);
            })
            ->editColumn('extracurricular_id',function($data){
                return str_ireplace("\r\n", "," , $data->extracurricular_id);
            })
            ->editColumn('registration_date',function($data){
                return str_ireplace("\r\n", "," , $data->registration_date);
            })
            ->editColumn('approval_letter',function($data){
                return str_ireplace("\r\n", "," , $data->approval_letter);
            })
            ->editColumn('status',function($data){
                return str_ireplace("\r\n", "," , $data->status);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $data = DB::table('t_registration')
          ->join('users', 't_registration.user_id', '=', 'users.id')
          ->join('t_extracurricular', 't_registration.extracurricular_id', '=', 't_extracurricular.extracurricular_id')
          ->select('users.name', 't_registration.*')
          ->first();


      $users = DB::table('users')->where('role', '=', 'Student')->get();
      $extracurricular = DB::table('t_extracurricular')->get();

      return view('registration.create', ['data' => $data, 'users' => $users, 'extracurricular'=>$extracurricular]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Registration::$createRules, Registration::$customMessage);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            // Fetch user information based on user_id
            $user = User::find($request->user_id);

            if (!$user) {
                return response()->json(['status' => 0, 'error' => 'User not found.']);
            }

            // Handle file upload with a custom name based on the user
            $userFileName = 'approval_letter_' . $user->name;
            $approvalLetterPath = $request->file('approval_letter')->storeAs('file', $userFileName, 'public');

            $values = [
                'user_id' => $request->user_id,
                'extracurricular_id' => $request->extracurricular_id,
                'registration_date' => $request->registration_date,
                'approval_letter' => $approvalLetterPath, // Store the file path in the database
                'status' => $request->status,
            ];

            // Make sure the table name matches the one used in your database
            $query = DB::table('t_registration')->insert($values);

            if ($query) {
                return response()->json(['status' => 1, 'url' => '/registration', 'message' => 'Registration Created Successfully!']);
            }
        }
    }




    public function show(string $id)
    {
        $data = DB::table('t_registration')
        ->join('users', 't_registration.user_id', '=', 'users.id')
        ->join('t_extracurricular', 't_registration.extracurricular_id', '=', 't_extracurricular.extracurricular_id')
        ->select('users.name', 't_registration.*')
        ->where('registration_id','=',$id)->first();

        return view('registration/view',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DB::table('t_registration')
        ->join('users', 't_registration.user_id', '=', 'users.id')
        ->join('t_extracurricular', 't_registration.extracurricular_id', '=', 't_extracurricular.extracurricular_id')
        ->select('users.name', 't_registration.*')
        ->where('registration_id','=',$id)->first();

        $users = DB::table('users')->where('role', '=', 'Student')->get();
        $extracurricular = DB::table('t_extracurricular')->get();

        return view('registration/edit',['data'=>$data, 'users' => $users, 'extracurricular'=>$extracurricular]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), Registration::$editRules, Registration::$customMessage);

    if (!$validator->passes()) {
        return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
    } else {
        $registration = Registration::find($id);

        if (!$registration) {
            return response()->json(['status' => 0, 'error' => 'Registration not found.']);
        }

        // Handle file upload if a new file is provided
        if ($request->hasFile('approval_letter')) {
            // Remove the existing file
            Storage::disk('public')->delete("file/{$registration->approval_letter}");

            // Handle file upload with a custom name based on the user
            $userFileName = 'approval_letter_' . $request->user_id->name;
            $approvalLetterPath = $request->file('approval_letter')->storeAs('file', $userFileName, 'public');

            // Update the file path in the database
            $registration->approval_letter = $approvalLetterPath;
        }

        // Update other fields
        $registration->user_id = $request->user_id;
        $registration->extracurricular_id = $request->extracurricular_id;
        $registration->registration_date = $request->registration_date;
        $registration->status = $request->status;

        // Save the changes to the database
        $registration->save();

        return response()->json(['status' => 1, 'url' => '/registration', 'message' => 'Registration Updated Successfully!']);
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $extracurricular = Registration::find($id);

        if( $extracurricular->delete() ){
            return response()->json(['status'=>1, 'url'=>'/registration','message'=>'Registration Deleted Succesfully!']);
        }
    }


}
