<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/flickity.min.css">
		<link href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" rel="stylesheet" />

		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/favicon-16x16.png">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/favicons/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">

		<?php wp_head(); ?>

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108398439-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			<?php if( empty($_COOKIE['performance_cookies']) ) { ?>
				gtag('config', 'UA-108398439-1', {'anonymize_ip': true});
			<?php } else { ?>
				gtag('config', 'UA-108398439-1');
			<?php } ?>
			
		</script>

		<!-- Facebook Pixel Code -->
		<script id="pixel-code">
			!function(f,b,e,v,n,t,s)
			{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};
			if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
			n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t,s)}(window, document,'script',
			'https://connect.facebook.net/en_US/fbevents.js');

			<?php if( empty($_COOKIE['marketing_cookies']) ) { ?>
				fbq('consent', 'revoke');
			<?php } else { ?>
				fbq('consent', 'grant');
			<?php } ?>

			fbq('init', '2366034370318681');
			fbq('track', 'PageView');
		</script>
		<noscript>
			<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=2366034370318681&ev=PageView&noscript=1"/>
		</noscript>
		<!-- End Facebook Pixel Code -->

		<?php if(is_singular( 'assets' )) { ?>
			<!-- Start of HubSpot Embed Code -->
			<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/4097841.js"></script>
			<!-- End of HubSpot Embed Code -->
		<?php } ?>

	</head>

	<body <?php body_class(); ?>>
		<div class="black-overflow"></div>
			<header class="header <?php echo is_singular( 'assets' ) ? 'blue-header' : '' ?>" >
				<div class="header-inner flex text-center">
					<div class="col flex flex-center menu-burger">
						<a class="mobile-menu" href="javascript:;">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/hamburger.png" alt="Dentacoin trusted reviews blog menu">
						</a>
						<img class="search-magnifier" src="<?php echo get_stylesheet_directory_uri(); ?>/img/search.png" alt="Dentacoin trusted reviews blog search icon">
					</div>

					<div class="col tac">
						<a class="logo" href="<?php echo get_site_url(); ?>">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="Dentacoin trusted reviews logo">
						</a>
						<a class="logo-mobile" href="<?php echo get_site_url(); ?>">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/trp-mobile-logo.svg" alt="Dentacoin trusted reviews logo mobile">
						</a>
					</div>

					<div class="search-form">
						<form method="get" action="<?php echo get_site_url(); ?>">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/search-black.png" alt="Dentacoin trusted reviews blog search icon">
							<input type="text" name="s" placeholder="Search .." value="<?= !empty($_GET['s']) ? htmlspecialchars($_GET['s']) : ''; ?>">
							<button type="submit" class="blue-search"></button>
							<input type="hidden" name="post_type" value="post" />
						</form>
					</div>

					<div class="col header-info">						
						<img class="search-magnifier" src="<?php echo get_stylesheet_directory_uri(); ?>/img/search.png" alt="Dentacoin trusted reviews blog search icon">

	            		<a href="https://reviews.dentacoin.com/?popup=popup-register-dentist" target="_blank" class="white-button">
							<?php _e('Join for free', 'blogtrp'); ?>
						</a>

					</div>
				</div>

				<nav class="main-menu">
					<a class="close-menu" href="javascript:;">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/x.png" alt="Dentacoin trusted reviews blog close menu icon">
					</a>

					<a class="menu-a" href="<?php echo get_site_url(); ?>/">
						<?php _e('All news', 'blogtrp'); ?>
					</a>
					<span class="menu-cats"><?php _e('Categories:', 'blogtrp'); ?></span>

					<?php
						wp_nav_menu( array(
							'container' => false,
							'theme_location' => 'primary',
							'menu_class'     => 'primary-menu',
						) );
					?>
					<a class="menu-a" target="_blank" href="https://reviews.dentacoin.com/">
						<?php _e('Find a dentist', 'blogtrp'); ?>
					</a>
					<a class="menu-a" target="_blank" href="https://reviews.dentacoin.com/?popup=popup-register">
						<?php _e('Sign up', 'blogtrp'); ?>
					</a>
					<a class="reviews-home" target="_blank" href="https://reviews.dentacoin.com/">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/home.png" alt="Dentacoin trusted reviews blog home page icon"><?php _e('Trusted Reviews Home', 'blogtrp'); ?>
					</a>
					
				</div>
		    </header>

		    <div class="site-content">