<?php

// 初期設定
require_once locate_template('functions/init.php');
// 削除設定
require_once locate_template('functions/creanup.php');
// ショートコード、独自関数
require_once locate_template('functions/shortcode.php');
// ウィジェット
require_once locate_template('functions/widget.php');
// カスタマイザー
require_once locate_template('functions/customizer.php');
// 管理画面
require_once locate_template('functions/admin.php');

require_once locate_template('functions/menu.php');

require_once locate_template('functions/load.php');



/* タグクラウドのパラメータ変更 */
function custom_wp_tag_cloud($args) {
	$myargs = array(
		'unit' => 'px',
	 	'smallest' => 13,      // 最小文字サイズは 10pt
	 	'largest' => 13,       // 最大文字サイズは 10pt
		'orderby' => 'count',  //使用頻度順
		'order' => 'DESC',     // 降順（使用頻度の高い順）
		'number' => 100        // 表示数
	);
	$args = wp_parse_args($args, $myargs);
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'custom_wp_tag_cloud' );



if (function_exists('cren_get_default_checked')) {
/**
 * Adds a checkbox to the comment form which allows the user to not receive
 * new replies.
 *
 * @param  array $fields The default form fields
 * @return array
 */
function my__cren_comment_fields($fields) {
    $label = apply_filters('cren_comment_checkbox_label', __('コメントに返信されたらメールで通知する.' ));
    $checked = cren_get_default_checked() ? 'checked' : '';

    $fields['cren_subscribe_to_comment'] = '<p class="comment-form-comment-subscribe">'.
      '<label for="cren_subscribe_to_comment"><input id="cren_subscribe_to_comment" name="cren_subscribe_to_comment" type="checkbox" value="on" ' . $checked . '>' . $label . '</label></p>';

    if (cren_display_gdpr_notice()) {
        $fields['cren_gdpr'] = my__cren_render_gdpr_notice();
    }

    return $fields;
}
add_filter('comment_form_default_fields', 'my__cren_comment_fields');


/**
 * Renders the GDPR checkbox.
 *
 * @return string
 */
function my__cren_render_gdpr_notice() {
    $label = apply_filters(
        'cren_gdpr_checkbox_label',
        sprintf(__('このフォームで送信したデータを%sが収集して保存することに同意します' ), get_option('blogname'))
    );

    $privacyPolicyUrl = cren_get_privacy_policy_url();
    $privacyPolicy    = "<a target='_blank' href='{$privacyPolicyUrl}'>(" . __('Privacy Policy', 'comment-reply-email-notification') . ")</a>";

    return '<p class="comment-form-comment-subscribe">'.
      '<label for="cren_gdpr"><input id="cren_gdpr" name="cren_gdpr" type="checkbox" value="yes" required="required">' . $label . ' ' . $privacyPolicy . ' <span class="required">*</span></label></p>';
}

}
