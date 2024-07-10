<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServicePriceRequest;
use App\Http\Requests\Admin\UpdateServicePriceRequest;
use App\Models\ServicePrice;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ServicePriceController extends Controller
{
   public function index()
   {
      return view('app.admin.service-price.index');
   }

   public function getList()
   {
      if (!request()->ajax()) abort(404);

      $servicePrice = ServicePrice::with('serviceType')
         ->where('veterinarian_id', Auth::user()->profile_id)
         ->get();

      return DataTables::of($servicePrice)
         ->addIndexColumn()
         ->addColumn('service_name', function ($data) {
            return $data->serviceType->name;
         })
         ->addColumn('price', function ($data) {
            return "Rp" . number_format($data->price);
         })
         ->addColumn('action', function ($data) {
            return view('app.admin.service-price.components.__action', compact('data'))->render();
         })
         ->make();
   }

   public function create()
   {
      $serviceTypes = ServiceType::pluck('name', 'id');
      return view('app.admin.service-price.create', compact('serviceTypes'));
   }

   public function store(StoreServicePriceRequest $request)
   {
      $isServicePriceExists = ServicePrice::where([
         ['veterinarian_id', Auth::user()->profile_id],
         ['service_type_id', $request->service_type_id]
         ])
         ->exists();

         if ($isServicePriceExists) return back()->with('error-toast', 'Service Has Already Exists!');
         DB::beginTransaction();
         try {
            ServicePrice::create([
               'veterinarian_id' => Auth::user()->profile_id,
               'service_type_id' => $request->service_type_id,
               'price' => $request->price
            ]);

         } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error-toast', 'Failed to Add Service Data');
         }

         DB::commit();
         return to_route('admin.service-price.index')->with('success-toast', 'Successfully Adding Service Data');
      }

      public function edit(ServicePrice $servicePrice)
      {
         $servicePrice;
         $serviceTypes = ServiceType::pluck('name', 'id');

      return view('app.admin.service-price.edit', compact('servicePrice', 'serviceTypes'));
   }

   public function update(ServicePrice $servicePrice, UpdateServicePriceRequest $request)
   {
      DB::beginTransaction();
      try {
         $servicePrice->update([
            'service_type_id' => $request->service_type_id,
            'price' => $request->price
         ]);
      } catch (\Exception $e) {
         DB::rollBack();
         return back()->withInput()->with('error-toast', 'Failed to Update Service Data');
      }

      DB::commit();
      return to_route('admin.service-price.index')->with('success-toast', 'Successfully Updating Service Data');
   }

   public function destroy(ServicePrice $servicePrice)
   {
      $servicePrice->delete();

      return to_route('admin.service-price.index')->with('success-toast', 'Successfully Deleting Service Data');
   }
}
