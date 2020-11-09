<?php
/**
 * Theme functions and definitions
 *
 */

 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


add_action( 'doing_it_wrong_run', function ( $function ) {
	if ( ! defined( 'WP_DEBUG_DISPLAY' ) || ! WP_DEBUG_DISPLAY ) {
		return;
	}
	echo '<pre>';
	echo "doing_it_wrong: $function\n";
	debug_print_backtrace();
	echo '<pre/>';
} );


remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_filter( 'rank_math/sitemap/remove_credit', '__return_true');
add_filter( 'rank_math/frontend/remove_credit_notice', '__return_true' );
add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );
add_filter( 'hello_elementor_add_woocommerce_support', '__return_false' );
add_filter( 'hello_elementor_page_title', '__return_false' );
add_action( 'wp_enqueue_scripts', 'remove_blaot', 20 ); 
function remove_blaot() { 
  //wp_deregister_style( 'elementor-icons' ); 
}

add_action( 'elementor/frontend/after_register_styles',function() {
	foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
		//wp_deregister_style( 'elementor-icons-fa-' . $style );
	}
}, 20 );


/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_script( 'jquery_drawer', get_stylesheet_directory_uri() . '/drawer.js', array('jquery'));
	wp_enqueue_style('hello-elementor-child-style', get_stylesheet_directory_uri() . '/style.css', array('hello-elementor-theme-style'), '1.4');
	
  /** At some point clean up enqueue's to only load where and what they need **/
  if ( true ) { 
	  wp_enqueue_script( 'ui_js', get_stylesheet_directory_uri() . '/ui-js.js', array('jquery'));
  }

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', '1.1.0');

add_filter('comment_form_default_fields', 'website_remove');

//remove url from comment fields
function website_remove($fields) {
	
	if(isset($fields['url'])) {
		unset($fields['url']);
	}
	
	return $fields;
}

function edit_post_shortcode() {

	return get_edit_post_link(); 
}
add_shortcode('edit_post_link', 'edit_post_shortcode');


function add_font_awesome_5_cdn_attributes( $html, $handle ) {
    if ( 'font-awesome-5' === $handle ) {
        return str_replace( "media='all'", "media='all' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'", $html );
    }
    return $html;
}
add_filter( 'style_loader_tag', 'add_font_awesome_5_cdn_attributes', 10, 2 );
