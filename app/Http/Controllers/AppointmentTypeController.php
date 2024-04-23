<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreAppointmentTypeRequest;
use App\Http\Requests\Admin\UpdateAppointmentTypeRequest;
use App\Models\AppointmentType;
use Yajra\DataTables\Facades\DataTables;

class AppointmentTypeController extends Controller
{
    public function getList()
    {
        $appointmentTypes = AppointmentType::all();

        return DataTables::of($appointmentTypes)
            ->addIndexColumn()
            ->addColumn('action', function ($appointmentType) {
                return view('app.admin.master.appointment-type.components.__action', compact('appointmentType'));
            })
            ->make();
    }

    public function index()
    {
        return view('app.admin.master.appointment-type.index');
    }

    public function create()
    {
        return view('app.admin.master.appointment-type.create');
    }

    public function store(StoreAppointmentTypeRequest $request)
    {
        AppointmentType::create($request->validated());

        return to_route('admin.master.appointment-type.index')->with('success-toast', 'Appointment Type Successfully Created');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(AppointmentType $appointmentType)
    {
        return view('app.admin.master.appointment-type.edit', compact('appointmentType'));
    }

    public function update(UpdateAppointmentTypeRequest $request, AppointmentType $appointmentType)
    {
        $appointmentType->update($request->validated());

        return to_route('admin.master.appointment-type.index')->with('success-toast', 'Appointment Type Successfully Updated');
    }

    public function destroy(AppointmentType $appointmentType)
    {
        $appointmentType->delete();

        return to_route('admin.master.appointment-type.index')->with('success-toast', 'Appointment Type Successfully Deleted');
    }
}
