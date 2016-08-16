<?php
/*
Plugin Name: Prism For WP
Plugin URI: https://github.com/ankurk91/wp-prism-js
Description: Control and Use the Prism syntax highlighter in your WordPress site.
Version: 1.7.0
Author: Ankur Kumar
Author URI: http://ankurk91.github.io/
License: GPL2
*/
?>
<?php
/* no direct access*/
if (!defined('ABSPATH')) exit;


define('APFW_PLUGIN_VERSION', '1.7.0');
define('APFW_BASE_FILE', __FILE__);
define('APFW_PLUGIN_SLUG', 'apfw_plugin_settings');
define('APFW_OPTION_NAME', 'ank_prism_for_wp');

if (!defined('APFW_MINIFY_CSS')) {
    define('APFW_MINIFY_CSS', true);
}


class Ank_Prism_For_WP
{

    private $apfw_options = array();

    function __construct()
    {
        $this->put_db_options();

        //enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'apfw_user_style'), 99);
        add_action('wp_enqueue_scripts', array($this, 'apfw_user_script'), 99);

    }


    private function put_db_options()
    {
        $this->apfw_options = get_option(APFW_OPTION_NAME);
    }


    function get_theme_list()
    {    //base url for demos
        $base_url = 'http://prismjs.com/index.html?theme=';
        $list = array(
            1 => array('name' => 'Default', 'url' => $base_url . 'prism', 'file' => 'prism'),
            2 => array('name' => 'Coy', 'url' => $base_url . 'prism-coy', 'file' => 'prism-coy'),
            3 => array('name' => 'Dark', 'url' => $base_url . 'prism-dark', 'file' => 'prism-dark'),
            4 => array('name' => 'Okaidia', 'url' => $base_url . 'prism-okaidia', 'file' => 'prism-okaidia'),
            5 => array('name' => 'Tomorrow', 'url' => $base_url . 'prism-tomorrow', 'file' => 'prism-tomorrow'),
            6 => array('name' => 'Twilight', 'url' => $base_url . 'prism-twilight', 'file' => 'prism-twilight'),

        );
        return $list;
    }

    function get_plugin_list()
    {   //$base_url, lets not repeat code ,since domains are subject to change
        $base_url = 'http://prismjs.com/plugins/';
        //JS and related CSS file name must be same, except extension
        $list = array(
            1 => array('name' => 'Autolinker ', 'url' => $base_url . 'autolinker/', 'file' => 'prism-autolinker', 'need_css' => 1),
            2 => array('name' => 'File Highlight ', 'url' => $base_url . 'file-highlight/', 'file' => 'prism-file-highlight', 'need_css' => 0),
            3 => array('name' => 'Line Highlight', 'url' => $base_url . 'line-highlight/', 'file' => 'prism-line-highlight', 'need_css' => 1),
            4 => array('name' => 'Line Numbers', 'url' => $base_url . 'line-numbers/', 'file' => 'prism-line-numbers', 'need_css' => 1),
            5 => array('name' => 'Show Invisibles', 'url' => $base_url . 'show-invisibles/', 'file' => 'prism-show-invisibles', 'need_css' => 1),
            6 => array('name' => 'Show Language', 'url' => $base_url . 'show-language/', 'file' => 'prism-show-language', 'need_css' => 1),
            7 => array('name' => 'WebPlatform Docs', 'url' => $base_url . 'wpd/', 'file' => 'prism-wpd', 'need_css' => 1),
        );
        return $list;
    }

    function get_lang_list()
    {
        //lets keep order and requirement
        //require is the id  of some other lang
        //id will be used in tiny mce popup too
        $list = array(
            1 => array('id' => 'markup', 'name' => 'Markup', 'file' => 'prism-markup', 'require' => '', 'in_popup' => 1),
            2 => array('id' => 'css', 'name' => 'CSS', 'file' => 'prism-css', 'require' => '', 'in_popup' => 1),
            3 => array('id' => 'css-extras', 'name' => 'CSS Extras', 'file' => 'prism-css-extras', 'require' => 'css', 'in_popup' => 0),
            4 => array('id' => 'clike', 'name' => 'C-Like', 'file' => 'prism-clike', 'require' => '', 'in_popup' => 1),
            5 => array('id' => 'javascript', 'name' => 'Java-Script', 'file' => 'prism-javascript', 'require' => 'clike', 'in_popup' => 1),
            6 => array('id' => 'php', 'name' => 'PHP', 'file' => 'prism-php', 'require' => 'clike', 'in_popup' => 1),
            7 => array('id' => 'php-extras', 'name' => 'PHP Extras', 'file' => 'prism-php-extras', 'require' => 'php', 'in_popup' => 0),
            8 => array('id' => 'sql', 'name' => 'SQL', 'file' => 'prism-sql', 'require' => '', 'in_popup' => 1),
        );
        return $list;
    }

