@push('script')
 <script>
    $(document).ready(function() {
      const firstError = $('.error-alert:first');

      // check if there are error alerts
      if (firstError.length) {
        // scroll to the first error
        $('html, body').animate({
          scrollTop: firstError.offset().top - 250
        }, 400, 'swing', function() {
          // focus on the closest input field
          firstError.closest('.form-group').find('.form-control').focus();
        });
      } else {
        // focus on the first element with autofocus
        $('[autofocus]').focus();
      }
    })
  </script>
@endpush
