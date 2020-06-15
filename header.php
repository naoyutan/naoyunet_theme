<?php header("X-UA-Compatible: IE=edge,chrome=1"); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title( '|', true, 'right' );  ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="format-detection" content="telephone=no">
<meta name="msvalidate.01" content="0A53E5205B9438E267F0B89368D7F30F" />

<?php if ( !is_user_logged_in() ) { ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TMKS9PX');</script>
<!-- End Google Tag Manager -->
<?php } ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/fontawesome/all.min.css" type="text/css">


<!-- <script src="https://kit.fontawesome.com/d2ec598f62.js" crossorigin="anonymous"></script> -->

<?php if ( !is_user_logged_in() ) { ?>
<script data-ad-client="ca-pub-7408088410773034" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-7408088410773034",
          enable_page_level_ads: true
     });
</script>
<?php } ?>
<!-- AMP Adsense -->
<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
<script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js"></script>

<!-- Push7 -->
<script src="https://sdk.push7.jp/v2/p7sdk.js"></script>
<script>
    p7.init("c34f05a2625041d4a624d2abfefc1dd3",{
      mode:"native",
      subscribe:"auto"
    });
</script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head();
?>


</head>
<?php  ?>
<body id="<?php the_pageslug(); ?>" <?php body_class(); ?>>
<!-- AMP Adsense -->
<amp-auto-ads type="adsense" data-ad-client="ca-pub-7408088410773034"></amp-auto-ads>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TMKS9PX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<input type="checkbox" name="color-mode" id="color-mode">

<div id="wrapper">

    <header id="header" class="">
        <div class="glovalHeader">
            <div class="mode">
                <i class="fas fa-moon"></i><label for="color-mode" class="color-mode-switch"></label>
            </div>
            <div class="site-description">
                <p><?php bloginfo('description'); ?></p>
            </div>
            <div class="site-header">
                <div class="sitename">
                    <a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a>
            	</div>
                <nav id="gnav" class="gnav">
                    <div class="content-inner">
                        <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
                    </div>
                </nav>
            </div>
        </div>
    </header><!-- #header -->


    <div id="container">
        <div class="content-inner">
            <div class="main-container">
		        <div id="mainCollumn">
