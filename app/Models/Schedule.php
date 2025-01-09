<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule';

    protected $fillable = [
        'room_id',
        'prof_id',
        'subject_id',
        'section_id',
        'course_id',
        'start_time',
        'end_time',
        'school_yr',
        'semester',
        'day',
        'status',
    ];
}
