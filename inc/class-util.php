<?php
namespace Ankur\Plugins\Prism_For_WP;
/**
 * Class Util
 * @package Ankur\Plugins\Prism_For_WP
 */
class Util
{
    private $path;

    public function __construct()
    {
        $this->path = plugin_dir_path(APFW_BASE_FILE);
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

    public function get_file_modify_time($file)
    {
        $file = $this->path . 'out/' . $file;
        if (file_exists($file)) {
            $mtime = filemtime($file);
            if ($mtime) {
                return esc_attr($mtime);
            }

        }
        return '';
    }

    public function write_file($data, $file)
    {
        $file = $this->path . 'out/' . $file;
        $handle = fopen($file, 'w');
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

    public function delete_file($file)
    {
        $file = $this->path . 'out/' . $file;
        if (file_exists($file)) {
            @unlink($file);
        }
    }

    public function minify_css($buffer)
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

    /**
     * Load view and show it to front-end
     * @param $file string File name without ext
     * @param $options array Array to be passed to view, not an unused variable
     * @throws \Exception
     */
    public function load_view($file, $options = array())
    {
        $file_path = $this->path . 'views/' . $file . '.php';
        if (is_readable($file_path)) {
            // Make array keys available as variable on view
            extract($options);
            require $file_path;
        } else {
            throw new \Exception('Unable to load template file - ' . esc_html($file_path));
        }
    }


}