
 <?php
 /*
  * Plugin Name: Personal Plugin demo
  * Plugin URI: https://www.google.com
  * Description: This is sample plugin
  * Version: 0.1
  * Author: Muhammed Shafaf
  * Author URI: https://www.facebook.com
  */

 /* Register meta boxes. */
 function radio_button_meta_box(){
   add_meta_box('radio-1','Hello custom radio button','display_callback','post');
 }
 add_action('add_meta_boxes','radio_button_meta_box');
 add_action( 'save_post', 'save_post_data' ,10,3);
 add_action( 'the_content', 'filter_the_content');




 /* function for creating html style. */
 function display_callback($object){
   ?>
   <form name="form" action="" method="POST">
     <label for="author name">Author</label>
     <input id="meta_key" type="text" name="meta_text">
     <label class="label-show" for="show the content">Show</label>
     <input type="checkbox"  name="checked" value="Bike">
   </form>
 <?php
 get_post_meta  ($object->ID, "meta_box_key",true);
 }


 function filter_the_content($content) {
		global $post;
		//retrieve the metadata values if they exist
		$data = get_post_meta($post -> ID, 'meta_key', true);
		if (!empty($data)) {
			$custom_message = "<div style='background-color: #FFEBE8;border-color: #C00;padding: 2px;margin:2px;font-weight:bold;text-align:center'>";
			$custom_message .= $data;
			$custom_message .= "</div>";
			$content = $custom_message . $content;
		}

		return $content;
	}


 /* add the field value to database */
 function save_post_data( $post_id, $post, $update) {

   if(defined("DOING AUTOSAVE")&& DOING_AUTOSAVE)
     return $post_id;

     if ( array_key_exists( 'meta_text', $_POST ) ) {
         update_post_meta($post_id,'meta_key',$_POST['meta_text']);
     }

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
 */
 ?>
