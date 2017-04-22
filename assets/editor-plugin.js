(function (window, $) {
  'use strict';

  /**
   * Custom Trim function
   * @returns {string}
   */
  String.prototype.trim = function () {
    return this.replace(/^\s+|\s+$/g, '');
  };

  /**
   * Get language list from inline script
   */
  var langs = [];
  if (typeof window.prismLangs !== 'undefined') {
    langs = window.prismLangs;
  }
  tinymce.PluginManager.add('prism_assist_button', function (editor, url) {
    editor.addButton('prism_assist_button', {
      title: 'Prism Assistant',
      text: 'Prism',
      type: false,
      icon: 'apfw-icon',
      onclick: function () {
        editor.windowManager.open({
          title: 'Prism Syntax Highlighter Assistant',
          width: 550,
          height: 450,
          body: [
            {
              type: 'listbox',
              name: 'language',
              label: 'Language* :',
              values: langs,
              value: langs[0].value
            },
            {
              type: 'checkbox',
              name: 'lineNumbers',
              label: 'Show line numbers:',
              checked: true
            },
            {
              type: 'textbox',
              name: 'lineNumStart',
              label: 'Start line number from:'
            },
            {
              type: 'textbox',
              name: 'highLight',
              label: 'Lines to highlight:'
            },
            {
              type: 'textbox',
              name: 'code',
              label: 'Paste code*:',
              multiline: true,
              minHeight: 250,
              value: '',
              onclick: function (e) {
                $(e.target).css('border-color', '');
              }
            },
            {
              type: 'label',
              name: 'info',
              label: 'Note:',
              text: 'These options works only if enabled on Plugin Option Page.',
              style: 'font-size:smaller'
            }
          ],
          onsubmit: function (e) {
            var lineNum = '',
                lineNumStart = '',
                highlight = '',
                code = e.data.code.trim();

            // Code is required
            if (code === '') {
              var windowId = this._id;
              var inputs = $('#' + windowId + '-body').find('.mce-formitem textarea');
              $(inputs.get(0)).css('border-color', 'red').focus();
              return false;
            }
            if (e.data.lineNumbers) {
              lineNum = ' class="line-numbers" ';
            }
            if (e.data.lineNumStart && e.data.lineNumbers) {
              lineNumStart = ' data-start="' + e.data.lineNumStart + '" ';
            }
            if (e.data.highLight) {
              highlight = ' data-line="' + e.data.highLight + '" ';
            }
            var language = e.data.language;
            // HTML entities encode
            code = code.replace(/</g, '&lt;').replace(/>/g, '&gt;');
            editor.insertContent('<pre' + highlight + lineNum + lineNumStart + '><code class="language-' + language + '">' + code + '</code></pre>');
          }
        });
      }
    });
  });
})(window, jQuery);