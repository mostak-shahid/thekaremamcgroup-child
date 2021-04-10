<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );


require_once('theme-init/plugin-update-checker.php');
$themeInit = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/mostak-shahid/update/master/mosastra-child.json',
	__FILE__,
	'mosastra-child'
);
/**
 * Enqueue styles
 */
function child_enqueue_styles() {
    wp_enqueue_script('jquery');
    wp_enqueue_style( 'fancybox', get_stylesheet_directory_uri() . '/plugins/fancybox/jquery.fancybox.min.css' );
    wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/plugins/fancybox/jquery.fancybox.min.js', 'jquery');
    
    wp_enqueue_style( 'jarallax', get_stylesheet_directory_uri() . '/plugins/jarallax/jarallax.css' );
    wp_enqueue_script('jarallax', get_stylesheet_directory_uri() . '/plugins/jarallax/jarallax.js', 'jquery');
    wp_enqueue_script('jarallax-video', get_stylesheet_directory_uri() . '/plugins/jarallax/jarallax-video.js', 'jquery');
    
    //wp_enqueue_script('numscroller', get_stylesheet_directory_uri() . '/plugins/numscroller.js', 'jquery');
    
    wp_enqueue_style( 'slick', 'https://kenwheeler.github.io/slick/slick/slick.css' );
    wp_enqueue_style( 'slick-theme', 'https://kenwheeler.github.io/slick/slick/slick-theme.css' );
    wp_enqueue_script('slick', 'https://kenwheeler.github.io/slick/slick/slick.js', 'jquery');
    
    wp_enqueue_script('jquery.waypoints.min', get_stylesheet_directory_uri() . '/plugins/jquery.counterup/jquery.waypoints.min.js', 'jquery');
    wp_enqueue_script('jquery.counterup', get_stylesheet_directory_uri() . '/plugins/jquery.counterup/jquery.counterup.js', 'jquery');
    
    wp_enqueue_style( 'font-awesome.min', get_stylesheet_directory_uri() . '/fonts/font-awesome-4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'icomoon', get_stylesheet_directory_uri() . '/fonts/icomoon/icomoon.css' );
    
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/script.js', 'jquery');

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );
function mos_get_terms ($taxonomy = 'category') {
    global $wpdb;
    $output = array();
    $all_taxonomies = $wpdb->get_results( "SELECT {$wpdb->prefix}term_taxonomy.term_id, {$wpdb->prefix}term_taxonomy.taxonomy, {$wpdb->prefix}terms.name, {$wpdb->prefix}terms.slug, {$wpdb->prefix}term_taxonomy.description, {$wpdb->prefix}term_taxonomy.parent, {$wpdb->prefix}term_taxonomy.count, {$wpdb->prefix}terms.term_group FROM {$wpdb->prefix}term_taxonomy INNER JOIN {$wpdb->prefix}terms ON {$wpdb->prefix}term_taxonomy.term_id={$wpdb->prefix}terms.term_id", ARRAY_A);

    foreach ($all_taxonomies as $key => $value) {
        if ($value["taxonomy"] == $taxonomy) {
            $output[] = $value;
        }
    }
    return $output;
}
//var_dump(mos_get_terms('product_cat'));
//require_once 'astra-custom.php';
require_once 'hooks.php';
require_once 'shortcodes.php';
require_once 'carbon-fields.php';
require_once 'aq_resizer.php';