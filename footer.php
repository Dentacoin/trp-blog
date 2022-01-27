			
			<?php 
			$current_user = wp_get_current_user();
			if (user_can( $current_user, 'administrator' )) { ?>
				
				<script type="text/javascript">
					var admin = true;
				</script>

			<?php } else { ?>

				<script type="text/javascript">
					var admin = false;
				</script>
			<?php } ?>

			<a href="javascript::" class="single-subscribe-button active"><?php _e("Subscribe", 'blogtrp'); ?></a>
			<div class="subscribe-wrapper">
				<a href="javascript:;" class="subscribe-button"><?php _e("Subscribe", 'blogtrp'); ?></a>
				<div class="subscribe-box">
					<?php echo do_shortcode('[mc4wp_form id="5"]'); ?>
				</div>
			</div>
			
	    </div>

		<div class="tooltip-window" style="display: none;"></div>

		<?php if(empty($_COOKIE['performance_cookies']) && empty($_COOKIE['marketing_cookies']) && empty($_COOKIE['strictly_necessary_policy'])) { ?>
			<div class="bottom-drawer">
				<div class="privacy-policy-cookie">
					<div class="container-cookie flex">
						<div class="cookies-text">
							This site uses cookies. Find out more on how we use cookies in our <a href="https://dentacoin.com/privacy-policy" target="_blank"> Privacy Policy </a>. | <a href="javascript:;" class="adjust-cookies"> Adjust cookies </a>
						</div>
						<a href="javascript:;" class="accept-all">Accept All Cookies</a>
					</div>
					<div id="customize-cookies" class="customize-cookies" style="display: none;">
						<button class="close-customize-cookies-icon close-customize-cookies-popup">×</button>
						<div class="tac"><img src="/img-trp/cookie-icon.svg" alt="Cookie icon" class="cookie-icon"/></div>
						<div class="tac cookie-popup-title">Select cookies to accept:</div>
						<div class="cookies-options-list flex">
							<div class="cookie-checkbox-wrapper">
								<label class="cookie-label active" for="strictly-necessary-cookies">
									<i class="checkbox-icon"></i>
									<input checked disabled id="strictly-necessary-cookies" type="checkbox" class="cookie-checkbox">
									<span class="gray">Strictly necessary</span> 
									<i class="fas fa-info-circle info-cookie tooltip-text" text="Cookies essential to navigate around the website and use its features. Without them, you wouldn’t be able to use basic services like signup or login."></i>
								</label>
							</div>
							<div class="cookie-checkbox-wrapper">
								<label class="cookie-label active" for="performance-cookies">
									<i class="checkbox-icon"></i>
									<input checked id="performance-cookies" type="checkbox" class="cookie-checkbox">
									<span>Performance cookies</span> 
									<i class="fas fa-info-circle info-cookie tooltip-text" text="These cookies collect data for statistical purposes on how visitors use a website, they don’t contain personal data and are used to improve user experience."></i>
								</label>
							</div>
							<div class="cookie-checkbox-wrapper">
								<label class="cookie-label active" for="marketing-cookies">
									<i class="checkbox-icon"></i>
									<input checked id="marketing-cookies" type="checkbox" class="cookie-checkbox">
									<span>Marketing cookies</span> 
									<i class="fas fa-info-circle info-cookie tooltip-text" text="Marketing cookies are used e.g. to deliver advertisements more relevant to you or limit the number of times you see an advertisement."></i>
								</label>
							</div>
						</div>
						<div class="flex actions">
							<a href="javascript:;" class="close-cookie-button close-customize-cookies-popup">Cancel</a>
							<a href="javascript:;" class="custom-cookie-save">Save</a>
						</div>
						<div class="custom-triangle"></div>
					</div>
				</div>
			</div>
		<?php } ?>

		<footer>
			<div class="container clearfix">
				<a href="https://dentacoin.com/" target="_blank" class="footer-logo col-md-3 flex break-mobile flex-center">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/dc-logo.png" alt="Dentacoin logo">
					<p class="bold">
						Powered by Dentacoin
					</p>
				</a>
				<div class="footer-text col-md-6 tac">
					<div class="footer-menu">
						<a href="https://reviews.dentacoin.com" target="_blank">Trusted Reviews</a>
						<a href="https://dentavox.dentacoin.com/" target="_blank">Dentavox</a>
						<a href="https://dentacare.dentacoin.com/" target="_blank">Dentacare App</a>
					</div>
					<small>
						Copyright © <?php echo date('Y'); ?>. Dentacoin Foundation. All rights reserved
					</small>
					<a href="https://dentacoin.com/privacy-policy/" target="_blank" class="pp">Privacy Policy</a>
				</div>
				<div class="socials col-md-3">
					Stay in the loop: &nbsp;
					<a class="social tg" href="https://t.me/dentacoin" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/telegram.png"></a>
					<a class="social fb" href="https://www.facebook.com/dentacoin.trusted.reviews/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/fb.png"></a>
				</div>
			</div>
			<?php wp_footer(); ?>
		</footer>

		<?php if(is_single() && 'post' == get_post_type()) {
			$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large', false ); ?>

			<script type="application/ld+json">
			{
			  "@context": "https://schema.org",
			  "@type": "BlogPosting",
			  "headline": "<?php the_title(); ?>",
			  "image": "<?php echo !empty(get_field('inner_post_featured_image')) ? get_field('inner_post_featured_image')['sizes']['large'] : $src[0]; ?>" ,
			  "author": {
			    "@type": "Person",
			    "name": "<?php the_author(); ?>"
			  },  
			  "publisher": {
			    "@type": "Organization",
			    "name": "Dentacoin Trusted Reviews Blog",
			    "logo": {
			      "@type": "ImageObject",
			      "url": "<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png",
			      "width": 274,
			      "height": 80
			    }
			  },
			  "datePublished": "<?php echo get_the_date('Y-m-d'); ?>"
			}
			</script>

		<?php } ?>


	    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-3.4.1.min.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/cookie.min.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/main.js"></script>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/flickity.min.js"></script>
    </body>
</html>