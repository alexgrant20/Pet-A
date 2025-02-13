<div class="join">
  <a class="join-item btn btn-primary btn-padding" href="{{ route('admin.master.medication-type.edit', $medicationType->id) }}">
   <i class="fa fa-pencil"></i>
  </a>
  <form action="{{ route('admin.master.medication-type.destroy', $medicationType->id) }}" method="POST" id="delete_form_{{ $medicationType->id }}">
    @csrf
    @method('DELETE')

    <button type="submit" class="join-item btn btn-error text-base-100 btn-padding" id="btn_delete_medication_type"
       data-id="{{ $medicationType->id }}" data-title="{{ $medicationType->name }}">
      <i class="fa fa-trash"></i>
    </button>
  </form>
</div>