<?php
/**
 * custom theme comment template.
 * =====================================================
 * @package  Saifa
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */


/**
 * Change comment template.
 *
 * @param string $comment_template
 * @return string comment template path.
 */

add_filter( 'comments_template', 'saifa_plugin_comment_template', 10, 1 );

function saifa_plugin_comment_template( $comment_template ){

	return get_template_directory() . '/modules/comments.php';

}

/**
 * Customize the text prior to the comment form fields
 *
 * @param  array $defaults
 * @return $defaults
 *
 */

add_filter( 'comment_form_defaults', 'saifa_comment_form_defaults' );

function saifa_comment_form_defaults( $defaults ) {

	$defaults['title_reply'] = __( 'Post a new comment','saifa' );
	$defaults['comment_notes_before'] = '<p class="comment-notes">'. __( 'Your email address will not be published. Required fields are marked', 'saifa' ).'</p>';

	return $defaults;

}

/**
 * Modify the comment form input fields
 * @param  $args http://codex.wordpress.org/Function_Reference/comment_form
 * $args['author']
 * $args['email']
 * $args['url']
 *
 * @return $args
 */

add_filter( 'comment_form_default_fields', 'saifa_comment_form_args' );

function saifa_comment_form_args( $args ) {
	$comment_author = isset( $commenter['comment_author'] ) ? $commenter['comment_author'] : '';
	$comment_author_email = isset( $commenter['comment_author_email'] ) ? $commenter['comment_author_email'] : '';
	$comment_author_url = isset( $commenter['comment_author_url'] ) ? $commenter['comment_author_url'] : '';
	$args['author'] = '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $comment_author ) . '" size="40" tabindex="1" aria-required="true" title="'. __( 'Your Name (required)','saifa' ) .'" placeholder="'. __( 'Your Name (required)','saifa' ) .'" required /><!-- .comment-form-author .form-section --></p>';
	$args['email'] = '<p class="comment-form-email"><input id="email" name="email" type="email" value="' . esc_attr( $comment_author_email ) . '" size="40" tabindex="2" aria-required="true" title="'. __( 'Email Address (required)','saifa' ) .'" placeholder="'. __( 'Email Address (required)','saifa' ) .'" required /><!-- .comment-form-email .form-section --></p>';
	$args['url'] = '<p class="comment-form-url"><input id="url" name="url" type="url" value="' . esc_attr( $comment_author_url ) . '" size="40" tabindex="3" aria-required="false" title="'. __( 'Website (url)','saifa' ) .'" placeholder="'. __( 'Website (url)','saifa' ) .'" required /><!-- .comment-form-url .form-section --></p>';

	return $args;

}

/**
 * Customize the comment form comment field
 * @param  string $field
 * @return string
 */

add_filter( 'comment_form_field_comment', 'saifa_comment_form_field_comment' );

function saifa_comment_form_field_comment( $field ) {

	$field = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" tabindex="4" title="' . __( 'Comment','saifa' ) . '" placeholder="' . __( 'Comment','saifa' ) . '" aria-required="true"></textarea><!-- #form-section-comment .form-section --></p>';

	return $field;

}
