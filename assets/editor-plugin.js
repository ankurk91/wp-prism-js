(function (window, jQuery) {
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
    if (typeof prismLangs !== 'undefined') {
        langs = prismLangs;
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
                            label: 'Show Line numbers:',
                            checked: true
                        },
                        {
                            type: 'textbox',
                            name: 'lineNumStart',
                            label: 'Start Line Number From:'
                        },
                        {
                            type: 'textbox',
                            name: 'highLight',
                            label: 'Lines to Highlight:'
                        },
                        {
                            type: 'textbox',
                            name: 'code',
                            label: 'Paste Code*:',
                            multiline: true,
                            minHeight: 250,
                            value: '',
                            onclick: function (e) {
                                jQuery(e.target).css('border-color', '');
                            }
                        },
                        {
                            type: 'label',
                            name: 'info',
                            label: 'Please Note: :',
                            text: 'These options works only if enabled on Plugin Option Page.',
                            style: 'font-size:smaller'
                        }
                    ],
                    onsubmit: function (e) {
                        var line_num = '';
                        var line_num_start = '';
                        var highlight = '';
                        var code = e.data.code.trim();
                        if (code === '') {
                            /*code is required*/
                            var window_id = this._id;
                            var inputs = jQuery('#' + window_id + '-body').find('.mce-formitem textarea');
                            jQuery(inputs.get(0)).css('border-color', 'red').focus();
                            return false;
                        }
                        if (e.data.lineNumbers) {
                            line_num = ' class="line-numbers" ';
                        }
                        if (e.data.lineNumStart && e.data.lineNumbers) {
                            line_num_start = ' data-start="' + e.data.lineNumStart + '" ';
                        }
                        if (e.data.highLight) {
                            highlight = ' data-line="' + e.data.highLight + '" ';
                        }
                        var language = e.data.language;
                        /*html entities encode*/
                        code = code.replace(/</g, '&lt;').replace(/>/g, '&gt;');
                        editor.insertContent('<pre' + highlight + line_num + line_num_start + '><code class="language-' + language + '">' + code + '</code></pre>');
                    }
                });
            }
        });
    });
})(window, jQuery);