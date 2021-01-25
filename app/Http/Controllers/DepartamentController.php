<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentController extends Controller
{
    public function index(){
        $departaments = DB::table('departaments')->get();

        return response()->json($departaments,200);
    }
}
