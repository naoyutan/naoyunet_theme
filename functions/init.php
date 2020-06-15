<?php
/*----------------------------------
  初期設定
----------------------------------*/

/* WordPressGalleryのCSS無効 */
function disable_default_gallery_style() {
    return false;
}
add_filter("use_default_gallery_style", "disable_default_gallery_style");


/* 投稿スラッグのデフォルト設定 */
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
        //$slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
        $slug =  $post_ID;
    }
    return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );


/* the_excerptの文字数 */
function custom_excerpt_length( $length ) {
    return 130;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/* 検索ウィジェットのカスタマイズ */
function new_search_form($form) {
    $form = '<form method="get" id="searchform" action="' . home_url() . '" >
	<div class="widget-inner">
	<input type="text" value="' . esc_attr(apply_filters('the_search_query', get_search_query())) . '" name="s" id="s" size="10" />
	<input type="submit" id="searchsubmit" value="'.esc_attr(__('Search')).'" />
	</div>
	</form>';
	return $form;
}
add_filter('get_search_form', 'new_search_form' );


/* 検索対象の投稿タイプを限定 */
function search_filter($query) {
  if (!$query -> is_admin && $query -> is_search) {
    $query -> set('post_type', array('post')); // post_typeの配列
  }
  return $query;
}
add_filter('pre_get_posts', 'search_filter');


/* パスワード保護の記事は一覧から非表示 */
function my_posts_where($where){
    global $wpdb;
    if(!is_singular() && !is_admin()){
        $where .= " AND $wpdb->posts.post_password = ''";
    }
    return $where;
}
add_filter('posts_where', 'my_posts_where');


// A better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
  }

  return $title;

} // end better title
add_filter( 'wp_title', 'rw_title', 10, 3 );
