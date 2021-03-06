	<?php 

	if ( file_exists( TEMPLATEPATH.'/library/mobile-detect.php' ) ) {

		require_once TEMPLATEPATH.'/library/mobile-detect.php';
		$detect = new Mobile_Detect;
		$check = $detect->isMobile();

	}

?>
<!DOCTYPE HTML>
<html <?php language_attributes('html') ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <style>.async-hide { opacity: 0 !important} </style>
    <script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
    h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
    (a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
    })(window,document.documentElement,'async-hide','dataLayer',4000,
    {'GTM-KSBRGRP':true});</script>
	<title>
		<?php global $page, $paged; wp_title( '|', true, 'right' );
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'cebolang' ), max( $paged, $page ) );
		?>
	</title>
	<?php 
		if ( file_exists( dirname( __FILE__ ) . '/noindex.php' ) ) {
		    include( dirname( __FILE__ ) . '/noindex.php' );
		}
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="//gmpg.org/xfn/11" />
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if (get_option('cebo_custom_favicon') == '') { ?>
	
	<link rel="icon" href="<?php bloginfo ('template_url'); ?>/cebo_options/<?php bloginfo ('template_url'); ?>/images/admin_sidebar_icon.png" type="image/x-ico"/>
	
	<?php } else { ?>
	
	<link rel="icon" href="<?php echo get_option('cebo_custom_favicon'); ?>" type="image/x-ico"/>
	
	<?php } ?>
	
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('cebo_feedburner_url') <> "" ) { echo get_option('cebo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
	
	<!-- favicon -->

	<link rel="shortcut icon" href="<?php bloginfo ('template_url'); ?>/icfavicon.png" type="image/png">
	<link rel="icon" href="icfavicon.png" type="image/png">
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/jquery.mmenu.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/js/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/js/slick/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/magnific-popup.css">
    <?php if (is_page_template('page_landing_template_without_map.php')) : ?>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/landingpage.css">   
    <?php endif; ?>

	<?php include(TEMPLATEPATH. "/library/inset.php"); ?>

	<!-- Jquery -->
	<?php //include(TEMPLATEPATH. "/library/jquery.php"); ?>
	<script type="text/javascript" src="//code.jquery.com/jquery-1.8.2.min.js"></script>
	<script type='text/javascript' src='<?php bloginfo ('url'); ?>/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>

	<?php
		/****************** DO NOT REMOVE **********************
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		wp_head();
	?>

	<?php
		// Do not index date based archives eg. www.site.com/2016/07
		if ( is_date() ) {
			echo ('<meta name="robots" content="noindex,nofollow" />');
		}
	?>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-KSBRGRP');</script>
	<!-- End Google Tag Manager -->

	<!-- Sojern Head -->
	<script>
	(function () {
	var pl = document.createElement('script');
	pl.type = 'text/javascript';
	pl.async = true;
	pl.src = 'https://beacon.sojern.com/pixel/p/3032';(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(pl);
	})();
	</script>
	<!-- End Sojern -->

<!--
	<script type="application/ld+json">
		{
		"@context": "//schema.org",
		"@type": "NewsArticle",
		"headline": "Article headline",
		"alternativeHeadline": "The headline of the Article",
		"image": [
		"thumbnail1.jpg",
		"thumbnail2.jpg"
		],
		"datePublished": "2015-02-05T08:00:00+08:00",
		"description": "A most wonderful article",
		"articleBody": "The full body of the article"
		}
	</script>
-->

</head> 
	
<body id="oceana" <?php body_class($class); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KSBRGRP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="menu-wrap">	

	<div id="navigation">
			
			
			<div class="ressys">
				
				
				<div class="whippapeal">
				<div class="formfields">
				
					<div class="reservationform">
					
					
					<form method="get" action="<?php echo get_option('cebo_genbooklink'); ?>">
						
						<input type="hidden" value="1" name="rooms">
						
						<span class="calsec">
							<input type="text"  id="arrival_date" name="arrival_date" placeholder="<?php _e('Arrival','cebolang'); ?>" class="calendarsection" />
							<input type="hidden"  id="arv">
							<i class="fa fa-calendar"></i>
						</span>
						
						<span class="calsec">
							<input type="text" id="departure_date" name="departure_date" placeholder="<?php _e('Departure','cebolang'); ?>" class="calendarsection" />
							<input type="hidden" id="dep">
							<i class="fa fa-calendar"></i>
						</span>
						
						<span class="dropsec" style="margin-right: 6px">
							<select name="adults[]" id="adults" class="halfsies">
								<option value="1"><?php _e('1 Adult','cebolang'); ?></option>
								<option value="2" selected="selected"><?php _e('2 Adults','cebolang'); ?></option>
								<option value="3"><?php _e('3 Adults','cebolang'); ?></option>
								<option value="4"><?php _e('4 Adults','cebolang'); ?></option>
							</select>
						</span>
						
						<span class="dropsec">
							<select name="children[]" id="children" class="halfsies">
								<option value="0"><?php _e('0 Kids','cebolang'); ?></option>
								<option value="1"><?php _e('1 Kid','cebolang'); ?></option>
								<option value="2"><?php _e('2 Kids','cebolang'); ?></option>
								<option value="3"><?php _e('3 Kids','cebolang'); ?></option>
							</select>
						</span>
						
						<button type="submit" class="button">Search Now</button>
						
					
					</form>
				
				</div>

				<!-- flex dates -->

					<div class="reservationform flexdate">
					
						<p><a href="https://nuhotelbrooklyn.reztrip.com/calendar">Flexible dates?</a> Search for our best available rate</p>
						
					</div>

				<!-- end flex datess -->

				</div>
				
				<div class="calendars">
					
					 <div class="datepicker"></div>
				
				
				</div>
				
				</div>
			</div>
			
			
		<div id="property-nav">

			<nav class="click-nav" style="border: none;">
				<ul class="container no-js">
					<li><span class="clicknav-clicker">Join The IC Local Perks Program & Get Rewarded With Every Stay</span></li>
					<li class="blue-btn"><a href="//nuhotelbrooklyn.com/why-blue/"><i class="fa fa-info-circle"></i><span class="blue-mobile">why blue?</span></a></li>
				</ul>
			</nav>

		</div>
		
		<div class="login-portal" aria-label="Membership Portal" aria-modal="true" tabindex="0">
			<form id="login-portal">
				<input type="text" name="fname" placeholder="First Name">
				<input type="text" name="lname" placeholder="Last Name">
				<input type="text" name="email" placeholder="Email">
				<input type="text" name="zipcode" placeholder="Zip Code">
				<span class="btn--circle">
					<input type="submit" name="submit" value="Join Us">
				</span>	
			</form>
			<div class="postal-greetings">
				<span>Your Perks are Waiting</span>
			</div>
			<span class="postal-signin">Already a Member? <a href="https://independentcollectionloyaltyqa.cendyn.com/">Sign In</a></span>
		</div>
		<div id="primary-nav" style="overflow:visible;">
			<div class="login-portal__trigger--container">
				<button class="login-portal__trigger">
					<span class="login-portal__text">Sign In / Sign Up</span>
					<div class="login-portal__close-btn">
						<span class="line-one"></span>
						<span class="line-two"></span>
					</div>
					
				</button>
			</div>
			<a href="<?php bloginfo('url'); ?>" class="logo droplogo"><img src="<?php echo get_option('cebo_logo'); ?>" alt="<?php echo the_title(); ?>" /></a>
			<div class="login-portal__trigger--container">
				<button class="login-portal__trigger--secondary desktop">
					<span class="login-portal__text">Sign In / Sign Up</span>
					<div class="login-portal__close-btn">
					<span class="line-one"></span>
					<span class="line-two"></span>
				</div>
				</button>
			</div>
			
			<div class="login-portal__trigger--container">
				<button class="login-portal__trigger--secondary mobile">
					<span class="login-portal__text">Sign In / Sign Up</span>
					<div class="login-portal__close-btn">
					<span class="line-one"></span>
					<span class="line-two"></span>
				</div>
				</button>
			</div>
			

			<a href="<?php bloginfo('url'); ?>" class="logo mobile"><img src="<?php echo get_option('cebo_logo'); ?>" alt="<?php echo the_title(); ?>" /></a>

			<?php 
				$arg = array(
							'post_type' => array('specials', 'tribe_events'),
							'value' => time(),
							'meta_key' => 'ticker_date_end',
							'order' => 'ASC',
							'meta_query' => array(
								'relation' => 'AND',
								array(
									'key' => 'ticker_status',
									'value' => 'On',
									'compare' => '='
								),
								array(
									'relation' => 'OR',
									array(
										'key' => 'ticker_date_start',
										'value' => date('Ymd'),
										'compare' => '<='
									),
									array(
										'relation' => 'AND',
										array(
											'key' => 'ticker_date_start',
											'value' => date('Ymd'),
											'compare' => '>='
										),
										array(
											'key' => 'ticker_date_end',
											'value' => date('Ymd'),
											'compare' => '<='
										),
									)
								)
							)
						);
				$text = new WP_Query($arg);
				if ($text->posts) {
					foreach ($text->posts as $post) {
						$tickerName = $post->post_title;
						$tickerDate = date('m/d/Y H:i:s', strtotime(get_field('ticker_date_end')));
						$tickerId = $post->ID;
						if (strtotime("now") < strtotime($tickerDate)) {
			?>
							<div class="ticker">
								<span><?php echo get_field('ticker_offer') ?></span>
								<a class="close">X</a>
								<div class="ticker-content">
									<h3><?php echo get_field('ticker_title') ?></h3>
									<div id="ticker">
										<?php echo $tickerDate; ?>
									</div>
									<div class="clear"></div>
										<a href="<?php echo get_field('ticker_cta_url'); ?>"><?php echo get_field('ticker_cta_text') ?></a>
									<?php // } ?>
								</div>
							</div>
							<?php break; ?>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			<?php wp_reset_postdata(); ?>

			<a class="reserve fixeer button fr input-append date" id="idp3" data-date="12-02-2012" data-date-format="mm-dd-yyyy">RESERVE</a>

			<a class="reserve fixeer mobile button fr" id="idp4" href="<?php echo get_option('cebo_genbooklink'); ?>">RESERVE</a>

			<div class="container" style="float: right;">

				<a class="mmenu-icon"><i class="fa fa-bars"></i></a>

				<nav id="menus" class="fl" style="z-index:1">
					<ul id="menu">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu' => 'Header',
								'items_wrap' => home_nav_wrap(),
								'container' => '',
								'menu_class' => 'navitem'
							) );
						?>
					</ul>
				</nav>

			</div>

			<div class="clear"></div>

		</div>

	</div>

	<div id="quiet"></div>
    
    <div class="cookie-consent">
	 	<p>
	 		<?php echo get_bloginfo( 'name' ); ?> site uses cookies. By using this site, you are agreeing to our <a href="<?php bloginfo('url'); ?>/privacy-policy/" target="_blank" target="_blank">Privacy Policy</a>.
	 	</p>
	 	<a class="cookie-consent__accept-btn button">accept</a>
	 </div>