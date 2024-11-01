<?php

/**
 *
 * @link              http://wensolutions.com
 * @since             1.0.0
 * @package           Wp_Author_Profile_Box_Lite
 *
 * @wordpress-plugin
 * Plugin Name:       WP Author Profile Box Lite
 * Plugin URI:        http://wensolutions.com/plugins/wp-author-profile-box-lite/
 * Description:       WP Author Profile Box Lite is an easy way to highlight author of your WordPress posts.
 * Version:           1.0.2
 * Author:            WEN Solutions
 * Author URI:        http://wensolutions.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-author-profile-box-lite
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define( 'AB_LITE_FILE_PATH', __FILE__ );
define( 'AB_LITE_BASE_PATH', dirname( __FILE__ ) );
define( 'AB_LITE_FILE_URL', plugins_url( '', __FILE__ ) );
define( 'AB_LITE_IMG_URL', AB_LITE_FILE_URL.'/admin/images/' );
define( 'AB_LITE_VERSION', '1.0.2' );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-author-profile-box-lite-activator.php
 */
function activate_wp_author_profile_box_lite() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-author-profile-box-lite-activator.php';
	Wp_Author_Profile_Box_Lite_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-author-profile-box-lite-deactivator.php
 */
function deactivate_wp_author_profile_box_lite() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-author-profile-box-lite-deactivator.php';
	Wp_Author_Profile_Box_Lite_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_author_profile_box_lite' );
register_deactivation_hook( __FILE__, 'deactivate_wp_author_profile_box_lite' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-author-profile-box-lite.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_author_profile_box_lite() {

	$plugin = new Wp_Author_Profile_Box_Lite();
	$plugin->run();

}
run_wp_author_profile_box_lite();
