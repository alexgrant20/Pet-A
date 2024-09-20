<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
   /**
    * Write code on Method
    *
    * @return response()
    */
   public function showForgetPasswordForm()
   {
      return view('app.auth.forget-password');
   }

   /**
    * Write code on Method
    *
    * @return response()
    */
   public function submitForgetPasswordForm(Request $request)
   {
      $request->validate([
         'email' => 'required|email|exists:users',
      ]);

      $user = User::where('email', $request->email)->whereNotNull('password')->first();

      if(!$user) return back()->with('message', 'E-mail not found!');

      $token = hash_hmac('sha256', Str::random(40), config('app.key'));

      DB::table('password_resets')->insert([
         'email' => $request->email,
         'token' => $token,
         'created_at' => Carbon::now()
      ]);

      Mail::send('email.forget-password', ['token' => $token], function ($message) use ($request) {
         $message->to($request->email);
         $message->subject('Reset Password');
      });

      return back()->with('message', 'We have e-mailed your password reset link!');
   }
   /**
    * Write code on Method
    *
    * @return response()
    */
   public function showResetPasswordForm($token)
   {
      $tokenExists = DB::table('password_resets')
         ->where([
            'token' => $token
         ])
         ->first();

      if (!$tokenExists) {
         abort(404);
      }

      return view('app.auth.reset-password', ['token' => $token]);
   }

   /**
    * Write code on Method
    *
    * @return response()
    */
   public function submitResetPasswordForm(Request $request)
   {
      $request->validate([
         'password' => 'required|string|min:6|confirmed',
         'password_confirmation' => 'required'
      ]);

      $updatePassword = DB::table('password_resets')
         ->where([
            'token' => $request->token
         ])
         ->first();

      if (!$updatePassword) {
         return back()->withInput()->with('error', 'Invalid token!');
      }

      User::where('email', $updatePassword->email)
         ->update(['password' => Hash::make($request->password)]);

      DB::table('password_resets')->where(['email' => $request->email])->delete();

      return to_route('login')->with('message', 'Your password has been changed!');
   }
}
