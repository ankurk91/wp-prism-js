<?php

namespace Ankur\Plugins\Prism_For_WP;
/**
 * Plugin Name: Prism For WP
 * Plugin URI: https://github.com/ankurk91/wp-prism-js
 * Description: Control and Use the Prism syntax highlighter in your WordPress site.
 * Version: 3.0.0
 * Author: Ankur Kumar
 * Author URI: http://ankurk91.github.io/
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 */

// No direct access
if (!defined('ABSPATH')) exit;

define('APFW_PLUGIN_VERSION', '3.0.0');
define('APFW_BASE_FILE', __FILE__);
define('APFW_OPTION_NAME', 'ank_prism_for_wp');

require __DIR__ . "/inc/class-util.php";
require __DIR__ . "/inc/class-frontend.php";
require __DIR__ . "/inc/class-admin.php";


if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX)) {
    new Admin();
} else {
    new FrontEnd();
}

