<?php

/**
 * Settings Page for this Plugin
 * Needs main class object also
 */
class Ank_Prism_For_WP_Admin
{


    function __construct()
    {
        /*save setting upon plugin activation*/
        register_activation_hook(plugin_basename(APFW_BASE_FILE), array($this, 'add_default_settings'));

        /* Add settings link under admin settings */
        add_action('admin_menu', array($this, 'add_to_settings_menu'));
        /* Add settings link to plugin list page */
        add_filter('plugin_action_links_' . plugin_basename(APFW_BASE_FILE), array($this, 'add_plugin_actions_links'), 10, 2);

        /*for register setting*/
        add_action('admin_init', array($this, 'register_plugin_settings'));

        //add a button to mce editor
        //@source: https://www.gavick.com/blog/wordpress-tinymce-custom-buttons/
        add_action('admin_head', array($this, 'apfw_add_editor_button'));
        add_action('admin_print_scripts', array($this, 'apfw_admin_inline_script'), 10);
        add_action('admin_print_styles', array($this, 'apfw_admin_inline_style'), 99);

    }   //end constructor


    function add_default_settings()
    {

        if (get_option(APFW_OPTION_NAME) == false) {
            add_option(APFW_OPTION_NAME, $this->get_default_options());
        }

    }

    private function get_default_options()
    {
        return array(
            'plugin_ver' => APFW_PLUGIN_VERSION,
            'theme' => 2,
            'lang' => array(1, 2, 3),
            'plugin' => array(4),
            'onlyOnPost' => 0,
            'noAssistant' => 0,
        );
    }

    /*Register our settings, using WP settings API*/
    function register_plugin_settings()
    {
        register_setting(APFW_OPTION_NAME, APFW_OPTION_NAME, array($this, 'validate_form_post'));
    }


    function add_to_settings_menu()
    {
        $page_hook_suffix = add_submenu_page('options-general.php', 'Prism For WP', 'Prism For WP', 'manage_options', APFW_PLUGIN_SLUG, array($this, 'show_options_page'));

        /* add help drop down menu on option page  wp v3.3+ */
        add_action("load-$page_hook_suffix", array($this, 'add_help_menu_tab'));

    }


    function add_plugin_actions_links($links)
    {

        if (current_user_can('manage_options')) {
            $url = add_query_arg('page', APFW_PLUGIN_SLUG, 'options-general.php');
            array_unshift(
                $links,
                sprintf('<a href="%s">%s</a>', esc_url($url), __('Settings'))
            );
        }

        return $links;
    }


    function validate_form_post($in)
    {
        $out = array();

        $out['plugin_ver'] = APFW_PLUGIN_VERSION;

        if (isset($in['theme'])) {
            $out['theme'] = intval($in['theme']);
        } else {
            $out['theme'] = 1;
        }
        if (isset($in['lang'])) {
            $out['lang'] = $in['lang'];
        } else {
            $out['lang'] = array();
            add_settings_error(APFW_OPTION_NAME, 'apfw_lang', 'At-least one language must be selected to work');
        }
        if (isset($in['plugin'])) {
            $out['plugin'] = $in['plugin'];
        } else {
            $out['plugin'] = array();
        }

        $out['onlyOnPost'] = (isset($in['onlyOnPost'])) ? 1 : 0;
        $out['noAssistant'] = (isset($in['noAssistant'])) ? 1 : 0;

        //delete js and css files, will be re-created on front end
        $this->delete_a_file('prism-css.css');
        $this->delete_a_file('prism-js.js');

        return $out;
    }

    function show_options_page()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        global $Ank_Prism_For_WP_Obj;
        ?>
        <!--option page start-->
        <style type="text/css">
            div.meta-col {
                width: 32.5%;
                vertical-align: top;
                display: inline-block
            }

            @media screen and (max-width: 782px) {
                div.meta-col {
                    width: 99%;
                    display: block
                }
            }

            .hndle {
                text-align: center;
                cursor: default !important;
                background: #fdfdfd;
                border-bottom-color: #DFDFDF !important;
            }
        </style>
        <div class="wrap">
            <h2>Prism For WP
                <small>(v<?php echo APFW_PLUGIN_VERSION ?>)</small>
            </h2>
            <form action="<?php echo admin_url('options.php') ?>" method="post" id="apfw_form">
                <?php
                settings_fields(APFW_OPTION_NAME);
                $options = get_option(APFW_OPTION_NAME);
                ?>
                <p style="text-align: center">
                    <button class="button button-primary" type="submit" name="save_apfw_form" value="Save »">Save
                        Settings
                    </button>
                </p>
                <div id="poststuff">
                    <div class="postbox meta-col">
                        <h3 class="hndle"><i class="dashicons-before dashicons-admin-appearance"
                                             style="color: #02af00"> </i><span>Select a Theme</span></h3>

