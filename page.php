<?php
/**
 * The template for displaying all pages.
 * =====================================================
 * @package  Saifa
 * @license  GPLv2 or later
 * @since 1.0.0
 * @see http://codex.wordpress.org/Template_Hierarchy
 * =====================================================
 */

while ( have_posts() ) :
	the_post();

	get_template_part( 'templates/content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template
	if ( comments_open() || '0' != get_comments_number() ) :
		comments_template();
	endif;

endwhile; // end of the loop.


