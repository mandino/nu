<div id="home-slider">
	
	<div class="flexslider">
		<ul class="slides">
		
			<!-- loop for the slides -->
		
			<?php query_posts('post_type=slides&posts_per_page=5'); if(have_posts()) : while(have_posts()) : the_post(); 
			$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");?>
			
			
			<li style="background-image: url(<?php echo tt($imgsrc[0], 1400, 498); ?>);">
				<a target="_blank" href="<?php echo get_post_meta($post->ID, 'sliderurl', true); ?>">
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
				<img src="<?php echo $imgsrc[0]; ?>" alt="<?php get_post_meta($post->ID, 'bigtitle', true); ?>" />
			</a>
			</li>
			
			
			<?php endwhile; endif; wp_reset_query(); ?>	
			
			<!-- end loop for the slides -->
			
		</ul>
	</div>
		
</div>