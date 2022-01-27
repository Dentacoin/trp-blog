<?php 
get_header();

	while ( have_posts() ) {
	the_post();	?>

		<div class="main-section">
    		<div class="container">
    			<h1><?php _e("- The Blog for Trusted Dentist Reviews from Real Patients -", 'blogtrp'); ?></h1>
    		</div>
    	</div>

    	<div class="front-info container">
    		<?php 
			$query = new WP_Query( array( 
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'orderby'          => 'date',
				'order'            => 'DESC',
				'posts_per_page' => -1,
			) );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
			    	$query->the_post(); 
			    	if(get_field('featured', $featured->ID) === true) {
			        	$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large', false ); ?>

			    		<a href="<?php the_permalink(); ?>" class="main-image cover" style="background-image: url(<?php echo $src[0]; ?>); background-position: 50% <?php echo !empty(get_field('featured_image_position')) || get_field('featured_image_position') === '0' ? get_field('featured_image_position').'%' : '50%' ?>">
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
			    		<div class="main-post">
			    			<div class="post-wrapper">
				    			<div class="post-info">
				    				<?php foreach (wp_get_post_categories( get_the_ID() ) as $k => $f_cat_id) {
			    						if($k == 0) { ?>
			    							<a href="<?php echo get_category_link($f_cat_id); ?>" class="cat">
												<?php echo get_category($f_cat_id)->name; ?>
											</a>
										<?php }
									} ?>
				    				<span class="date"><?php echo get_the_date('M j, Y (D)'); ?></span> 
				    			</div>
				    			<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
				    			<?php the_excerpt(); ?>
				    			<a href="<?php the_permalink(); ?>" class="read-more"><?php _e("Read more", 'blogtrp'); ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/read-arrow.png"></a>
				    		</div>
			    		</div>
			    		<?php break;
		    		}
		    	}
		    	wp_reset_postdata();
		    } ?>
    	</div>

    	<div class="section-slider-posts">
    		<h2 class="section-title"><span><?php _e("HIGHLIGHTS", 'blogtrp'); ?></span></h2>

    		<div class="slider-posts-inner">

	    		<div class="flickity slider-posts">
	    			<?php $args = array(
						'posts_per_page'   => -1,
						'post_type'        => 'post',
						'post_status'      => 'publish',
					);
					$highlights_posts = get_posts( $args );

					foreach ($highlights_posts as $h_post) { 
						if(get_field('higthlights', $h_post->ID) === true) {
							$src = wp_get_attachment_image_src( get_post_thumbnail_id( $h_post->ID ), 'medium', false ); ?>

			    			<div class="post">
			    				<div class="post-inner">
				    				<a href="<?php the_permalink($h_post->ID); ?>" class="post-image cover" style="background-image: url(<?php echo $src[0] ?>); background-position: 50% <?php echo !empty(get_field('featured_image_position', $h_post->ID)) || get_field('featured_image_position', $h_post->ID) === '0' ? get_field('featured_image_position', $h_post->ID).'%' : '50%' ?>">
										<?php if( get_the_date('d', $h_post->ID) >= '15' && get_the_date('m', $h_post->ID) >= '09' && get_the_date('Y', $h_post->ID) >= '2021' ) {
											if(!empty(get_field('left_tag', $h_post->ID))) {
												if(!empty(get_field('left_tag_image', $h_post->ID))) { ?>
													<img class="left-tag" src="<?php echo get_field('left_tag_image', $h_post->ID); ?>"/>
												<?php } else { ?>
													<img class="left-tag" src="https://reviews.dentacoin.com/blog/wp-content/uploads/2021/09/dcn-accepted-here-tag.png"/>
												<?php }
											}
											
											if(!empty(get_field('right_tag', $h_post->ID))) {
												if(!empty(get_field('right_tag_image', $h_post->ID))) { ?>
													<img class="right-tag" src="<?php echo get_field('right_tag_image', $h_post->ID); ?>"/>
												<?php } else { ?>
													<img class="right-tag" src="https://reviews.dentacoin.com/blog/wp-content/uploads/2021/09/in-the-spotlight-1.png"/>
												<?php }
											}
										} ?>
									</a>
			    					<div class="hover-top">
					    				<div class="post-info">
						    				<?php foreach (wp_get_post_categories( $h_post->ID ) as $k => $h_cat_id) {
					    						if($k == 0) { ?>
					    							<a href="<?php echo get_category_link($h_cat_id); ?>" class="cat">
														<?php echo get_category($h_cat_id)->name; ?>
													</a>
												<?php }
											} ?>
						    				<span class="date"><?php echo get_the_date('M j, Y (D)', $h_post->ID); ?></span> 
						    			</div>
						    			<a href="<?php the_permalink($h_post->ID); ?>"><h4><?php echo get_the_title($h_post->ID); ?></h4></a>
						    		</div>
						    		<div class="bottom-container">
						    			<p>
						    				<?php echo get_the_excerpt($h_post->ID); ?>
						    			</p>
				    					<a href="<?php the_permalink($h_post->ID); ?>" class="read-more"><?php _e("Read more",'blogtrp'); ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/read-arrow.png"></a>
						    		</div>
					    		</div>
			    			</div>
			    		<?php }
			    	} ?>
	    		</div>
	    	</div>
    	</div>

    	<div class="section-slider-dentists">
    		<h2 class="section-title"><span><?php _e("top 3 dentists this month", 'blogtrp'); ?></span></h2>

    		<div class="container">
	    		<div class="slider-dentists">
	    			<?php $args = array(
						'posts_per_page'   => 3,
						'orderby'          => 'date',
						'order'            => 'DESC',
						'post_type'        => 'dentist',
						'post_status'      => 'publish',
					);
					$dentists = get_posts( $args );

					foreach ($dentists as $dentist) {
						$src = wp_get_attachment_image_src( get_post_thumbnail_id( $dentist->ID ), 'medium', false ); ?>

						<a class="slider-wrapper" target="_blank" href="<?php echo get_field('link', $dentist->ID); ?>">
							<div class="slider-image-wrapper"> 
								<div class="slider-image" style="background-image: url(<?php echo $src[0]; ?>);">
									<?php if(get_field('dcn_partner', $dentist->ID) === true) { ?>
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mini-logo.png"/>
									<?php } ?>
								</div>
							</div>
						    <div class="slider-container">
						    	<p class="dentist-info green-text"><?php echo get_field('info', $dentist->ID ); ?></p>
						    	<h4><?php echo get_the_title($dentist->ID); ?></h4>

						    	<?php if (!empty(get_field('address', $dentist->ID ))) { ?>
							    	<div class="p">
							    		<div class="img">
							    			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/map-pin.png">
							    		</div>
										<?php echo get_field('address', $dentist->ID ); ?>
							    	</div>
						    	<?php } ?>

							    <div class="ratings">
									<div class="stars" style="vertical-align: middle;">
										<div class="bar" style="width: <?php echo !empty(get_field('rating', $dentist->ID )) ? (get_field('rating', $dentist->ID )/5*100) : 0 ?>%;">
										</div>
									</div>
									<span class="rating">
										(<?php echo !empty(get_field('reviews_number', $dentist->ID )) ? get_field('reviews_number', $dentist->ID ) : 0 ?> reviews)
									</span>
								</div>
						    </div>
					    	<div class="flickity-buttons clearfix">
					    		<div>
					    			<?php _e("See Profile", 'blogtrp'); ?>
					    		</div>
					    		<div href="<?php echo get_field('link', $dentist->ID); ?>?popup-loged=submit-review-popup">
					    			<?php _e("Submit review", 'blogtrp'); ?>
					    		</div>
					    	</div>
						</a>

					<?php } ?>
				</div>
				<div class="tac">
		    		<a target="_blank" href="https://reviews.dentacoin.com/" class="gray-button"><?php _e("FIND DENTISTS AROUND YOU", 'blogtrp'); ?></a>
		    	</div>
			</div>
    	</div>

    	<div class="section-news">
    		<h2 class="section-title"><span><?php _e("News", 'blogtrp'); ?></span></h2>

    		<div class="container">
	    		<div class="news-wrapper">
		    		<script type="text/javascript">
			            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

			            jQuery(document).ready(function($){
				            function cvf_load_all_posts(page){
						        // Start the transition
						        $(".cvf_pag_loading").fadeIn().css('background','#ccc');

						        // Data to receive from our server
						        // the value in 'action' is the key that will be identified by the 'wp_ajax_' hook 
						        var data = {
						            page: page,
						            action: "demo-pagination-load-posts"
						        };

						        // Send the data
						        $.post(ajaxurl, data, function(response) {
						            // If successful Append the data into our html container
						            $(".cvf_universal_container").html('').append(response);
						            // End the transition
						            $(".cvf_pag_loading").css({'background':'none', 'transition':'all 1s ease-out'});
						        });
						    }

						    // Load page 1 as the default
						    cvf_load_all_posts(1);

						    // Handle the clicks
						    $('.cvf_universal_container .cvf-universal-pagination li.active').live('click',function(){
						        var page = $(this).attr('p');
						        $('.cvf-pagination-nav').first().remove();
						        cvf_load_all_posts(page);
						        

						        $('html, body').animate({
						            scrollTop: $('.section-news').offset().top - 90
						        }, 500);
						    });
						});
			        </script>
			        <div class = "cvf_pag_loading">
			            <div class = "cvf_universal_container">
			                <div class="cvf-universal-content flex wrap"></div>
			            </div>
			        </div>
	    		</div>
	    	</div>
    	</div>

	    <div class="blue-ribbon">
			<div class="container flex">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/review.png" alt="Dentacoin trusted reviews">
				<div class="ribbon-box">
					<h2>
						<?php _e("Learn and Earn From Your Patients' Feedback!", 'blogtrp'); ?>
					</h2>
				</div>
				<a href="https://reviews.dentacoin.com/?popup=popup-register" target="_blank" class="white-transparent-button"><?php _e("Sign up", 'blogtrp'); ?></a>
			</div>
		</div>
	</div>

	<?php } 
get_footer(); ?>