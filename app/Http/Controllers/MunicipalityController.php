<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MunicipalityController extends Controller
{
    public function index(Request $request)
    {
        $municipalities = DB::table('municipalities')
        ->where('id_departament','=',$request->id_departament)
        ->get();
        return response()->json($municipalities, 200);
    }
}
