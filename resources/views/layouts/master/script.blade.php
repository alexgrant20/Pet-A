{{-- JS VALIDATION --}}
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

<script src="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
   rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
   const airDatePickerDefaultConfiguration = {
      locale: {
         days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
         daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
         daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
         months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
            'September', 'October', 'November', 'December'
         ],
         monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
            'Nov', 'Dec'
         ],
         today: 'Today',
         clear: 'Clear',
         dateFormat: 'dd-MM-yyyy',
         timeFormat: 'hh:mm aa',
         firstDay: 0
      },
      autoClose: true,
   }

   $(document).ready(function() {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

      $('.select-2').select2();

      document.querySelectorAll(".date-picker").forEach(function(el) {
         new AirDatepicker(el, airDatePickerDefaultConfiguration);
      });
   });

   function convertToRupiah(angka) {
      let rupiah = '';
      const angkarev = angka.toString().split('').reverse().join('');
      for (let i = 0; i < angkarev.length; i++)
         if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
      return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
   }

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
