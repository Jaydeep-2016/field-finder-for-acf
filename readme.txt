=== Field Finder for ACF ===
Contributors: jaydipmakwana1996
Tags: acf, developer tools, debug, field finder, theme files
Requires at least: 6.3
Tested up to: 6.8
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A simple developer tool to search for where a specific ACF field is being used in your active theme files.

== Description ==

**Field Finder for ACF** helps WordPress developers quickly locate where specific Advanced Custom Fields (ACF) are used inside their theme’s `.php` files.

It searches through your active theme's directory and lists files that reference the selected ACF field using `get_field()`, `the_field()`, or `get_sub_field()`.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the WordPress 'Plugins' menu
3. Go to `Tools > Field Finder for ACF` to use it

== Changelog ==

= 1.0 =
* Initial release with core field search functionality

== Frequently Asked Questions ==

= Does this plugin work without ACF? =
No, it requires the ACF plugin to be installed and active.

= Does it search child themes? =
Yes, it uses the active theme directory (`get_stylesheet_directory()`).

== Upgrade Notice ==

= 1.0 =
Initial stable release.
