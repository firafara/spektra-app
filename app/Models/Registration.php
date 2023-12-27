<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $table = 't_registration';

    protected $primaryKey = 'registration_id';

    protected $fillable = [
        'student_id',
        'extracurricular_id',
        'registration_date',
        'approval_letter',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function extracurricular()
    {
        return $this->belongsTo(Extracurricular::class, 'extracurricular_id', 'extracurricular_id');
    }
}
