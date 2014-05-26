<?php 
/*
Plugin Name: Pixelytics - Pixelbar Asynchronous Google Analytics Plugin
Description: Google Analytics Code in Backend ballern, fertig! 
Version:0.2
Author: Gino Cremer
GitHub Plugin URI: https://github.com/PixelbarEupen/Pixelytics
GitHub Access Token: 6ca583973da0e33ee1a6c90c3e4920e6143369ca
*/

function pixelyticsoption() {
	if(isset($_POST['pixelytics'])) {
		update_option('pixelytics_values',$_POST["values"]);
		update_option('pixelytics_domain',$_POST["domain"]);		
	}
	$values = (get_option('pixelytics_values') != false) ? stripslashes(get_option('pixelytics_values')) : "";
	$domain = (get_option('pixelytics_domain') != false) ? stripslashes(get_option('pixelytics_domain')) : "";
		echo '
		<div class="wrap">
		<h2>Pixelytics Optionen</h2>
		
		<form method="post" action="">
		<p>Google Analytics U-ID hier eintragen:</p>
		<input type="text" name="values" value="'.$values.'" />
		<p>Domainnamen, der in Google analytics hinterlegt wurde hier eintragen:</p>
		<input type="text" name="domain" value="'.$domain.'" />
		<input type="submit" class="button-primary" name="pixelytics" value="Speichern" />
		</form>
		</div>';	
}

function pixelyticsoptionpage() {
		add_options_page('Pixelytics - Optionen', 'Pixelytics', 10, basename(__FILE__), "pixelyticsoption");	
	}

add_action('admin_menu','pixelyticsoptionpage');

function pixelyticsjshead() { ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo get_option('pixelytics_values'); ?>', '<?php echo get_option('pixelytics_domain'); ?>');
  ga('send', 'pageview');

</script>


<?php }
add_action('wp_head', 'pixelyticsjshead');
?>