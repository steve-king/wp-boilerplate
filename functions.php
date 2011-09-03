<?php 
	// Custom HTML5 Comment Markup
	function mytheme_comment($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; ?>
	   <li>
	     <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	       <header class="comment-author vcard">
	          <?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>
	          <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	          <time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a></time>
	          <?php edit_comment_link(__('(Edit)'),'  ','') ?>
	       </header>
	       <?php if ($comment->comment_approved == '0') : ?>
	          <em><?php _e('Your comment is awaiting moderation.') ?></em>
	          <br />
	       <?php endif; ?>
	
	       <?php comment_text() ?>
	
	       <nav>
	         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	       </nav>
	     </article>
	    <!-- </li> is added by wordpress automatically -->
	<?php
	}
	
	// Widgetized Sidebar HTML5 Markup
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'before_widget' => '<section>',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widgettitle">',
			'after_title' => '</h2>',
		));
	}
	
	
	
	// Add ?v=[last modified time] to a file url - for cache busting
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
	}
	
	

	// Register Scripts
  function register_scripts() {
    if (!is_admin()){
    	
    	wp_deregister_script('jquery'); // Lets use the most modern version rather than the one packaged with Wordpress
    	wp_deregister_script( 'l10n' ); // Unneccessary http request made by WP

    	// Add scripts to this array as neccessary
    	$scripts = array(
    		'modernizr' => array(
    			'url' => get_bloginfo('template_directory').'/js/libs/modernizr-2.0.6.min.js',
    			'dependencies' => false,
    			'version' => '2.0.6',
    			'in_footer' => false
    		),
    		
    		'jQuery' => array(
    			'url' => 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js',
    			'dependencies' => false,
    			'version' => '1.6.2',
    			'in_footer' => true
    		),
    		
    		'plugins' => array(
    			'url' => get_bloginfo('template_directory').'/js/plugins.js',
    			'dependencies' => array('modernizr', 'jquery'),
    			'version' => get_file_version($scripts['plugins']['url']),
    			'in_footer' => true
    		),
    		
    		'functions' => array(
    			'url' => get_bloginfo('template_directory').'/js/functions.js',
    			'dependencies' => array('modernizr', 'jquery', 'plugins'),
    			'version' => get_file_version($scripts['functions']['url']),
    			'in_footer' => true
    		)
    	);
    	
    	// Register and enqueue the above scripts
    	foreach($scripts as $key => $val){
    		wp_register_script($key, $val['url'], $val['dependencies'], $val['version'], $val['in_footer']);
    		wp_enqueue_script($key);
    	}
    }
	}    
	add_action('init', 'register_scripts');
	
	

?>