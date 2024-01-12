<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 't_teacher';

    protected $primaryKey = 'teacher_id';

    protected $fillable = [
        'nip',
        'user_id',
        'gender',
        'phone_number',
    ];
    public static $createRules = [
        'user_id' => 'required',
        'nip' => 'required|unique:t_teacher',
        'gender' => 'required',
        'phone_number' => 'required',
    ];

    public static $editRules = [
        'user_id' => 'required',
        'nip' => 'required',
        'gender' => 'required',
        'phone_number' => 'required',
    ];

    public static $customMessage = [
        'user_id.required'=> 'Name cannot be empty!',
        'nip.required'=> 'nip cannot be empty!',
        'nip.unique'=> 'nip already exist!',
        'gender.required'=> 'gender cannot be empty!',
        'phone_number.required'=> 'Phone number cannot be empty!',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
