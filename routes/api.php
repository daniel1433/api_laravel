<?php


// Middlewares
use App\Http\Middleware\Authentication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('api')->get('/clients', function (Request $request) {
//     echo "Pasa por aquí?";
//     return $request->user();
// });

Route::middleware([Authentication::class])->group(function () {
    // Route::Metodo(uri,nameController@funcion)
    Route::get('/clients',[ClientController::class, 'index']); 
    Route::post('/clients',[ClientController::class, 'createClient']);
    Route::put('/clients',[ClientController::class, 'updateClient']);
    Route::post('/deleteClients',[ClientController::class, 'deleteClients']);
    Route::get('/departaments', [DepartamentController::class, 'index']);
    Route::get('/municipalities', [MunicipalityController::class, 'index']);
    Route::get('/document_types', [DocumentTypeController::class, 'index']);
});

Route::post('/login', [LoginController::class, 'login']);

