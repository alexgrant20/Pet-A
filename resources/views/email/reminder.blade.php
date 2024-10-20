<!DOCTYPE html>
<html>

<body style="font-family: Arial, sans-serif; background-color: #f2f2f2; padding: 20px;">
   <div
      style="background-color: #ffffff; padding: 20px; border: 1px solid #ddd; border-radius: 10px; max-width: 600px; margin: 0 auto; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
      <div
         style="background-color: #e37b58; padding: 10px; border-radius: 10px 10px 0 0; color: white; text-align: center;">
         <h2 style="margin: 0;">Reminder: {{ $notification->title }} for {{ $notification->pet->name }}</h2>
      </div>
      <div style="padding: 20px; font-size: 14px; color: #555; line-height: 1.6;">
         <p>Dear {{ $notification->user->name }},</p>
         <p>This is a friendly reminder about your {{ $notification->title }} for {{ $notification->pet->name }} on {{ $notification->date_start->format('d M Y') }} at {{ $notification->date_start->format('H:i') }}.</p>
         @if ($notification->link)
            <p>To find out more about this appointment</p>

            <a href="{{ $notification->link }}" style="color: #ffffff; text-decoration: none; background-color: #e37b58; padding: 10px; border-radius: 5px; border: 0;">
               See Appointment
            </a>
         @endif
         <p>We look forward to seeing you and {{ $notification->pet->name }} soon!</p>
      </div>
      <div style="font-size: 12px; color: #999; margin-top: 20px; text-align: center;">
         Sincerely,<br>
         The Team at Pet-A
      </div>
   </div>
</body>

</html>
