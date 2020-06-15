<?php
/*----------------------------------
  投稿ショートコード
----------------------------------*/
/* サイト名 [site_name]  */
function shortcode_sitename() {
    return get_bloginfo('name');
}
add_shortcode('site_name', 'shortcode_sitename');


/**
*  吹き出しショートコード
*  [fukidashi]ここにセリフを入れます[/fukidashi]
*/
function fukidashi_init( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'color' => '#eeeeee',
        'icon' => 'fukidashi-default.png',
        'name' => ''
    ), $atts ) );

    return '<div class="fukidashi"><div class="icon"><img src="' .get_stylesheet_directory_uri(). '/images/' .$icon. '" alt="" /><span>' .$name. '</span></div><div style="border-color:' .$color. ';background-color: ' .$color. ';" class="ball"><p>' .$content. '</p></div></div>';
}
add_shortcode('fukidashi', 'fukidashi_init');

/*----------------------------------
  独自関数
----------------------------------*/

/**
* ページスラッグを表示
*/
function the_pageslug(){
	$page = get_post( get_the_ID() );
	$slug = $page->post_name;
	echo $slug;
}
function get_pageslug(){
 	$page = get_post( get_the_ID() );
 	$slug = $page->post_name;
 	return $slug;
}

/**
* 子ページかどうかを判定
*/
function is_subpage() {
  global $post;
  if (is_page() && $post->post_parent){
    $parentID = $post->post_parent;
    return $parentID;
  } else {
    return false;
  };
};

/**
* サブページまたはサブページを持っているかの判定
*/
function has_subpage() {
	global $post;

	if ( is_page() ) { // test to see if the page has a parent
		$ancestor = array_pop( get_post_ancestors( $post->ID ) );
		if( $ancestor ) {
			$parent = $ancestor;
		} else {
			$parent = $post->ID;
		}
		$h = get_children("post_type=page&post_parent=" .$parent );
		if ( empty($h) ) {
			return false;
		} else {
			return true;
		}

	} else {  // there is no parent so ...
		return false;  // ... the answer to the question is false
	}
}

/**
* ページネーション
*/
function the_pagination() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '&larr;',
    'next_text'    => '&rarr;',
    'type'         => 'list',
    'end_size'     => 1,
    'mid_size'     => 1
  ) );
  echo '</nav>';
}

