<?php
/**
 * Sturtevant Camp plugin
 *
 * Change this header information to suit your needs.
 *
 * @package     Sturtevant_Plugin
 * @version     1.0.0
 * @author      Greg Sweet <greg@ccdzine.com>
 * @copyright   Copyright © 2018, Greg Sweet
 * @link        https://github.com/ControlledChaos/sturtevant-plugin
 * @link        https://github.com/ControlledChaos/controlled-chaos-plugin
 * @license     GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * Plugin Name: Sturtevant Camp
 * Plugin URI:  https://github.com/ControlledChaos/sturtevant-plugin
 * Description: Functionality sepecific to the Sturtevant Camp website.
 * Version:     1.0.0
 * Author:      Controlled Chaos Design
 * Author URI:  http://ccdzine.com/
 * License:     GPL-3.0+
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Text Domain: sturtevant-plugin
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Get plugins path to check for active plugins.
 *
 * @since  1.0.0
 * @return void
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Define the parent plugin path: directory and core file name.
 *
 * @since  1.0.0
 * @return string Returns the plugin path of the parent.
 */
if ( ! defined( 'STURTEVANT_PARENT' ) ) {
	define( 'STURTEVANT_PARENT', 'burcon-plugin/burcon-plugin.php' );
}

/**
 * Define the parent plugin prefix for filters and options.
 *
 * @since  1.0.0
 * @return string Returns the prefix without.
 */
if ( ! defined( 'STURTEVANT_PARENT_PREFIX' ) ) {
	define( 'STURTEVANT_PARENT_PREFIX', 'burcon' );
}

/**
 * Define the parent plugin name.
 *
 * Used in admin notices
 *
 * @since  1.0.0
 * @return string Returns the parent plugin name.
 */
if ( ! defined( 'STURTEVANT_PARENT_NAME' ) ) {
	define( 'STURTEVANT_PARENT_NAME', 'Burcon Outfitters' );
}

/**
 * Define the child [this] plugin name.
 *
 * Used in admin notices
 *
 * @since  1.0.0
 * @return string Returns the child plugin name.
 */
if ( ! defined( 'STURTEVANT_CHILD_NAME' ) ) {
	define( 'STURTEVANT_CHILD_NAME', 'Sturtevant Camp' );
}

/**
 * Check for the plugin dependency.
 *
 * Add an admin error notice if the parent plugin is not active.
 *
 * @since  1.0.0
 * @return void
 */
if ( ! is_plugin_active( STURTEVANT_PARENT ) ) {

	add_action( 'admin_notices', 'sturtevant_parent_notice' );

}

/**
 * Get the parent plugin admin notice output.
 *
 * @since  1.0.0
 * @return void
 */
function sturtevant_parent_notice() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/partials/parent-notice.php';

}

/**
 * If the parent plugin is not active then stop here.
 *
 * @since  1.0.0
 * @return void
 */
if ( ! is_plugin_active( STURTEVANT_PARENT ) ) {
	return;
}

/**
 * Keeping the version at 1.0.0 as this is a starter plugin but
 * you may want to start counting as you develop for your use case.
 *
 * @since  1.0.0
 * @return string Returns the latest plugin version.
 */
if ( ! defined( 'STURTEVANT_VERSION' ) ) {
	define( 'STURTEVANT_VERSION', '1.0.0' );
}

/**
 * Universal slug partial for admin pages.
 *
 * This URL slug is used for various plugin admin & settings pages.
 *
 * @since  1.0.0
 * @return string Returns the URL slug of the admin pages.
 */
if ( ! defined( 'STURTEVANT_ADMIN_SLUG' ) ) {
	define( 'STURTEVANT_ADMIN_SLUG', 'sturtevant-plugin' );
}

/**
 * Define default meta image path.
 *
 * Change the path and file name to suit your needs.
 *
 * @since  1.0.0
 * @return string Returns the URL of the image.
 */
if ( ! defined( 'STURTEVANT_DEFAULT_META_IMAGE' ) ) {
	define(
		'STURTEVANT_DEFAULT_META_IMAGE',
		plugins_url( 'frontend/assets/images/default-meta-image.jpg', __FILE__ )
	);
}

/**
 * The core plugin class.
 *
 * Simply gets the initialization class file plus the
 * activation and deactivation classes.
 *
 * @since  1.0.0
 * @access public
 */
class Sturtevant_Plugin {

	/**
	 * Get an instance of the plugin class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns the instance.
	 */
	public static function instance() {

		// Varialbe for the instance to be used outside the class.
		static $instance = null;

		if ( is_null( $instance ) ) {

			// Set variable for new instance.
			$instance = new self;

			// Require the core plugin class files.
			$instance->dependencies();
		}

		// Return the instance.
		return $instance;

	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void Constructor method is empty.
	 */
	public function __construct() {}

	/**
	 * Require the core plugin class files.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void Gets the file which contains the core plugin class.
	 */
	private function dependencies() {

		// The hub of all other dependency files.
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-init.php';

		// Include the activation class.
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-activate.php';

		// Include the deactivation class.
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-deactivate.php';

	}

}
// End core plugin class.

/**
 * Put an instance of the plugin class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns the instance of the `Sturtevant_Plugin` class.
 */
function sturtevant_plugin() {

	return Sturtevant_Plugin::instance();

}

// Begin plugin functionality.
sturtevant_plugin();

/**
 * Register the activaction & deactivation hooks.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
register_activation_hook( __FILE__, '\activate_sturtevant' );
register_deactivation_hook( __FILE__, '\deactivate_sturtevant' );

/**
 * The code that runs during plugin activation.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function activate_sturtevant_addon() {

	// Run the activation class.
	sturtevant_activate();

}

/**
 * The code that runs during plugin deactivation.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function deactivate_sturtevant_addon() {

	// Run the deactivation class.
	sturtevant_deactivate();

}

/**
 * Add a link to the plugin's settings page on the plugins page.
 *
 * @param  array $links Default plugin links on the 'Plugins' admin page.
 * @since  1.0.0
 * @access public
 * @return mixed[] Returns an HTML string for the settings page link.
 *                 Returns an array of the settings link with the default plugin links.
 * @link   https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
 */
function sturtevant_addon_about_link( $links ) {

	if ( ! is_network_admin() ) {
		// Create new settings link array as a variable.
		$settings = [
			sprintf(
				'<a href="%1s" class="' . STURTEVANT_ADMIN_SLUG . '-settings-link">%2s</a>',
				admin_url( 'options-general.php?page=' . STURTEVANT_ADMIN_SLUG . '-settings' ),
				esc_attr( 'Settings', 'sturtevant-plugin' )
			),
		];

		// Merge the new settings array with the default array.
		return array_merge( $settings, $links );
	}

}
// Filter the default settings links with new array.
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'sturtevant_addon_about_link' );