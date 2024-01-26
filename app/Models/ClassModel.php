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
        'major_name',
        'class_name',
        'grade',
    ];

    public static $createRules = [
        'major_name' => 'required',
        'grade' => 'required',
        'class_name' => 'required',
    ];

    public static $customMessage = [
        'major_name.required'=> 'Major cannot be empty!',
        'grade.required'=> 'Grade cannot be empty!',
        'class_name.required'=> 'Class cannot be empty!',
    ];
    public static $editRules = [
        'major_name' => 'required',
        'grade' => 'required',
        'class_name' => 'required',

    ];
}
