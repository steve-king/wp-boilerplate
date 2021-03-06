<?php get_header();?>

	<?php if(have_posts()): while(have_posts()): the_post();?>
		
		<article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
			<header>
				<h2><?php the_title()?></h2>
				<time datetime="<?php the_time('Y-m-d')?>"><?php the_time('F jS, Y') ?></time>
	    	<span class="author">by <?php the_author() ?></span>
	    </header>
	    <?php the_content()?>
	    <?php edit_post_link('Edit this entry'); ?>
		</article>
		
	<?php endwhile; ?> 
	
		<nav class="pagination">
	    <div class="older"><?php next_posts_link('&laquo; Older Entries') ?></div>
	    <div class="newer"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
	  </nav>
	  
	<?php else: ?>
	
	<?php wp_redirect(get_bloginfo('siteurl').'/404', 404); exit; ?>
		
	<?php endif;?>


<?php get_footer();?>