<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $table = 'professors';
    protected $fillable = [
        'employee_id',
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'mobile_no',
        'education_id',
        'ranking_id',
        'college_id',
        'course_id',
        'maximum_hours',
        'employee_status',
        'status',
    ];

    public static function getProfessorByCourseId($courseId)
    {
        return self::where('course_id', $courseId)->get();
    }
}
