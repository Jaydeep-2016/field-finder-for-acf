<?php

/**
 * Plugin Name: Field Finder for ACF
 * Plugin URI: https://wordpress.org/plugins/field-finder-for-acf
 * Description: Find where specific ACF fields are used in your active theme files. Dev tool for WordPress.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://profiles.wordpress.org/jaydipmakwana1996/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: field-finder-for-acf
 * Requires at least: 6.3
 * Tested up to: 6.8
 * Requires PHP: 7.4
 */

defined('ABSPATH') || exit;

// Check if ACF is active
function fielffoa_is_acf_active()
{
    return function_exists('get_field');
}

// Load plugin files
add_action('plugins_loaded', function () {
    if (!fielffoa_is_acf_active()) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p><strong>Field Finder for ACF:</strong> ACF plugin is not active.</p></div>';
        });
        return;
    }

    require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
    require_once plugin_dir_path(__FILE__) . 'admin/page.php';
});

add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'tools_page_field-finder-for-acf') {
        return;
    }

    wp_enqueue_style(
        'field-finder-for-acf-style',
        plugin_dir_url(__FILE__) . 'assets/style.css',
        [],
        '1.0'
    );
});
