<?php
/*
Plugin Name: Say Hello
Plugin URI: http://virtual-sightseeing.com/
Description: Say hello to your visitors. Adds a 'Hello' in diferrent languages in your sidebar
Version: 1.0.0
Author: Kasper Solberg
Author URI: http://virtual-sightseeing.com/
*/

/*  This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

function say_hello() {
global $chosen;
 
	// These are Hello in different languages
$hello = "Mshybziakua!
Goeie Dag!
Irankaratte!
Tungjatjeta!
Tadiyaas!
Iiti em Hotep!
Daazho!
Marhaba!
Schlama! 
Voghdzuyin!
Namaskara!
Kamisaraki? 
Nahardansonia Xeyir!
Kaixo!
Privitani!
Namaskar!
Demad!
Zdravei!
Kuzu Zangpo!
Mingala Ba!
Suksabai Jie Te!
Layho!
Marsha Voghila!
Ahoj!
Haa!
Haaahe!
Halito!
Osiyo!
Ni Hao!
Dydh Dau!
Bonghjornu!
Kako si!
Hej!
Dag!
Saluton!
Tere!
Hey!
";

// Here we split it into lines
$hello = explode("\n", $hello);
// And then randomly choose a line
$chosen = wptexturize( $hello[ mt_rand(0, count($hello) - 1) ] );

echo "<p><h2>$chosen</h2></p>";
}

function widget_init_say_hello(){
	if(!function_exists('register_sidebar_widget') || !function_exists('register_widget_control')) return;
 
	function widget_say_hello($args){
		extract($args);
		$options = get_option('widget_say_hello');
		$title = $options['title'];

		echo $before_widget;
		if(!empty($title)){echo $before_title.$title.$after_title;}
		say_hello();
		echo $after_widget;
	}
 
	function widget_say_hello_control(){
		$options = get_option('widget_say_hello');
	  
		if($_POST['say-hello-submit']):
			$newoptions['title'] = strip_tags(stripslashes($_POST['say-hello-title']));
			if($options != $newoptions):
				$options = $newoptions;
				update_option('widget_say_hello', $options);
			endif;
		endif;
		
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		
		//begin widget form
		?>
			<p><label>Title: <input type="text" class="widefat" id="say-hello-title" name="say-hello-title" value="<?php echo $title; ?>" /></label></p>
			<input type="hidden" name="say-hello-submit" id="say-hello-submit" value="1" />
		<?
		//end widget form
	}
	
	$widget_ops = array('description' => __("Displays 'Hello!' in randomly selected languages"));
	wp_register_sidebar_widget('say-hello','Say Hello','widget_say_hello',$widget_ops);
	wp_register_widget_control('say-hello','Say Hello', 'widget_say_hello_control',$widget_ops);
}

add_action('widgets_init', 'widget_init_say_hello');
?>