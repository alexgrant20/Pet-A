<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetOwner\StorePetRequest;
use App\Models\Breed;
use App\Models\FieldAttachmentUpload;
use App\Models\Pet;
use App\Models\PetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = auth()->user()->profile->pet;

        return view('app.pet-owner.pets.index', compact('pets'));
    }

    public function create()
    {
        $petTypes = PetType::all();
        $breeds = Breed::all();

        return view('app.pet-owner.pets.create', compact('petTypes', 'breeds'));
    }

    public function store(StorePetRequest $request)
    {
        $payload = $request->validated();
        $payload['pet_owner_id'] = Auth::user()->profile->id;

        $pet = Pet::create($payload);

        $file = $request->file('pet_image');
        $directory = 'pet-image';
        $fileName = 'test.' . $file->getClientOriginalExtension();
        $file->storeAs($directory, $fileName);

        $file = new FieldAttachmentUpload([
            'path' => $directory . '/' . $fileName
        ]);

        $file->attachment()->associate($pet)->save();

        return to_route('pet-owner.index')->with('success-toast', 'Pet Successfully Created');
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
