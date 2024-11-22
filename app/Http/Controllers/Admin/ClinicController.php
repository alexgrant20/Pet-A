<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClinicRequest;
use App\Http\Requests\Admin\UpdateClinicRequest;
use App\Models\City;
use App\Models\Clinic;
use App\Utilities\FieldAttachmentUploadUtility;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ClinicController extends Controller
{
   private $fieldAttachmentUploadUtility;

   public function __construct(FieldAttachmentUploadUtility $fieldAttachmentUploadUtility)
   {
      $this->fieldAttachmentUploadUtility = $fieldAttachmentUploadUtility;
   }

   public function index()
   {
      return view('app.admin.clinic.index');
   }

   public function getList()
   {
      if (!request()->ajax()) abort(404);

      $clinics = Clinic::with('city', 'attachment')->orderBy('name')->get();

      return DataTables::of($clinics)
         ->addIndexColumn()
         ->addColumn('image', function ($data) {
            return view('app.admin.clinic.components.__clinic-image', compact('data'));
         })
         ->addColumn('city', function ($data) {
            return $data->city->name;
         })
         ->addColumn('action', function ($data) {
            return view('app.admin.clinic.components.__action', compact('data'))->render();
         })
         ->make();
   }

   public function create()
   {
      $cities = City::pluck('name', 'id');
      return view('app.admin.clinic.create', compact('cities'));
   }

   public function store(StoreClinicRequest $request)
   {
      $isClinicExists = Clinic::where([
         ['name', $request->name],
         ['city_id', $request->city_id],
         ['address', $request->address]
      ])
         ->exists();

      if ($isClinicExists) return back()->with('error-toast', 'Clinic has already registered');

      $city = City::find($request->city_id);
      DB::beginTransaction();
      try {
         $clinic = Clinic::create([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'phone_number' => $request->phone_number,
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'latitude' => $city->latitude,
            'longitude' => $city->longitude
         ]);

         $this->fieldAttachmentUploadUtility
            ->setRefTable($clinic::class)
            ->setRefId($clinic->id)
            ->setFolder('clinic_image')
            ->setFieldName('clinic_image')
            ->uploadFile($request);
      } catch (\Exception $e) {
         DB::rollBack();
         return back()->with('error-toast', 'Failed to Add Clinic');
      }

      DB::commit();
      return to_route('admin.clinic.index')->with('success-toast', 'Clinic Successfuly Added');
   }

   public function edit(Clinic $clinic)
   {
      $clinic->load('attachment');
      $cities = City::pluck('name', 'id');

      return view('app.admin.clinic.edit', compact('clinic', 'cities'));
   }

   public function update(Clinic $clinic, UpdateClinicRequest $request)
   {
      $city = City::find($request->city_id);

      DB::beginTransaction();
      try {
         $clinic->update([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'phone_number' => $request->phone_number,
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'latitude' => $city->latitude,
            'longitude' => $city->longitude
         ]);

         if($request->clinic_image) {
            $this->fieldAttachmentUploadUtility
            ->setRefTable($clinic::class)
            ->setRefId($clinic->id)
            ->setFolder('clinic_image')
            ->setFieldName('clinic_image')
            ->uploadFile($request);
         }
      } catch (\Exception $e) {
         DB::rollBack();
         return back()->withInput()->with('error-toast', 'Failed to Edit Clinic');
      }

      DB::commit();
      return to_route('admin.clinic.index')->with('success-toast', 'Clinic Successfully Edited');
   }

   public function destroy(Clinic $clinic)
   {
      $clinic->delete();

      return to_route('admin.clinic.index')->with('success-toast', 'Clinic Successfully Deleted');
   }
}
