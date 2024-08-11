<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
   public function adminChat($sessionId)
   {
      $countMessage = Message::where('session_id', $sessionId)->count();

      if($countMessage == 0) abort(404);

      return view('app.admin.chat.show', compact('sessionId'));
   }

   public function index()
   {
      $adminId = User::role('admin')->pluck('id');

      $user = Message::with('user')
         ->groupBy('user_id')->whereNotIn('user_id', $adminId->toArray())
         ->get(['user_id'])
         ->pluck('user');

      return view('app.admin.chat.index', compact('user'));
   }

   public function clientChat($sessionId)
   {
      if($sessionId !== Auth::id()) abort(404);

      return view('app.pet-owner.chat.index', compact('sessionId'));
   }

   public function fetchMessages($sessionId)
   {
      $messages = Message::where('session_id', $sessionId)
         ->orderBy('created_at', 'asc')
         ->get();

      return response()->json($messages);
   }

   public function sendMessage(Request $request)
   {
      $message = new Message();
      $message->user_id = Auth::id();
      $message->session_id = $request->input('sessionId');
      $message->message = $request->input('message');
      $message->save();

      return response()->json(['status' => 'Message sent!']);
   }
}
