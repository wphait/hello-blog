<?php
/**
 * Template part for displaying breadcrumb content
 *
 * @package Hello_Blog
 */

?>
<div class="page-header-breadcrumb">
	<div class="page-breadcrumb">
		<div class="container">
			<?php
			$breadcrumb_type = hello_blog_get_option( 'breadcrumb_type' );

			if ( function_exists( 'rank_math_the_breadcrumbs' ) && ( 'rankmath' === $breadcrumb_type ) ) {
				rank_math_the_breadcrumbs();
			} elseif ( function_exists( 'yoast_breadcrumb' ) && ( 'yoast' === $breadcrumb_type ) ) {
				yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
			}
			?>
		</div><!-- .container -->
	</div><!-- .page-breadcrumb -->
</div><!-- .page-header-breadcrumb -->
