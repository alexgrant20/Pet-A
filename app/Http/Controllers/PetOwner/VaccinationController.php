<?php

namespace App\Http\Controllers\PetOwner;

use App\Http\Controllers\Controller;
use App\Models\PetMedication;
use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.pet-owner.vaccination.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PetMedication $petMedication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PetMedication $petMedication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PetMedication $petMedication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PetMedication $petMedication)
    {
        //
    }
}
