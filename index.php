
 <?php
 /*
  * Plugin Name: Personal Plugin demo
  * Plugin URI: https://www.google.com
  * Description: This is sample plugin
  * Version: 0.1
  * Author: Muhammed Shafaf
  * Author URI: https://www.facebook.com
  */

 /* root metabox class */
class MetaBoxClass{
  /* constucter call all action hooks */
  function __construct(){
     add_action('add_meta_boxes',array($this,'text_field_meta_box'));
     add_action( 'save_post', array($this,'save_post_data'));
     add_action( 'the_content',array($this, 'filter_the_content'));
  }

  public function text_field_meta_box(){
     add_meta_box('radio-1','Custom Message Box',array($this,'display_callback'),'post');
  }

 /* function for creating ul design. */
  public function display_callback($object){
     ?>
     <form name="form" action="" method="POST">
     <label for="author name">Author</label>
     <input id="meta_key" type="text" name="meta_text">
     <label class="label-show" for="show the content">Show</label>
     <input type="checkbox"  name="checked" value="true" >
     </form>
     <?php
     get_post_meta ($object->ID, "meta_box_key",true);
  }

  public function filter_the_content($content) {
     global $post;
		 //retrieve the metadata values if they exist
		 $data_field = get_post_meta($post -> ID, 'meta_key', true);
     $data_checkbox = get_post_meta($post -> ID, 'check_box_meta_key', true);
		 if (!empty($data_field) && $data_checkbox == "true") {
		     $custom_message = "<div style='font-weight:bold;text-align:center'>";
			   $custom_message .= $data_field;
			   $custom_message .= "</div>";
			   $content = $custom_message . $content;
		 }

		return $content;
  }
 /* add the field value to database */

  public function save_post_data($post_id) {
     if (isset($_POST['checked'])) {
         update_post_meta($post_id,'check_box_meta_key',$_POST['checked']);
     }else {
         update_post_meta($post_id,'check_box_meta_key',$_POST['checked']);
     }
     if ( array_key_exists( 'meta_text', $_POST ) ) {
         update_post_meta($post_id,'meta_key',$_POST['meta_text']);
     }
  }

}

new  MetaBoxClass;

?>
