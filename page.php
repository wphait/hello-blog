<?php
/**
 * The template for displaying all pages
 *
 * @package Hello_Blog
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			do_action( 'hello_blog_page_before_content' );

			get_template_part( 'template-parts/content', 'page' );

			do_action( 'hello_blog_page_after_content' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile;
		?>

	</main><!-- #primary -->

<?php
do_action( 'hello_blog_sidebar' );
get_footer();