                        <div class="inside">
                            <?php
                            $theme_list = $Ank_Prism_For_WP_Obj->get_theme_list();
                            for ($i = 1; $i <= count($theme_list); $i++) {
                                echo '<input ';
                                echo ($options['theme'] == $i) ? ' checked ' : '';
                                echo 'name="' . APFW_OPTION_NAME . '[theme]" value="' . $i . '" id="ptheme-' . $i . '" type="radio">';
                                echo '<label for="ptheme-' . $i . '">' . $theme_list[$i]['name'] . "</label>";
                                echo '&emsp;<a target="_blank" href="' . $theme_list[$i]['url'] . '">Preview</a><br>';
                            }
                            ?>
                        </div>
                    </div>
                    <!--end post box-->
                    <div class="postbox meta-col">
                        <h3 class="hndle"><i class="dashicons-before dashicons-format-aside"
                                             style="color: #5b27af"> </i><span>Select Languages</span></h3>

                        <div class="inside" id="plang-list">
                            <?php
                            $lang_list = $Ank_Prism_For_WP_Obj->get_lang_list();
                            for ($i = 1; $i <= count($lang_list); $i++) {
                                echo '<input ';
                                echo (in_array($i, $options['lang'])) ? ' checked ' : '';
                                echo ($lang_list[$i]['require'] !== '') ? ' data-require="' . $lang_list[$i]['require'] . '" ' : '';
                                echo ' name="' . APFW_OPTION_NAME . '[lang][]" value="' . $i . '" id="plang-' . $lang_list[$i]['id'] . '" type="checkbox">';
                                echo '<label for="plang-' . $lang_list[$i]['id'] . '">' . $lang_list[$i]['name'] . "</label>";
                                echo ($lang_list[$i]['require'] !== '') ? '&emsp;<i>(Requires: ' . $lang_list[$i]['require'] . ')</i>' : '';
                                echo '<br>';
                            }
                            ?>
                        </div>
                    </div>
                    <!--end post box-->
                    <div class="postbox meta-col">
                        <h3 class="hndle"><i class="dashicons-before dashicons-admin-plugins"
                                             style="color: #af0013"> </i><span>Select Plugins</span></h3>

