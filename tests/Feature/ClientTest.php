<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Departament;
use App\Models\DocumentType;
use App\Models\Municipality;
use App\Models\Client;
use App\Models\Login;

class ClientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {

        $departament = Departament::factory()->create();
        $documentType = DocumentType::factory()->create();
        $municipality = Municipality::factory()->create([
            'id_departament'=>$departament->id
        ]);
        $client = Client::factory()->create([
            'id_document_type'=>$documentType->id
            , 'id_municipality'=>$municipality->id
        ]);
        $login = Login::factory()->create([
            'id_client'=>$client->id
        ]);

        $response = $this->get('/api/login');
        // $response = $this->json('GET', '/api/clients');


        $response->assertStatus(200);
        // ->assertJsonStructure([
        //     'id_client'
        //     , 'id_document_type'
        //     , 'id_municipality'
        //     , 'document_number'
        //     , 'full_name'
        //     , 'address'
        //     , 'phone'
        // ]);

        $this->assertCount(1,$response->json()["idClient"]);

    }
}
