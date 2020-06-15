<?php get_header(); ?>

<?php
global $paged;
if( empty( $paged ) ) $paged = 1;

global $wp_query;
$pages = $wp_query -> max_num_pages;
if( !$pages ) {
    $pages = 1;
}
// 1ページしかないor最後のページでは出力しない
if( $pages != 1 && $paged < $pages ) {
    $lastPage = false;
} else {
    $lastPage = true;
}
?>
<section>
    <div class="archive-title">
    <?php the_archive_title( '<h1>', '</h1>' ); ?>
    </div>
</section>

<section id="infinite-scroll">
	<?php if (have_posts()) : ?>
    <div class="loading-target">
		<div class="article_index" >
            <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part( 'include/article', 'post' ); ?>
    		<?php endwhile; ?>
		</div>

        <?php if( function_exists("the_pagination") ) the_pagination(); ?>
    </div>
	<?php endif; ?>
</section>

<?php if( !$lastPage ) { ?>
    <button class="view-more-button ov" type="button">さらに記事を表示する</button>
    <div class="page-load-status" style="display:none;">
        <div class="infinite-scroll-request"></div>
        <p class="infinite-scroll-last">これ以上は記事がありません</p>
        <p class="infinite-scroll-error">読み込むページがありません</p>
    </div>
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script>
$('.view-more-button').on('click',function(){
    $(this).hide();
    $('.pagination').remove();
})
var infScroll = new InfiniteScroll( '#infinite-scroll', {
    append: '.loading-target',
    path: '.pagination .next',
    // hideNav: '.pagination',
    button: '.view-more-button',
    scrollThreshold: false,
    status: '.page-load-status',
    history: 'push',
    historyTitle: true,
    prefill: true,
    onInit: function() {
      this.on( 'load', function() {
          $('.view-more-button').show();
        console.log('Infinite Scroll load')
      });
    }
});
</script>
<?php } ?>


<?php get_footer(); ?>
