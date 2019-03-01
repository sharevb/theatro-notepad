<?php
/**
 * The Header for our theme.
 *
 * @package	In Theatro Veritas Notepad
 * @since	1.0
 * @author	ShareVB based on Anarcho Notepad from Arthur "Berserkr" Gareginyan <arthurgareginyan@gmail.com>
 * @copyright 	Copyright © 2015, ShareVB - Copyright © 2013-2015, Arthur Gareginyan
 * @link      	http://sharevb.net
 * @license   	http://www.gnu.org/licenses/gpl-3.0.html
 */
?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="x-ua-compatible" content="IE=edge" />	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('|', true, 'right'); ?></title>

	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>	
    <script src="<?php echo get_template_directory_uri().'/js/jquery.responsive-dom.min.js' ?>"></script>		
    <script type="text/javascript">	$(function() {		var $mainNav = $('#sidebar');		$mainNav.responsiveDom({			appendTo: '#mobilemenu',			mediaQuery: '(max-width: 480px)',			callback: function(mediaMatched) { 						if (mediaMatched) { 							$('.sidebar-inner').hide();						} else { 							$('.sidebar-inner').show();						} 					} 		});		$('.mobile-head').click(function() {			if (!$('.sidebar-inner').is(':visible')) $('.mobile-head').toggleClass('opened', true);			$('.sidebar-inner').slideToggle('slow', function() {				if (!$('.sidebar-inner').is(':visible')) $('.mobile-head').toggleClass('opened', false);			});		});	})	</script>	
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script type="text/javascript">
    //<![CDATA[
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    $(function() {
	    $('<img/>')[0].src="images/sidebar-alone.gif";
    });
    // Wrap all Boxes and resize
    $(window).bind("load resize", function()
    {
        $('.fb-like').each(function()
        {
            // Change 'data-width' attribute
            $(this).attr('data-width', $(this).parent().width());

            FB.XFBML.parse();
        });
    });
    //]]>
</script>

<header id="masthead" class="site-header" role="banner">
	<?php if ( get_theme_mod('disable_paper_search') !== '1') { ?>
		<div class="top-search-form-bg">			<div class="top-search-form"><?php get_search_form(); ?></div>		</div>
	<?php } ?>
	<div id="title">
	  <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">

	   <?php $header_image = get_header_image();
		if ( !empty( $header_image ) ) : ?>
			<img
				class="logo"
				src="<?php esc_url(header_image()); ?>" 
				height="<?php echo esc_attr(get_custom_header()->height); ?>" 
				width="<?php echo esc_attr(get_custom_header()->width); ?>" 
				alt="<?php bloginfo('name'); ?>" 
			/>
	   <?php endif; ?>

	    <h1 class="site-title"><?php bloginfo('name'); ?></h1>
	    <h2 class="site-description"><?php bloginfo('description'); ?></h2>

	  </a>
	</div>
	<div class="notebook-top">		<div class="notebook-top-row">			<span class="notebook-top-left"></span>			<span class="notebook-top-middle"></span>			<span class="notebook-top-sidebar"></span>			<span class="notebook-top-right"></span>		</div>	</div>
</header>