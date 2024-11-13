<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table = 'section';
    
    protected $fillable = [
        'id',
        'name',
        'year_lvl',
        'college_id',
        'course_id',
        'program',
        'status'
    ];
}
