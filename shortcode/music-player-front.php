<?php 

// Test shortcode 

	function post_test_shortcode(){
		ob_start();
		?>
			<!-- Development shortcode -->

		
			<?php echo('<h1 class="color">Hello World</h1>')?>

		
			<!-- Development shortcode -->
	<?php
		return ob_get_clean();

	}
	
	add_shortcode('post-test-shortcode', 'post_test_shortcode');