<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use App\Models\Registration;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudent = User::where('role', 'Student')->count();
        $totalextracurricular = Extracurricular::all()->count();
        $totalregistpending = Registration::where('status', 'Pending')->count();
        $totaladmin = User::where('role', 'Admin')->count();
        return view('pages.dashboard-v1',['totalStudent'=>$totalStudent, 'totalextracurricular'=>$totalextracurricular, 'totalregistpending'=>$totalregistpending, 'totaladmin'=>$totaladmin]);
    }






}
