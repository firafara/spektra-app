<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;
    protected $table = 't_extracurricular';

    protected $primaryKey = 'extracurricular_id';

    protected $fillable = [
        'teacher_id',
        'name',
        'description',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'extracurricular_id', 'extracurricular_id');
    }
}
