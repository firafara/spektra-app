<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    protected $table = 't_achievement';

    protected $primaryKey = 'achievement_id';

    protected $fillable = [
        'user_id',
        'type',
        'description',
    ];

    public static $createRules = [
        'user_id' => 'required',
        'type' => 'required',
        'description' => 'required',
    ];

    public static $customMessage = [
        'user_id.required'=> 'Major cannot be empty!',
        'type.required'=> 'Grade cannot be empty!',
        'description.required'=> 'Class cannot be empty!',
    ];
    public static $editRules = [
        'user_id' => 'required',
        'type' => 'required',
        'description' => 'required',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
