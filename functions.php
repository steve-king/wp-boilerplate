<?php 
	
	// Clean up wp_head()
	add_filter( 'show_admin_bar', '__return_false' );
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wp_generator');
	
	
	// Register menus
	register_nav_menus(
		array(
		  'main_nav' => 'Main Navigation'
		)
	);
		
		
/*	// Add ?v=[last modified time] to a file url - for cache busting
	function get_file_version($absolute_url){
		
		$relative_url = wp_make_link_relative($absolute_url);
	  	$file = $_SERVER["DOCUMENT_ROOT"].$relative_url;
	  	$file_version = "";
	
	  	if(file_exists($file)) {
	    	$file_version = "?v=".filemtime($file);
	  	}
	  	return $file_version;
	}


	// Add ?v=[last modified time] to stylesheet
	add_filter('stylesheet_uri', 'versioned_stylesheet_uri');
	function versioned_stylesheet_uri($url){
		$v_url = $url.get_file_version($url);
		return $v_url;
	}*/
	


/*	// Register Scripts
	function register_scripts() {
	    if (!is_admin()){
	    	wp_deregister_script('jquery'); // Lets use the most modern version rather than the one packaged with Wordpress
	    	wp_deregister_script( 'l10n' ); // Unneccessary http request made by WP
	    }
	}    
	add_action('init', 'register_scripts');*/
	
?>