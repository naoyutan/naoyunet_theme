
<div class="admin_profile">
	<div class="admin_avatar">
		<div class="icon"><?php echo get_avatar( get_the_author_meta('user_email'), 150 ); ?></div>
		<div class="">
			<p class="head">このサイトの管理者</p>
			<p class="name"><?php the_author(); ?></p>
		</div>
	</div>
	<div class="admin_description">
		<div class="body">
			<p><?php the_author_meta('user_description'); ?></p>
		</div>
        <div class="admin_twitter">
			<a href="https://twitter.com/naoyunet?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-show-count="false">Follow @naoyunet</a>
			<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div>
	</div>
</div>
