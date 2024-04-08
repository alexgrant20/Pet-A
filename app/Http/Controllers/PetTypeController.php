<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StorePetTypeRequest;
use App\Http\Requests\Admin\UpdatePetTypeRequest;
use App\Models\PetType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PetTypeController extends Controller
{
    public function getList()
    {
        $petTypes = PetType::all();

        return DataTables::of($petTypes)
            ->addIndexColumn()
            ->addColumn('action', function ($petType) {
                return view('app.admin.master.pet-type.components.__action', compact('petType'));
            })
            ->make();
    }

    public function index()
    {
        return view('app.admin.master.pet-type.index');
    }

    public function create()
    {
        return view('app.admin.master.pet-type.create');
    }

    public function store(StorePetTypeRequest $request)
    {
        PetType::create($request->validated());

        return to_route('admin.petType.index')->with('success-swal', 'Pet Type Successfully Created');
    }

    public function show(PetType $petType)
    {
        //
    }

    public function edit(PetType $petType)
    {
        return view('app.admin.master.pet-type.edit', compact('petType'));
    }

    public function update(UpdatePetTypeRequest $request, PetType $petType)
    {
        $petType->update($request->validated());

        return to_route('admin.petType.index')->with('success-swal', 'Pet Type Successfully Updated');
    }

    public function destroy(PetType $petType)
    {
        //
    }
}
