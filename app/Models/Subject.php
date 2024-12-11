<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    
    protected $fillable = [
        'id',
        'subj_code',
        'subj_desc',
        'subj_prereq',
        'subj_type',
        'subj_lec_hours',
        'subj_lab_hours',
        'subj_hours',
        'semester',
        'school_year',
        'year_level'
    ];
}
