(function ($) {
    'use strict';

    $.fn.hasAttr = function (name) {
        return this.attr(name) !== undefined;
    };
    var plang = $("#plang-list");
    var plist = plang.find('input:checkbox');
    plist.change(function () {
        if (!$(this).is(":checked")) {
            var tid = $(this).attr('id');
            $(plist).each(function () {
                if ($(this).hasAttr('data-require')) {
                    if ('plang-' + $(this).attr('data-require') == tid) {
                        $(this).prop('checked', false).trigger('change');
                    }
                }
            });
        }
        if ($(this).hasAttr('data-require') && $(this).is(":checked")) {
            $("#plang-list").find("#plang-" + $(this).attr('data-require')).prop('checked', true).trigger('change');
        }
    });
})(jQuery);