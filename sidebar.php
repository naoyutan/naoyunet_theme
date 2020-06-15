<aside id="sideCollumn" class="sidebar">

	<?php
		if( is_page() ){
		$ancestors = get_post_ancestors( $post->ID );
		$ancestor  = array_pop( $ancestors );
		$parent = get_page($ancestor);
			if($post->post_parent) {
				$children = wp_list_pages("sort_column=menu_order&title_li=&child_of=".$ancestor."&echo=0");
			} else {
				$children = wp_list_pages("sort_column=menu_order&title_li=&child_of=".$post->ID."&echo=0");
			}
	 ?>
	<?php if ( $children) : ?>
	<div class="pagelink">
		<ul>
			<li class="parent">
				<a href="<?php echo get_page_link($ancestor); ?>"><?php echo $parent->post_title; ?></a>
			</li>
			<?php echo $children; ?>
		</ul>
	</div>
	<?php endif; ?>
	<?php } ?>


	<?php get_template_part( 'include/wpp', 'category' );?>


	<?php if(!dynamic_sidebar( 'sidebar-1' )) ; ?>


	<div id="sticky_box">
		<div class="sticky-inner">
			<?php if (!dynamic_sidebar( 'sidebar-fix' )); ?>
			<?php get_template_part( 'ads/ad', 'w300' );?>
		</div>
	</div>

</aside>
