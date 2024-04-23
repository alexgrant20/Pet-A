<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreVaccinationTypeRequest;
use App\Http\Requests\Admin\UpdateVaccinationTypeRequest;
use App\Models\PetType;
use App\Models\VaccinationType;
use App\Models\Province;
use Yajra\DataTables\Facades\DataTables;

class VaccinationTypeController extends Controller
{
    public function getList()
    {
        $vaccinationTypes = VaccinationType::with('petType')->get();

        return DataTables::of($vaccinationTypes)
            ->addIndexColumn()
            ->addColumn('action', function ($vaccinationType) {
                return view('app.admin.master.vaccination-type.components.__action', compact('vaccinationType'));
            })
            ->make();
    }

    public function index()
    {
        return view('app.admin.master.vaccination-type.index');
    }

    public function create()
    {
        $petTypes = PetType::all();

        return view('app.admin.master.vaccination-type.create', compact('petTypes'));
    }

    public function store(StoreVaccinationTypeRequest $request)
    {
        VaccinationType::create($request->validated());

        return to_route('admin.master.vaccination-type.index')->with('success-toast', 'Vaccination Type Successfully Created');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(VaccinationType $vaccinationType)
    {
        $petTypes = PetType::all();

        return view('app.admin.master.vaccination-type.edit', compact('vaccinationType', 'petTypes'));
    }

    public function update(UpdateVaccinationTypeRequest $request, VaccinationType $vaccinationType)
    {
        $vaccinationType->update($request->validated());

        return to_route('admin.master.vaccination-type.index')->with('success-toast', 'Vaccination Type Successfully Updated');
    }

    public function destroy(VaccinationType $vaccinationType)
    {
        $vaccinationType->delete();

        return to_route('admin.master.vaccination-type.index')->with('success-toast', 'Vaccination Type Successfully Deleted');
    }
}
