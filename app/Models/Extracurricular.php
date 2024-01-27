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
        'user_id',
        'name',
        'description',
        'picture',
    ];

    public static $createRules = [
        'user_id' => 'required',
        'name' => 'required',
        'description'=>'required',
        'picture'=>'nullable',

    ];

    public static $editRules = [
        'user_id' => 'required',
        'name' => 'nullable',
        'description' => 'nullable',
        'picture'=>'nullable',

    ];

    public static $customMessage = [
        'user_id.required'=> 'Teacher cannot be empty!',
        'name.required'=> 'Name cannot be empty!',
        'Description.unique'=> 'Description Date already exist!',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function registrations()
    // {
    //     return $this->hasMany(Registration::class, 'extracurricular_id', 'extracurricular_id');
    // }


}
