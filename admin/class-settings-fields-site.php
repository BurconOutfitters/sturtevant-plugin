<?php
/**
 * Settings for site customization.
 *
 * Extends the parent plugin site settings.
 *
 * @package    Sturtevant_Plugin
 * @subpackage Admin
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace CC_Addon\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Settings for site customization.
 *
 * @since  1.0.0
 * @access public
 */
class Settings_Fields_Site {

	/**
	 * Holds the values to be used in the fields callbacks.
	 *
	 * @var array
	 */
	private $options;

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

		}

		// Return the instance.
		return $instance;

	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
    public function __construct() {

		// Register settings sections and fields.
		add_action( 'admin_init', [ $this, 'settings' ], 11 );

	}

	/**
	 * Plugin site settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 *
	 * @link  https://codex.wordpress.org/Settings_API
	 */
	public function settings() {

		/**
		 * Add a settings section for the new tab.
		 *
		 * @since 1.0.0
		 */
		add_settings_section(
			'sturtevant-site-extended',
			sprintf(
				'%1s %2s',
				get_bloginfo( 'name' ),
				__( 'Extended Settings', 'sturtevant-plugin' )
			),
			[ $this, 'sturtevant_field_section_extended_callback' ],
			'sturtevant-site-extended'
		);

		// Add a demo field to the new section.
		add_settings_field(
			'sturtevant_demo_extended_field',
			__( 'Demo Field', 'sturtevant-plugin' ),
			[ $this, 'sturtevant_demo_extended_field_callback' ],
			'sturtevant-site-extended',
			'sturtevant-site-extended',
			[ esc_html__( 'Check this box', 'sturtevant-plugin' ) ]
		);

		register_setting(
			'sturtevant-site-extended',
			'sturtevant_demo_extended_field'
		);

		/**
		 * Admin menu settings.
		 *
		 * @since 1.0.0
		 */

		// Hide this plugin's settings page.
		add_settings_field(
			'sturtevant_hide_addon_settings',
			__( 'Hide Addon Settings', 'sturtevant-plugin' ),
			[ $this, 'sturtevant_hide_addon_settings_callback' ],
			STURTEVANT_PARENT_PREFIX . '-site-admin-menu',
			STURTEVANT_PARENT_PREFIX . '-site-admin-menu',
			[ sprintf(
				'%1s %2s %3s',
				esc_html__( 'Hide the', 'sturtevant-plugin' ),
				STURTEVANT_CHILD_NAME,
				esc_html__( 'link in the admin menu', 'sturtevant-plugin' )
			) ]
		);

		register_setting(
			STURTEVANT_PARENT_PREFIX . '-site-admin-menu',
			'sturtevant_hide_addon_settings'
		);

	}

	/**
	 * New tab section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Extra arguments passed into the callback function.
	 * @return mixed[]
	 */
	public function sturtevant_field_section_extended_callback() {

		$html = sprintf(
			'<p class="description">%1s %2s %3s</p>',
			esc_html( 'This demo tab was added by the', 'sturtevant-plugin' ),
			STURTEVANT_PARENT_NAME,
			esc_html( 'plugin.', 'sturtevant-plugin' )
		);

		echo $html;

	}

	/**
	 * Demo field in the new section.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Extra arguments passed into the callback function.
	 * @return mixed[]
	 */
	public function sturtevant_demo_extended_field_callback( $args ) {

		$option = get_option( 'sturtevant_demo_extended_field' );

		$html = '<p><input type="checkbox" id="sturtevant_demo_extended_field" name="sturtevant_demo_extended_field" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="sturtevant_demo_extended_field"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Hide this plugin's settings page.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Extra arguments passed into the callback function.
	 * @return mixed[]
	 */
	public function sturtevant_hide_addon_settings_callback( $args ) {

		$option = get_option( 'sturtevant_hide_addon_settings' );

		$html = '<p><input type="checkbox" id="sturtevant_hide_addon_settings" name="sturtevant_hide_addon_settings" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="sturtevant_hide_addon_settings"> '  . $args[0] . '</label></p>';

		echo $html;

	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function sturtevant_settings_fields_site() {

	return Settings_Fields_Site::instance();

}

// Run an instance of the class.
sturtevant_settings_fields_site();