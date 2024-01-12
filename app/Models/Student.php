<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 't_student';

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'user_id',
        'nis',
        'class_id',
        'gender',
        'phone_number',
        'birthdate',
        'birthplace',
        'address',
    ];
    public static $createRules = [
        'user_id' => 'required',
        'nis' => 'required|unique:t_student',
        'class_id' => 'required',
        'gender' => 'required',
        'phone_number' => 'required',
    ];

    public static $editRules = [
        'user_id' => 'required',
        'nis' => 'required',
        'class_id' => 'required',
        'gender' => 'required',
        'phone_number' => 'required',
    ];

    public static $customMessage = [
        'user_id.required'=> 'Name cannot be empty!',
        'nis.required'=> 'NIS cannot be empty!',
        'nis.unique'=> 'NIS already exist!',
        'class_id.required'=> 'Class cannot be empty!',
        'gender.required'=> 'Gender cannot be empty!',
        'phone_number.required'=> 'Phone number cannot be empty!',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studentClass()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'class_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'student_id', 'student_id');
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class, 'student_id', 'student_id');
    }
}
