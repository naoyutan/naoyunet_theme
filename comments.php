<?php /* WordPress CMS Theme WSC Project. */ ?>
<div class="comment_block">
<?php
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Please do not load this page directly. Thanks!');
	if (!empty($post->post_password)) {
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php return; }}

	$oddcomment = 'class="alt" ';
?>

<?php if ($comments) : ?>
	<div id="comments" class="comment-title">この記事へのコメント</div>
	<ol class="commentlist">
		<?php wp_list_comments( array(
			'type'              => 'comment', //タイプ（※）を指定
			'avatar_size'       => 50,
		) ); ?>
	</ol>
<?php paginate_comments_links(); ?>
<?php else : ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">ログイン</a></p>
<?php else : ?>
<?php
$aria_req = ( $req ? " aria-required='true'" : '' );
// $comments_args = array(
//     'fields' => array(
//       'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
//                     '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
// 	  'email' =>  '',
//       'url'    => '',
//     ),
// 	'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="85" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p>',
//     'comment_notes_before' => '',
//     'comment_notes_after'  => '',
//     'title_reply'          => 'お気軽にコメントをどうぞ。',
//   );
?>


<?php
$args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => __( 'Leave a Reply' ),
  'title_reply_to'    => __( 'Leave a Reply to %s' ),
  'cancel_reply_link' => __( 'Cancel Reply' ),
  'label_submit'      => __( 'Post Comment' ),

  'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
    '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required>' .
    '</textarea></p>',

  'must_log_in' => '<p class="must-log-in">' .
    sprintf(
      __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</p>',

  'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',

  'comment_notes_before' => '<p class="comment-notes">' .
    __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) .
    '</p>',

  'comment_notes_after' => '<p class="form-allowed-tags">' .
    sprintf(
      __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
      ' <code>' . allowed_tags() . '</code>'
    ) . '</p>',

  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<p class="comment-form-author">' .
      '<label for="author">' . __( 'Name' ) . '</label> ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' /></p>',

    'email' =>
      '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' /></p>',

    'url' =>
      '<p class="comment-form-url"><label for="url">' .
      __( 'Website' ) . '</label>' .
      '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></p>'
    )
  ),
);

comment_form($args); ?>
<?php endif; ?>
<?php endif; ?>
</div>