/********************************
 パンくずリスト出力
 <?php if(function_exists("the_breadcrumb")) the_breadcrumb(); ?>
*********************************/
function the_breadcrumb(){
    global $post;
	$title = '';
    $str ='';
    if(!is_home()&&!is_admin()){
        // ホーム（必ず表示）
        $str.= '<ol itemscope itemtype="https://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        $str.= '<a itemprop="item" href="'. home_url() .'"><span itemprop="name">ホーム</span></a><meta itemprop="position" content="1" /></li>';

        // 以下条件分岐
        // 固定ページ
		if(is_page()){
            if($post -> post_parent != 0 ){
                $ancestors = array_reverse(get_post_ancestors( $post->ID ));
                foreach($ancestors as $ancestor){
                    $str.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'. get_permalink($ancestor).'" itemprop="item"><span itemprop="name">'. get_the_title($ancestor) .'</span></a><meta itemprop="position" content="2" /></li>';
                }
                $title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.get_the_title().'</span><meta itemprop="position" content="3" /></li>';
            } else {
                $title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.get_the_title().'</span><meta itemprop="position" content="2" /></li>';
            }

        // タグ
		} elseif(is_tag()) {
			$title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.single_tag_title('',false).'</span><meta itemprop="position" content="2" /></li>';
        } elseif(is_date()) {
            $title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.get_the_time('Y年n月').'</span><meta itemprop="position" content="2" /></li>';

        // カテゴリー
        } elseif (is_category()) {
            $cat = get_queried_object();
            if($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                foreach($ancestors as $ancestor){
                    $str.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'. get_category_link($ancestor) .'" itemprop="item"><span itemprop="name">'. get_cat_name($ancestor) .'</span></a><meta itemprop="position" content="2" /></li>';
                }
                $title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.single_cat_title('',false).'</span><meta itemprop="position" content="3" /></li>';
            } else {
                $title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.single_cat_title('',false).'</span><meta itemprop="position" content="2" /></li>';
            }

        // ブログ投稿
		} elseif(is_singular('post')){
            $categories = get_the_category($post->ID);
            $cat = $categories[0];
            if($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                foreach($ancestors as $ancestor){
                    $str.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'. get_category_link($ancestor).'" itemprop="item"><span itemprop="name">'. get_cat_name($ancestor). '</span></a><meta itemprop="position" content="2" /></li>';
                }
                $str.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'. get_category_link($cat -> term_id). '" itemprop="item"><span itemprop="name">'. $cat-> cat_name . '</span></a><meta itemprop="position" content="3" /></li>';
                $title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.get_the_title().'</span><meta itemprop="position" content="4" /></li>';
            } else {
                $str.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'. get_category_link($cat -> term_id). '" itemprop="item"><span itemprop="name">'. $cat-> cat_name . '</span></a><meta itemprop="position" content="2" /></li>';
    			$title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.get_the_title().'</span><meta itemprop="position" content="3" /></li>';
            }


        // タクソノミー
		} elseif(is_tax()){
			$query = get_queried_object();
            $tax = get_taxonomy($query->taxonomy);
            $type = $tax->object_type[0];
            $typelink = get_post_type_archive_link($type);
			$typename = get_post_type_object($type);
            $str.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'. $typelink .'" itemprop="item"><span itemprop="name">'. $typename->labels->name . '</span></a><meta itemprop="position" content="2" /></li>';
			$taxonomy_slug = $query->taxonomy;
            $terms = array_reverse(get_the_terms($post->ID, $taxonomy_slug));
			$term = $terms[0];
            if($term -> parent != 0){
				$ancestors = get_ancestors( $term -> term_id, $taxonomy_slug);
                foreach($ancestors as $ancestor){
                	$term_name = get_term_by('term_taxonomy_id', $ancestor, $taxonomy_slug);
                    $str.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'. get_term_link($ancestor, $taxonomy_slug).'" itemprop="item"><span itemprop="name">'. $term_name->name . '</span></a><meta itemprop="position" content="3" /></li>';
                }
                $title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.esc_html($query->name).'</span><meta itemprop="position" content="4" /></li>';
            } else {
                $title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.esc_html($query->name).'</span><meta itemprop="position" content="3" /></li>';
            }


        // カスタム投稿
		} elseif(is_singular()){
			$query = get_queried_object();
            $typelink = get_post_type_archive_link($query->post_type);
			$typename = get_post_type_object($query->post_type);
            $str.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'. $typelink .'" itemprop="item"><span itemprop="name">'. $typename->labels->name . '</span></a><meta itemprop="position" content="2" /></li>';

            $taxonomy_slug = get_post_taxonomies();
            $taxonomy_slug = $taxonomy_slug[0];
            if($taxonomy_slug){
                $terms = get_the_terms($post->ID,$taxonomy_slug);
                if($terms) {
                    $term=$terms[0];
                    $termlink = get_term_link($term->slug, $taxonomy_slug);
                    $str.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'. $termlink .'" itemprop="item"><span itemprop="name">'. $term->name . '</span></a><meta itemprop="position" content="3" /></li>';
                    $title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.get_the_title().'</span><meta itemprop="position" content="4" /></li>';
                }
            } else {
                $title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.get_the_title().'</span><meta itemprop="position" content="3" /></li>';
            }


        // カスタム投稿アーカイブ
		} elseif (is_post_type_archive()) {
			$posttypeTitle = post_type_archive_title('', false );
			$title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.esc_html($posttypeTitle).'</span><meta itemprop="position" content="2" /></li>';

        // 404
		} elseif (is_404()) {
			$title = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">404 ページが見つかりません</span><meta itemprop="position" content="2" /></li>';
		} else {

        }
        $str.=$title ;
        $str.='</ol>';
    }
    echo $str;
}
