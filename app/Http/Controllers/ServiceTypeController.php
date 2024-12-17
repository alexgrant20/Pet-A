<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StorePetTypeRequest;
use App\Http\Requests\Admin\StoreServiceTypeRequest;
use App\Http\Requests\Admin\UpdatePetTypeRequest;
use App\Http\Requests\Admin\UpdateServiceTypeRequest;
use App\Models\Appointment;
use App\Models\PetType;
use App\Models\ServiceType;
use Yajra\DataTables\DataTables;

class ServiceTypeController extends Controller
{
    public function getList()
    {
        $serviceTypes = ServiceType::all();

        return DataTables::of($serviceTypes)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('app.admin.master.service-type.components.__action', compact('data'));
            })
            ->make();
    }

    public function index()
    {
        return view('app.admin.master.service-type.index');
    }

    public function create()
    {
        return view('app.admin.master.service-type.create');
    }

    public function store(StoreServiceTypeRequest $request)
    {
        ServiceType::create($request->validated());

        return to_route('admin.master.service-type.index')->with('success-toast', 'Service Type Successfully Created');
    }

    public function edit(ServiceType $serviceType)
    {
        return view('app.admin.master.service-type.edit', compact('serviceType'));
    }

    public function update(UpdateServiceTypeRequest $request, ServiceType $serviceType)
    {
        $serviceType->update($request->validated());

        return to_route('admin.master.service-type.index')->with('success-toast', 'Service Type Successfully Updated');
    }

    public function destroy(ServiceType $serviceType)
    {
        $hasActiveAppointment = Appointment::where('service_type_id', $serviceType->id)->exists();
        if($hasActiveAppointment) return(to_route('admin.master.service-type.index')->with('error-toast', 'Service Type has active appointments'));

        $serviceType->delete();

        return to_route('admin.master.service-type.index')->with('success-toast', 'Service Type Successfully Deleted');
    }
}
