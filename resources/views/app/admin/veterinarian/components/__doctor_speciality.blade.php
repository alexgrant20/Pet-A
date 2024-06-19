<div class="flex flex-wrap gap-1">
  @foreach ($veterinarian->petType as $petType)
    <div class="badge badge-primary">
      {{ $petType->name }}
    </div>
  @endforeach
</div>
