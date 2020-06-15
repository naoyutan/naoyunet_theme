<?php
/*----------------------------------
  widget
----------------------------------*/
function widgets_init() {
	register_sidebar( array(
		'name' => 'sidebar1',
		'id' => 'sidebar-1',
		'description' => __( '' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => 'footer1',
		'id' => 'footbar-1',
		'description' => __( '' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => 'footer2',
		'id' => 'footbar-2',
		'description' => __( '' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => 'footer3',
		'id' => 'footbar-3',
		'description' => __( '' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );

	register_sidebar( array(
		'name' => '広告-本文下',
		'id' => 'ad-post_under',
		'description' => __( '' ),
		'before_widget' => '<div id="%1$s" class="post-under-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div style="display:none;">',
		'after_title' => '</div>',
	) );
	// register_sidebar( array(
	// 	'name' => 'ピックアップ記事',
	// 	'id' => 'pickup-posts',
	// 	'description' => __( '' ),
	// 	'before_widget' => '<div id="%1$s" class="pickup-widget %2$s">',
	// 	'after_widget' => '</div>',
	// 	'before_title' => '<div style="display:none;">',
	// 	'after_title' => '</div>',
	// ) );
	register_sidebar( array(
		'name' => '固定sidebar',
		'id' => 'sidebar-fix',
		'description' => __( '' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );

}
add_action( 'widgets_init', 'widgets_init' );
