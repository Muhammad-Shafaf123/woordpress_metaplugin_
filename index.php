<?php

/*
* Plugin Name: Personal Plugin demo
* Plugin URI: https://www.google.com
* Description: This is sample plugin
* Version: 0.1
* Author: Muhammed Shafaf
* Author URI: https://www.facebook.com
 */


/**
 * The Class.
 */
class MetaBoxClass {
  public function __construct() {
	add_action('add_meta_boxes', array($this, 'cs_add_meta_box'));
    add_action('save_post', array($this, 'save_postdata'));
	add_action('the_content', array($this, 'custom_message'));
	}

  /**
  	 * Adds the meta box container.
  	 */
  	public function cs_add_meta_box($post_type) {
  		$post_types = array('post', 'page');

  		//limit meta box to certain post types
  		if (in_array($post_type, $post_types)) {
  			add_meta_box('cs-meta',
  			'Add Custom Message',
  			array($this, 'cs_meta_box_function'),
  			$post_type,
  			'normal',
  			'high');
  		}
  	}

    public function cs_meta_box_function($post) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field('cs_nonce_check', 'cs_nonce_check_value');

		// Use get_post_meta to retrieve an existing value from the database.
		$custom_message = get_post_meta($post -> ID, '_cs_custom_message', true);

		// Display the form, using the current value.
		$view_html =  '<div style="margin: 10px 100px; text-align: center">';
		$view_html .='<label for="custom_message">';
		$view_html .='<strong><p>Add custom message to post</p></strong>';
		$view_html .='</label>';
		$view_html .='<textarea rows="3" cols="50" name="cs_custom_message">';
		$view_html .= esc_attr($custom_message);
		$view_html .='</textarea>';
		$view_html .='</div>';

    echo $view_html;
	}

  public function save_postdata($post_id) {



    function wporg_save_postdata( $post_id ) {

        if ( array_key_exists( 'subject', $_POST ) ) {
            update_post_meta($post_id,'meta_key',$_POST['subject']);
        }

    }
		// Check if our nonce is set.
		if (!isset($_POST['cs_nonce_check_value']))
			return $post_id;

		$nonce = $_POST['cs_nonce_check_value'];

		// Verify that the nonce is valid.
		if (!wp_verify_nonce($nonce, 'cs_nonce_check'))
			return $post_id;

		// If this is an autosave, our form has not been submitted,
		//     so we don't want to do anything.
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;

		// Check the user's permissions.
		if ('page' == $_POST['post_type']) {

			if (!current_user_can('edit_page', $post_id))
				return $post_id;

		} else {

			if (!current_user_can('edit_post', $post_id))
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$data = sanitize_text_field($_POST['cs_custom_message']);

		// Update the meta field.
		update_post_meta($post_id, '_cs_custom_message', $_POST['cs_custom_message']);
	}


  public function custom_message($content) {
		global $post;
		//retrieve the metadata values if they exist
		$data = get_post_meta($post -> ID, '_cs_custom_message', true);
		if (!empty($data)) {
			$custom_message = $data;
			$custom_message .= "</div>";
			$content = $custom_message . $content;
		}

		return $content;
	}
}
new MetaBoxClass;
