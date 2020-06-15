<?php
// カスタマイザー：カテゴリー別記事一覧
$post_by_category = get_option('post_by_category');
$pbc_id = $post_by_category['id']; // カテゴリーIDを,（カンマ）区切りで入れる
$pbc_num = $post_by_category['num']; // カテゴリーごとに表示する最大記事数
if( !$pbc_id == "") {
    $taxonomy_name = 'category'; // タクソノミーのスラッグ名を入れる
    $post_type = 'post'; // カスタム投稿のスラッグ名を入れる
    $args = array(
        'orderby' => 'name',
        'hierarchical' => false,
        'include' => $pbc_id,
        );
    $taxonomys = get_terms($taxonomy_name, $args);
    if(!is_wp_error($taxonomys) && count($taxonomys)):
?>
<section class="post_by_category">
    <div class="pager">
        <a href="" data-slide-index="0">新着記事</a>
        <?php $i = 1;
            foreach($taxonomys as $taxonomy){
            echo '<a href="" data-slide-index="' .$i. '">' .esc_html($taxonomy->name). '</a>';
            $i++;
            } ?>
    </div>
    <div class="post_by_category_slider">
        <div class="slide">
            <div class="article_index">
            <?php
                while (have_posts()) : the_post();
        		get_template_part( 'include/article', 'post' );
        		endwhile;
            ?>
    		</div>
            <?php if( function_exists("the_pagination") ) the_pagination(); ?>
        </div>
        <?php foreach($taxonomys as $taxonomy):
            $url = get_term_link($taxonomy->slug, $taxonomy_name);
            $tax_posts = get_posts( array(
                'post_type' => $post_type,
                'posts_per_page' => $pbc_num,
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy_name,
                        'terms' => array( $taxonomy->slug ),
                        'field' => 'slug',
                        'include_children' => true,
                        'operator' => 'IN'
                    )
                )
            ));
            if( $tax_posts ) :
        ?>
        <div class="slide">
            <div class="article_index">
                <?php $v = 0;
                    foreach($tax_posts as $tax_post):
                    $v++;
                 ?>
                <article <?php post_class('article'); ?>>
                    <div class="wrap">
                        <a href="<?php echo get_permalink($tax_post->ID); ?>">
                            <div class="meta_category">
                                <div class="label"><?php $category = get_the_category($tax_post->ID); echo $category[0]->cat_name; ?></div>
                            </div>
                            <?php $image_id = get_post_thumbnail_id($tax_post->ID);
                                if($image_id){
                                    $image = wp_get_attachment_image_src($image_id,'thumbnail');
                                    $post_thumbnail = $image[0];
                                } else {
                                    $post_thumbnail = get_stylesheet_directory_uri(). '/images/noimage-320.jpg';
                                }
                            ?>
                            <figure class="thumb"><img src="<?php echo $post_thumbnail ?>" alt=""></figure>
                            <div class="body">
                                <p class="entry-title"><?php echo get_the_title($tax_post->ID); ?></p>
                                <div class="index_meta">
                					<div class="meta_date">
                						<i class="far fa-clock" aria-hidden="true"></i> <?php echo get_the_time('Y.n.j',$tax_post->ID) ?>
                					</div>
                					<div class="meta_tag">
                						<i class="fas fa-tags" aria-hidden="true"></i>
                						<?php $posttags = get_the_tags($tax_post->ID);
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
                <?php endforeach; // $tax_posts as $tax_post
                wp_reset_postdata(); ?>
            </div>
            <?php if($v >= $pbc_num) : // 最大記事数が表示されたらカテゴリーページへのリンクを表示する ?>
            <div class="more"><a href="<?php echo $url; ?>">「<?php echo esc_html($taxonomy->name); ?>」の記事をもっと見る</a></div>
            <?php endif; ?>
        </div>
    <?php endif; // $tax_posts
        endforeach; // $taxonomys as $taxonomy
    ?>
    <!-- /.post_by_category_slider -->
    </div>
</section>
<?php endif; ?>
<script>
$(document).ready(function(){
  $('.post_by_category_slider').bxSlider({
      controls: false,
      pager: true,
      pagerCustom : '.pager',
      auto: false,
      adaptiveHeight: true,
      touchEnabled: false
  });
});
</script>

<?php } else { ?>
    <section>
        <div class="index">
            <?php
                while (have_posts()) : the_post();
                get_template_part( 'include/article', 'post' );
                endwhile;
            ?>
        </div>
    </section>

    <?php if( function_exists("the_pagination") ) the_pagination(); ?>

<?php } ?>
