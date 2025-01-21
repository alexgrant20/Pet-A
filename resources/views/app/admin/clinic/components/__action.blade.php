<div class="join">
   <a class="join-item btn btn-primary btn-padding" href="{{ route('admin.clinic.edit', $data->id) }}">
      <i class="fa fa-pencil"></i>
   </a>
   <form action="{{ route('admin.clinic.destroy', $data->id) }}" method="POST" id="delete_form_{{ $data->id }}">
      @csrf
      @method('DELETE')

      <button type="button" class="join-item btn btn-error text-base-100 btn-padding" id="btn_delete_clinic"
         data-id="{{ $data->id }}" data-title="{{ $data->name }}">
         <i class="fa fa-trash"></i>
      </button>
   </form>
</div>
