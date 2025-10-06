<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\ClientResource; // Usamos el recurso

class ClientController extends Controller
{
    // Obtener todos los clientes (READ: Listar)
    public function index()
    {
        return ClientResource::collection(Client::all());
    }

    // Crear un nuevo cliente (CREATE)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:clients,email|max:100',
            'phone' => 'nullable|string|max:20',
        ]);

        $client = Client::create($validated);
        return new ClientResource($client);
    }

    // Mostrar un cliente específico (READ: Detalle)
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    // Actualizar un cliente (UPDATE)
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:100',
            'email' => 'sometimes|required|email|unique:clients,email,' . $client->id . '|max:100',
            'phone' => 'nullable|string|max:20',
        ]);

        $client->update($validated);
        return new ClientResource($client);
    }

    // Eliminar un cliente (DELETE)
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(null, 204);
    }
}