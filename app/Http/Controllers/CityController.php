<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreCityRequest;
use App\Http\Requests\Admin\UpdateCityRequest;
use App\Models\City;
use App\Models\Province;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function getList()
    {
        $cities = City::with('province')->get();

        return DataTables::of($cities)
            ->addIndexColumn()
            ->addColumn('action', function ($city) {
                return view('app.admin.master.city.components.__action', compact('city'));
            })
            ->make();
    }

    public function index()
    {
        return view('app.admin.master.city.index');
    }

    public function create()
    {
        $provinces = Province::all();

        return view('app.admin.master.city.create', compact('provinces'));
    }

    public function store(StoreCityRequest $request)
    {
        City::create($request->validated());

        return to_route('admin.master.city.index')->with('success-toast', 'City Successfully Created');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(City $city)
    {
        $provinces = Province::all();

        return view('app.admin.master.city.edit', compact('city', 'provinces'));
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->validated());

        return to_route('admin.master.city.index')->with('success-toast', 'City Successfully Updated');
    }

    public function destroy(City $city)
    {
        $city->delete();

        return to_route('admin.master.city.index')->with('success-toast', 'City Successfully Deleted');
    }
}
