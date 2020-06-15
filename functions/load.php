<?php
/*----------------------------------
  読み込み設定
----------------------------------*/
/* css */
function add_styles() {
	wp_enqueue_style( 'notosans', 'https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,700');
	wp_enqueue_style( 'wpstyle', get_stylesheet_directory_uri() . '/css/wpstyle.css', '', filemtime( get_stylesheet_directory().'/css/wpstyle.css'));
	if(is_single()) wp_enqueue_style( 'prism', get_stylesheet_directory_uri() . '/css/prism.css', '', filemtime( get_stylesheet_directory().'/css/prism.css'));
}
add_action('wp_print_styles', 'add_styles');

/* js */
function add_scripts() {
	wp_deregister_script('jquery'); // WordPress本体のjquery.jsを読み込まない
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, "2.1.4", false );
	if(is_home()) wp_enqueue_script( 'bxslider', 'https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.js', array( 'jquery' ), '4.2.15', true );
	if(is_single()) wp_enqueue_script( 'prismjs', get_stylesheet_directory_uri() . '/js/prism.js', array( 'jquery' ), filemtime( get_stylesheet_directory().'/js/prism.js'), true );
	wp_enqueue_script( 'commonjs', get_stylesheet_directory_uri() . '/js/common.js', array( 'jquery' ), filemtime( get_stylesheet_directory().'/js/common.js'), true );
}
add_action('wp_enqueue_scripts', 'add_scripts');
