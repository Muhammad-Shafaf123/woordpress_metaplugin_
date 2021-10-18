<?php
 /**
  * Plugin Name: Meta box Plugin.
  * Plugin URI: https://www.example.com
  * Description: meta box plugin for text field.
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
*  root metabox class
*/
if ( !class_exists( 'MetaBoxClass' ) ) {
  class MetaBoxClass {
    /**
    * constucter call all action hooks
    */
    function __construct() {
      add_action( 'add_meta_boxes',array( $this, 'text_field_meta_box' ) );
      add_action( 'save_post', array( $this, 'save_post_data' ) );
      add_filter( 'the_content',array( $this, 'filter_the_content' ) );
    }
    public function text_field_meta_box() {
      add_meta_box( 'radio-1', 'Custom Message Box', array( $this, 'display_callback' ),'post' );
    }
    /**
    * meta box callback function.
    */
    public function display_callback( $object ) {
      ?>
      <form name="form" action="" method="POST">
        <label for="author name">Author</label>
        <input id="meta_key" type="text" name="meta_text"
            value="<?php $field_value= get_post_meta ( $object->ID, "meta_key",true ); echo $field_value; ?>">
        <label class="label-show" for="show the content">Show</label>
        <input type="checkbox"  name="checked" value="true" >
        <?php wp_nonce_field( 'nonce_action', 'nonce_field' ); ?>
      </form>
      <?php
    }

    public function filter_the_content( $content ) {
      global $post;
      /**
      * retrieve the metadata values if they exist
      */
      $data_field = get_post_meta( $post -> ID, 'meta_key', true );
      $data_checkbox = get_post_meta( $post -> ID, 'check_box_meta_key', true );
      if ( !empty( $data_field ) && $data_checkbox == "true" ) {
        $custom_message = "<div style='font-weight:bold;text-align:center'>";
        $custom_message .= $data_field;
        $custom_message .= "</div>";
        $content = $custom_message . $content;
      }
        return $content;
    }
    /**
    * add the field value to database
    */
    public function save_post_data( $post_id ) {
      /**
      * check nonce
      */
      if ( !isset( $_POST['nonce_field'] ) || ! wp_verify_nonce( $_POST['nonce_field'], 'nonce_action' ) ) {
        return $post_id;
      }else {
        /**
        * check it is a valid user.
        */
        if ( !current_user_can( 'edit_post', $post_id ) ) {
          return $post_id;
        }
        if ( isset( $_POST['checked']) ) {
          /**
          * sanitize check book field
          */
          $data_checkbox_field = sanitize_text_field( $_POST['checked'] );
          update_post_meta( $post_id,'check_box_meta_key',$data_checkbox_field );
        }
        if( isset( $_POST['meta_text'] ) ) {
          /**
          * sanitize text field
          */
          $data_text_field = sanitize_text_field( $_POST['meta_text'] );
          update_post_meta( $post_id,'meta_key',$data_text_field );
        }
      }
    }
  }
}else {
    exit();
}

new  MetaBoxClass;
?>
