<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;
class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialties=Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('specialties.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $specialty = new Specialty();
        $specialty->name = $request->name;
        $specialty->save();
        return redirect()->route('specialties.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $specialty = Specialty::findOrFail($id);
        return view('specialties.edit', compact('specialty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $specialty = Specialty::findOrFail($id);
        $specialty->name=$request->name;
        $specialty->save();
        return redirect()->route('specialties.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $specialty = Specialty::findOrFail($id);
        $specialty->delete();
        return redirect()->route('specialties.index');
    }
}
