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
        'name',
        'class_id',
        'major_id',
        'gender',
        'phone_number',
        'birthdate',
        'birthplace',
        'address',
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
