<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    protected $table = 't_major';

    protected $primaryKey = 'major_id';

    protected $fillable = [
        'major_name',
    ];
}
