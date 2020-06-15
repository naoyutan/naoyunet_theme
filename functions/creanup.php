<?php
/*----------------------------------
  削除設定
----------------------------------*/
/**
 * 管理バーの項目を非表示設定（ comments = コメント, wp-logo = WPロゴ, new-content = 新規, my-account アカウント, updates 更新通知 ）
 */
function mytheme_remove_item( $wp_admin_bar ) {
    global $current_user;
    wp_get_current_user();
    if ($current_user->ID != "1" ) {
        $wp_admin_bar->remove_node('comments');
    	$wp_admin_bar->remove_node('wp-logo');
    	$wp_admin_bar->remove_node('new-content');
    	$wp_admin_bar->remove_node('updates');
    	$wp_admin_bar->remove_node('customize');
    	$wp_admin_bar->remove_node('widgets');
    	$wp_admin_bar->remove_node('themes');
    	$wp_admin_bar->remove_node('appearance');
    }
}
add_action( 'admin_bar_menu', 'mytheme_remove_item', 1000 );


//wp_headで出力されるtitleタグを削除
remove_action('wp_head','_wp_render_title_tag', 1);


/**
 * バージョン更新を非表示にする
 */
//add_filter('pre_site_transient_update_core', '__return_zero');


/**
 * APIによるバージョンチェックの通信をさせない
 */
//remove_action('wp_version_check', 'wp_version_check');
//remove_action('admin_init', '_maybe_update_core');


/**
 * フッターWordPressリンクを非表示
 */
function custom_admin_footer() { echo ''; }
add_filter('admin_footer_text', 'custom_admin_footer');


/**
 * ヘッダーを綺麗に
 */
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );


/**
 * hentryクラス削除
 */
function remove_hentry( $classes ) {
    $classes = array_diff($classes, array('hentry'));
    return $classes;
}
add_filter('post_class', 'remove_hentry');
