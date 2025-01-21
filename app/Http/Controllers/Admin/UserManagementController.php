<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use App\Interfaces\RoleInterface;
use App\Models\Appointment;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

   public function edit(User $user)
   {
      $user->load('profile');

      $cities = City::get();
      return view('app.admin.user-management.edit', compact('user', 'cities'));
   }

   public function update(UpdateUserRequest $request, User $user)
   {
      DB::beginTransaction();
      try {
         $user->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'is_active' => $request->is_active
         ]);
      } catch (\Exception $e) {
         DB::rollBack();
         return back()->with('error-toast', 'Something went wrong');
      }

      DB::commit();
      return to_route('admin.user-management.index')->with('success-toast', 'Successfully Edit User Data');
   }

   public function resetPassword(User $user)
   {
      return view('app.admin.user-management.reset-password', compact('user'));
   }

   public function resetPasswordStore(ResetPasswordRequest $request, User $user)
   {
      $user->update([
         'password' => Hash::make($request->password)
      ]);

      return to_route('admin.user-management.index')->with('success-toast', 'Successfully Change User Password');
   }

   public function destroy(User $user)
   {
      $hasActiveAppointment = Appointment::when($user->hasRole(self::ROLE_PET_OWNER), function ($q) use ($user) {
         $q->where('pet_owner_id', $user->profile->id);
      })
         ->when($user->hasRole(self::ROLE_VETERINARIAN), function ($q) use ($user) {
            $q->where('veterinarian_id', $user->profile->id);
         })
         ->where([
            ['is_cancelled', false],
            ['finished_at', null]
         ])
         ->exists();

      if ($hasActiveAppointment)
         return to_route('admin.user-management.index')->with('error-swal', 'User has active appointments');

      if (!$user->hasRole(self::ROLE_ADMIN)) $user->profile->delete();

      $user->delete();

      return to_route('admin.user-management.index')->with('success-toast', 'Successfully Deleted User');
   }
}
