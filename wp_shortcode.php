<?php
 /**
  * Plugin Name: shortcode Plugin demo
  * Plugin URI: https://www.example.com
  * Description: plugin for printing text, and you can change the color of the text, use [write color=blue].
  * Version: 0.1
  * Author: Muhammed Shafaf
  * Author URI: https://muhammad-shafaf123.github.io/personal/
  */

/**
* Exit if accessed directly
*/
if ( ! defined( 'ABSPATH' ) ) {
   exit;
}
/**
* Check that the class exists before trying to use it
*/
if ( !class_exists( 'WpTextShortcode' ) ) {
   class WpTextShortcode{
       public function __construct() {
           add_shortcode( 'write',array( $this, 'print_text_shortcode_callback' ) );
       }
       /**
       * shortcode callback function.
       */
       function print_text_shortcode_callback( $atts ) {
           $changes = shortcode_atts( array(
              'color' => "#000"
           ), $atts );
           $print_name = '<h2 style= "color:'.$changes['color'].';">Some text</h2>';
           return $print_name;
       }
   }
}else {
    exit;
}

new WpTextShortcode();

?>
