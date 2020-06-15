<?php get_header();

/**
 * title setting
 */
if (is_category()) {
    $title = single_cat_title('',false);
} elseif(is_tag()) {
    $title = single_tag_title('',false);
} elseif (is_post_type_archive()) {
    $posttypeTitle = post_type_archive_title('', false );
    $title = esc_html($posttypeTitle);
} elseif (is_tax()) {
    $taxonomy = $wp_query->get_queried_object();
    $title = esc_html($taxonomy->name);
} elseif (is_date()) {
    $title = get_the_time('Y年n月');
} elseif (is_search()) {
    $title = '検索結果：'.esc_html( get_search_query(false) );
} elseif (is_404()) {
    $title = '「404」ページが見つかりません';
} else {
    $title = '';
}
 ?>

    <?php if (!is_home()) { ?>
    <section>
        <div class="archive-title">
    		<h1><?php echo $title ?></h1>
        </div>
    </section>
    <?php } ?>

	<section>
		<?php if (have_posts()) : ?>
		<div class="article_index">
            <?php $loopcounter = null;
                while (have_posts()) : the_post(); $loopcounter++;
                // if ( !wp_is_mobile() && $loopcounter == 5) {
        		// 	get_template_part( 'ads/ad', 'index' ); // 広告
        		// }
            ?>
    		<?php get_template_part( 'include/article', 'post' ); ?>
    		<?php endwhile; ?>
		</div>
		<?php else : ?>

		<p>お探しのページは削除されたか、すでに存在していません。</p>

		<?php endif; ?>

    </section>

	<?php if( function_exists("the_pagination") ) the_pagination(); ?>

<?php get_footer(); ?>
