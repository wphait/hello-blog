<?php
/**
 * Main footer
 *
 * @package Hello_Blog
 */

?>
<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="site-footer-inner">

			<?php if ( has_nav_menu( 'social' ) && true === hello_blog_get_option( 'enable_social_links' ) ) : ?>

				<div class="social-links">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'social',
							'depth'           => 1,
							'container'       => 'div',
							'container_class' => 'social-links-inner',
							'link_before'     => '<span class="screen-reader-text">',
							'link_after'      => '</span>',
						)
					);
					?>
				</div><!-- .social-links -->

			<?php endif; ?>

			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location'  => 'footer',
						'menu_id'         => 'footer-menu',
						'container'       => 'div',
						'container_class' => 'footer-menu',
						'depth'           => 1,
					)
				);
			}
			?>

			<?php if ( true === apply_filters( 'hello_blog_credits_status', true ) ) : ?>
				<div class="site-info">
					<?php do_action( 'hello_blog_credits' ); ?>
				</div><!-- .site-info -->
			<?php endif; ?>

		</div><!-- .site-footer-inner -->
	</div><!-- .container -->
</footer><!-- #colophon -->
