{{-- JS VALIDATION --}}
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

<script src="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script>
  $('form').submit(function(e) {
    e.preventDefault();
    const formIsValid = $(this).valid();

    if (!formIsValid) return;

    this.submit();
  })

  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.select-2').select2({
        placeholder: ''
    });
  })
</script>

@if ($errors->any())
  <script>
    let errorMessages = {
      @foreach ($errors->keys() as $error)
        @error($error)
          '{{ $error }}': '{{ $message }}',
        @enderror
      @endforeach
    };
    Object.keys(errorMessages).forEach(inputName => {
      $(`[name="${inputName}"]`).addClass("is-invalid");
      let errMessageElement = `<div class='invalid-feedback'>${errorMessages[inputName]}</div>`;
      $(errMessageElement).insertAfter(`[name="${inputName}"]`);
    });
  </script>
@endif
