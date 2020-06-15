<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article_wrap'); ?>>
	<div class="entry-title">
		<h1><?php the_title(); ?></h1>
	</div>
	<div class="meta">
		<div>
			<span class="date"><i class="far fa-clock"></i> <?php the_time('Y年n月j日') ?></span>
			<?php if ( get_the_time( 'U' ) < get_the_modified_time( 'U' ) ) { ?>
			<span class="date"><i class="fas fa-sync-alt"></i> <?php the_modified_date('Y年n月j日'); ?></span>
			<?php } ?>
			<span class="cate"><i class="fas fa-folder" aria-hidden="true"></i> <?php the_category(' ') ?></span>

			<span class="tag"><i class="fas fa-tags"></i> <?php the_tags('',' , ') ?></span>
		</div>
    </div>
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-thumbnail">
		<figure>
			<?php the_post_thumbnail( 'large' ); ?>
		</figure>
	</div>
	<?php } ?>

	<?php get_template_part( 'ads/ad', 'post_header' ); // 広告 ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="content clearfix">
		<?php the_content(); ?>
	</div>
	<?php endwhile; endif; ?>
</article>

<?php get_template_part( 'include/share'); ?>

<?php get_template_part( 'ads/ad', 'post_footer' ); // 広告 ?>

<div class="breadcrumb">
	<?php if(function_exists("the_breadcrumb")) the_breadcrumb(); ?>
</div>

<?php comments_template('', true); ?>

<?php get_template_part( 'ads/ad','related'); ?>

<div class="before-after">
	<?php
		$previous_post = get_previous_post(true);
		$next_post = get_next_post(true);
		if (!empty( $previous_post )):
	?>
	<div class="prev">
		<p class="label">前の記事</p>
		<a href="<?php echo get_permalink( $previous_post->ID ); ?>">
			<?php if ( has_post_thumbnail($previous_post->ID ) ) {
				$prev_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($previous_post->ID),'thumbnail');
				$prev_thumbnail = $prev_thumbnail[0]; ?>
				<figure><img src="<?php echo $prev_thumbnail; ?>" alt="<?php echo $previous_post->post_title; ?>"></figure>
			<?php } echo $previous_post->post_title; ?>
		</a>
	</div>
	<?php endif;
		if (!empty( $next_post )):
	?>
	<div class="next">
		<p class="label">次の記事</p>
		<a href="<?php echo get_permalink( $next_post->ID ); ?>">
			<?php if ( has_post_thumbnail($next_post->ID) ) {
				$next_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID),'thumbnail');
				$next_thumbnail = $next_thumbnail[0]; ?>
				<figure><img src="<?php echo $next_thumbnail; ?>" alt="<?php echo $next_post->post_title; ?>"></figure>
			<?php } echo $next_post->post_title; ?>
		</a>
	</div>
	<?php endif; ?>
</div>



<?php get_template_part( 'include/author'); ?>

<div class="post-under">
<?php if ( ! dynamic_sidebar( 'ad-post_under' ) ) ; ?>
</div>

<?php if(is_single()) {
 	$url_encode=urlencode(get_permalink());
 	$title_encode=urlencode(get_the_title()).'｜'.get_bloginfo('name');
?>
<div class="share-btns" id="share-btns">
 	<div class="content-inner">
 		<ul>
 		    <li class="facebook"><a href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>"><i class="fab fa-facebook-f"></i></a></li>
 		    <li class="tweet"><a href="http://twitter.com/intent/tweet?url=<?php echo $url_encode ?>&text=<?php echo $title_encode ?>&via=naoyunet"><i class="fab fa-twitter"></i></a></li>
 		    <li class="pocket"><a href="http://getpocket.com/edit?url=<?php echo $url_encode;?>&title=<?php echo $title_encode;?>"><i class="fab fa-get-pocket"></i></a></li>
 		</ul>
 	</div>
</div>
<?php } ?>

<?php get_footer(); ?>
