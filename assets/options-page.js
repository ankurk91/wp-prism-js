(function ($) {
  'use strict';
  /**
   * Determines if element has given attribute
   * @param name
   * @returns {boolean}
   */
  $.fn.hasAttr = function (name) {
    return this.attr(name) !== undefined;
  };

  var $checkboxContainer = $("#plang-list");
  var $checkboxes = $checkboxContainer.find('input:checkbox');

  $checkboxes.on('change', function (e) {
    if (!$(this).is(":checked")) {
      var thisId = $(this).attr('id');
      $($checkboxes).each(function () {
        if ($(this).hasAttr('data-require')) {
          if ('plang-' + $(this).attr('data-require') === thisId) {
            $(this).prop('checked', false).trigger('change');
          }
        }
      });
    }
    if ($(this).hasAttr('data-require') && $(this).is(":checked")) {
      $checkboxContainer.find("#plang-" + $(this).attr('data-require')).prop('checked', true).trigger('change');
    }
  });
})(jQuery);