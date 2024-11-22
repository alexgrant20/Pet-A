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
      return view('app.auth.login');
   }

   public function attemptLogin(LoginRequest $request)
   {
      $login = $this->doLogin($request);

      if (!$login['status']) {
         return redirect()->intended(route('login'))->with($login['type'], $login['msg']);
      }

      return redirect()->intended(route('home'))->with($login['type'], $login['msg']);
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
            'msg' => 'Email not found!',
         ];
         return $msg;
      }

      if (Carbon::now() < @$user->attempt_login_active) {
         $msg = [
            'status' => false,
            'type' => 'error-swal',
            'msg' => 'Login attempts have exceeded the maximum limit. You can try again on ' . @$user->attempt_login_active,
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
            'type' => 'success-swal',
            'msg' => 'Welcome to Pet-A',
         ];
      } else {
         $msg = [
            'status' => false,
            'type' => 'error-swal',
            'msg' => 'Someting went wrong, try again later',
         ];
      }

      return $msg;
   }

   public function failedLogin($user)
   {
      $msg = [
         'status' => false,
         'type' => 'error-swal',
         'msg' => 'Something went wrong',
      ];

      if ($user->attempt_login < 5) {
         $user->attempt_login += 1;

         $msg['msg'] = 'The password is incorret. Failed attempt ' . $user->attempt_login . 'time(s)';
      } else {
         // get timeouts
         $user->attempt_login_active = Carbon::now()->addMinutes(60);
         $user->attempt_login = 0;

         $msg['msg'] = 'Login attempts have exceeded the maximum limit. You can try again on ' . @$user->attempt_login_active;
      }

      $user->save();

      return $msg;
   }
}
