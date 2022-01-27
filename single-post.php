<?php get_header(); 

	while ( have_posts() ) {
		the_post();	
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large', false ); ?>

		<div class="main-section"></div>

	    <div class="main-image cover" style="background-image: url(<?php echo !empty(get_field('inner_post_featured_image')) ? get_field('inner_post_featured_image')['sizes']['large'] : $src[0]; ?>); background-position: 50% <?php echo !empty(get_field('inner_post_featured_image_position')) || get_field('inner_post_featured_image_position') === '0' ? get_field('inner_post_featured_image_position').'%' : '50%' ?>">

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
		</div>

    	<div class="post-wrapper">
    		<div class="post-info">
    			<p>
    				Published <span class="hide-mobile">by <?php the_author_posts_link(); ?></span> in <a href="<?php echo get_category_link(get_the_category()[0]->term_id); ?>" class="blue"><?php echo get_the_category()[0]->name; ?></a> on <?php echo get_the_date('M j, Y (D)'); ?>
    			</p>

			    <h1><?php the_title(); ?></h1>
			</div>
		</div>
	    <div class="flex main-post-wrapper">
	    	<div class="col col-shares">
	    		<div class="shares-outer">
			    	<div class="shares a2a_kit a2a_kit_size_32 addtoany_list" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>">
			    		<div class="share twt">
					      	<a href="javascript:;">
				         		<span class="at-icon-wrapper" style="line-height: 32px; height: 32px; width: 32px;">
				            		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-twitter-1" class="at-icon at-icon-twitter">
				               			<title id="at-svg-twitter-1">Twitter</title>
					               		<g>
					                  		<path d="M27.996 10.116c-.81.36-1.68.602-2.592.71a4.526 4.526 0 0 0 1.984-2.496 9.037 9.037 0 0 1-2.866 1.095 4.513 4.513 0 0 0-7.69 4.116 12.81 12.81 0 0 1-9.3-4.715 4.49 4.49 0 0 0-.612 2.27 4.51 4.51 0 0 0 2.008 3.755 4.495 4.495 0 0 1-2.044-.564v.057a4.515 4.515 0 0 0 3.62 4.425 4.52 4.52 0 0 1-2.04.077 4.517 4.517 0 0 0 4.217 3.134 9.055 9.055 0 0 1-5.604 1.93A9.18 9.18 0 0 1 6 23.85a12.773 12.773 0 0 0 6.918 2.027c8.3 0 12.84-6.876 12.84-12.84 0-.195-.005-.39-.014-.583a9.172 9.172 0 0 0 2.252-2.336" fill-rule="evenodd"></path>
					               		</g>
				            		</svg>
				         		</span>
					      	</a>
					    </div>
			    		<div class="share fb">
					      	<a href="javascript:;">
					         	<span class="at-icon-wrapper" style="line-height: 32px; height: 32px; width: 32px;">
					            	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-facebook-2" class="at-icon at-icon-facebook">
					               		<title id="at-svg-facebook-2">Facebook</title>
				               			<g>
				                  			<path d="M22 5.16c-.406-.054-1.806-.16-3.43-.16-3.4 0-5.733 1.825-5.733 5.17v2.882H9v3.913h3.837V27h4.604V16.965h3.823l.587-3.913h-4.41v-2.5c0-1.123.347-1.903 2.198-1.903H22V5.16z" fill-rule="evenodd"></path>
				               			</g>
					            	</svg>
					         	</span>
					      	</a>
					    </div>
					    <?php if(false) { ?>
				    		<!-- <div class="share email">
						      	<a href="javascript:;">
						         	<span class="at-icon-wrapper" style="line-height: 32px; height: 32px; width: 32px;">
						            	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-mailto-3" class="at-icon at-icon-mailto">
						               		<title id="at-svg-mailto-3">Email App</title>
						               		<g>
						                  		<g fill-rule="evenodd"></g>
					                  			<path d="M26.684 23.264H4.948v-12.88l.2-.1c.303-.202 7.046-4.73 8.152-5.435 1.41-.907 3.22-.806 4.63.1 1.308.804 8.453 5.333 8.453 5.333l.2.1.1 12.88zm-20.63-1.006H25.68v-11.27c-1.207-.806-7.044-4.53-8.252-5.133-1.107-.704-2.515-.704-3.622-.1-1.007.603-6.743 4.528-7.95 5.232.2.1.2 11.27.2 11.27z"></path>
						                  		<path d="M21.753 16.622H10.08a1.59 1.59 0 0 1-1.61-1.61v-3.02c0-.905.704-1.61 1.61-1.61h11.673c.906 0 1.61.705 1.61 1.61v3.02a1.59 1.59 0 0 1-1.61 1.61zM9.98 11.49c-.404 0-.605.302-.605.604v3.02c0 .4.302.603.604.603H21.65c.403 0 .604-.302.604-.604v-3.02c0-.402-.302-.603-.604-.603H9.98z"></path>
						                  		<path d="M25.778 21.956v-10.97l-5.837 4.53 5.838 6.44zM5.954 21.956v-10.97l5.837 4.53-5.836 6.44z"></path>
						                  		<path d="M25.778 22.76l-6.138-6.74h-7.548l-6.137 6.74-.806-.603 6.54-7.145h8.353l6.54 7.145-.805.604z"></path>
						                  		<path d="M25.945 10.334l.61.8-6.32 4.823-.61-.8zM5.902 10.386l6.326 4.814-.61.802-6.326-4.815zM15.816 17.83l.302 8.252 2.013-2.516 2.013 4.226 1.107-.503-2.113-4.227 3.22-.2-6.54-5.033z"></path>
						               		</g>
						            	</svg>
						         	</span>
						      	</a>
						    </div> -->
						<?php } ?>
			    		<div class="share in">
					      	<a href="javascript:;">
					         	<span class="at-icon-wrapper" style="line-height: 32px; height: 32px; width: 32px;">
					            	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-linkedin-4" class="at-icon at-icon-linkedin">
					               		<title id="at-svg-linkedin-4">LinkedIn</title>
				               			<g>
				                  			<path d="M26 25.963h-4.185v-6.55c0-1.56-.027-3.57-2.175-3.57-2.18 0-2.51 1.7-2.51 3.46v6.66h-4.182V12.495h4.012v1.84h.058c.558-1.058 1.924-2.174 3.96-2.174 4.24 0 5.022 2.79 5.022 6.417v7.386zM8.23 10.655a2.426 2.426 0 0 1 0-4.855 2.427 2.427 0 0 1 0 4.855zm-2.098 1.84h4.19v13.468h-4.19V12.495z" fill-rule="evenodd"></path>
				               			</g>
				            		</svg>
					         	</span>
					      	</a>
					    </div>
					    <?php if(false) { ?>
				    		<!-- <div class="share messenger">
						      	<a href="javascript:;">
						         	<span class="at-icon-wrapper" style="line-height: 32px; height: 32px; width: 32px;">
						            	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-messenger-5" class="at-icon at-icon-messenger">
						               		<title id="at-svg-messenger-5">Messenger</title>
					               			<g>
					                  			<path d="M16 6C9.925 6 5 10.56 5 16.185c0 3.205 1.6 6.065 4.1 7.932V28l3.745-2.056c1 .277 2.058.426 3.155.426 6.075 0 11-4.56 11-10.185C27 10.56 22.075 6 16 6zm1.093 13.716l-2.8-2.988-5.467 2.988 6.013-6.383 2.868 2.988 5.398-2.987-6.013 6.383z" fill-rule="evenodd"></path>
					               			</g>
					            		</svg>
						         	</span>
						      	</a>
						    </div> -->
						<?php } ?>
					    <?php if ( is_active_sidebar( 'post_social_share' ) ) { ?>
							<div class="social-share-widget" role="complementary">
								<?php dynamic_sidebar( 'post_social_share' ); ?>
							</div>
						<?php } ?>

						<?php if(false) { ?>
				    		<!-- <div class="share slack">
						      	<a href="javascript:;">
						         	<span class="at-icon-wrapper" style="line-height: 32px; height: 32px; width: 32px;">
						            	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-slack-6" class="at-icon at-icon-slack">
						               		<title id="at-svg-slack-6">Slack</title>
					               			<g>
					                  			<path d="M9.622 18.902c0 1.272-1.04 2.31-2.31 2.31A2.317 2.317 0 0 1 5 18.903c0-1.272 1.04-2.31 2.31-2.31h2.312v2.31zm1.165 0c0-1.272 1.04-2.31 2.31-2.31 1.273 0 2.312 1.038 2.312 2.31v5.787c0 1.27-1.04 2.31-2.312 2.31a2.317 2.317 0 0 1-2.31-2.31V18.9zm2.31-9.28a2.317 2.317 0 0 1-2.31-2.31c0-1.273 1.04-2.312 2.31-2.312 1.273 0 2.312 1.04 2.312 2.31v2.312h-2.312zm0 1.165c1.273 0 2.312 1.04 2.312 2.31 0 1.273-1.04 2.312-2.312 2.312H7.31A2.317 2.317 0 0 1 5 13.097c0-1.272 1.04-2.31 2.31-2.31H13.1zm9.28 2.31c0-1.27 1.04-2.31 2.312-2.31 1.27 0 2.31 1.04 2.31 2.31 0 1.273-1.04 2.312-2.31 2.312h-2.312v-2.312zm-1.164 0c0 1.273-1.04 2.312-2.31 2.312a2.317 2.317 0 0 1-2.312-2.312V7.31c0-1.27 1.04-2.31 2.312-2.31 1.272 0 2.31 1.04 2.31 2.31V13.1zm-2.31 9.28c1.27 0 2.31 1.04 2.31 2.312 0 1.27-1.04 2.31-2.31 2.31a2.317 2.317 0 0 1-2.312-2.31v-2.312h2.312zm0-1.164a2.317 2.317 0 0 1-2.312-2.31c0-1.273 1.04-2.312 2.312-2.312h5.787c1.27 0 2.31 1.04 2.31 2.312 0 1.272-1.04 2.31-2.31 2.31H18.9z" fill-rule="evenodd"></path>
					               			</g>
						            	</svg>
						         	</span>
						      	</a>
						    </div> -->
						<?php } ?>
			    	</div>
			    </div>
		    </div>
		    <div class="post-container col">
		    	<div class="post-wrapper">

					<div class="post-content"><?php the_content(); ?></div>
					<div class="post-footer">
						<?php if ( is_active_sidebar( 'post_social_share' ) ) { ?>
							<div class="social-share-widget" role="complementary">
								<?php dynamic_sidebar( 'post_social_share' ); ?>
							</div>
						<?php } ?>
						<div class="post-categories">
							<span><?php _e("Categories:", 'blogtrp'); ?> </span>
							<?php foreach (wp_get_post_categories( get_the_ID() ) as $cat_id) { ?>
								<a href="<?php echo get_category_link($cat_id); ?>"><?php echo get_category($cat_id)->name; ?></a>
							<?php } ?>
						</div>
						<div class="post-tags">
							<span><?php _e("Tags:", 'blogtrp'); ?> </span>
							<?php foreach (get_the_tags( get_the_ID() ) as $tag) { ?>
								<a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
							<?php } ?>
						</div>
						<div class="post-author">
							<span><?php _e("Author:", 'blogtrp'); ?> </span>
		                    <div class="author-avatar">
		                        <?php echo get_wp_user_avatar(); ?>
		                        <?php the_author_posts_link(); ?>
		                    </div>
		                    <p><?php the_author_meta('description'); ?></p>
		                </div>
					</div>
				</div>

				<?php 
    			$cats = get_the_category(get_the_ID());
		        $cur_cat = $cats[0]->term_id;

				$query = new WP_Query( array( 
					'category__in' => $cur_cat,
					'post_type' => 'post',
					'posts_per_page' => 9,
					'post__not_in' => [
						get_the_ID()
					]
				) );

				if ( $query->have_posts() ) { ?>

					<div class="section-slider-posts related-posts">
			    		<h2 class="section-title"><span><?php _e("Related posts", 'blogtrp'); ?></span></h2>

			    		<div class="flickity slider-posts">

			    			<?php while ( $query->have_posts() ) {
			    				$query->the_post(); 
		        				$srcc = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium', false ); ?>

				    			<div class="post">
				    				<div class="post-inner">
					    				<a href="<?php the_permalink(); ?>" class="post-image cover" style="background-image: url(<?php echo $srcc[0]; ?>); background-position: 50% <?php echo !empty(get_field('featured_image_position')) || get_field('featured_image_position') === '0' ? get_field('featured_image_position').'%' : '50%' ?>">
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
							    				<a href="<?php echo get_category_link(get_the_category(get_the_ID())[0]->term_id); ?>" class="cat">
							    					<?php echo get_the_category(get_the_ID())[0]->name; ?>
							    				</a>
							    				<span class="date"><?php echo get_the_date('M j, Y (D)' ); ?></span> 
							    			</div>
							    			<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
							    		</div>
							    		<div class="bottom-container">
							    			<?php the_excerpt(); ?>
					    					<a href="<?php the_permalink(); ?>" class="read-more"><?php _e("Read more", 'blogtrp'); ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/read-arrow.png"></a>
							    		</div>
						    		</div>
				    			</div>

					    	<?php }
					    	wp_reset_postdata(); ?>
			    		</div>
			    		<div class="tac">
			    			<a href="<?php echo get_category_link($cur_cat); ?>" class="gray-button"><?php _e("See all", 'blogtrp'); ?></a>
			    		</div>
			    	</div>
			    <?php } ?>

	    		<div class="section-comments">
	    			<h2 class="section-title"><span><?php _e("Comments", 'blogtrp'); ?></span></h2>
    				<div class="comments-inner">
						<div class="row comments-form">
			                <?php
			                if(comments_open() || get_comments_number()) :
			                    comments_template();
			                endif;
			                ?>		
			           	</div>
		    		</div>
		    	</div>
		    </div>
		    <div class="col col-cats">
		    	<div class="right-inner">
			    	<div class="all-cats">
				    	<span><?php _e("Categories:", 'blogtrp'); ?></span>
					    <?php
							wp_nav_menu( array(
								'container' => false,
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu',
							) );
						?>
					</div>
					<?php 
					$current_user = wp_get_current_user();
					if (true || user_can( $current_user, 'administrator' )) { ?>
						<div class="subscribe-box test-box">
							<a href="javascript:;" class="close-subscr"><img src="<?php echo get_stylesheet_directory_uri();?>/img/arrow-right.png"></a>
							<?php echo do_shortcode('[mc4wp_form id="5"]'); ?>
						</div>
					<?php } else { ?>
						<div class="subscribe-box ">
							<?php echo do_shortcode('[mc4wp_form id="5"]'); ?>
						</div>
					<?php } ?>
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
				<a target="_blank" href="https://reviews.dentacoin.com/?popup=popup-register" class="white-transparent-button"><?php _e("Sign up", 'blogtrp'); ?></a>
			</div>
		</div>
    	

	<?php }
get_footer(); ?>