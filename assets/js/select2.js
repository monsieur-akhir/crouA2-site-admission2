(function($) {
  'use strict';

  if ($(".select2").length) {
    $(".select2").select2(
      {
        placeholder: "Selectionner l'element",
        allowClear: false
    });
  }
  if ($(".js-example-basic-multiple").length) {
    $(".js-example-basic-multiple").select2();
  }
})(jQuery);