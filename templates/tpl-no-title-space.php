<?php
/**
 * Template Name: No Title & Spaces
 *
 * The template for displaying full width pages wihout page title and content space.
 *
 * @package Hello_Blog
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page-no-title' );
		endwhile;
		?>

	</main><!-- #main -->

<?php

get_footer();
