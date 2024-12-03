<?php

namespace App\Http\Controllers;

use App\Interfaces\RoleInterface;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller implements RoleInterface
{
   public function adminChat($sessionId)
   {
      $countMessage = Message::where('session_id', $sessionId)->count();

      Message::where([
         ['session_id', $sessionId],
         ['is_read', 0]
      ])->update(['is_read' => 1]);

      if ($countMessage == 0) abort(404);

      return view('app.admin.chat.show', compact('sessionId'));
   }

   public function index()
   {
      $adminId = User::withoutRole('pet-owner')->pluck('id');

      $user = Message::with('user')
         ->selectRaw('user_id, MIN(is_read::int) as is_read')
         ->whereNotIn('user_id', $adminId->toArray())
         ->groupBy('user_id')
         ->orderBy('is_read', 'asc')
         ->get();

      return view('app.admin.chat.index', compact('user'));
   }

   public function clientChat($sessionId)
   {
      if ($sessionId !== Auth::id()) abort(404);

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

      if (!Auth::user()->hasRole(self::ROLE_ADMIN)) {
         $adminId = User::role('admin')->pluck('id');

         foreach ($adminId as $id) {
            Notification::create([
               'user_id' => $id,
               'title' => 'You have new message from ' . Auth::user()->name,
               'link' => route('admin.chat.show', $request->input('sessionId')),
               'is_emailed' => true
            ]);
         }
      }

      return response()->json(['status' => 'Message sent!']);
   }
}
