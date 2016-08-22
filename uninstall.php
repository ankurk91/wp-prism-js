<?php

/**
 * Uninstall file for this Plugin
 * This file will be used to remove all traces of this plugin when uninstalled
 */


// If uninstall not called from WordPress do exit

if (!defined('WP_UNINSTALL_PLUGIN'))
    exit;

/*
 * Remove the database entry created by this plugin
 */

delete_option('ank_prism_for_wp');

