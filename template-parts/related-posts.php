<?php
/**
 * Template part for displaying related posts
 *
 * @package Hello_Blog
 */

$post_id = get_the_ID();

$related_posts_heading = hello_blog_get_option( 'related_posts_heading' );
$related_posts_number  = hello_blog_get_option( 'related_posts_number' );

$args = array(
	'fields'     => 'ids',
	'number'     => absint( $related_posts_number ),
	'taxonomies' => array( 'category', 'post_tag' ),
);

$related_ids = \Nilambar\WPRelatedPosts\RelatedPosts::posts( $post_id, $args );

$related_ids = apply_filters( 'hello_blog_related_posts', $related_ids, $post_id );

if ( empty( $related_ids ) ) {
	return;
}
?>

<div class="related-posts">
	<?php if ( ! empty( $related_posts_heading ) ) : ?>
		<h2 class="heading"><?php echo esc_html( $related_posts_heading ); ?></h2>
	<?php endif; ?>

	<div class="related-posts-inner">
		<?php
		global $post;

		foreach ( $related_ids as $post ) {
			setup_postdata( $post );
			get_template_part( 'template-parts/content-related-post' );
		}

		wp_reset_postdata();
		?>
	</div><!-- .related-posts-inner -->
</div><!-- .related-posts -->
