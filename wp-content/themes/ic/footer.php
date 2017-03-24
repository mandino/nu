<?php
/**
 * The template for displaying the footer.
 *
**/
?>

<footer>

		<div id="footer-newsletter" class="section"<?php if(get_option('cebo_footerpic')) { ?> style="background-image:url(<?php echo get_option('cebo_footerpic'); ?>);"<?php } ?>>
			
			<div class="container">
				
				<?php if(get_option('cebo_foottitle')) { ?>
				
				
				<h2 class="newsletter-title"><?php echo get_option('cebo_foottitle'); ?></h2>
			
				<?php } ?>
				
				<?php if(get_option('cebo_footdesc')) { ?>
				
				<p><?php echo get_option('cebo_footdesc'); ?></p>
				
				<?php } ?>
				
				<ul class="contact-details">
					
					<?php if(get_option('cebo_address')) { ?>
					<li class="locationa"><i class="fa fa-map-marker fa-lg"></i> <?php echo get_option('cebo_address'); ?></li>
					<?php } ?>
					<?php if(get_option('cebo_tele')) { ?>
					<li class="phone"><i class="fa fa-mobile-phone fa-lg"></i> <?php echo get_option('cebo_tele'); ?> <?php if(get_option('cebo_fax')) { ?>| Fax: <?php echo get_option('cebo_fax'); ?><?php } ?></li>
					<?php } ?>
					<?php if(get_option('cebo_email')) { ?>
					<li class="email"><i class="fa fa-envelope fa-lg"></i> <a href="mailto:<?php echo get_option('cebo_email'); ?>"><?php echo get_option('cebo_email'); ?></a></li>
					<?php } ?>
				</ul>
	
				<div class="newsletter-form">
					
					
					<?php if(get_option('cebo_enewslettercode')) { ?>
					
					<?php echo get_option('cebo_enewslettercode'); ?>
					
					<?php } else { ?>
					
						<form name="surveys" action="//zmaildirect.com/app/new/MTIzNTQzMjYx" method="get">  

						<input type="hidden" name="formId" value="MTIzNTQzMjYx">
							<div style="float: left;">
						<input name="email" type="text">
							</div>
						  <div style="float: right;">	
						<input value="Subscribe" type="submit">
							</div>
						</form>
					
					<?php  } ?>
	
				</div>
				
			</div>

		</div>

		<div id="property-name">
			<a href="//www.independentcollection.com/ic-local/" target="_blank"><i class="sprite sprite-ic_01"></i></a>
			<a href="//www.independentcollection.com/" target="_blank"><i class="sprite sprite-ic_02"></i></a>
		</div>
		<div class="footer-nav container">

			<nav>
		
				<ul class="fl footling">
					 <?php wp_nav_menu( array( 'theme_location' => 'footer' ,  'items_wrap' => '%3$s', 'container' => '', 'menu_class' => 'navitem' ) ); ?>
				</ul>

				<ul class="social-buttons fr">

					<?php if(get_option('cebo_twitter')) { ?>
					
						<li class="twitter"><a href="//twitter.com/<?php echo get_option('cebo_twitter'); ?>" target="_blank"><i class="fa fa-twitter fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>
				
					<?php if(get_option('cebo_facebook')) { ?>
					
						<li class="facebook"><a href="//facebook.com/<?php echo get_option('cebo_facebook'); ?>" target="_blank"><i class="fa fa-facebook fa-2x"></i><span>facebook</span></a></li>
						
					<?php } ?>
					
					<?php if(get_option('cebo_instagram')) { ?>

						<li class="instagram"><a href="//instagram.com/<?php echo get_option('cebo_instagram'); ?>" target="_blank"><i class="fa fa-instagram fa-2x"></i><span>instagram</span></a></li>

					<?php } ?>
					
					<?php if(get_option('cebo_youtube')) { ?>
					
						<li class="youtube"><a href="//youtube.com/<?php echo get_option('cebo_youtube'); ?>" target="_blank"><i class="fa fa-youtube fa-2x"></i><span>youtube</span></a></li>
					
					<?php } ?>
				</ul>

			</nav>

		</div>		

		<div id="footer-details">
			<div class="container">
			
				<?php if(get_option('cebo_address')) { ?>
					<p><?php echo get_option('cebo_address'); ?><br />
					<span class="mobile-number"><?php if(get_option('cebo_tele')) { echo get_option('cebo_tele'); } ?></span></p>
				<?php } ?>
				
			</div>
		</div>

	</footer>

<?php wp_footer(); ?>

<!-- Scripts -->
<?php include(TEMPLATEPATH. "/library/scripts.php"); ?>
	
<!-- <div id="fb-root"></div> -->
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Remarketing -->
<?php if(is_home()) { ?> 
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 971943105;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/971943105/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php } ?>
<!-- End Remarketing -->

<!-- Email signup popup -->
<?php wp_reset_query(); ?>
<?php if ( is_single() || is_page( 'blog' ) ) { ?>

	<?php query_posts('post_type=email-signup-form&posts_per_page=1'); if(have_posts()) : while(have_posts()) : the_post(); ?>

	<?php if( get_post_meta($post->ID,'misfit_signup_box', true) && $post->post_content != "" ) { ?>

		<div class="lb-overlay">

			<div class="the-popup">
			
				<span class="ns-close" onClick="sessionStorage.setItem('id', '1')"></span>

				<div class="popup-logo-area">
					
					<img class="nu-logo" src="<?php bloginfo('template_url'); ?>/images/nu-hotel-logo.jpg" alt="NU Hotel logo">

				</div>

				<div class="popup-contents">

					<?php the_content(); ?>

				</div>
				
				<div class="signup-form">

						<form id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" method="post" action="//nuhotelbrooklyn.us3.list-manage.com/subscribe/post?u=59c75b2e64de9a8bf94c59372&id=9f057a50d1" class="validate" target="_blank" novalidate>

							<input type="hidden" name="formId" value="MTIzNTQzMjYx">
							<input type="email" name="EMAIL" value="" size="25" class="email" id="mce-EMAIL" placeholder="<?php echo get_post_meta($post->ID,'misfit_signup_placeholder', true); ?>" required>
							<!-- real people should not fill this in and expect good things -->
							<div class="hidden-from-view"><input type="text" value="" tabindex="-1" name="b_bba380aec3f50098434defc93_a126c8bb0f"></div>
							<div style="position: absolute; left: -5000px;"><input type="text" name="b_59c75b2e64de9a8bf94c59372_9f057a50d1" tabindex="-1" value=""></div>
							<input id="mc-embedded-subscribe" type="submit" value="<?php echo get_post_meta($post->ID,'misfit_signup_buttontext', true); ?>" class="button">

						</form>

				</div>

			</div>
				
		</div>
		
		<script>

			(function() {

				<?php if( get_post_meta($post->ID,'misfit_signup_box_pageview', true) ) { ?>

					<?php if( get_post_meta($post->ID,'misfit_signup_box_pageview', true) ) { ?>
						var rand_time = Math.floor(Math.random()*(10000-5000+1)+5000);						
					<?php } else { ?>
						var rand_time = 1300;
					<?php } ?>

					// alert(rand_time);

					$(window).on( 'load', function() {

						if (!sessionStorage.getItem('id')) {
						    
						    setTimeout( function() {
							
								$('.lb-overlay').addClass('ns-show');
								// $('#notification-trigger').attr('disabled','disabled');

							}, rand_time );

						}
						
					});	

				<?php } ?>

				$('.ns-close').click(function(){
					$('.lb-overlay').addClass('ns-hide'),
					$('.lb-overlay').removeClass('ns-show'),
					// vvv This is so it won't transition differently than expected
					setTimeout( function() {
						$('.lb-overlay').removeClass('ns-hide');
					}, 1300 );	
					// $('#notification-trigger').removeAttr('disabled','disabled');
				});



				<?php if( get_post_meta($post->ID,'misfit_signup_box_scroll', true) ) { ?>

					// When user scrolls past 1/3 of page

					var doc_height = $(document).height();
					// alert(doc_height);

					$(window).scroll(function() {
						scroll_height = $(document).scrollTop(),
						scroll_percent = scroll_height / doc_height;

							if (scroll_percent > 0.3 && !sessionStorage.getItem('id')) {
								$('.lb-overlay').addClass('ns-show');
							}
					});

				<?php } ?>

			})();

			<?php if( get_post_meta($post->ID,'misfit_signup_box_visit', true) ) { ?>

				if( !$.cookie('visit') ) {
						$.cookie('visit', '1');
					} else {
						$.cookie('visit', $.cookie('visit', Number) + 1);
					}

				// alert($.cookie('visit', Number));

				if ( $.cookie('visit', Number) >= 2 && !sessionStorage.getItem('id') ) {

						setTimeout( function() {
							$('.lb-overlay').addClass('ns-show');
						}, 1300);
				}

			<?php } ?>

		</script>

	<?php } ?>

	<?php endwhile; endif; wp_reset_query(); ?>
	
<?php } ?>	

<!-- VOYAT CODE -->
<script> (function(){ var v = document.createElement('script'); var s = document.getElementsByTagName('script')[0]; v.src = '//io.voyat.com/v.js'; v.async = true; s.parentNode.insertBefore(v, s); })(); </script>
<!-- VOYAT CODE -->	

</body>
</html>