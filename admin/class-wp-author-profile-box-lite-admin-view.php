<?php

/**
 * The file that defines the all backend settings on the plugin class
 * public-view-customizing side of the site and the admin area.
 *
 * @link       http://wensolutions.com
 * @since      1.0.0
 *
 * @package    Wp_Author_Profile_Box
 * @subpackage Wp_Author_Profile_Box/includes
 */

/**
 * The core plugin class.
 *
 * This class is the main file where all the secttings and backend page definations are defined
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wp_Author_Profile_Box
 * @subpackage Wp_Author_Profile_Box/includes
 * @author     WEN Solutions <info@wensolutions.com>
 */

class Wp_Author_Profile_Box_Lite_Settings_Page
{  
    
    /**
     * [construct all the admin settings after the class is called]
     * 
     *  @since  [1.0.0]
     *
     */

    public function __construct()
    {
        add_action( 'show_user_profile', array($this,'show_social_icon_fields')  );
        add_action( 'edit_user_profile', array($this,'show_social_icon_fields')  );
        add_action( 'personal_options_update', array($this,'update_social_icon_fields') );
        add_action( 'edit_user_profile_update', array($this,'update_social_icon_fields')  );
    }


    public function show_social_icon_fields($user){ ?>
    <h2> <?php _e('Author Box', 'wp-author-profile-box-lite'); ?> </h2>
    <div class = "social-profile">
    <h3 class = "social-head"> <?php _e(' Social profile', 'wp-author-profile-box-lite'); ?></h3>
    </div>
    <div id="ab-accordion">
        <h3><?php _e('Social links','wp-author-profile-box-lite');?></h3>
        <div>
        <table class="form-table append-table">
            <?php 
                $link   = get_user_meta( $user->ID, 'ab_social_link' );
                $select = get_user_meta( $user->ID, 'ab_select' );
                
                if(isset($link[0]))
                    $link_count = count($link[0]);
                else
                  $link_count = NULL;
                if(isset($select[0])) 
                    $select_count = count($select[0]);
                else
                  $select_count = NULL;

                if( $link_count != NULL && $select_count != NULL ) :
                    for ($i=0; $i < $link_count; $i++) { ?>
                        <tr id ="newtd" class="ab-social-td">
                            <td class ="ab-social-tr">
                              <a class="ab-remove"></a>
                                <select class="ab-select" id="absocial-icons" name="social_select[]">
                                    <option <?php selected($select[0][$i],'facebook'); ?> value="facebook"><?php _e('Facebook','wp-author-profile-box-lite');?></option>
                                    <option <?php selected($select[0][$i],'twitter'); ?> value="twitter"><?php _e('Twitter','wp-author-profile-box-lite');?></option>
                                    <option <?php selected($select[0][$i],'google'); ?> value="google"><?php _e('Google Plus','wp-author-profile-box-lite');?></option>
                                    <option <?php selected($select[0][$i],'instagram'); ?> value="instagram"><?php _e('Instagram','wp-author-profile-box-lite');?></option>
                                    <option <?php selected($select[0][$i],'wordpress'); ?> value="wordpress"><?php _e('WordPress','wp-author-profile-box-lite');?></option>
                                </select>
                                <span class="description"><?php _e('Select social type.', 'wp-author-profile-box-lite'); ?></span>
                            </td>
                            <td>
                                <input type="text" name="social[]" id="" value="<?php print esc_url( $link[0][$i]); ?>" class="regular-text" /><br />
                                <span class="description ab-description"><?php _e('Please enter a link for social media.', 'wp-author-profile-box-lite'); ?></span>
                            </td>
                    
                        </tr>
                        <?php
                    }
                else: 
                  ?>
                      <tr id="no-icon">
                            <td>
                                <span class="description ab-description"><?php _e("Seems like you have no social links. Click on the add new button to get started", 'wp-author-profile-box-lite') ; ?></span>
                            </td>              
                        </tr>
               <?php
                endif;
                ?>
        </table>
            <p class="ab-btn-append"><button id="append" class="button button-primary" value="Add New"><?php _e('Add New', 'wp-author-profile-box-lite'); ?></button></p>
            <p class="pro-msg description"> <a href = "http://themepalace.com/downloads/wp-author-profile-box/"><?php _e('Upgrade to pro to add more icons', 'wp-author-profile-box-lite'); ?> </a> </p>
        </div>
      </div>
    <?php 
    }

    function update_social_icon_fields( $user_id ) {

        if ( !current_user_can( 'edit_user', $user_id ) )
            return false;

        $social = $_POST['social'];
        $social_name = $_POST['social_select'];
        foreach ($social as $key => $value) {
          $new_social[$key] = esc_url_raw( $value );
        }
        foreach ($social_name as $key => $value) {
          $new_social_name[$key] = esc_html( $value );
        }
        update_user_meta( $user_id, 'ab_social_link', $new_social);
        update_user_meta( $user_id, 'ab_select', $new_social_name  );
    }

}

$this->loader = new Wp_Author_Profile_Box_Lite_Loader();
$plugin_admin = new Wp_Author_Profile_Box_Lite_Admin( $this->get_plugin_name(), $this->get_version() );
$backend = new Wp_Author_Profile_Box_Lite_Settings_Page();
$this->loader->add_action( 'plugins_loaded', $plugin_admin, $backend);
