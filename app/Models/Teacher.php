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
        'name',
        'gender',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
