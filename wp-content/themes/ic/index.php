<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); 

?>



	<!-- ================= PRIMARY SLIDER HERE OPTIONAL ===================== -->

	<?php include (TEMPLATEPATH . '/library/featured.php'); ?>



	<div id="intro" class="section">

		<div class="container">

			<div class="section-header">

				<div class="fl">
					<?php if(get_option('cebo_shorttitle')) { ?>

					<span class="section-pre-title fl"><?php echo get_option('cebo_shorttitle'); ?></span>

					<div class="section-header-divider fl"></div>

					<?php } ?>

					<?php if(get_option('cebo_longtitle')) { ?>

					<span class="section-title fr"><?php echo get_option('cebo_longtitle'); ?></span>

					<?php } ?>

					</div>

				<div class="fr">

					<ul class="social-buttons">
					<?php if(get_option('cebo_facebook')) { ?>

						<li class="facebook"><a href="//facebook.com/<?php echo get_option('cebo_facebook'); ?>" target="_blank"><i class="fa fa-facebook fa-2x"></i><span>facebook</span></a></li>

					<?php } ?>
					<?php if(get_option('cebo_twitter')) { ?>

						<li class="twitter"><a href="//twitter.com/<?php echo get_option('cebo_twitter'); ?>" target="_blank"><i class="fa fa-twitter fa-2x"></i><span>twitter</span></a></li>

					<?php } ?>
					<?php if(get_option('cebo_instagram')) { ?>

						<li class="instagram"><a href="//instagram.com/<?php echo get_option('cebo_instagram'); ?>" target="_blank"><i class="fa fa-instagram fa-2x"></i><span>twitter</span></a></li>

					<?php } ?>
					<?php if(get_option('cebo_instagram')) { ?>
					
						<li class="instagram"><a href="//instagram.com/<?php echo get_option('cebo_instagram'); ?>" target="_blank"><i class="fa fa-instagram fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>
					</ul>

				</div>

			</div>




		<!-- ================= INTRO SECTION ===================== -->





			<div class="section-photos" style="margin-bottom: 45px;">

				<ul>


					<?php
						$counter = 0;
						$image_sizes['name'] = array( 'Image 260x290', 'Image 260x290', 'Image 540x290' );
						$image_sizes['sizes'] = array( array(260, 290), array(260, 290), array(540, 290));

						if( have_rows( 'homepage_tiles', 'options' ) ) : while( have_rows( 'homepage_tiles', 'options' ) ) : the_row();

							$image = array();
							$page_info = get_sub_field('related_page');
							$title = '';
							$subtitle = '';
							$image_size = $image_sizes['name'][$counter];
							$size = $image_sizes['sizes'][$counter];

							if (get_sub_field('image')) {
								$imageDetail = get_sub_field('image');
								$image['url'] = $imageDetail['sizes'][$image_size];
								$image['alt'] = $imageDetail['alt'] ? $imageDetail['alt'] : $imageDetail['name'];
							} else {
								$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $page_info->ID ), $image_size);
								$image_id = get_attachment_id_by_url(get_post_meta($page_info->ID, 'cebo_homethumb', true));
								$image_url = wp_get_attachment_image_src($image_id , $image_size);
								$image['alt'] = ( get_image_alt_text_by_post_id('',$post->ID) ? get_image_alt_text_by_post_id('',$post->ID) : get_image_alt_text_by_post_id(get_post_meta($post->ID, 'cebo_homethumb', true), '') );

								if(get_post_meta($post->ID, 'cebo_homethumb', true))
									$image['url'] = $image_url[0];
								else
									$image['url'] = $imgsrc[0];
							}

							if (get_sub_field('title')) {
								$title = get_sub_field('title');

							} else {
								$title = $page_info->post_title;
							}

							if (get_sub_field('subtitle')) {
								$subtitle = get_sub_field('subtitle');
							}


							if (get_sub_field('link'))
								$link = get_sub_field('link');
							else
								$link = get_the_permalink($page_info->ID);

							if (get_sub_field('open_link_in_new_tab'))
								$newtab = 'target="_blank"';
							else
								$newtab = '';

					?>

						<li class="hover">

							<?php //price ?>
							<?php if(get_post_meta($page_info->ID, 'cebo_pricepoint', true)) : ?>
								<div class="from-price">
									<?php echo get_post_meta($page_info->ID, 'cebo_pricepoint', true); ?>
								</div>
							<?php endif; ?>

							<?php //images ?>
							<img width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>" src="<?php echo tt($image['url'], $size[0], $size[1]); ?>" alt="<?php echo $image['alt']; ?>">

							<span><?php echo $title; ?></span>

							<div class="hover-effect">

								<?php if($subtitle) { ?>

								<a class="special-copy-link" href="<?php echo $link; ?>" <?php echo $newtab; ?>><span><?php echo $subtitle; ?></span></a>

								<?php } ?>
								<br>
								<p><?php echo $title; ?></p>

								<a class="special-external" href="<?php echo $link; ?>" <?php echo $newtab; ?>><i class="fa fa-chevron-right fa-lg"></i></a>

							</div>

						</li>

					<?php $counter++; endwhile; endif; ?>

					<div class="clear"></div>

				</ul>



			</div>

			<div class="welcometext">

				<?php query_posts('post_type=page&p=585'); if(have_posts()) : while(have_posts()) : the_post(); 	?>

				<h1><?php the_title(); ?></h1>

				<?php the_content(); ?>


				<?php endwhile; endif; wp_reset_query(); ?>

			</div>

			<div class="quote">

				<a class="quote-nav quote-next"><i class="fa fa-angle-right"></i></a>
				<a class="quote-nav quote-prev"><i class="fa fa-angle-left"></i></a>

				<div class="ico-quote quote-left fl"></div>

				<?php

					query_posts('post_type=testimonials&posts_per_page=4');
					if(have_posts()) :

				?>

					<div id="cbp-qtrotator" class="cbp-qtrotator">

						<?php while(have_posts()) : the_post(); ?>

							<div class="cbp-qtcontent">
								<blockquote>
								  <p><?php echo excerpt(40); ?></p>
								  <footer><?php the_title(); ?></footer>
								</blockquote>
							</div>

						<?php endwhile; ?>

					</div>

				<?php endif; wp_reset_query(); ?>

			</div>

			<div class="ico-quote quote-right fr"></div>

		</div>

	</div>




	<div id="neighborhood" class="section">

		<!-- section containing the to do map -->

	<ul style="" class="right-links right" id="toggles">

		<li class="dine"><a class="linkerd active" href="<?php bloginfo('url'); ?>/?page_id=505" title="Dining">Eat</a></li>
		<li class="shop"><a class="linkerd active" href="<?php bloginfo('url'); ?>/?page_id=507" title="Dining">Shop</a></li>
		<li class="arts"><a class="linkerd active" href="<?php bloginfo('url'); ?>/?page_id=503" title="Dining">Culture</a></li>
		<li class="sights"><a class="linkerd active" href="<?php bloginfo('url'); ?>/?page_id=509" title="Dining">Landmarks</a></li>

	</ul>


		<a href="#features-1" id="link" class="navigateTo page-down"></a>


    <!-- begins map area -->
	<div id="maparea" style="width: 100%; height: 500px; position: relative;">
	</div>
    <!-- begins map area -->


		<div class="container">
			<div class="section-header">

				<div class="fl">

					<span class="section-pre-title fl">Neighborhood</span>

					<div class="section-header-divider fl"></div>

					<h2 class="section-title fr">Brooklyn</h2>

				</div>

			</div>

			<div class="neighborhood-sliders">

				<div class="fl">
					<div class="slides-mini">

						<?php $query = new WP_Query( array( 'post_type' => 'tribe_events','eventDisplay' => 'upcoming', 'posts_per_page' => 4
					) ); if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>


						<div>


							<?php
							$shortdater = tribe_get_start_date($post->ID, true, 'M');
							$shortdaterend = tribe_get_end_date($post->ID, true, 'M');
						    $shortdaterz = substr($shortdater, 0, 3);
						    $shortdaterendz = substr($shortdaterend, 0, 3);

						    $shortdate = tribe_get_start_date($post->ID, true, 'j');
							$shortdateend = tribe_get_end_date($post->ID, true, 'j');
						    $shortdatez = substr($shortdate, 0, 2);
						    $shortdateendz = substr($shortdateend, 0, 2);
						?>

					<?php if( ($shortdatez== $shortdateendz) && ($shortdaterz==$shortdaterendz) ) { ?>

							<div class="post-date post-date-start" style="right: 20px;">
								<span class="date-month"><?php echo $shortdaterz; ?></span>
								<span class="date-number"><?php echo $shortdatez; ?></span>
							</div>

						<?php } else { ?>

							<div class="post-date post-date-start">
								<span class="date-month"><?php echo $shortdaterz; ?></span>
								<span class="date-number"><?php echo $shortdatez; ?></span>
							</div>

							<div style="right: 109px; padding: 10px 0;" class="post-date"><span style="font-size: 30px; line-height: 2.5;">-</span></div>

							<div class="post-date">
								<span class="date-month"><?php echo $shortdaterendz; ?></span>
								<span class="date-number date-number-end"><?php echo $shortdateendz; ?></span>
							</div>

						<?php } ?>

							<a href="<?php the_permalink(); ?>"><img src="<?php echo tt($imgsrc[0], 540, 292); ?>" alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>" ></a>
							<div class="ptit">
								<a href="<?php the_permalink(); ?>"><span><?php the_title_char_limit(40); ?></span></a>
							</div>

						</div>

						<?php endwhile; endif; wp_reset_query(); ?>




						<a href="#" class="slidesjs-previous slidesjs-navigation"><i class="fa fa-chevron-left fa-lg"></i></a>
						<a href="#" class="slidesjs-next slidesjs-navigation"><i class="fa fa-chevron-right fa-lg"></i></a>

					</div>

					<!-- <a class="slidesjs-previous slidesjs-navigation" href="#"><i class="icon-chevron-left icon-large"></i></a> -->

					<h3><a href="<?php echo get_option('eventsSlug', 'events'); ?>"><?php _e('Upcoming events', 'cebolang'); ?></a></h3>
				</div>

				<div class="fr">
					<div class="slides-mini">

						<?php query_posts('post_type=post&posts_per_page=4&cat=-10'); if(have_posts()) : while(have_posts()) : the_post();
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>


						<div>
							<a href="<?php the_permalink(); ?>"><img src="<?php echo tt($imgsrc[0], 540, 292); ?>" alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>" ></a>
							<div class="ptits">
								<a href="<?php the_permalink(); ?>"><span><?php the_title_char_limit(40); ?></span></a>
							</div>
						</div>


						<?php endwhile; endif; wp_reset_query(); ?>

						<a href="#" class="slidesjs-previous slidesjs-navigation"><i class="fa fa-chevron-left fa-lg"></i></a>
						<a href="#" class="slidesjs-next slidesjs-navigation"><i class="fa fa-chevron-right fa-lg"></i></a>
					</div>

					<h3><a href="<?php echo get_permalink(1226); ?>"><?php _e('From our blog', 'cebolang'); ?></a></h3>
				</div>

			</div>
		</div>

	</div>

<?php get_footer(); ?>