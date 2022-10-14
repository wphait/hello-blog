<?php
/**
 * Main header
 *
 * @package Hello_Blog
 */

?>
<header id="masthead" class="site-header">
	<div class="main-navigation-wrap">
		<div class="container">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="menu-bar"></span><span class="menu-bar"></span><span class="menu-bar"></span></button>
			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'fallback_cb'    => 'hello_blog_menu_fallback',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</div>
	</div><!-- .main-navigation-wrap -->
	<div class="site-branding">
		<div class="container">
			<div class="site-branding-inner">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo">
						<?php the_custom_logo(); ?>
					</div>
				<?php endif; ?>

				<div class="site-title-tagline">
					<?php
					$hide_site_title = hello_blog_get_option( 'hide_site_title' );

					if ( false === $hide_site_title ) {
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;
					}

					$hide_tagline = hello_blog_get_option( 'hide_tagline' );

					if ( false === $hide_tagline ) {
						$hello_blog_description = get_bloginfo( 'description', 'display' );
						if ( $hello_blog_description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo $hello_blog_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
							<?php
						endif;
					}
					?>
				</div><!-- .site-title-tagline -->
			</div><!-- .site-branding-inner -->
		</div><!-- .container -->
	</div><!-- .site-branding -->
</header><!-- #masthead -->
