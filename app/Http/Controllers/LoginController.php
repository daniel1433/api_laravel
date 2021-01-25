<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
// use App\Models\Login;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $login = DB::table("logins")
            ->where("user_name", $request->userName)
            ->where("passwrd", $request->password)
            ->exists();

        if ($login == "1") {
            return response()->json(["login" => true], 200);
        } else {;
            return response()->json(["login" => false], 200);
        }
    }
}
