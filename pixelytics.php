<?php 
/*
Plugin Name: Pixelytics - Pixelbar Asynchronous Google Analytics Plugin
Description: Google Analytics Code in Backend ballern, fertig! 
Version:0.1
Author: Gino Cremer

GitHub Access Token: 6ca583973da0e33ee1a6c90c3e4920e6143369ca
*/

function pixelyticsoption() {
	if(isset($_POST['pixelytics'])) {
		update_option('pixelytics_values',$_POST["values"]);		
	}
	$values = (get_option('pixelytics_values') != false) ? stripslashes(get_option('pixelytics_values')) : "";
		echo '
		<div class="wrap">
		<h2>Pixelytics Optionen</h2>
		<p>Google Analytics U-ID hier eintragen:</p>
		<form method="post" action="">
		<input type="text" name="values" value="'.$values.'" />
		<input type="submit" class="button-primary" name="pixelytics" value="Speichern" />
		</form>
		</div>';	
}

function pixelyticsoptionpage() {
		add_options_page('Pixelytics - Optionen', 'Pixelytics', 10, basename(__FILE__), "pixelyticsoption");	
	}

add_action('admin_menu','pixelyticsoptionpage');

function pixelyticsjshead() { ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo get_option('pixelytics_values'); ?>']);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_setSiteSpeedSampleRate', 10]);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<?php }
add_action('wp_head', 'pixelyticsjshead');
?>