<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreMedicationTypeRequest;
use App\Http\Requests\Admin\UpdateMedicationTypeRequest;
use App\Models\MedicationType;
use Yajra\DataTables\Facades\DataTables;

class MedicationTypeController extends Controller
{
    public function getList()
    {
        $medicationTypes = MedicationType::all();

        return DataTables::of($medicationTypes)
            ->addIndexColumn()
            ->addColumn('action', function ($medicationType) {
                return view('app.admin.master.medication-type.components.__action', compact('medicationType'));
            })
            ->make();
    }

    public function index()
    {
        return view('app.admin.master.medication-type.index');
    }

    public function create()
    {
        return view('app.admin.master.medication-type.create');
    }

    public function store(StoreMedicationTypeRequest $request)
    {
        MedicationType::create($request->validated());

        return to_route('admin.master.medication-type.index')->with('success-toast', 'Medication Type Successfully Created');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(MedicationType $medicationType)
    {
        return view('app.admin.master.medication-type.edit', compact('medicationType'));
    }

    public function update(UpdateMedicationTypeRequest $request, MedicationType $medicationType)
    {
        $medicationType->update($request->validated());

        return to_route('admin.master.medication-type.index')->with('success-toast', 'Medication Type Successfully Updated');
    }

    public function destroy(MedicationType $medicationType)
    {
        $medicationType->delete();

        return to_route('admin.master.medication-type.index')->with('success-toast', 'Medication Type Successfully Deleted');
    }
}
