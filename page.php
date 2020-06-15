<?php get_header(); ?>

	<div class="article_wrap">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	    	<?php if ( !is_front_page()) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php endif; ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	        <div class="content clearfix">
	        	<?php the_content(); ?>
	        </div>
			<?php endwhile; endif; ?>

	    </article>
	</div>

	<?php if(wp_link_pages('echo=0')){ ?>
	<nav class="wp_link_pages">
    	<?php
			$defaults = array(
				'before'           => '<div>',
				'after'            => '</div>',
				'link_before'      => '<span class="pagenum">',
				'link_after'       => '</span>',
				'next_or_number'   => 'number',
				'separator'        => '',
				'nextpagelink'     => __( 'Next page' ),
				'previouspagelink' => __( 'Previous page' ),
				'pagelink'         => '%',
				'echo'             => 1
			);
			wp_link_pages($defaults);
		 ?>
    </nav>
	<?php } ?>

	

<?php get_footer(); ?>
