<?php
/**
 * The template for displaying Search Results pages.
 * =====================================================
 * @package  Saifa
 * @license  GPLv2 or later
 * @since 1.0.0
 * @see http://codex.wordpress.org/Template_Hierarchy
 * =====================================================
 */

if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'saifa' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header><!-- .page-header -->

	<?php /* Start the Loop */
	while ( have_posts() ) :

		the_post();
		get_template_part( 'templates/content', 'search' );

	endwhile;

		saifa_paging_nav();

else :

	get_template_part( 'content', 'none' );

endif;
