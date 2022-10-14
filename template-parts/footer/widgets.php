<?php
/**
 * Footer widgets
 *
 * @package Hello_Blog
 */

if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
	<div id="site-footer-widgets" class="footer-widgets">
		<div class="container">
			<div class="footer-widgets-inner">
				<?php
				for ( $i = 1; $i <= 3; $i ++ ) {
					if ( is_active_sidebar( 'footer-' . $i ) ) {
						?>
						<div class="footer-widget <?php echo esc_attr( 'footer-widget-' . $i ); ?>">
							<?php dynamic_sidebar( 'footer-' . $i ); ?>
						</div>
						<?php
					}
				}
				?>
			</div><!-- .footer-widgets-inner -->
		</div><!-- .container -->
	</div><!-- #site-footer-widgets -->
	<?php
endif;
