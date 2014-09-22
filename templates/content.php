<?php
/**
 * default content template
 * =====================================================
 * @package  Saifa
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php saifa_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() || is_archive() || is_home() || is_front_page() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php
		the_post_thumbnail();?>
		<?php
		the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
		the_post_thumbnail();?>
		<?php
		the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'saifa' ) ); ?>
		<?php

		if ( ! current_theme_supports( 'saifa-pagination' ) ) {
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'saifa' ),
				'after'  => '</div>',
			) );
		}
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'saifa' ) );
				if ( $categories_list && saifa_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'saifa' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'saifa' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'saifa' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php
		if ( ! post_password_required() && ( comments_open() || '0' !== get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'saifa' ), __( '1 Comment', 'saifa' ), __( '% Comments', 'saifa' ) ); ?></span>
		<?php
		endif; ?>

		<?php edit_post_link( __( 'Edit', 'saifa' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
