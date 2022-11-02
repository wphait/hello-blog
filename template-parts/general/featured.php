<?php
/**
 * Featured posts
 *
 * @package Hello_Blog
 */

?>
<?php do_action( 'hello_blog_before_featured_posts' ); ?>

<?php
$attrs = array(
	'class' => apply_filters( 'hello_blog_featured_posts_classes', array( 'featured-posts' ) ),
);
?>

<div <?php hello_blog_render_attr( $attrs ); ?>>

	<?php do_action( 'hello_blog_featured_posts_open' ); ?>

		<div class="featured-posts-inner">
			<?php
			$feat_args = array(
				'posts_per_page'      => 3,
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
				'cache_results'       => false,
			);

			$featured_posts_categories = (array) hello_blog_get_option( 'featured_posts_categories' );

			if ( ! empty( $featured_posts_categories ) ) {
				$feat_args['category__in'] = (array) $featured_posts_categories;
			}

			$feat_query = new WP_Query( apply_filters( 'hello_blog_featured_posts_query_args', $feat_args ) );

			if ( $feat_query->have_posts() ) :
				while ( $feat_query->have_posts() ) :
					$feat_query->the_post();

					$style_rules  = '';
					$custom_style = '';

					$image_url = get_the_post_thumbnail_url( null, 'large' );

					if ( ! $image_url ) {
						$image_url = HELLO_BLOG_URL . '/assets/image/no-image.png';
					}

					$custom_style .= "background-image:url('" . esc_url( $image_url ) . "')";

					if ( $custom_style ) {
						$style_rules = 'style="' . $custom_style . '"';
					}
					?>
					<div class="featured-post" <?php echo $style_rules; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<div class="featured-post-overlay"></div>

						<div class="featured-post-content">

							<?php if ( true === apply_filters( 'hello_blog_featured_posts_categories_status', true ) ) : ?>
								<?php
								/* translators: used between list items, there is a space after the comma */
								$categories_list = get_the_category_list( esc_html_x( ', ', 'list item separator', 'hello-blog' ) );

								if ( $categories_list ) {
									echo '<div class="featured-post-categories">';
									echo $categories_list; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									echo '</div>';
								}
								?>
							<?php endif; ?>

							<?php the_title( '<h2 class="featured-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

							<?php if ( true === apply_filters( 'hello_blog_featured_posts_read_more_status', true ) ) : ?>
									<a href="<?php the_permalink(); ?>" class="featured-post-read-more button"><?php esc_html_e( 'Read More', 'hello-blog' ); ?></a>
							<?php endif; ?>

						</div><!-- .featured-post-content -->
					</div><!-- .featured-post -->
					<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div><!-- .featured-posts-inner -->

	<?php do_action( 'hello_blog_featured_posts_close' ); ?>

</div><!-- .featured-posts -->

<?php do_action( 'hello_blog_after_featured_posts' ); ?>
