<div class="join">
  <a class="join-item btn btn-primary btn-padding" href="{{ route('admin.petType.edit', $petType->id) }}">
   <i class="fa fa-pencil"></i>
  </a>
  <a class="join-item btn btn-accent text-base-100 btn-padding" href="{{ route('admin.petType.edit', $petType->id) }}">
    <i class="fa fa-paw"></i>
  </a>
  <form action="{{ route('admin.petType.destroy', $petType->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class="join-item btn btn-error text-base-100 btn-padding">
      <i class="fa fa-trash"></i>
    </button>
  </form>
</div>