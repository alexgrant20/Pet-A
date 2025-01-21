<div class="join">
  <a class="join-item btn btn-primary btn-padding" href="{{ route('admin.master.pet-type.edit', $petType->id) }}">
   <i class="fa fa-pencil"></i>
  </a>
  <a class="join-item btn btn-accent text-base-100 btn-padding" href="{{ route('admin.master.breed.index', ['pet_type_id' => $petType->id]) }}">
    <i class="fa fa-paw"></i>
  </a>
  <form action="{{ route('admin.master.pet-type.destroy', $petType->id) }}" method="POST" id="delete_form_{{ $petType->id }}">
    @csrf
    @method('DELETE')

    <button type="button" class="join-item btn btn-error text-base-100 btn-padding" id="btn_delete_pet_type"
       data-id="{{ $petType->id }}" data-title="{{ $petType->name }}">
      <i class="fa fa-trash"></i>
    </button>
  </form>
</div>
