
 <?php
 /*
  * Plugin Name: Personal Plugin demo
  * Plugin URI: https://www.google.com
  * Description: This is sample plugin
  * Version: 0.1
  * Author: Muhammed Shafaf
  * Author URI: https://www.facebook.com
  */
  class WP_class{
    public function __construct(){
      add_shortcode('write',array($this, 'print_text'));

    }
    function print_text($atts){
      $changes = shortcode_atts(array(
        'color' => "#000"
      ),$atts);
      $print_name = '<h2 style= "color:'.$changes['color'].';">Some text</h2>';
      return $print_name;
    }
  }

  $textPrint = new WP_class();

?>
