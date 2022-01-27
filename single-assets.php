<?php 

get_header();

	while ( have_posts() ) {
		the_post(); 
		$the_post_ID = get_the_ID();
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large', false ); ?>

		<div class="assets-top-wrapper">
			<div class="flex break-small-mobile-asset">
				<div class="col assets-bubble">
					<div class="asset-image" style="background-image: url(<?php echo $src[0]; ?>);"></div> 
				</div>
				<div class="col">
					<div class="top-content">
						<p><?php the_field('first_text'); ?></p>
						<h1><?php the_title(); ?></h1>
						<p><?php the_field('second_text'); ?></p>
						<a href="javascript:;" class="red-button download-asset">Download</a>
					</div>
				</div>
			</div>
		</div>

		<div class="assets-bottom-wrapper">
			<div class="flex break-tablet">
				<div class="col">
					<div class="bottom-content">
						<h2><?php echo get_field('what_is_in_the_pack')['title']; ?></h2>
						<ul>
							<?php foreach (get_field('what_is_in_the_pack')['options'] as $po) { ?>
								<li>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/check-green.png"><?php echo $po['option']; ?>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="col assets-bubble">
					<div class="asset-form" link="<?php echo str_rot13(get_field('asset_form')['asset_media_url']); ?>" type="<?php echo get_field('asset_form')['asset_type']; ?>">
						<img src="<?php echo get_stylesheet_directory_uri();?>/img/forn-red-angle.png">
						<h3>Fill out this form to access a free online reputation assessment checklist.</h3>
						<?php echo do_shortcode('[contact-form-7 id="1385" title="Assets form"]'); ?>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			var wpcf7Elm = document.querySelector( '.wpcf7' ); 
			wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {
			  	window.location.href = document.querySelector( '.asset-form' ).getAttribute("link").replace(/[a-zA-Z]/g, function (c) {
					return String.fromCharCode((c <= "Z" ? 90 : 122) >= (c = c.charCodeAt(0) + 13) ? c : c - 26);
				});
			}, false );
		</script>

	<?php }
get_footer(); ?>