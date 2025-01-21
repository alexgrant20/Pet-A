<div class="join">
  <a class="join-item btn btn-primary btn-padding" href="{{ route('admin.master.breed.edit', $breed->id) }}">
   <i class="fa fa-pencil"></i>
  </a>
  <form action="{{ route('admin.master.breed.destroy', $breed->id) }}" method="POST" id="delete_form_{{ $breed->id }}">
    @csrf
    @method('DELETE')

    <button type="submit" class="join-item btn btn-error text-base-100 btn-padding" id="btn_delete_breed"
       data-id="{{ $breed->id }}" data-title="{{ $breed->name }}">
      <i class="fa fa-trash"></i>
    </button>
  </form>
</div>