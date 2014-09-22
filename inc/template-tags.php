<?php
/**
 * Custom template tags for this theme.
 * =====================================================
 * @package  Saifa
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */

if ( ! function_exists( 'saifa_paging_nav' ) ) :

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @return void
	 */
	function saifa_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text navigation-title"><?php _e( 'Posts navigation', 'saifa' ); ?></h1>
			<div class="nav-links cf">

				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous navigation-previous left"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'saifa' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next navigation-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'saifa' ) ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'saifa_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 *
	 * @return void
	 */
	function saifa_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h1 class="screen-reader-text navigation-title"><?php _e( 'Post navigation', 'saifa' ); ?></h1>
			<div class="nav-links">
				<?php
					previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'saifa' ) );
					next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'saifa' ) );
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'saifa_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function saifa_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( __( 'Updated : ', 'saifa' ) . get_the_modified_date() )
		);

		printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'saifa' ),
			sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
				esc_url( get_permalink() ),
				$time_string
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function saifa_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so saifa_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so saifa_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in saifa_categorized_blog.
 */
function saifa_category_transient_flusher() {
	delete_transient( 'all_the_cool_cats' );
}

add_action( 'edit_category', 'saifa_category_transient_flusher' );
add_action( 'save_post',     'saifa_category_transient_flusher' );


/**
 * breadcrumbs output
 * @see classes/class-breadcrumbs.php
 * @return void
 */
function saifa_breadcrumb() {

	$templates = array(
		'before' => '<nav class="breadcrumbs"><ul>',
		'after' => '</ul></nav>',
		'standard' => '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">%s</li>',
		'current' => '<li class="current">%s</li>',
		'link' => '<a href="%s" itemprop="url"><span itemprop="title">%s</span></a>',
	);

	$options = array(
		'show_htfpt' => true,
	);

	// init
	$breadcrumb = new saifa_Breadcrumbs( $templates, $options );

}

/**
 * For function for outputting pagination
 * @param boolean $output
 * @return void
 */
function saifa_pagination( $output = true ){

	global $wp_query, $wp_rewrite;

	$base = trailingslashit( get_pagenum_link( 1 ) ) . '%_%';
	$format = ( $wp_rewrite->using_permalinks() ) ? 'page/%#%' : '?paged=%#%';
	$args = array(
		'base' => $base,
		'format' => $format,
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $wp_query->max_num_pages,
		'prev_next' => true,
		'prev_text' => '&larr;' . __( 'Previous','saifa' ),
		'next_text' => __( 'Next','saifa' ) . '&rarr;',
	);

	$before = apply_filters( 'saifa_paginavi_before', '<nav class="pagination primary-links">' );
	$pagination = paginate_links( $args );
	$after = apply_filters( 'saifa_paginavi_after', '</nav>' );

	if ( $output && $pagination ) {
		echo $before . wp_kses_post( $pagination ) . $after;
		return false;
	}

	return $pagination;

}

/**
 * Header file include path
 * @return void
 */
function saifa_get_header(){
	$header_style = get_theme_mod( 'header_style', '' );

	if ( $header_style === 'minimal' ) {

		get_template_part( 'modules/header-minimal' );

	} else {

		get_template_part( 'modules/header' );

	}

}

add_action( 'get_header', 'saifa_social_icon' );

function saifa_social_icon(){

	$icons = '';
	$social['facebook']    = get_theme_mod( 'socal_facebook', '' );
	$social['twitter']     = get_theme_mod( 'socal_twitter', '' );
	$social['github']      = get_theme_mod( 'socal_github', '' );
	$social['google_plus'] = get_theme_mod( 'socal_google_plus', '' );

	if ( $social['facebook'] ) {
		$icons .= '	<a href="' . $social['facebook'] . '" target="_blank"><i class="fa fa-facebook"></i></a>
		';
	}

	if ( $social['twitter'] ) {
		$icons .= '	<a href="' . $social['twitter'] . '" target="_blank"><i class="fa fa-twitter"></i></a>
		';
	}

	if ( $social['github'] ) {
		$icons .= '	<a href="' . $social['github'] . '" target="_blank"><i class="fa fa-github"></i></a>
		';
	}

	if ( $social['google_plus'] ) {
		$icons .= '	<a href="' . $social['google_plus'] . '" target="_blank"><i class="fa fa-google-plus"></i></a>
		';
	}

	if ( $icons ) {
		echo '<div class="social-icons">
		' . $icons .'</div>
		';
	}

}
