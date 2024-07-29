{{-- JS VALIDATION --}}
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

<script src="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
   rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
   $('form').submit(function(e) {
      e.preventDefault();
      const formIsValid = $(this).valid();

      if (!formIsValid) return;

      this.submit();
   })

   $(document).ready(function() {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

      $('.select-2').select2();
   })

   function previewImageWithSelector(input, previewImageSelector, defaultImage) {
      const url = $(input).val();
      const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
      if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext ==
            "jpg")) {
         const reader = new FileReader();

         reader.onload = function(e) {
            $(previewImageSelector).attr('src', e.target.result);
         }
         reader.readAsDataURL(input.files[0]);
      } else {
         $(previewImageSelector).attr('src', defaultImage);
      }
   };
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
