<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
   public function login()
   {
      return view('auth.login');
   }

   public function attemptLogin(LoginRequest $request)
   {
      $login = $this->doLogin($request);

      if ($login['status'] == true) {
         Session::flash('message', 'Berhasil Masuk!');
         Session::flash('alert-class', 'alert-success');
         if (@Auth::user()->role == 1) {
            return redirect()->intended(route('admin.index')); //GANTI routenya
         } else if (@Auth::user()->role == 2) {
            return redirect()->intended(route('admin.index')); //GANTI routenya
         } else if (@Auth::user()->role == 3) {
            return redirect()->intended(route('admin.index')); //GANTI routenya
         } else if (@Auth::user()->role == 4) {
            return redirect()->intended(route('admin.index'));
         }
      } else {
         Session::flash('message', 'Gagal Masuk!');
         Session::flash('alert-class', 'alert-danger');
         return redirect()->intended(route('login'));
      };
   }

   public function logout(Request $request)
   {
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      Auth::logout();

      return to_route('login');
   }

   private function doLogin(LoginRequest $request)
   {
      $user = User::where('email', $request->email)->where('is_active', 1)->first();
      if (!$user) {
         $msg = [
            'status' => false,
            'type' => 'error-swal',
            'msg' => 'Email tidak ditemukan!',
         ];
         return $msg;
      }

      if (Carbon::now() < @$user->attempt_login_active) {
         $msg = [
            'status' => false,
            'type' => 'error-swal',
            'msg' => 'Percobaan login melebihi batas. Percobaan login Anda dapat digunakan pada ' . @$user->attempt_login_active,
         ];
         return $msg;
      }

      if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
         $msg = $this->failedLogin($user);
         return $msg;
      }

      $msg = $this->successLogin($request, $user);

      return $msg;
   }

   public function successLogin(Request $request, $user)
   {
      if ($user) {
         $user->attempt_login = 0;
         $user->attempt_login_active = null;
         $user->last_login = Carbon::now();
         $user->save();

         $msg = [
            'status' => true,
            'type' => 'success',
            'msg' => 'Selamat Datang',
         ];
      } else {
         $msg = [
            'status' => false,
            'type' => 'error-swal',
            'msg' => 'Sistem sedang mengalami gangguan, coba lagi nanti!',
         ];
      }

      return $msg;
   }

   public function failedLogin($user)
   {
      $msg = [
         'status' => false,
         'type' => 'error-swal',
         'msg' => 'Terjadi Kesalahan',
      ];

      if ($user->attempt_login < 5) {
         $user->attempt_login += 1;

         $msg['msg'] = 'Password yang digunakan salah, Percobaan gagal ' . $user->attempt_login . 'x';
      } else {
         // get timeouts
         $user->attempt_login_active = Carbon::now()->addMinutes(60);
         $user->attempt_login = 0;

         $msg['msg'] = 'Percobaan login melebihi batas. Percobaan login Anda dapat digunakan pada ' . @$user->attempt_login_active;
      }

      $user->save();

      return $msg;
   }
}