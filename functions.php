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
	
	
	
	// Add ?v=[last modified time] to a file url
	function get_file_version($absolute_url){
	
		$relative_url = wp_make_link_relative($absolute_url);
	
	  $file = $_SERVER["DOCUMENT_ROOT"].$relative_url;
	  $file_version = "";
	
	  if(file_exists($file)) {
	    $file_version = "?v=".filemtime($file);
	  }
	  return $file_version;
	}




	// Register Scripts
  function register_scripts() {
    if (!is_admin()){
    	
    	$scripts = array();
    	
    	$scripts[0]['name'] = 'jquery';
    	$scripts[0]['url'] = 'http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js';
    	$scripts[0]['dependencies'] = false;
    	$scripts[0]['version'] = get_file_version($scripts[0]['url']);
    	$scripts[0]['in_footer'] = false;
    	
    	$scripts[1]['name'] = 'modernizr';
    	$scripts[1]['url'] = get_bloginfo('template_directory').'/js/libs/modernizr-1.7.min.js';
    	$scripts[1]['dependencies'] = false;
    	$scripts[1]['version'] = get_file_version($scripts[1]['url']);
    	$scripts[1]['in_footer'] = false;
    	
    	foreach($script in $scripts){
    		wp_register_script($script['name'], $script['url'], $script['dependencies'], $script['version'], $script['in_footer']);
    		wp_enqueue_script($script['name']);
    	}
    }
	}    
	add_action('init', 'register_scripts');
	
	

?>