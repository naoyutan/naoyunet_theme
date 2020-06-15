<?php
/*----------------------------------
  カスタマイザー
----------------------------------*/
function my_theme_customize_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	/* 背景画像 */
	add_theme_support( 'custom-background', array(
		'default-color' => '',
		'default-image' => ''
	) );

	/* カスタムヘッダー */
	add_theme_support( 'custom-header', array(
		'width'         => 2000,
		'height'        => 700,
		'flex-width'    => true,
	    'flex-height'   => true,
		'default-text-color'     => '#ff0000', // header_textcolor() で出力
	    'header-text'   => true,
		'video'         => true,
		'default-image' => get_stylesheet_directory_uri() . '/images/custom-header.jpg'
	) );

	/* カスタムヘッダーのデフォルト画像を登録 */
	register_default_headers( array(
	    'default' => array(
	        'url'           => get_stylesheet_directory_uri() . '/images/custom-header.jpg',
	        'thumbnail_url' => get_stylesheet_directory_uri() . '/images/custom-header.jpg',
	        'description'   => 'default',
	    ),
	) );

}
add_action( 'after_setup_theme', 'my_theme_customize_setup' );


function my_theme_customize_register( $wp_customize ) {
  // add_section、add_setting、add_controlで1セット
  $wp_customize->add_section( 'post_by_category_section', array(
      'title'     => 'カテゴリー別投稿リスト', // 管理画面に表示される項目名
      'priority'  => 200, //セクションの表示順序
      'description' => '',
  ));
  $wp_customize->add_setting( 'post_by_category[id]', array(
      'default'   => '',
      'type'      => 'option',
      'transport' => 'refresh', //テーマ設定値更新のトリガー。'refresh' または 'postMessage'（即時反映）
  ));
  $wp_customize->add_control( 'post_by_category_control', array(
      'label'     => 'カテゴリーIDをカンマ（,）区切りで入力', // ラベル名
      'description' => '例）10,20,25',
      'section'   => 'post_by_category_section', // add_sectionのキーを入力
      'settings'  => 'post_by_category[id]', // add_settingのキーを入力
      'type'      => 'text', // 入力タイプ: text, checkbox, radio, select, textarea, dropdown-pages, email, url, number, hidden, and date.
  ));

  $wp_customize->add_setting( 'post_by_category[num]', array(
      'default'   => '',
      'type'      => 'option',
      'transport' => 'refresh',
  ));
  $wp_customize->add_control( 'post_by_category_num', array(
      'label'     => '一覧に表示する記事数', // ラベル名
      'description' => '整数を入力',
      'section'   => 'post_by_category_section', // add_sectionのキーを入力
      'settings'  => 'post_by_category[num]', // add_settingのキーを入力
      'type'      => 'number', // 入力タイプ: text, checkbox, radio, select, textarea, dropdown-pages, email, url, number, hidden, and date.
  ));

}
add_action( 'customize_register', 'my_theme_customize_register' );
