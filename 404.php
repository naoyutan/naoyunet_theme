<?php get_header(); ?>
<div class="article_wrap">
	<article id="post-404" <?php post_class(); ?>>
		<div class="entry-title">
			<h1>「404」ページが見つかりません</h1>
		</div>

        <div class="content clearfix">
			<p>お目当てのページじゃなくてごめんなさい。<br>検索かカテゴリーのリンクから探してみてください。</p>

			<h2>検索</h2>
			<div class="page404_search">
				<?php get_search_form(); ?>
			</div>

			<h2>カテゴリー</h2>
			<ul>
			<?php wp_list_categories('title_li='); ?>
			</ul>
        </div>

    </article>
</div>
<?php get_footer(); ?>
