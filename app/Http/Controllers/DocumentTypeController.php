<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentTypeController extends Controller
{
    public function index(){
        $documentTypes = DB::table('document_types')->get();
        return response()->json($documentTypes,200);
    }
}
