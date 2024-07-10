{{-- Modified From /vendor/jsvalidation/bootstrap5.php --}}
@php
   $payload = [];
   try {
       $payload = Crypt::decrypt($validator['selector']);
   } catch (\Exception $e) {
       $payload['selector'] = $validator['selector'];
   }
   $payload['ignore'] = $payload['ignore'] ?? $validator['ignore'];
   $payload['need_loading'] = $payload['need_loading'] ?? false;
@endphp

<script>
   jQuery(document).ready(function() {
      const datepickerFormatNormalizer = (value) => {
         return value.replaceAll("/", "-");
      };

      $("<?= $payload['selector'] ?>").each(function() {
         let validateOptions = {
            errorElement: 'div',
            errorClass: 'invalid-feedback',

            <?php if ($payload['need_loading']): ?>
            submitHandler: function(form) {
               $.LoadingOverlay("show");
               form.submit();
            },
            <?php endif; ?>

            errorPlacement: function(error, element) {
               if (element.hasClass('select2-hidden-accessible')) {
                  error.insertAfter(element.parent().find('.select2-container'));
               } else {
                  error.insertAfter(element);
               }
            },
            highlight: function(element) {
               // add the Bootstrap error class to the control group
               $(element).removeClass('is-valid').addClass('is-invalid');
            },

            <?php if (isset($payload['ignore']) && is_string($payload['ignore'])): ?>

            ignore: "<?= $payload['ignore'] ?>",
            <?php endif; ?>


            unhighlight: function(element) {
               $(element).removeClass('is-invalid').addClass('is-valid');
            },

            success: function(element) {
               // remove the Boostrap error class from the control group
               $(element).removeClass('is-invalid').addClass('is-valid');

               if ($(element).parent().find('.filepond--root').length > 0) {
                  // filepond after upload file
                  let filepondRoot = element.parent().find('.filepond--root');
                  filepondRoot.parent().find('.invalid-feedback').remove()
                  let filepondPanelRoot = filepondRoot.find('.filepond--panel-root');
                  let filepondFile = filepondRoot.find('.filepond--file');
                  filepondPanelRoot.css('border', '0px')
                  filepondFile.css('background-color', '#1CC88A')
               }
            },

            focusInvalid: true,
            <?php if (Config::get('jsvalidation.focus_on_error')): ?>
            invalidHandler: function(form, validator) {
               if (!validator.numberOfInvalids())
                  return;

               $('html, body').animate({
                  scrollTop: $(validator.errorList[0].element).offset().top
               }, <?= Config::get('jsvalidation.duration_animate') ?>);

            },
            <?php endif; ?>

            rules: <?= json_encode($validator['rules']) ?>
         };

         if (Object.keys(validateOptions.rules).length > 0) {
            for (const inputName in validateOptions.rules) {
               const needReformating = $(`input[name='${inputName}']`).hasClass('need-datepicker-reformat');
               if (needReformating) {
                  validateOptions.rules[inputName].normalizer = datepickerFormatNormalizer;
               }
            }
         }
         $(this).validate(validateOptions);
      });
   });
</script>
