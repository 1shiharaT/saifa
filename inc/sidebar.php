<?php
/**
 * Register sidebar area
 * =====================================================
 * @package  Saifa
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================
 */

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'saifa_custom_sidebar' );

function saifa_custom_sidebar() {

	register_sidebar( array(
		'name'          => __( 'Sidebar Primary', 'saifa' ),
		'id'            => 'sidebar-primary',
		'before_widget' => '<section class="widget widget-sidebar %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header Primary Area', 'saifa' ),
		'id'            => 'header-primary',
		'before_widget' => '<section class="widget widget-header %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Main Visual', 'saifa' ),
		'id'            => 'main-visual',
		'before_widget' => '<section class="widget widget-header %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Above Contents', 'saifa' ),
		'id'            => 'content-primary',
		'before_widget' => '<section class="widget widget-content %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Primary', 'saifa' ),
		'id'            => 'footer-primary',
		'before_widget' => '<section class="widget widget-footer %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}


