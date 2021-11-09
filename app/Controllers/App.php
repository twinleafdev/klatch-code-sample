<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }
    public static function siteLogo()
    {
      $image = get_field('logo', 'option');

      $size = array('600', '600'); // (thumbnail, medium, large, full or custom size)

      if( $image ) {
          return wp_get_attachment_image( $image, $size , "", array( "class" => "img-fluid logo" ) );
      }
    }
    public static function footerLogo()
    {
      $image = get_field('footer_logo', 'option');

      $size = array('600', '600'); // (thumbnail, medium, large, full or custom size)

      if( $image ) {
          return wp_get_attachment_image( $image, $size , "", array( "class" => "img-fluid footer-logo w-md-25" ) );
      }
    }
		public function primarymenu()
		{
		    $args = array(
		        'theme_location'    => 'primary_navigation',
		        'container_class' => 'menu-main-menu-container w-100',
		        'menu_class'        => 'nav navbar-nav',
		        'depth'             => 2,
		        'walker'            => new \App\wp_bootstrap4_navwalker(),
		    );
		    return $args;
		}
		public function footermenu()
		{
		    $args = array(
		        'theme_location'    => 'footer_links',
		        'container_class' => 'menu-footer-menu-container',
		        'menu_class'        => 'nav footer-links',
		        'depth'             => 1,
		        'walker'            => new \App\wp_bootstrap4_navwalker(),
		    );
		    return $args;
		}
    public static function footerBg()
    {
      $image = get_field('footer_bg', 'option');

      $size = array('2000', '2000'); // (thumbnail, medium, large, full or custom size)

      if( $image ) {
          return wp_get_attachment_image( $image, $size , "", array( "class" => "img_fluid jumbo-bg footer_bg" ) );
      }
    }
    public static function getImage($field, $imgsize, $classes )
    {
      $image = get_field($field);
      $imgsize = "full";
      $classes = "img_fluid";
      
      $size = array($imgsize); // (thumbnail, medium, large, full or custom size)

      if( $image ) {
          return wp_get_attachment_image( $image, $size , "", array( "class" => $classes ) );
      }
    }
    public static function stringify($string)
    {
      //Lower case everything
      $string = strtolower($string);
      //Make alphanumeric (removes all other characters)
      $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
      //Clean up multiple dashes or whitespaces
      $string = preg_replace("/[\s-]+/", " ", $string);
      //Convert whitespaces and underscore to dash
      $string = preg_replace("/[\s_]/", "-", $string);
      return $string;
    }
    public static function modelNumbers()
    {
      $model_number = "";
        // Check rows exists.
      if( have_rows('models', get_the_ID()) ):
          // Loop through rows.
          $i=0;
          
          while( have_rows('models', get_the_ID()) ) : the_row();
      
              // Load sub field value.
             // $model_number .= "<p class='m-0'>Model ".get_sub_field('model_number')." | Range ".get_sub_field('range')."</p>"; 
              $model_number .= "<p class='m-0'>Range: ".get_sub_field('range')."</p>"; 
      
              // Do something...
              
              $i++;
          // End loop.
          endwhile; 
      return $model_number;
      // No value.
      else :
          // Do something...
      endif;
    }   
    public static function pageWidth()
    {
      $class = "";
/*
      if(is_page_template('views/template-sidebar.blade.php')) {
        $class = "-fluid";
      }
*/
      if( is_page_template('views/template-full-width.blade.php') || is_front_page() ) {
        $class = "-fluid";
      }
      
      return $class;
    }
}
