<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://wensolutions.com
 * @since      1.0.0
 *
 * @package    Wp_Author_Profile_Box
 * @subpackage Wp_Author_Profile_Box/public/partials
 */


class Wp_Author_Profile_Box_Lite_Front {


	function __construct() {

		add_action( 'template_redirect', array( $this, 'wp_author_profile_box_content_filter' ) );
		
	}

	public function wp_author_profile_box_content_front( $content = null ) {

		global $post;

		$author_id = $post->post_author;
		$post_id   = $post->ID;
		$desc      = get_the_author_meta( 'description', $author_id );

		if ( is_single() or is_author() ) {
			$content .= self::wp_author_profile_box_content( $author_id, 'right' );
		}

		return $content;

	}

	public function wp_author_profile_box_content_front_author( $query ) {

		global $post;
		$content   = '';
		$author_id = $post->post_author;
		$post_id   = $post->ID;
		echo self::wp_author_profile_box_content( $author_id, 'right' );
	}


	public function remove_empty_tags( $content ) {
		$content = preg_replace(
			array(
				'#<p>\s*<(div|aside|section|article|header|footer)#',
				'#</(div|aside|section|article|header|footer)>\s*</p>#',
				'#</(div|aside|section|article|header|footer)>\s*<br ?/?>#',
				'#<(div|aside|section|article|header|footer)(.*?)>\s*</p>#',
				'#<p>\s*</(div|aside|section|article|header|footer)#',
			),
			array(
				'<$1',
				'</$1>',
				'</$1>',
				'<$1$2>',
				'</$1',
			),
			$content
		);

		return preg_replace( '#<p>(\s|&nbsp;)*+(<br\s*/*>)?(\s|&nbsp;)*</p>#i', '', $content );
	}

	public function wp_author_profile_box_content_filter() {
		$filter = $this->get_filter_hook();

		if ( is_author() ) {
			add_action( $filter, array( $this, 'wp_author_profile_box_content_front_author' ) );
		} else  {
			add_filter( $filter, array( $this, 'wp_author_profile_box_content_front' ), 100 );
			add_filter( $filter, array( $this, 'remove_empty_tags' ), 100 );
		}
	}

	public function get_filter_hook() {

		$hook = apply_filters( 'author_box_filter', 'the_content' );

		if ( is_author() ) {
			$hook = 'loop_start';
		}
		return $hook;
	}

	public static function wp_author_profile_box_content( $author_id = '', $template = '' ) {
		$data = '';
		if ( $author_id == null ) {
			global $post;
			$author_id = $post->post_author;
		}
		switch ( $template ) {

			case 'right':
				ob_start();
				include_once AB_LITE_BASE_PATH . '/public/partials/wp-author-profile-box-lite-public-display.php';
				$data .= ob_get_contents();
				ob_end_clean();
				break;

			default:
				ob_start();
				include_once AB_LITE_BASE_PATH . '/public/partials/wp-author-profile-box-lite-public-display.php';
				$data .= ob_get_contents();
				ob_end_clean();
		}

		$data = apply_filters( 'author_box_templates', $data );
		return $data;

	}



}

$this->loader  = new Wp_Author_Profile_Box_Lite_Loader();
$plugin_public = new Wp_Author_Profile_Box_Lite_Loader( $this->get_plugin_name(), $this->get_version() );
$public        = new Wp_Author_Profile_Box_Lite_Front();

$this->loader->add_action( 'plugins_loaded', $plugin_public, $public );

