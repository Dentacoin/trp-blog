<?php get_header(); ?>

	<div class="error-wrapper">
		<div class="blue-line"></div>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/404.jpg" alt="Dentacoin page not found">

		<div class="error-container container">
			<h2>Sorry, Page Was Not Found. <br> Check Our Latest Posts.</h2>

    		<div class="section-slider-posts">
	    		<div class="slider-posts-inner">

		    		<div class="flickity slider-posts">
		    			<?php $args = array(
							'posts_per_page'   => 6,
							'post_type'        => 'post',
							'post_status'      => 'publish',
							'orderby'          => 'id',
							'order'            => 'DESC',
						);
						$latest_posts = get_posts( $args );

						foreach ($latest_posts as $l_post) { 
							$src = wp_get_attachment_image_src( get_post_thumbnail_id( $l_post->ID ), 'medium', false ); ?>

			    			<div class="post">
			    				<div class="post-inner">
				    				<a href="<?php the_permalink($l_post->ID); ?>" class="post-image cover" style="background-image: url(<?php echo $src[0] ?>); background-position: 50% <?php echo !empty(get_field('featured_image_position', $l_post->ID)) || get_field('featured_image_position', $l_post->ID) === '0' ? get_field('featured_image_position', $l_post->ID).'%' : '50%' ?>">
										<?php
										$post_date = date('Y-m-d', strtotime(get_the_date())) ;
										$date_from = '2021-09-15';
										
										if( $post_date > $date_from ) {
											if(!empty(get_field('left_tag'))) {
												if(!empty(get_field('left_tag_image'))) { ?>
													<img class="left-tag" src="<?php echo get_field('left_tag_image'); ?>"/>
												<?php } else { ?>
													<img class="left-tag" src="https://reviews.dentacoin.com/blog/wp-content/uploads/2021/09/dcn-accepted-here-tag.png"/>
												<?php }
											}
											
											if(!empty(get_field('right_tag'))) {
												if(!empty(get_field('right_tag_image'))) { ?>
													<img class="right-tag" src="<?php echo get_field('right_tag_image'); ?>"/>
												<?php } else { ?>
													<img class="right-tag" src="https://reviews.dentacoin.com/blog/wp-content/uploads/2021/09/in-the-spotlight-1.png"/>
												<?php }
											}
										} ?>
									</a>
			    					<div class="hover-top">
					    				<div class="post-info">
						    				<?php foreach (wp_get_post_categories( $l_post->ID ) as $k => $h_cat_id) {
					    						if($k == 0) { ?>
					    							<a href="<?php echo get_category_link($h_cat_id); ?>" class="cat">
														<?php echo get_category($h_cat_id)->name; ?>
													</a>
												<?php }
											} ?>
						    				<span class="date"><?php echo get_the_date('M j, Y (D)', $l_post->ID); ?></span> 
						    			</div>
						    			<a href="<?php the_permalink($l_post->ID); ?>"><h4><?php echo get_the_title($l_post->ID); ?></h4></a>
						    		</div>
						    		<div class="bottom-container">
						    			<p>
						    				<?php echo get_the_excerpt($l_post->ID); ?>
						    			</p>
				    					<a href="<?php the_permalink($l_post->ID); ?>" class="read-more"><?php _e("Read more",'blogtrp'); ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/read-arrow.png"></a>
						    		</div>
					    		</div>
			    			</div>
			    		<?php } ?>
		    		</div>
		    	</div>
	    	</div>
			<div class="tac">
	    		<a href="<?php echo get_site_url(); ?>" class="blue-button"><?php _e("Back to home page", 'blogtrp'); ?></a>
	    	</div>
		</div>
	</div>

<?php get_footer(); ?>