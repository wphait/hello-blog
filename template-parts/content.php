<?php
/**
 * Template part for displaying posts
 *
 * @package Hello_Blog
 */

$show_excerpt = hello_blog_get_option( 'show_excerpt' );

$post_footer_meta = hello_blog_get_option( 'post_footer_meta' );

if ( is_singular() ) {
	$meta_keys = hello_blog_get_option( 'post_header_meta' );
} else {
	$meta_keys = hello_blog_get_option( 'blog_meta' );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-content">
		<?php hello_blog_post_thumbnail(); ?>

		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>

			<?php if ( 'post' === get_post_type() && ! empty( $meta_keys ) ) : ?>
				<div class="entry-meta">
					<?php hello_blog_render_meta( $meta_keys ); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>

		</header><!-- .entry-header -->

		<?php if ( is_singular() ) : ?>
			<div class="entry-content">
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'hello-blog' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hello-blog' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->

		<?php elseif ( true === $show_excerpt ) : ?>
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

		<?php if ( is_singular() ) : ?>
			<?php
			$enable_social_share = hello_blog_get_option( 'enable_social_share' );

			if ( is_singular() && ( 'post' === get_post_type() ) && true === $enable_social_share ) {
				get_template_part( 'template-parts/general/social-share' );
			}
			?>

			<?php if ( is_singular() ) : ?>
			<footer class="entry-footer">
				<?php hello_blog_render_meta( array_merge( $post_footer_meta, array( 'edit' ) ) ); ?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>

		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
