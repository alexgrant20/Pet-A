<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreBreedRequest;
use App\Http\Requests\Admin\UpdateBreedRequest;
use App\Models\Breed;
use App\Models\PetType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BreedController extends Controller
{
    public function getList()
    {
        $breeds = Breed::with('petType')->get();

        return DataTables::of($breeds)
            ->addIndexColumn()
            ->addColumn('action', function ($breed) {
                return view('app.admin.master.breed.components.__action', compact('breed'));
            })
            ->make();
    }

    public function index(Request $request)
    {
        $petTypeId = $request->petTypeId;

        return view('app.admin.master.breed.index', compact('petTypeId'));
    }

    public function create()
    {
        $petTypes = PetType::all();

        return view('app.admin.master.breed.create', compact('petTypes'));
    }

    public function store(StoreBreedRequest $request)
    {
        Breed::create($request->validated());

        return to_route('admin.master.breed.index')->with('success-toast', 'Breed Successfully Created');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Breed $breed)
    {
        $petTypes = PetType::all();

        return view('app.admin.master.breed.edit', compact('breed', 'petTypes'));
    }

    public function update(UpdateBreedRequest $request, Breed $breed)
    {
        $breed->update($request->validated());

        return to_route('admin.master.breed.index')->with('success-toast', 'Breed Successfully Updated');
    }

    public function destroy(Breed $breed)
    {
        $breed->delete();

        return to_route('admin.master.breed.index')->with('success-toast', 'Breed Successfully Deleted');
    }
}
