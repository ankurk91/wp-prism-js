<?php

namespace Ankur\Plugins\Prism_For_WP;
/**
 * Class FrontEnd
 * @package Ankur\Plugins\Prism_For_WP
 */
class FrontEnd
{
    protected $db = [];
    protected $util;

    // Plugin dir path
    private $path;

    public function __construct()
    {
        $this->put_db_options();

        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', [$this, 'add_prism_css'], 99);
        add_action('wp_enqueue_scripts', [$this, 'add_prism_js'], 99);

        $this->util = new Util();
        $this->path = plugin_dir_path(APFW_BASE_FILE);
    }


    private function put_db_options()
    {
        $this->db = get_option(APFW_OPTION_NAME);
    }


    public function add_prism_css()
    {
        if ($this->should_enqueue() == false) return;
        // Enqueue front end css
        if (!file_exists($this->path . 'out/prism-css.min.css')) {
            // Try to create file
            $this->util->write_file($this->decide_css(), 'prism-css.min.css');
        }

        // Unique file version, every time the file get modified
        $version = $this->util->get_file_modify_time('prism-css.min.css');

        wp_enqueue_style('prism-theme', plugins_url('/out/prism-css.min.css', APFW_BASE_FILE), array(), $version);
    }

    public function add_prism_js()
    {
        if (!$this->should_enqueue()) return;

        // Enqueue front end js
        if (!file_exists($this->path . 'out/prism-js.min.js')) {
            //try to create file
            $this->util->write_file($this->decide_js(), 'prism-js.min.js');
        }

        // Unique file version, every time the file get modified
        $version = $this->util->get_file_modify_time('prism-js.min.js');
        // No dependency + enqueue to footer
        wp_enqueue_script('prism-script', plugins_url('/out/prism-js.min.js', APFW_BASE_FILE), [], $version, true);
    }

    private function should_enqueue()
    {
        if ($this->db['onlyOnPost'] == 1) {
            return is_single();
        }

        return true;
    }

    private function decide_css()
    {
        $options = $this->db;
        $themes = $this->util->get_themes_list();
        $plugins = $this->util->get_plugins_list();

        $style = file_get_contents($this->path . 'lib/themes/' . $themes[intval($options['theme'])]['file'] . '.css');

        // Check if selected plugins require css
        foreach ($options['plugin'] as $plugin) {
            if ($plugins[$plugin]['need_css'] == 1) {
                $style .= file_get_contents($this->path . 'lib/plugins/' . $plugins[$plugin]['file'] . '.css');
            }
        }

        return $this->util->minify_css($style);
    }


    private function decide_js()
    {
        $options = $this->db;
        $languages = $this->util->get_langs_list();
        $plugins = $this->util->get_plugins_list();

        // Always include core js file
        $script = file_get_contents($this->path . 'lib/prism-core.min.js');

        // Include selected languages js files
        foreach ($options['lang'] as $lang) {
            $script .= file_get_contents($this->path . 'lib/components/' . $languages[$lang]['file'] . '.min.js');
        }

        // Include selected plugin js files
        foreach ($options['plugin'] as $plugin) {
            $script .= file_get_contents($this->path . 'lib/plugins/' . $plugins[$plugin]['file'] . '.min.js');
        }

        // All js file are already minified
        return $script;
    }

}