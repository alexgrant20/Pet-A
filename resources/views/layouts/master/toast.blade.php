<script>
  toastr.options = {
    "positionClass": "toast-top-right",
    "timeOut": "6000",
    "extendedTimeOut": "100",
  }
</script>


@if ($message = Session::get('success-toast'))
  <script>
    toastr.success(`{!! $message !!}`, 'Success', {
      "iconClass": 'toast-success'
    });
  </script>
@endif

@if ($message = Session::get('error-toast'))
  <script>
    toastr.error(`{!! $message !!}`, 'Error', {
      "iconClass": 'toast-error'
    });
  </script>
@endif

@if ($message = Session::get('warning-toast'))
  <script>
    toastr.warning(`{!! $message !!}`, 'Warning', {
      "iconClass": 'toast-warning'
    });
  </script>
@endif

@if ($message = Session::get('info-toast'))
  <script>
    toastr.info(`{!! $message !!}`, 'Info', {
      "iconClass": 'toast-info'
    });
  </script>
@endif
