<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function autocomplete(Request $request)
    {
        $search = $request->get('query');

        if (!$search) {
            return response()->json([]);
        }

        // Realizar la solicitud a la API de CIMA
        $response = Http::get('https://cima.aemps.es/cima/rest/medicamentos', [
            'nombre' => $search,
        ]);

        if ($response->successful()) {
            $medications = $response->json();

            // Extraer los nombres de los medicamentos
            $results = collect($medications)->pluck('nombre')->take(10);

            return response()->json($results);
        } else {
            return response()->json([]);
        }
    }
}
