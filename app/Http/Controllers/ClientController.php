<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $client = DB::table('clients')
            ->join('document_types', 'clients.id_document_type', '=', 'document_types.id_document_type')
            ->join('municipalities', 'clients.id_municipality', '=', 'municipalities.id_municipaly')
            ->join('departaments', 'municipalities.id_departament', '=', 'departaments.id_departament')
            ->join('logins', 'logins.id_client', '=', 'clients.id_client')
            ->select(
                '.clients.id_client',
                'document_types.id_document_type',
                'document_types.document_type',
                'clients.document_number',
                'clients.full_name',
                'clients.address',
                'clients.phone',
                'logins.user_name',
                'municipalities.id_municipaly',
                'municipalities.municipaly',
                'departaments.id_departament',
                'departaments.departament'
            )
            ->get();
        return response()->json($client);
    }

    public function createClient(Request $request)
    {
        $client = DB::table('clients')
            ->insertGetId([
                'id_document_type' => $request->id_document_type, 'id_municipality' => $request->id_municipaly, 'document_number' => $request->document_number, 'full_name' => $request->full_name, 'address' => $request->address, 'phone' => $request->phone
            ]);

        $login = DB::table('logins')->insert([
            'id_client'  => $client, 'user_name' => $request->user_name, 'passwrd'   => $request->password
        ]);

        if ($client > 0 && $client != "0") {
            return response()->json(["status" => true], 200);
        } else {
            return response()->json(["status" => false], 200);
        }
    }


    public function updateClient(Request $request)
    {
        $client = DB::table('clients')
            ->where('id_client', "=", $request->id_client)
            ->update([
                'id_document_type' => $request->id_document_type, 'id_municipality' => $request->id_municipaly, 'document_number' => $request->document_number, 'full_name' => $request->full_name, 'address' => $request->address, 'phone' => $request->phone
            ]);


        $login = DB::table('logins');
        if ($request->password && $request->password != "") {
            $login->where('id_client', "=", $request->id_client)
                ->update([
                    'user_name' => $request->user_name, 'passwrd'   => $request->password
                ]);
        } else {
            $login->where('id_client', "=", $request->id_client)
                ->update([
                    'user_name' => $request->user_name
                ]);
        }

        if ($client == 1) {
            return response()->json(["status" => true], 200);
        } else {
            return response()->json(["status" => false], 200);
        }
    }

    public function deleteClients(Request $request)
    {
        $resultLogin = array();
        $resultClient = array();
        for ($i = 0; $i < count($request->deleteClient); $i++) {
            $resultLogin[$i] = DB::table('clients')->where("id_client", "=", $request->deleteClient[$i]["id_client"])
                ->delete();
            $resultClient[$i] = DB::table('logins')->where("id_client", "=", $request->deleteClient[$i]["id_client"])
                ->delete();
        }

        $validLogin = in_array(0,$resultLogin);
        $validClient = in_array(0,$resultClient);

        if(!$validLogin && !$validClient){
            return response()->json(["status" => true], 200);
        }else{
            return response()->json(["status" => false], 200);
        }
    }
}
