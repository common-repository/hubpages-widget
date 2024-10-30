<?php
/*
Plugin Name: HubPages Widget
Plugin URI:
Description: A very simple plugin to add a HubPages Widget to your blog
Version: 1.0.0
Author: Eliot Pearson
Author URI: http://blog.eliotpearson.com/wordpress-plugins
License: GPL3
*/
//error_reporting(E_ALL);
add_action("widgets_init", array('HubPages_Widget', 'register'));

class HubPages_Widget {
  function control(){
    $options = get_option("hubpages_widget_html");
    
    if (!is_array( $options )) {
      $options = array('title' => 'HubPages Widget');
    }
 
    if ($_POST['widget-Submit']) {
      $options['title'] = stripslashes($_POST['widget-title']);
      update_option("hubpages_widget_html", $options);
    }
?>
  <p>
    <label for="widget-title">Please paste widget code here: </label>
    <textarea rows="2" cols="20" id="widget-title" name="widget-title"><?php echo stripslashes($options['title']);?></textarea>
    <input type="hidden" id="widget-Submit" name="widget-Submit" value="1" />
  </p>
<?php	
  }
	
	function widget($args){
		echo $args['before_widget'];
	 	$options = get_option("hubpages_widget_html");  

    if (is_array( $options )) {
			echo stripslashes($options['title']);
		} else {
			echo "Plugin not setup properly";
		}
		echo $args['after_widget'];
	}
	
	function register(){
		register_sidebar_widget('HubPages Widget', array('HubPages_Widget', 'widget'));
		register_widget_control('HubPages Widget', array('HubPages_Widget', 'control'));
	}
}

?>
