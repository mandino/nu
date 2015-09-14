<?php 

/* Template Name: Neighborhood Guide

*/
 get_header(); ?>




  <ul class="right-links right" id="toggles">
										
		<li class="dine"><a class="linkerd active" href="/?page_id=505" title="Dining">Eat</a></li>
		<li class="shop"><a class="linkerd active" href="/?page_id=507" title="Dining">Shop</a></li>
		<li class="arts"><a class="linkerd active" href="/?page_id=503" title="Dining">Culture</a></li>
		<li class="sights"><a class="linkerd active" href="/?page_id=509" title="Dining">Landmarks</a></li>
		
	</ul>

						
						
						<a href="#features-1" id="link" class="navigateTo page-down"></a>
						
						
    <!-- begins map area -->
	<div id="maparea" style="width: 100%; height: 500px;">
	
	
	
	</div>
    <!-- begins map area -->


<div id="neighborhood-guide" class="section" style="padding: 20px 0 30px; border-bottom: 1px solid #D1D1D1;">
		
		<div class="container">

			<div class="section-header">
					
				<div class="fl">
	
					<?php if(get_option('cebo_shorttitle')) { ?>
					
					<h2 class="section-pre-title fl"><?php echo get_option('cebo_shorttitle'); ?></h2>

					<div class="section-header-divider fl"></div>
					
					<?php } ?>

		
					<h2 class="section-title fr"><?php the_title(); ?></h2>
	
				</div>
	
				<div class="fr">
					
					<ul class="social-buttons">
					<?php if(get_option('cebo_facebook')) { ?>
					
						<li class="facebook"><a href="http://facebook.com/<?php echo get_option('cebo_facebook'); ?>" target="_blank"><i class="fa fa-facebook fa-2x"></i><span>facebook</span></a></li>
						
					<?php } ?>
					<?php if(get_option('cebo_twitter')) { ?>
					
						<li class="twitter"><a href="http://twitter.com/<?php echo get_option('cebo_twitter'); ?>" target="_blank"><i class="fa fa-twitter fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>
					<?php if(get_option('cebo_instagram')) { ?>
					
						<li class="instagram"><a href="http://instagram.com/<?php echo get_option('cebo_instagram'); ?>" target="_blank"><i class="fa fa-instagram fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>
					</ul>
	
				</div>
	
			</div>
		
		</div>
			
		<div id="tabs-wrapper" class="tabs-wrapper">
		
			<div class="container">
				<div class="category-neighbor">
				<?php 
					// $post_thumbnail_eat = get_post_thumbnail_id( 505 );
					// $post_thumbnail_shop = get_post_thumbnail_id( 507 );
					// $post_thumbnail_culture = get_post_thumbnail_id( 503 );
					// $post_thumbnail_landmarks = get_post_thumbnail_id( 509 );

					// $image_eat = wp_get_attachment_url( $post_thumbnail_eat );
					// $image_shop = wp_get_attachment_url( $post_thumbnail_shop );
					// $image_culture = wp_get_attachment_url( $post_thumbnail_culture );
					// $image_landmarks = wp_get_attachment_url( $post_thumbnail_landmarks );
				?>

					<!-- <div class="eat" style="background-image: url(<?php echo $image_eat; ?>); margin-right: 10px; margin-top: 12px;">
						<a href="<?php echo get_permalink( $post->post_parent ); ?>/eat">Eat</a>
					</div>
					<div class="shop" style="background-image: url(<?php echo $image_shop; ?>); margin-top: 12px;">
						<a href="<?php echo get_permalink( $post->post_parent ); ?>/shop">Shop</a>
					</div>
					<div class="culture" style="background-image: url(<?php echo $image_culture; ?>); margin-right: 10px; margin-top: 12px;">
						<a href="<?php echo get_permalink( $post->post_parent ); ?>/culture">Culture</a>
					</div>
					<div class="landmarks" style="background-image: url(<?php echo $image_landmarks; ?>); margin-top: 12px;">
						<a href="<?php echo get_permalink( $post->post_parent ); ?>/landmarks">Landmarks</a>
					</div>-->


					<!-- ECHO EAT -->
					<?php
						$query_eat = new WP_Query('post_type=page&p=505');
						if ($query_eat->have_posts()) : while ($query_eat->have_posts()) : $query_eat->the_post();
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
					?>

							<div style="background-image: url(<?php echo $imgsrc[0]; ?>); margin-top: 10px; margin-right: 10px;">
								<a href="<?php echo get_permalink( $post->post_parent ); ?>/eat">
									<span class="def-title"><?php echo get_post_meta($post->ID, 'cebo_popout_title', true); ?></span>
									<span class="hover-title"><?php echo get_post_meta($post->ID, 'cebo_popout_welcome', true); ?></span>
								</a>		
							</div>

					<?php endwhile; endif; wp_reset_postdata(); ?>


					<!-- ECHO SHOP -->
					<?php
						$query_eat = new WP_Query('post_type=page&p=507');
						if ($query_eat->have_posts()) : while ($query_eat->have_posts()) : $query_eat->the_post();
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
					?>
						<div style="background-image: url(<?php echo $imgsrc[0]; ?>); margin-top: 12px;">
							<a href="<?php the_permalink(); ?>">
								<span class="def-title"><?php echo get_post_meta($post->ID, 'cebo_popout_title', true); ?></span>
								<span class="hover-title"><?php echo get_post_meta($post->ID, 'cebo_popout_welcome', true); ?></span>
							</a>
						</div>
					<?php endwhile; endif; wp_reset_postdata(); ?>


					<!-- ECHO CULTURE -->
					<?php
						$query_eat = new WP_Query('post_type=page&p=503');
						if ($query_eat->have_posts()) : while ($query_eat->have_posts()) : $query_eat->the_post();
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
					?>
						<div style="background-image: url(<?php echo $imgsrc[0]; ?>); margin-right: 10px; margin-top: 12px;">
							<a href="<?php the_permalink(); ?>">
								<span class="def-title"><?php echo get_post_meta($post->ID, 'cebo_popout_title', true); ?></span>
								<span class="hover-title"><?php echo get_post_meta($post->ID, 'cebo_popout_welcome', true); ?></span>
							</a>	
						</div>
					<?php endwhile; endif; wp_reset_postdata(); ?>


					<!-- ECHO LANDMARK -->
					<?php
						$query_eat = new WP_Query('post_type=page&p=509');
						if ($query_eat->have_posts()) : while ($query_eat->have_posts()) : $query_eat->the_post();
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
					?>
						<div style="background-image: url(<?php echo $imgsrc[0]; ?>); margin-top: 12px;">
							<a href="<?php the_permalink(); ?>">
								<span class="def-title"><?php echo get_post_meta($post->ID, 'cebo_popout_title', true); ?></span>
								<span class="hover-title"><?php echo get_post_meta($post->ID, 'cebo_popout_welcome', true); ?></span>
							</a>
						</div>
					<?php endwhile; endif; wp_reset_postdata(); ?>

				</div> 
			</div>
			
			<div class="tabs-container">
				
				<div class="container">
					<div class="neighbor-content">
						<?php the_content(); ?>
					</div>
				</div>
				
			</div>
			<div class="clear"></div>
			
			
		<div class="container">
		
		
			<div class="upcoming-events">

				<h2>Upcoming Events</h2>

				<div class="upcoming-calendar fl tribe_mini_calendar_widget">
					
					 <!-- widgetized  -->

		     		<?php if ( !function_exists('dynamic_sidebar')
							|| !dynamic_sidebar('Footer Column 2') ) : ?>
					<?php endif; ?>  

					<a href="<?php bloginfo('url'); ?>/events" style="text-align: center; margin-top: 10px; display: inline-block;">See all events</a>
		
			     	<!-- widgetized  -->		
								
				</div>

				<div class="fr">
					<ul>
					
						
						
		            	<?php $count = 1; $query = new WP_Query( array( 'post_type' => 'tribe_events','eventDisplay' => 'upcoming', 'posts_per_page' => 4
							) ); if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
						
						<li<?php if($count == 2 || $count == 4) { ?> class="even"<?php } ?>>
							
							
							<a href="<?php the_permalink(); ?>"><img src="<?php echo tt($imgsrc[0], 275, 178); ?>"  alt="<?php the_title();?>"/>
							
							
							<?php $shortdater = tribe_get_start_date($post->ID, true, 'M'); $shortdaterz = substr($shortdater, 0, 3);  ?>
							
							<?php $shortdate = tribe_get_start_date($post->ID, true, 'j'); $shortdatez = substr($shortdate, 0, 2);  ?>
							
							<div class="event-date"><?php echo $shortdaterz; ?> <span><?php echo $shortdatez; ?></span></div>
							<div class="event-description">
								<p><?php the_title(); ?></p>
							</div>
							
							</a>
						</li>
						
						
						<?php $count++;  endwhile; endif; wp_reset_query(); ?>	
						

					</ul>
				</div>

			</div>
			
			<div class="clear"></div>
		
		</div>
		
		<div class="heater">
					
			<div class="container">

				<div class="whats-hot">
	
					<h2>What's Hot</h2>
	
					<div>
						<ul>
						
							<?php query_posts('post_type=post&posts_per_page=2&offset=1&cat=-10'); if(have_posts()) : while(have_posts()) : the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
							
							<li>
								<a href="<?php the_permalink(); ?>"><img src='<?php echo tt($imgsrc[0], 240, 161); ?>' alt='<?php the_title(); ?>' /></a>
								<a href="<?php the_permalink(); ?>"><h3 style="margin-top: 15px;"><?php the_title(); ?></h3></a>
								<p><?php echo excerpt(10); ?></p>
							</li>
							<?php endwhile; endif; wp_reset_query(); ?>	
							
							
						</ul>
						<ul class="hot-featured">
						
						<?php query_posts('post_type=post&posts_per_page=1&cat=-10'); if(have_posts()) : while(have_posts()) : the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
							<li>
								<a href="<?php the_permalink(); ?>"><img src='<?php echo tt($imgsrc[0], 540, 361); ?>' alt='<?php the_title(); ?>' /></a>
								<a href="<?php the_permalink(); ?>"><h3 style="margin-top: 15px;"><?php the_title(); ?></h3></a>
								<p><?php echo excerpt(80); ?></p>
							</li>
						</ul>
						<?php endwhile; endif; wp_reset_query(); ?>	
						
						
						
						<ul>
						
							<?php query_posts('post_type=post&posts_per_page=2&offset=3&cat=-10'); if(have_posts()) : while(have_posts()) : the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
							
							<li>
								<a href="<?php the_permalink(); ?>"><img src='<?php echo tt($imgsrc[0], 240, 161); ?>' alt='<?php the_title(); ?>' /></a>
								<a href="<?php the_permalink(); ?>"><h3 style="margin-top: 15px;"><?php the_title(); ?></h3></a>
								<p><?php echo excerpt(10); ?></p>
							</li>
						<?php endwhile; endif; wp_reset_query(); ?>	
						</ul>
						
						<div class="clear"></div>

						<?php $projects = get_page_with_template('page_blog');
				  				$projecturl= get_permalink($projects);	
									?>

						<a href="<?php echo $projecturl; ?>" style="width: 99%; display: block; padding: 20px 0; font-family: didot, serif; font-size: 20px;" class="button">View All Posts</a>
						
					</div>
	
				</div>
				
				<div class="clear"></div>
			</div>

		</div>

	</div>
	
	<div class="clear"></div>

	</div>


<?php include (TEMPLATEPATH . '/library/super-map.php'); ?>
<?php get_footer(); ?>