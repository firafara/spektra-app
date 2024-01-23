<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'avatar',
        'role',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $createRules = [
        'name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required',
        'role' => 'required',
        'avatar' => 'mimes:png,jpg,jpeg',
    ];

    public static $editRules = [
        'email' => 'nullable',
        'password' => 'nullable',
        'role' => 'required',
        'avatar' => 'mimes:png,jpg,jpeg',
    ];

    public static $customMessage = [
        'name.required'=> 'User name cannot be empty!',
        'email.required'=> 'Email cannot be empty!',
        'email.unique'=> 'Email already exist!',
        'password.required'=> 'Password cannot be empty!',
        'role.required'=> 'User level cannot be empty!',
        'avatar.mimes'=> 'Avatar format only jpg png!',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');

    }

    public function class()
    {
        return $this->hasOne(ClassModel::class, 'class_id');
    }

    public function extracurricular()
    {
        return $this->hasOne(Extracurricular::class, 'extracurricular_id', 'extracurricular_id');
    }
    
    public function registration()
    {
        return $this->hasOne(Registration::class, 'user_id');
    }

    
}
