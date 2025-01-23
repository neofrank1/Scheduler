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
        'school_yr',
        'semester',
        'status',
    ];
}
