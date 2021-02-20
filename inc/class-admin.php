<?php

namespace Ankur\Plugins\Prism_For_WP;
/**
 * Class Admin
 * @package Ankur\Plugins\Prism_For_WP
 */
class Admin
{
    const PLUGIN_SLUG = 'prism_options';

    /**
     * Util class instance
     * @var Util
     */
    private $util;

    public function __construct()
    {
        // Save setting upon plugin activation
        register_activation_hook(plugin_basename(APFW_BASE_FILE), [$this, 'add_default_settings']);

        // Add settings link under admin settings
        add_action('admin_menu', [$this, 'add_to_settings_menu']);

        // Add settings link to plugin list page
        add_filter('plugin_action_links_' . plugin_basename(APFW_BASE_FILE), [$this, 'add_plugin_actions_links'], 10, 2);

        // Register setting
        add_action('admin_init', [$this, 'register_plugin_settings']);

        // Add a button to mce editor
        //@link https://www.gavick.com/blog/wordpress-tinymce-custom-buttons/
        add_action('admin_head', [$this, 'add_editor_button']);
        add_action('admin_print_scripts', [$this, 'add_admin_inline_script'], 10);
        add_action('admin_print_styles', [$this, 'add_admin_inline_style'], 99);

        $this->util = new Util();
    }


    public function add_default_settings()
    {
        if (false == get_option(APFW_OPTION_NAME)) {
            add_option(APFW_OPTION_NAME, $this->get_default_options());
        }
    }

    private function get_default_options()
    {
        return [
            'plugin_ver' => APFW_PLUGIN_VERSION,
            'theme' => 2,
            'lang' => [1, 2, 3],
            'plugin' => [4],
            'onlyOnPost' => 0,
            'noAssistant' => 0,
        ];
    }

    /**
     * Register our settings, using WP settings API
     */
    public function register_plugin_settings()
    {
        register_setting(APFW_OPTION_NAME, APFW_OPTION_NAME, array($this, 'validate_form_post'));
    }


    public function add_to_settings_menu()
    {
        $page_hook_suffix = add_submenu_page(
            'options-general.php',
            'Prism Syntax Highlighter',
            'Prism Syntax Highlighter',
            'manage_options',
            self::PLUGIN_SLUG, array($this, 'show_options_page')
        );

        // We can load additional css/js to our option page here
        add_action('admin_print_scripts-' . $page_hook_suffix, [$this, 'add_settings_assets']);

    }


    public function add_plugin_actions_links($links)
    {
        if (current_user_can('manage_options')) {
            $url = add_query_arg('page', self::PLUGIN_SLUG, 'options-general.php');
            array_unshift(
                $links,
                sprintf('<a href="%s">%s</a>', esc_url($url), __('Settings'))
            );
        }

        return $links;
    }

    public function add_settings_assets()
    {
        wp_enqueue_style('prism-admin', plugins_url("/assets/options-page.css", APFW_BASE_FILE), [], APFW_PLUGIN_VERSION);
        wp_enqueue_script('prism-admin', plugins_url("/assets/options-page.js", APFW_BASE_FILE), ['jquery'], APFW_PLUGIN_VERSION, true);
    }

    public function validate_form_post($in)
    {
        $out = [];

        $out['plugin_ver'] = APFW_PLUGIN_VERSION;

        if (isset($in['theme'])) {
            $out['theme'] = intval($in['theme']);
        } else {
            $out['theme'] = 1;
        }
        if (isset($in['lang'])) {
            $out['lang'] = $in['lang'];
        } else {
            $out['lang'] = [];
            add_settings_error(APFW_OPTION_NAME, 'apfw_lang', 'At-least one language must be selected to work.');
        }
        if (isset($in['plugin'])) {
            $out['plugin'] = $in['plugin'];
        } else {
            $out['plugin'] = [];
        }

        $out['onlyOnPost'] = (isset($in['onlyOnPost'])) ? 1 : 0;
        $out['noAssistant'] = (isset($in['noAssistant'])) ? 1 : 0;

        //delete js and css files, will be re-created on front end
        $this->util->delete_file('prism-css.min.css');
        $this->util->delete_file('prism-js.min.js');

        return $out;
    }

    public function show_options_page()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        $this->util->load_view('settings', [
            'db' => get_option(APFW_OPTION_NAME),
            'themeList' => $this->util->get_themes_list(),
            'langList' => $this->util->get_langs_list(),
            'pluginList' => $this->util->get_plugins_list()
        ]);
    }


    public function add_editor_button()
    {
        if ($this->should_add_button()) {
            add_filter("mce_external_plugins", [$this, "add_tinymce_plugin"]);
            add_filter('mce_buttons', [$this, 'register_tinymce_button']);
        }
    }

    public function register_tinymce_button($buttons)
    {
        array_push($buttons, "prism_assist_button");
        return $buttons;
    }

    public function add_tinymce_plugin($plugins)
    {
        $plugins['prism_assist_button'] = plugins_url('/assets/editor-plugin.js', APFW_BASE_FILE);
        return $plugins;
    }

    public function add_admin_inline_script($hook)
    {
        if ($this->should_add_button()) {
            $lang_list = $this->util->get_langs_list();
            echo "<script type='text/javascript'> /* <![CDATA[ */";
            echo 'var prismLangs=[';
            for ($i = 1; $i <= count($lang_list); $i++) {
                if ($lang_list[$i]['in_popup'] == 1)
                    echo '{text:"' . esc_attr(ucwords($lang_list[$i]['id'])) . '", value:"' . esc_attr($lang_list[$i]['id']) . '"},';
            }
            echo "]; /* ]]> */</script>";
        }
    }

    public function add_admin_inline_style($hook)
    {
        if ($this->should_add_button()) {
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

    protected function should_add_button()
    {
        // check for user permissions
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
            return false;
        }

        // check if user don't want it
        $options = get_option(APFW_OPTION_NAME);
        if ($options['noAssistant'] == 1) {
            return false;
        }

        // check if WYSIWYG is enabled
        if (get_user_option('rich_editing') == 'true') {
            return true;
        }

        return false;
    }

}
