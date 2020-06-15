<article <?php post_class('article'); ?>>
	<div class="wrap">
		<a href="<?php the_permalink() ?>">
			<div class="meta_category">
				<div class="label"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></div>
			</div>
			<?php if ( has_post_thumbnail() ) {
				$post_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'thumbnail');
				$post_thumbnail = $post_thumbnail[0];
			} else {
				$post_thumbnail = get_stylesheet_directory_uri(). '/images/noimage-320.jpg';
			 ?>
			<?php } ?>
			<figure class="thumb">
				<img src="<?php echo $post_thumbnail; ?>" alt="">
			</figure>
			<div class="body">
				<p class="entry-title"><?php the_title(); ?></p>
				<div class="index_meta">
					<div class="meta_date">
						<i class="far fa-clock" aria-hidden="true"></i> <?php the_time('Y.n.j') ?>
					</div>
					<div class="meta_tag">
						<i class="fas fa-tags" aria-hidden="true"></i>
						<?php $posttags = get_the_tags();
							if ( $posttags ) {
							  foreach ( $posttags as $tag ) {
							    echo $tag->name . ' ';
							  }
							}
						?>
					</div>
				</div>
			</div>
		</a>
	</div>
</article>
