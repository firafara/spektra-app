<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'email' => 'required',
        'password' => 'required',
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
}
