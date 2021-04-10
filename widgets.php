<?php
//Add widgets area
function mosacademy_widgets_init(){
	register_sidebar(array(
		'id' => 'sidebar',
		'name' => __('Sidebar for Post', 'mosacademy'),
		//'description' => __('Add widgets here to appear in your Left SideBar', 'mosacademy'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'sidebar-page',
		'name' => __('Sidebar for Page', 'mosacademy'),
		//'description' => __('Add widgets here to appear in your Left SideBar', 'mosacademy'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_1',
		'name' => __('Footer Column 1', 'mosacademy'),
		'description' => __('Add widgets here to appear in your Footer Column 1', 'mosacademy'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_2',
		'name' => __('Footer Column 2', 'mosacademy'),
		'description' => __('Add widgets here to appear in your Footer Column 2', 'mosacademy'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_3',
		'name' => __('Footer Column 3', 'mosacademy'),
		'description' => __('Add widgets here to appear in your Footer Column 3', 'mosacademy'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_4',
		'name' => __('Footer Column 4', 'mosacademy'),
		'description' => __('Add widgets here to appear in your Footer Column 4', 'mosacademy'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
		'after_widget' => '</div>'
	));		
	register_widget( 'Mos_Contact_Widget' );	
	register_widget( 'Mos_Contact_Widget_Email' );
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );	
	if( is_plugin_active( 'formidable/formidable.php' ) ) {
		register_widget( 'Mos_Formadable_Form' );	
	}
}