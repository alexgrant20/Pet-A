<div class="flex flex-wrap gap-1">
   @foreach ($data as $schedule)
      <div class="badge badge-primary">
         {{ date('H:i', strtotime($schedule->start_time)) }}
      </div>
   @endforeach
</div>