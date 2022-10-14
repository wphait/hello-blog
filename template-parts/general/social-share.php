<?php
/**
 * Social Share
 *
 * @package Hello_Blog
 */

$post_id = get_the_ID();

$social_share_heading = hello_blog_get_option( 'social_share_heading' );
?>

<div class="hello-blog-social-share">
	<?php if ( ! empty( $social_share_heading ) ) : ?>
		<h2 class="heading"><?php echo esc_html( $social_share_heading ); ?></h2>
	<?php endif; ?>

	<?php echo hello_blog_get_social_share( $post_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div><!-- .hello-blog-social-share -->
