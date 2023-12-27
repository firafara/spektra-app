<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 't_class';

    protected $primaryKey = 'class_id';

    protected $fillable = [
        'class_name',
    ];
}
