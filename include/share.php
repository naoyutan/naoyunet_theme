<?php
    $url_encode=urlencode(get_permalink());
    $title_encode=urlencode(get_the_title().'｜'.get_bloginfo('name'));
    if ( has_post_thumbnail() ) {
        $post_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
        $post_thumbnail = $post_thumbnail[0];
    }
?>
<div class="share">
	<ul>
	    <li class="facebook">
	        <a href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>" target="_blank" rel="nofollow">
	            <span class="icon"><i class="fab fa-facebook-f"></i></span>
	            <?php if(function_exists('scc_get_share_facebook')) echo (scc_get_share_facebook()==0)?'':scc_get_share_facebook(); ?>
	        </a>
	    </li>
	    <li class="tweet">
	        <a href="https://twitter.com/share?url=<?php echo $url_encode ?>&text=<?php echo $title_encode ?>&via=naoyunet" target="_blank" rel="nofollow">
	            <span class="icon"><i class="fab fa-twitter"></i></span>
	            <?php if(function_exists('scc_get_share_twitter')) echo (scc_get_share_twitter()==0)?'':scc_get_share_twitter(); ?>
	        </a>
	    </li>
	    <li class="pinterest">
	        <a rel="nofollow" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo $url_encode;?>&media=<?php echo $post_thumbnail;?>&description=<?php echo $title_encode ?>">
	            <span class="icon"><i class="fab fa-pinterest"></i></span>
	            <?php if(function_exists('scc_get_share_pinterest')) echo (scc_get_share_pinterest()==0)?'':scc_get_share_pinterest(); ?>
	        </a>
	    </li>
	    <li class="hatena">
	        <a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $url_encode ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=510');return false;">
	            <span class="icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hatenabookmark-logomark.svg" alt="はてブ"></span>
	            <?php if(function_exists('scc_get_share_hatebu')) echo (scc_get_share_hatebu()==0)?'':scc_get_share_hatebu(); ?>
	        </a>
	    </li>
	    <li class="line">
	        <a href="http://line.me/R/msg/text/?<?php echo $title_encode . '%0A' . $url_encode;?>">
	            <span class="icon"><i class="fab fa-line"></i></span>
	        </a>
	    </li>
	    <li class="pocket">
	        <a href="http://getpocket.com/edit?url=<?php echo $url_encode;?>&title=<?php echo $title_encode;?>">
	            <span class="icon"><i class="fab fa-get-pocket"></i></span>
	            <?php if(function_exists('scc_get_share_pocket')) echo (scc_get_share_pocket()==0)?'':scc_get_share_pocket(); ?>
	        </a>
	    </li>
	    <li class="rss">
	        <a href="<?php echo home_url(); ?>/?feed=rss2">
	            <span class="icon"><i class="fas fa-rss-square"></i></span>
	        </a>
	    </li>
	    <li class="feedly">
	        <a href="http://feedly.com/i/subscription/feed/<?php bloginfo( url ); ?>/feed" target="blank">
	            feedly
	            <?php if(function_exists('scc_get_follow_feedly')) echo (scc_get_follow_feedly()==0)?'':scc_get_follow_feedly(); ?>
	        </a>
	    </li>
	</ul>
</div>
