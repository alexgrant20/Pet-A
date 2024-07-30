<div class="join">
   <a class="join-item btn btn-primary btn-padding"
      href="{{ route('admin.clinic.edit', $data->id) }}">
      <i class="fa fa-pencil"></i>
   </a>
   <form action="{{ route('admin.appointment-schedule.destroy', $data->id) }}" method="POST">
      @csrf
      @method('DELETE')

      <button type="submit" class="join-item btn btn-error text-base-100 btn-padding">
         <i class="fa fa-trash"></i>
      </button>
   </form>
</div>
