<?php
/**
 * Custom template tags for this theme
 *
 * @package Hello_Blog
 */

/**
 * Render post meta by given keys.
 *
 * @since 1.0.0
 *
 * @param array $keys Meta keys.
 */
function hello_blog_render_meta( $keys ) {
	if ( empty( $keys ) ) {
		return;
	}

	foreach ( $keys as $key ) {
		switch ( $key ) {
			case 'date':
				hello_blog_posted_on();
				break;

			case 'author':
				hello_blog_posted_by();
				break;

			case 'categories':
				hello_blog_posted_category();
				break;

			case 'tags':
				hello_blog_posted_tags();
				break;

			case 'comments':
				hello_blog_posted_comments();
				break;

			case 'edit':
				hello_blog_post_edit_link();
				break;

			default:
				break;
		}
	}
}

/**
 * Prints HTML with meta information for the current post-date/time.
 *
 * @since 1.0.0
 */
function hello_blog_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf( '%s', '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prints HTML with meta information for the current author.
 *
 * @since 1.0.0
 */
function hello_blog_posted_by() {
	$byline = sprintf(
		'%s',
		'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prints HTML with meta information for the categories.
 *
 * @since 1.0.0
 */
function hello_blog_posted_category() {
	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( esc_html_x( ', ', 'list item separator', 'hello-blog' ) );

	if ( $categories_list ) {
		echo '<span class="cat-links">' . $categories_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Prints HTML with meta information for the tags.
 *
 * @since 1.0.0
 */
function hello_blog_posted_tags() {
	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'hello-blog' ) );

	if ( $tags_list ) {
		printf( '<span class="tags-links">' . $tags_list . '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Prints HTML with meta information for the comments.
 *
 * @since 1.0.0
 */
function hello_blog_posted_comments() {
	if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'hello-blog' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		echo '</span>';
	}
}

/**
 * Prints HTML for post edit link.
 *
 * @since 1.0.0
 */
function hello_blog_post_edit_link() {
	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'hello-blog' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			wp_kses_post( get_the_title() )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Displays post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since 1.0.0
 */
function hello_blog_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
		?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumbnail -->

	<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
			?>
		</a>

		<?php
	endif; // End is_singular().
}
