<?php
/**
 * @package WordPress
 * @subpackage Theme_Compat
 * @deprecated 3.0.0
 *
 * This file is here for backward compatibility with old themes and will be removed in a future version
 */
_deprecated_file(
	/* translators: %s: template name */
	sprintf( __( 'Theme without %s' ), basename( __FILE__ ) ),
	'3.0.0',
	null,
	/* translators: %s: template name */
	sprintf( __( 'Please include a %s template in your theme.' ), basename( __FILE__ ) )
);

// Do not delete these lines
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die( 'Please do not load this page directly. Thanks!' );
}

if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.' ); ?></p>
	<?php
	return;
}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments">
		<?php
		if ( 1 == get_comments_number() ) {
			/* translators: %s: post title */
			printf( __( 'One response to %s' ), '&#8220;' . get_the_title() . '&#8221;' );
		} else {
			/* translators: 1: number of comments, 2: post title */
			printf(
				_n( '%1$s response to %2$s', '%1$s responses to %2$s', get_comments_number() ),
				number_format_i18n( get_comments_number() ),
				'&#8220;' . get_the_title() . '&#8221;'
			);
		}
		?>
	</h3>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link(); ?></div>
		<div class="alignright"><?php next_comments_link(); ?></div>
	</div>

	<ol class="commentlist">
	<?php wp_list_comments(); ?>
	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link(); ?></div>
		<div class="alignright"><?php next_comments_link(); ?></div>
	</div>
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
		<div class="no-results"><?php _e("There are no comments.", 'blogtrp'); ?></div>
	<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e( 'Comments are closed.', 'blogtrp' ); ?></p>

	<?php endif; ?>
<?php endif; ?>

<div id="respond" class="comment-respond">
	<h3 id="reply-title" class="comment-reply-title"><?php _e("Leave a comment", 'blogtrp'); ?>
		<small>
			<a rel="nofollow" id="cancel-comment-reply-link" href="javascript:;" style="display:none;"><?php _e("Cancel reply", 'blogtrp'); ?></a>
		</small>
	</h3>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment-form">
		<?php if($user_ID) : ?>  
			<p class="logged-in-as">
				<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php" aria-label="Logged in as <?php echo $user_identity; ?>. Edit your profile."><?php _e("Logged in as", 'blogtrp'); ?> <?php echo $user_identity; ?></a>.
				<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account"><?php _e("Log out &raquo;", 'blogtrp'); ?></a>
			</p>
		<?php else : ?>
			<div class="flex comments-flex">
				<div class="col">
					<div class="modern-field comment-form-author">
						<input type="text" name="author" id="author" class="modern-input" value="" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" size="30" maxlength="245" required="required">
						<label for="author">
							<span><?php _e("Name:", 'blogtrp'); ?></span>
						</label>
					</div>
				</div>
				<div class="col">
					<div class="modern-field comment-form-email">
						<input type="email" name="email" id="email" class="modern-input" value="" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" size="30" maxlength="100" required="required">
						<label for="email">
							<span><?php _e("Email:", 'blogtrp'); ?></span>
						</label>
					</div>
				</div>
			</div>
		<?php endif; ?> 

		<div class="modern-field comment-form-comment">
			<textarea class="modern-input" id="comment" name="comment" maxlength="65525" required="required"></textarea>
			<label for="comment">
				<span><?php _e("Comment:", 'blogtrp'); ?></span>
			</label>
		</div>
		
		<p class="form-submit">
			<input name="submit" type="submit" id="submit" class="submit blue-button" value="<?php _e("Post Comment", 'blogtrp'); ?>">
			<input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" id="comment_post_ID">
			<input type="hidden" name="comment_parent" id="comment_parent" value="0">
		</p>
	</form>
</div>