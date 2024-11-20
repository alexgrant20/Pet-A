<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use App\Interfaces\RoleInterface;
use App\Models\City;
use App\Models\Clinic;
use App\Models\Province;
use App\Models\Veterinarian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class UserManagementController extends Controller implements RoleInterface
{
   public function index()
   {
      return view('app.admin.user-management.index');
   }

   public function getList($roleId)
   {
      if (!request()->ajax()) abort(404);

      $user = User::with('profile')->role((int)$roleId)->get();

      $dataTable =  DataTables::of($user)
         ->addIndexColumn()
         ->addColumn('action', function ($data) {
            return view('app.admin.user-management.components.__action', compact('data'))->render();
         });

      if ($roleId == self::ROLE_VETERINARIAN) {
         $dataTable = $dataTable->addColumn('clinic_name', function ($data) {
            return $data->profile->clinic->name;
         });
      }

      return $dataTable->make();
   }

   public function create()
   {
      $provinces = Province::get();
      $cities = City::get();
      return view('app.admin.user-management.create', compact('provinces', 'cities'));
   }

   public function store(StoreUserRequest $request)
   {
      DB::beginTransaction();
      try {
         $clinic = Clinic::create([
            'name' => $request->clinic_name,
            'city_id' => $request->city_id,
            'phone_number' => $request->clinic_phone_number,
            'address' => $request->clinic_address,
            'zip_code' => $request->zip_code
         ]);
         Veterinarian::create([
            'clinic_id' => $clinic->id,
            'length_of_service' => $request->length_of_service
         ])
            ->user()
            ->create([
               'id' => Str::uuid(),
               'name' => $request->name,
               'phone_number' => $request->phone_number,
               'email' => $request->email,
               'password' => Hash::make($request->password),
               'is_active' => 1,
            ])
            ->assignRole(self::ROLE_VETERINARIAN);
      } catch (\Exception $e) {
         DB::rollback();
         return back()->with('error-toast', 'Dokter Hewan Gagal Ditambahkan');
      }

      DB::commit();
      return to_route('admin.user-management.index')->with('success-toast', 'Dokter Hewan Berhasil Ditambahkan');
   }

   public function edit(User $user)
   {
      $user->load('profile');

      $cities = City::get();
      if ($user->hasRole(self::ROLE_VETERINARIAN)) $user->profile->load('clinic');
      return view('app.admin.user-management.edit', compact('user', 'cities'));
   }

   public function update(User $user, UpdateUserRequest $request)
   {
      DB::beginTransaction();
      try {
         if ($user->hasRole(self::ROLE_VETERINARIAN)) {
            $user->profile->clinic->update([
               'name' => $request->clinic_name,
               'city_id' => $request->city_id,
               'phone_number' => $request->clinic_phone_number,
               'address' => $request->clinic_address,
               'zip_code' => $request->zip_code
            ]);

            $user->profile->update(['length_of_service' => $request->length_of_service]);
         }

         $user->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'is_active' => $request->is_active
         ]);
      } catch (\Exception $e) {
         DB::rollBack();
         return back()->with('error-toast', 'Gagal Mengubah Data Pengguna');
      }

      DB::commit();
      return to_route('admin.user-management.index')->with('success-toast', 'Berhasil Mengubah Data Pengguna');
   }

   public function resetPassword(User $user)
   {
      return view('app.admin.user-management.reset-password', compact('user'));
   }

   public function resetPasswordStore(ResetPasswordRequest $request, User $user)
   {
      $user->update([
         'password' => $request->password
      ]);

      return to_route('admin.user-management.index')->with('success-toast', 'Berhasil Mengubah Kata Sandi Pengguna');
   }

   public function destroy(User $user)
   {
      if(!$user->hasRole(self::ROLE_ADMIN)) $user->profile->delete();
      $user->delete();

      return to_route('admin.user-management.index')->with('success-toast', 'Berhasil Menghapus Data Pengguna');
   }
}