                        <div class="inside">
                            <?php
                            $plugin_list = $Ank_Prism_For_WP_Obj->get_plugin_list();
                            for ($i = 1; $i <= count($plugin_list); $i++) {
                                echo '<input ';
                                echo (in_array($i, $options['plugin'])) ? ' checked ' : '';
                                echo ' name="' . APFW_OPTION_NAME . '[plugin][]" value="' . $i . '" id="pplugin-' . $i . '" type="checkbox">';
                                echo '<label for="pplugin-' . $i . '">' . $plugin_list[$i]['name'] . "</label>";
                                echo '&emsp;<a target="_blank" href="' . $plugin_list[$i]['url'] . '">View Demo</a><br>';
                            }
                            ?>
                        </div>
                    </div>
                    <!--end post box-->
                </div>
                <!--end post stuff-->
                <hr>
                <p>
                    <input name="<?php echo APFW_OPTION_NAME ?>[onlyOnPost]" id="p_onlyOnPost"
                           type="checkbox" <?php checked($options['onlyOnPost'], 1); ?>>
                    <label for="p_onlyOnPost">Enqueue Prism files (CSS+JS) only to post/single pages</label>&ensp;
                    <input name="<?php echo APFW_OPTION_NAME ?>[noAssistant]" id="p_noAssistant"
                           type="checkbox" <?php checked($options['noAssistant'], 1); ?>>
                    <label for="p_noAssistant">Don't show Assistant Button in editor</label>
                </p>
                <hr>
            </form>
            <!--end form-->
            Created with &hearts; by <a target="_blank" href="http://ankurk91.github.io/"> Ankur Kumar</a> |
            View <a target="_blank" href="http://www.prismjs.com">Original Developer Site </a>for Demos |
            Fork on <a target="_blank" href="https://github.com/ankurk91/wp-prism-js">GitHub</a>
            <!--end dev info-->
            <script type="text/javascript">
                (function ($) {
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
            </script>
            <?php if (isset($_GET['debug']) || WP_DEBUG == true) {
                echo '<hr><p><h5>Showing Debugging Info:</h5><pre>';
                var_dump($options);
                echo '</pre></p><hr>';
            } ?>
        </div> <!--end wrap-->
        <!--options page ends here -->
        <?php
    }//end function apfw_option_page

    private function delete_a_file($file)
    {
        $file = __DIR__ . '/' . $file;
        if (file_exists($file)) {
            @unlink($file);
        }
    }

    function add_help_menu_tab()
    {
        /*get current screen obj*/
        $curr_screen = get_current_screen();

        $curr_screen->add_help_tab(
            array(
                'id' => 'apfw-overview',
                'title' => 'Overview',
                'content' => '<p><strong>Thanks for using this plugin.</strong><br>' .
                    'This plugin allows you to control and use <i>Prism Syntax Highlighter</i> on your website. Just configure options below and ' .
                    'save your settings.Then use something like this in your posts.' .
                    '<code>&lt;pre&gt;&lt;code class="language-css"&gt;p { color: red }&lt;/code&gt;&lt;/pre&gt;</code>' .
                    '<br>You can also use in editor <i>Prism Assistant Button</i>.</p>'

            )
        );

        $curr_screen->add_help_tab(
            array(
                'id' => 'apfw-troubleshoot',
                'title' => 'Troubleshoot',
                'content' => '<p><strong>Things to remember</strong>' .
                    '<ul>' .
                    '<li>If you are using a cache/performance plugin, you need to flush/delete your site cache after  saving settings here.</li>' .
                    '<li>Only selected languages are available at this time. Stay tuned for more.</li>' .
                    '<li>Please make sure that plugin\'s folder is writable, because we create new files each time you save settings here.</li>' .
                    '</ul></p>'

            )
        );
        $curr_screen->add_help_tab(
            array(
                'id' => 'apfw-more-info',
                'title' => 'More',
                'content' => '<p><strong>Need more information ?</strong><br>' .
                    'A brief FAQ is available <a href="https://wordpress.org/ank-prism-for-wp/faq/" target="_blank">here</a><br>' .
                    'You can also check out instructions from original developer <a href="http://www.prismjs.com" target="_blank">here</a> .<br>' .
                    'Support is only available on WordPress Forums, click <a href="https://wordpress.org/support/plugin/ank-prism-for-wp" target="_blank">here</a> to ask anything about this plugin.<br>' .
                    'You can also report a bug at plugin&apos;s GitHub <a href="https://github.com/ankurk91/wp-prism-js" target="_blank">page</a>.' .
                    ' I will try to reply as soon as possible. </p>'

            )
        );

        /*help sidebar links */
        $curr_screen->set_help_sidebar(
            '<p><strong>Quick Links</strong></p>' .
            '<p><a href="https://wordpress.org/ank-prism-for-wp/faq/" target="_blank">Plugin FAQ</a></p>' .
            '<p><a href="https://github.com/ankurk91/wp-prism-js" target="_blank">Plugin Home</a></p>'
        );
    }

    public function apfw_add_editor_button()
    {
        if ($this->apfw_check_if_btn_can_be() == true) {
            add_filter("mce_external_plugins", array($this, "afpw_add_tinymce_plugin"));
            add_filter('mce_buttons', array($this, 'afpw_register_tinymce_button'));
        }

    }

    function afpw_register_tinymce_button($buttons)
    {
        array_push($buttons, "afpw_assist_button");
        return $buttons;
    }

    function afpw_add_tinymce_plugin($plugin_array)
    {
        $plugin_array['afpw_assist_button'] = plugins_url('/apfw-editor-plugin.min.js', APFW_BASE_FILE);
        return $plugin_array;
    }

    function apfw_admin_inline_script($hook)
    {
        if ($this->apfw_check_if_btn_can_be() == true) {
            global $Ank_Prism_For_WP_Obj;
            $lang_list = $Ank_Prism_For_WP_Obj->get_lang_list();
            echo "<script type='text/javascript'> /* <![CDATA[ */";
            echo 'var apfw_lang=[';
            for ($i = 1; $i <= count($lang_list); $i++) {
                if ($lang_list[$i]['in_popup'] == 1)
                    echo '{text:"' . esc_attr(ucwords($lang_list[$i]['id'])) . '", value:"' . esc_attr($lang_list[$i]['id']) . '"},';
            }
            echo "]; /* ]]> */</script>";

        }
    }

    function apfw_admin_inline_style($hook)
    {
        if ($this->apfw_check_if_btn_can_be() == true) {
            ?>
            <style type="text/css"> .mce-i-apfw-icon:before {
                    content: '\f499';
                    font: 400 20px/1 dashicons;
                    padding: 0;
                    vertical-align: top;
                    -webkit-font-smoothing: antialiased;
                    -moz-osx-font-smoothing: grayscale;
                } </style>
            <?php
        }
    }

    private function apfw_check_if_btn_can_be()
    {
        // check user permissions
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
            return false;
        }

        //check if user don't want the
        $options = get_option(APFW_OPTION_NAME);
        if ($options['noAssistant'] == 1)
            return false;
        // check if WYSIWYG is enabled
        if (get_user_option('rich_editing') == 'true') {
            return true;
        }
        return false;
    }


}