    private function get_file_m_time($file)
    {
        $file = __DIR__ . '/' . $file;
        if (file_exists($file)) {
            $mtime = filemtime($file);
            if ($mtime) {
                return esc_attr($mtime);
            }

        }
        return '';
    }

    function apfw_user_style()
    {
        if ($this->check_if_enqueue() == false) return;
        //enqueue front end css
        if (!file_exists(__DIR__ . '/prism-css.css')) {
            //try to create file
            $this->write_a_file($this->apfw_decide_css(), 'prism-css.css');
        }

        /* unique file version, every time the file get modified */
        $file_ver = $this->get_file_m_time('prism-css.css');

        wp_enqueue_style('prism-theme', plugins_url('prism-css.css', __FILE__), array(), $file_ver);
    }

    function apfw_user_script()
    {
        if ($this->check_if_enqueue() == false) return;
        //enqueue front end js
        if (!file_exists(__DIR__ . '/prism-js.js')) {
            //try to create file
            $this->write_a_file($this->apfw_decide_js(), 'prism-js.js');
        }

        /* unique file version, every time the file get modified */
        $file_ver = $this->get_file_m_time('prism-js.js');
        //no dependency + enqueue to footer
        wp_enqueue_script('prism-script', plugins_url('prism-js.js', __FILE__), array(), $file_ver, true);

    }

    private function check_if_enqueue()
    {
        $options = $this->apfw_options;
        if ($options['onlyOnPost'] == 1) {
            if (is_single()) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    private function apfw_decide_css()
    {
        $options = $this->apfw_options;
        $theme_list = $this->get_theme_list();
        $plugin_list = $this->get_plugin_list();

        $style = file_get_contents(__DIR__ . '/themes/' . $theme_list[intval($options['theme'])]['file'] . '.css');

        //check if selected plugins require css
        foreach ($options['plugin'] as $plugin) {
            if ($plugin_list[$plugin]['need_css'] == 1) {
                $style .= file_get_contents(__DIR__ . '/plugins/' . $plugin_list[$plugin]['file'] . '.css');

            }
        }
        //minify css before saving to file
        if (APFW_MINIFY_CSS == true) {
            return $this->minify_css($style);
        } else {
            return $style;
        }


    }


    private function apfw_decide_js()
    {
        $options = $this->apfw_options;
        $lang_list = $this->get_lang_list();
        $plugin_list = $this->get_plugin_list();
        //always include core js file
        $script = file_get_contents(__DIR__ . '/prism-core.min.js');
        //include selected langs  js
        foreach ($options['lang'] as $lang) {
            $script .= file_get_contents(__DIR__ . '/languages/' . $lang_list[$lang]['file'] . '.min.js');

        }
        //include selected plugin js
        foreach ($options['plugin'] as $plugin) {
            $script .= file_get_contents(__DIR__ . '/plugins/' . $plugin_list[$plugin]['file'] . '.min.js');

        }
        //all js file are already minified
        return $script;

    }

    private function write_a_file($data, $file_name)
    {
        $file_name = __DIR__ . '/' . $file_name;
        $handle = fopen($file_name, 'w');
        if ($handle) {
            if (!fwrite($handle, $data)) {
                //could not write file
                @fclose($handle);

            } else {
                //success
                @fclose($handle);

            }
        }
    }

    private function minify_css($buffer)
    {
        /* remove comments */
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        /* remove tabs, spaces, newlines, etc. */
        $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '     '), '', $buffer);
        /* remove other spaces before/after ; */
        $buffer = preg_replace(array('(( )+{)', '({( )+)'), '{', $buffer);
        $buffer = preg_replace(array('(( )+})', '(}( )+)', '(;( )*})'), '}', $buffer);
        $buffer = preg_replace(array('(;( )+)', '(( )+;)'), ';', $buffer);
        return $buffer;
    }


}


/*Init main class */
global $Ank_Prism_For_WP_Obj;
$Ank_Prism_For_WP_Obj = new Ank_Prism_For_WP();

if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX)) {

    require(__DIR__."/apfw-admin.php");

    /*Init option page class class */
    global $Ank_Prism_For_WP_Admin_Obj;
    $Ank_Prism_For_WP_Admin_Obj = new Ank_Prism_For_WP_Admin();

}


