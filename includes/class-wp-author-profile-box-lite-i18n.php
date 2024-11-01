<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://wensolutions.com
 * @since      1.0.0
 *
 * @package    Wp_Author_Profile_Box_Lite
 * @subpackage Wp_Author_Profile_Box_Lite/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Author_Profile_Box_Lite
 * @subpackage Wp_Author_Profile_Box_Lite/includes
 * @author     WEN Solutions <info@wensolutions.com>
 */
class Wp_Author_Profile_Box_Lite_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-author-profile-box-lite',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
