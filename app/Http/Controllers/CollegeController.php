<?php

namespace App\Http\Controllers;
use App\Models\College;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function collegeList(): JsonResponse {
        $result = College::all(['id', 'full_name']);
        return response()->json($result);
    }
}
