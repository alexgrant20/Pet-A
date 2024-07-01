<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreVaccinationRequest;
use App\Http\Requests\Admin\UpdateVaccinationRequest;
use App\Models\PetType;
use App\Models\Vaccination;
use App\Models\Province;
use Yajra\DataTables\Facades\DataTables;

class VaccinationController extends Controller
{
    public function getList()
    {
        $vaccinations = Vaccination::with('petType')->get();

        return DataTables::of($vaccinations)
            ->addIndexColumn()
            ->addColumn('action', function ($vaccination) {
                return view('app.admin.master.vaccination.components.__action', compact('vaccination'));
            })
            ->make();
    }

    public function index()
    {
        return view('app.admin.master.vaccination.index');
    }

    public function create()
    {
        $petTypes = PetType::all();

        return view('app.admin.master.vaccination.create', compact('petTypes'));
    }

    public function store(StoreVaccinationRequest $request)
    {
        Vaccination::create($request->validated());

        return to_route('admin.master.vaccination.index')->with('success-toast', 'Vaccination Type Successfully Created');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Vaccination $vaccination)
    {
        $petTypes = PetType::all();

        return view('app.admin.master.vaccination.edit', compact('vaccination', 'petTypes'));
    }

    public function update(UpdateVaccinationRequest $request, Vaccination $vaccination)
    {
        $vaccination->update($request->validated());

        return to_route('admin.master.vaccination.index')->with('success-toast', 'Vaccination Type Successfully Updated');
    }

    public function destroy(Vaccination $vaccination)
    {
        $vaccination->delete();

        return to_route('admin.master.vaccination.index')->with('success-toast', 'Vaccination Type Successfully Deleted');
    }
}
