<?php

namespace App\Jobs;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail; // Ensure this mailable exists

class NotificationJob implements ShouldQueue
{
   use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   /**
    * Create a new job instance.
    */
   public function __construct() {}

   /**
    * Execute the job.
    */
   public function handle(): void
   {
      $datetimeStart = now();
      $datetimeEnd = now()->addMinutes(60);

      $notifications = Notification::with('user', 'pet')
         ->where('date_start', '>=', $datetimeStart)
         ->where('date_start', '<=', $datetimeEnd)
         ->where('is_emailed', false)
         ->get();

      $notificationNeedToUpdate = [];

      foreach ($notifications as $notification) {
         try {
            Mail::send('email.reminder', [
               'notification' => $notification
            ], function ($message) use ($notification) {
               $message->to($notification->user->email);
               $message->subject($notification->title);
            });

            $notificationNeedToUpdate[] = $notification->id;

         } catch (\Exception $e) {
            // \Log::error('Failed to send notification email', [
            //    'notification_id' => $notification->id,
            //    'error' => $e->getMessage(),
            // ]);
         }
      }

      Notification::whereIn('id', $notificationNeedToUpdate)->update(['is_emailed' => true]);
   }
}
