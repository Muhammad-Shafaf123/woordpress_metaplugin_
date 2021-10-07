<?php
/*
*Plugin Name: form personal demo
*Plugin Description: creating input field
*Version: 0.1
*Author: Muhammed Shafaf
*/

function form_creation(){
  add_meta_box('form-1','form input field', 'input_fild_call_back','post');
}
add_action('add_meta_boxes','form_creation');

function input_fild_call_back(){
  $form_field = "<input type='text' placeholder='Enter the text' >";
  echo $form_field;
}

 ?>

 <?php
 /*
  * Plugin Name: Personal Plugin demo
  * Plugin URI: https://www.google.com
  * Description: This is sample plugin
  * Version: 0.1
  * Author: Muhammed Shafaf
  * Author URI: https://www.facebook.com
  */

 /* Register meta boxes.
 function radio_button_meta_box(){
   add_meta_box('radio-1','Hello custom radio button','radio_button_display_callback','post');
 }
 add_action('add_meta_boxes','radio_button_meta_box');
 add_filter( 'the_content', 'filter_the_content_in_the_main_loop', 1 );



  function for creating html style.
 function radio_button_display_callback(){
   ?>
   <form name="form" action="" method="POST">
     <label for="hcf_author">Author</label>
     <input id="post" type="text" name="subject" >
     <label class="label-show" for="show the content">Show</label>
     <input type="checkbox" id="vehicle1" name="checked" value="Bike">
   </form>
 <?php
 $hai=get_post_data();

 }





 function filter_the_content_in_the_main_loop( $content ) {

     // Check if we're inside the main loop in a single Post.
     $content ="kaljfk;a;j";

     return $content;
 }

  add the field value to database
 function wporg_save_postdata( $post_id ) {

     if ( array_key_exists( 'subject', $_POST ) ) {
         update_post_meta($post_id,'meta_key',$_POST['subject']);
     }

 }


 function get_post_data(){
   $post = get_the_ID();
   $value = get_post_meta( $post, 'meta_key', true );
   return $value;

 }






 if (!function_exists('write_log')) {
 	function write_log ( $log )  {
 		if ( true === WP_DEBUG ) {
 			if ( is_array( $log ) || is_object( $log ) ) {
 				error_log( print_r( $log, true ) );
 			} else {
 				error_log( $log );
 			}
 		}
 	}
 }
 /*
  class WP_class{
    public function __construct(){
      add_shortcode('tbare-plugin-demo',array($this, 'print_text'));

    }
    function print_text(){
      $print_name = "This is add_shortcode manualy created";
      return $print_name;
    }
  }

 $textPrint = new WP_class();





 class MetaBoxClass {
   public function __construct() {
 	   add_action('add_meta_boxes', array($this, 'radio_button_meta_box'));
      add_action('save_post', array($this, 'save'));
 	   add_filter('the_content', array($this, 'custom_message'));
 	}
   public function radio_button_meta_box($post_type){
     $post_type = array('post','page');
     add_meta_box('radio-1',
     'Hello custom radio button',
     array($this,'radio_button_display_callback'),
     $post_type);
   }
  ////
   public function cs_meta_box_function($post) {

 		// Add an nonce field so we can check for it later.
 		wp_nonce_field('cs_nonce_check', 'cs_nonce_check_value');

 		// Use get_post_meta to retrieve an existing value from the database.
 		$custom_message = get_post_meta($post -> ID, '_cs_custom_message', true);

 		// Display the form, using the current value.
 		echo '<div style="margin: 10px 100px; text-align: center">';
 		echo '<label for="custom_message">';
 		echo '<strong><p>Add custom message to post</p></strong>';
 		echo '</label>';
 		echo '<textarea rows="3" cols="50" name="cs_custom_message">';
 		echo esc_attr($custom_message);
 		echo '</textarea>';
 		echo '</div>';
 	}



 }
 */
 ?>
