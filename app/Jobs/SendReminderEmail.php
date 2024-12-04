<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notification;

    /**
     * Create a new job instance.
     *
     * @param $notification
     */
    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::send('email.reminder', [
            'notification' => $this->notification,
        ], function ($message) {
            $message->to($this->notification->user->email);
            $message->subject($this->notification->title);
        });
    }
}
