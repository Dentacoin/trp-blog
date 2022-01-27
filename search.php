<?php
/*
Template Name: Search Page
*/
get_header(); 
?>
	<div class="main-section">
		<div class="container">
			<h1 class="category-title"><?php _e("Results:", 'blogtrp'); ?></h1>
			<div class="cat-descr"></div>
		</div>
	</div>
	<div class="category-posts container">
		<?php if ( have_posts() ) { ?>
			<div class="flex wrap">
				<?php while ( have_posts() ) {
					the_post();
					$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium', false ); ?>

					<div class="post">
						<a href="<?php the_permalink(); ?>" class="post-image cover" style="background-image: url(<?php echo $src[0]; ?>); background-position: 50% <?php echo !empty(get_field('featured_image_position')) || get_field('featured_image_position') === '0' ? get_field('featured_image_position').'%' : '50%' ?>"></a>
						<div class="post-info">
							<span class="date"><?php echo get_the_date('M j, Y (D)'); ?></span> 
							<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
							<?php the_excerpt(); ?>
							<a href="<?php the_permalink(); ?>" class="read-more"><?php _e("Read more", 'blogtrp'); ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/read-arrow.png"></a>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php the_posts_pagination( array(
					'prev_text'          => '<',
					'next_text'          => '>',
				) );
			?>
		<?php } else { ?>
			<div class="no-results"><?php _e("Sorry, but nothing matched your search terms. Please try again with some different keywords.", 'blogtrp'); ?></div>
		<?php } ?>
	</div>
<?php
get_footer();
?>