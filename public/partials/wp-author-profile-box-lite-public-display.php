<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://wensolutions.com
 * @since      1.0.0
 *
 * @package    Wp_Author_Profile_Box_Lite
 * @subpackage Wp_Author_Profile_Box_Lite/public/partials
 */
$ab_current_theme = wp_get_theme();
if( $ab_current_theme->get('TextDomain') != NULL ) 
$ab_theme_slug = $ab_current_theme->get( 'TextDomain' );
else
$ab_theme_slug = '';
?>
<div id="about-author" class="wen-author-box <?php echo esc_attr(!empty($ab_theme_slug)? 'ab-'.$ab_theme_slug:'' );?>">
    <h2 class="ab-entry-title"> <?php _e('About the author', 'wp-author-profile-box-lite'); ?></h2>
    <div class="page-section author">
        <div class="pull-left-image">
            <?php if ( get_option( 'show_avatars' ) ) : ?>
                <div class="admin-image">
                   <?php echo get_avatar(  get_the_author_meta( 'user_email'), '150', '' ); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="pull-right-content">
          <header class="ab-entry-header">
              <h2 class="ab-entry-title left-author"><?php  the_author_posts_link(); ?>  </h2>
          </header>
            <?php if(get_the_author_meta( 'description') != NULL ): ?> 
                <div class="ab-entry-content right-author-details">
                    <p><?php the_author_meta( 'description'); ?> </p>
                </div>
            <?php 
            endif; 
            $social_link = get_user_meta( get_the_author_meta( 'ID' ),'ab_social_link');
            if ($social_link != NULL ): ?>            
                <div class="ab_social_icons-left">
                    <ul class="ab-social">
                    <?php if(get_the_author_meta( 'user_url') != NULL ): ?> 
                        <li> <a target = "_blank" href="<?php the_author_meta( 'user_url');?>"> </a> </li>
                    <?php endif; ?>
                     <?php 
                        if($social_link[0]!=NULL){
                            foreach ($social_link[0] as $key => $value) { 
                                if($value != NULL){ ?>
                                <li> <a href="<?php echo esc_url($value); ?>"></a></li>
                            <?php 
                            }
                        }
                    } 
                    ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>   
    </div>
</div>


