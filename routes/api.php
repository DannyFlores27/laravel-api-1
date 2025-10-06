<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Estas rutas se cargan con el middleware 'api' y tienen el prefijo '/api'.
|
*/

// Mapea las rutas RESTful para el CRUD de la tabla 'clients'.
// Endpoint: /api/clients
Route::apiResource('clients', ClientController::class);