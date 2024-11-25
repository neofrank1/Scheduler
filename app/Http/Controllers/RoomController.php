<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index() {

        return view('room.index');
    }
}
