<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $table = "college";
    protected $fillable = [
        'short_name',
        'full_name',
        'create_at',
        'updated_at'
    ] ;
}
