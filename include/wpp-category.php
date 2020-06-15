<?php
	if ( is_single() ) {
		$cat = get_the_category();                            //現在のページのカテゴリー情報を取得
		$cat_name = isset( $cat[0] ) ? $cat[0]->cat_name : '';//取得したカテゴリー情報からカテゴリー名を抽出
		$cat_id = isset( $cat[0] ) ? $cat[0]->term_id : '';   //取得したカテゴリー情報からIDを抽出

	} else if ( is_category() ) {
		$cat_name = single_cat_title('',false);               //現在のカテゴリー名を取得
		$cat_id = get_cat_ID($cat_name);                      //カテゴリー名からIDを取得
		$cats = get_term_children($cat_id, 'category');       //現カテゴリーに含まれる子カテゴリのIDを配列として取得
		if ( !empty( $cats ) ) {                              //配列が空でなければ(子カテゴリーが存在していれば)
			foreach ($cats as $key => $value) {               //配列をforeachループでカンマ区切りして変数へ追加
			$cat_id .= ',' . $value;
			}
		}
	}
?>
<?php if ( is_single() || is_category() ) : ?>
<div id="wpp-category" class="widget popular-posts">
	<div class="widget-title"> 同じカテゴリの人気記事</div>
	<?php if ( function_exists( 'wpp_get_mostpopular' ) ) : ?>
	<?php $args = array(
		 'limit' => 5,              //表示数
		 'range' => 'all',          //集計する期間（weekly,monthly,all）
		 'order_by' => 'views',     //閲覧数で集計、comments（コメント数で集計）、avg（1日の平均で集計））
		 'thumbnail_width' => 320,  //サムネイル画像の幅サイズ
		 'thumbnail_height' => 160, //サムネイル画像の高さサイズ
		 'cat' => $cat_id,
		 'wpp_start' => '<ul class="wpp-list">',
		 'wpp_end' => '</ul>',
		 'stats_views' => 0,        //閲覧数表示（1 or 0）※1＝表示、0＝非表示
		 'stats_comments' => 0,     //コメント数表示（1 or 0）※1＝表示、0＝非表示
		 'post_html' => '<li><figure>{thumb}</figure><a href="{url}" class="wpp-post-title"><p>{text_title}</p></a></li>' );
	?>
	<?php wpp_get_mostpopular( $args ); ?>
	<?php endif; ?>
</div>

<div id="wpp" class="widget popular-posts">
	<div class="widget-title">よく読まれています</div>
	<?php if ( function_exists( 'wpp_get_mostpopular' ) ) : ?>
	<?php $args2 = array(
		 'limit' => 5,              //表示数
		 'range' => 'all',          //集計する期間（weekly,monthly,all）
		 'order_by' => 'views',     //閲覧数で集計、comments（コメント数で集計）、avg（1日の平均で集計））
		 'thumbnail_width' => 320,  //サムネイル画像の幅サイズ
		 'thumbnail_height' => 160, //サムネイル画像の高さサイズ
		 'wpp_start' => '<ul class="wpp-list">',
		 'wpp_end' => '</ul>',
		 'stats_views' => 0,        //閲覧数表示（1 or 0）※1＝表示、0＝非表示
		 'stats_comments' => 0,     //コメント数表示（1 or 0）※1＝表示、0＝非表示
		 'post_html' => '<li><figure>{thumb}</figure><a href="{url}" class="wpp-post-title"><p>{text_title}</p></a></li>' );
	?>
	<?php wpp_get_mostpopular($args2); ?>
	<?php endif; ?>
</div>
<?php endif; ?>
