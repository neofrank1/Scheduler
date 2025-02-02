<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    
    protected $fillable = [
        'id',
        'building_name',
        'floor_number',
        'room_number',
        'college_id',
        'course_id',
    ];
}
