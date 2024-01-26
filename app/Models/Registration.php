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
        'user_id',
        'extracurricular_id',
        'registration_date',
        'approval_letter',
        'status',
    ];

    public static $createRules = [
        'user_id' => 'required',
        'extracurricular_id' => 'required',
        'registration_date' => 'required',
        'approval_letter'=>'nullable',
        'status'=>'nullable'

    ];

    public static $editRules = [
        'user_id' => 'required',
        'extracurricular_id' => 'required',
        'registration_date' => 'nullable',
        'approval_letter'=>'nullable',
        'status'=>'nullable'
    ];

    public static $customMessage = [
        'user_id.required'=> 'Student cannot be empty!',
        'extracurricular_id.required'=> 'Extracurricular cannot be empty!',
        'registration_date.unique'=> 'Registration Date already exist!',
        'approval_letter.required'=> 'Approval Letter  cannot be empty!',
        'status.required'=> 'Status cannot be empty!',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registration()
    {
        return $this->hasOne(Registration::class, 'registration_id');
    }

    public function extracurricular()
    {
        return $this->belongsTo(Extracurricular::class, 'extracurricular_id', 'extracurricular_id');
    }
}
