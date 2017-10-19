<div id="home-slider">

	<?php if(get_option('cebo_video_homepage_hero_banner') && is_home()) : ?>

		<div class="video-banner" data-vide-bg="<?php echo preg_replace('/\\.[^.\\s]{3,4}$/', '',get_option('cebo_video_homepage_hero_banner')) ?>" style="background-image: url('<?php echo get_option("cebo_video_thumbnail_homepage_hero_banner") ?>');">

			<div class="logo-container">
				<div class="video-header">
					<?php query_posts('post_type=slides&posts_per_page=1'); if(have_posts()) : while(have_posts()) : the_post();  ?>

						<?php if(get_post_meta($post->ID, 'logopic', true)) { ?>

							<div class="slicer" style="background-image: url(<?php echo get_post_meta($post->ID, 'logopic', true); ?>);"></div>

						<?php } ?>

						<?php if(get_post_meta($post->ID, 'bigtitle', true)) { ?>

							<h2><?php echo get_post_meta($post->ID, 'bigtitle', true); ?></h2>

						<?php } ?>

						<?php if(get_post_meta($post->ID, 'littletitle', true)) { ?>

							<h3><?php echo get_post_meta($post->ID, 'littletitle', true); ?></h3>

						<?php } ?>

					<?php endwhile; endif; wp_reset_query(); ?>
				</div>
			</div>

			<!-- loop for the slides -->
		</div>

	<?php else : ?>

		<div class="flexslider">
			<ul class="slides">
			
				<!-- loop for the slides -->
			
				<?php query_posts('post_type=slides&posts_per_page=5'); if(have_posts()) : while(have_posts()) : the_post(); 
				$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");?>
				
				
				<li style="background-image: url(<?php echo tt($imgsrc[0], 1400, 498); ?>);">
					<div class="slide-header">
						
						<?php if(get_post_meta($post->ID, 'logopic', true)) { ?>
						
						<div class="slicer" style="background-image: url(<?php echo get_post_meta($post->ID, 'logopic', true); ?>);"></div>
											
						<?php } ?>
						
						
						<?php if(get_post_meta($post->ID, 'bigtitle', true)) { ?>
						
						<h2><?php echo get_post_meta($post->ID, 'bigtitle', true); ?></h2>
						
						<?php } ?>
						
						<?php if(get_post_meta($post->ID, 'littletitle', true)) { ?>
						
						<h3><?php echo get_post_meta($post->ID, 'littletitle', true); ?></h3>
						
						<?php } ?>
						
					</div>
					<!--<img src="<?php //echo $imgsrc[0]; ?>" alt="<?php //get_post_meta($post->ID, 'bigtitle', true); ?>" />-->
					<img src="<?php echo $imgsrc[0]; ?>" alt="<?php if( get_post_meta($post->ID, 'bigtitle', true) ) echo get_post_meta($post->ID, 'bigtitle', true); else echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID )); ?>" />
				</li>
				
				
				<?php endwhile; endif; wp_reset_query(); ?>	
				
				<!-- end loop for the slides -->
				
			</ul>
		</div>

	<?php endif; ?>

	<?php 
/* popout box */
		$popout_query = new WP_Query(
			array(
				'post_type' => 'popout-box', 
				'posts_per_page' => 1,
			)
		);

		if($popout_query->have_posts()) :

			$specialsboxID = 1;

			while($popout_query->have_posts()) : $popout_query->the_post();
	?>
				<div class="specialsbox ID<?php echo $specialsboxID; ?>">
					<div class="closebox"><a href="#">X</a></div>

					<?php if(get_post_meta($post->ID, 'cebo_popout_welcome', true)) { ?>
						<span class="welcome-text"><?php echo get_post_meta($post->ID, 'cebo_popout_welcome', true); ?></span>
					<?php } ?>

					<div class="specialtab">
						<?php if(get_post_meta($post->ID, 'cebo_popout_url', true)) { ?>
							<a href="<?php echo get_post_meta($post->ID, 'cebo_popout_url', true); ?>"><h3 style="font-size: 25px;">
						<?php } ?>

							<span><?php echo get_post_meta($post->ID, 'cebo_popout_subtitle', true); ?></span>
							<?php echo get_post_meta($post->ID, 'cebo_popout_title', true); ?><br>
							<span><?php echo get_post_meta($post->ID, 'cebo_popout_tagline', true); ?></span></h3>

						<?php if(get_post_meta($post->ID, 'cebo_popout_url', true)) { ?></a><?php } ?>
					</div>
				</div>
				<?php $specialsboxID ++; ?>
			<?php endwhile; ?>

	<?php endif; ?>
</div>