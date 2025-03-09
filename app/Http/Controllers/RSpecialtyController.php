<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class RSpecialtyController extends Controller
{
    public function index()
    {
        return Specialty::all();
    }

    public function store(Request $request)
    {
        $specialty = new Specialty();
        $specialty->fill($request->all());
        $specialty->save();
        return response()->json($specialty, 201);
    }

    public function show($id)
    {
        $specialty = Specialty::findOrFail($id);
        return response()->json($specialty);
    }

    public function update(Request $request, $id)
    {
        $specialty = Specialty::findOrFail($id);
        $specialty->update($request->all());
        return response()->json($specialty);
    }

    public function destroy($id)
    {
        $specialty = Specialty::findOrFail($id);
        $specialty->delete();
        return response()->json(['message' => 'Specialty se elimino correctamente'], 200);
    }

}
