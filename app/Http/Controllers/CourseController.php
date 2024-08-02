<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function courseList(): JsonResponse {
        $result = Course::all(['id', 'full_name', 'college_id']);
        return response()->json($result);
    }
}
