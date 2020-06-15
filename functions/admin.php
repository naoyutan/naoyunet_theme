<?php
/*----------------------------------
  管理画面
----------------------------------*/

/* ビジュアルエディタ用スタイルシートを有効化 */
add_editor_style('css/admin/editor-style.css');
add_theme_support( 'editor-styles' );

// ビジュアルエディタのbodyにclassを追加
function custom_editor_settings( $initArray ) {
    $initArray['body_class'] = 'editor-area';
    return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );


/* editor-style.cssをキャッシュしない */
function extend_tiny_mce_before_init( $mce_init ) {
    $mce_init['cache_suffix'] = 'v='.time();
    return $mce_init;
}
add_filter( 'tiny_mce_before_init', 'extend_tiny_mce_before_init' );


/* embed（記事埋め込み）CSSカスタマイズ */
add_filter('embed_head', 'original_embed_style');
function original_embed_style() {
    wp_enqueue_style('wp-embed-template-org', get_stylesheet_directory_uri() . '/css/wp-embed-template.css');
}

// デフォルトのスタイルをembedのheadで使用しないように設定する
remove_action('embed_head', 'print_embed_styles');


/* ログイン画面にCSS読み込み */
function login_css() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/css/admin/login.css">';
}
// add_action('login_head', 'login_css');


/*=================================
  記事の更新日を変更しない機能
=================================*/
//管理画面が開いたときに実行
add_action( 'admin_menu', 'add_update_level_custom_box' );
//更新ボタンが押されたときに実行
add_action( 'save_post', 'save_custom_field_postdata' );

//カスタムフィールドを投稿画面に追加
function add_update_level_custom_box() {
  //ページ編集画面にカスタムメタボックスを追加
  add_meta_box( 'update_level', '更新日の変更', 'html_update_level_custom_box', 'post', 'side', 'high' );
}

//投稿画面に表示するフォームのHTMLソース
function html_update_level_custom_box() {
    $post = isset($_GET['post']) ? $_GET['post'] :null;
    $update_level = get_post_meta( $post, 'update_level' );

    $level = $update_level ? $update_level[0] : null;
    echo '<div style="padding-top: 3px; overflow: hidden;">';
    echo '<div style="width: 100px; float: left;"><label><input name="update_level" type="radio" value="high" ';
    if( $level=="" || $level=="high" ) echo ' checked="checked"';
    echo ' />更新する</label></div><div><label><input name="update_level" type="radio" value="low" ';
    if( $level=="low" ) echo ' checked="checked"';
    echo '/>更新しない</label><br /></div>';
    echo '<p class="howto" style="margin-top:1em;">更新日時を変更するかどうかを設定します。誤字修正などで更新日を変更したくない場合は「変更しない」にチェックを入れてください。</p>';
    echo '</div>';
}

//設定したカスタムフィールドの値をDBに書き込む記述
function save_custom_field_postdata( $post_id ) {
  $mydata = isset($_POST['update_level']) ? $_POST['update_level'] : null;
  if( "" == get_post_meta( $post_id, 'update_level' )) {
    /* update_levelというキーでデータが保存されていなかった場合、新しく保存 */
    add_post_meta( $post_id, 'update_level', $mydata, true ) ;
  } elseif( $mydata != get_post_meta( $post_id, 'update_level' )) {
    /* update_levelというキーのデータと、現在のデータが不一致の場合、更新 */
    update_post_meta( $post_id, 'update_level', $mydata ) ;
  } elseif( "" == $mydata ) {
    /* 現在のデータが無い場合、update_levelというキーの値を削除 */
    delete_post_meta( $post_id, 'update_level' ) ;
  }
}

//「更新」以外は更新日時を変更しない
add_filter( 'wp_insert_post_data', 'my_insert_post_data', 10, 2 );
function my_insert_post_data( $data, $postarr ){
  $mydata = isset($_POST['update_level']) ? $_POST['update_level'] : null;
    if( $mydata == "low" ){
        unset( $data["post_modified"] );
        unset( $data["post_modified_gmt"] );
    }
    return $data;
}



/*=================================
  投稿画面に追加コード
=================================*/
add_action('admin_menu', 'add_code_hooks');
add_action('save_post', 'save_add_code');
add_action('wp_head','insert_add_code');

function add_code_hooks() {
	add_meta_box('add_code', '追加コード', 'add_code_input', 'post', 'normal', 'high');
	add_meta_box('add_code', '追加コード', 'add_code_input', 'page', 'normal', 'high');
}

function add_code_input() {
	global $post;
	echo '<input type="hidden" name="add_code_noncename" id="add_code_noncename" value="'.wp_create_nonce('add-code').'" />';
	echo '<textarea name="add_code" id="add_code" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_add_code',true).'</textarea>';
}

function save_add_code($post_id) {
	if (!wp_verify_nonce($_POST['add_code_noncename'], 'add-code')) return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	$add_code = $_POST['add_code'];
	update_post_meta($post_id, '_add_code', $add_code);
}

function insert_add_code() {
	if (is_page() || is_single()) {
		if (have_posts()) : while (have_posts()) : the_post();
		$code = get_post_meta(get_the_ID(), '_add_code', true);
echo <<< EOS
$code
EOS;
		endwhile; endif;
		rewind_posts();
	}
}
