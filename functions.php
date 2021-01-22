<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */

 if ( ! isset( $content_width ) ) {
	$content_width = 1076;
}

// add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue a lot of css
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_deregister_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-fonts' );
    wp_deregister_style( 'storefront-fonts' );
    
    // storefront-jetpack-widgets-css
    wp_dequeue_style( 'storefront-jetpack-widgets' );
    wp_deregister_style( 'storefront-jetpack-widgets' );
    
    wp_deregister_style( 'storefront-woocommerce-style' );
}
add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );


function artezpress_style() {
    wp_register_style( 'artezpress-css', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'artezpress-css' );
    wp_register_style( 'app-css', get_stylesheet_directory_uri() . '/assets/css/app.css' );
    wp_enqueue_style( 'app-css' );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'jquery-ui');
    wp_enqueue_script( 'waypoints', get_theme_file_uri() . '/js/jquery.waypoints.min.js', [], null, true );
    // wp_enqueue_script( 'waypoints', get_theme_file_uri() . '/js/waypoints.debug.js', [], null, true );
    // wp_enqueue_script( 'colour-detector', get_theme_file_uri() . '/js/colourBrightness.min.js');
    wp_enqueue_script( 'masonry');
    wp_enqueue_script( 'owl-slider', get_theme_file_uri() . '/js/owl.slider.js', [], null, true );
    wp_enqueue_script( 'jquery-ui-accordion');
    wp_enqueue_script( 'jquery-ui-slider');
    wp_register_style( 'jquery-ui-smoothness', '//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui' );
    wp_enqueue_script( 'totitlecase',  get_theme_file_uri() . '/js/totitlecase-min.js', [], null, true  );
    wp_enqueue_script( 'artezpress-script', get_theme_file_uri() . '/js/script.js', [], null, true );
}

add_action( 'wp_enqueue_scripts', 'artezpress_style' );



function add_class_to_excerpt ( $post_excerpt ) {
    $post_excerpt = '<p class="news-excerpt small-text">' . $post_excerpt . '</p>';
    return $post_excerpt;
}
// add_filter( 'get_the_excerpt', 'add_class_to_excerpt' );
function ap_excerpt_more( $more ) {
    return ' ...';
}
add_filter( 'excerpt_more', 'ap_excerpt_more' );


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Hero Images',
		'menu_title'	=> 'Hero Images',
		'menu_slug' 	=> 'hero-img',
        'capability'	=> 'edit_posts',
        'position'      => '9',
		'redirect'		=> false
	));
	
}

/* Woocommerce filters */

/* 
* Mini cart with total counter not total price
*
*/
add_filter( 'woocommerce_add_to_cart_fragments', 'add_to_cart_fragment', 10, 1 );

function add_to_cart_fragment( $fragments ) {

    global $woocommerce;
    $count = $woocommerce->cart->cart_contents_count;
    
    if ($count > 0) {
        $fragments['.cart-counter'] = '<span class="cart-counter">' . $count . '</span>';
    }
    else {
        $fragments['.cart-counter'] = '<span class="cart-counter hide">' . $count . '</span>';
    }
    
    return $fragments;

}


if ( ! function_exists( 'woocommerce_widget_shopping_cart_subtotal' ) ) {
	/**
	 * Output to view cart subtotal.
	 *
	 * @since 3.7.0
	 */
	function woocommerce_widget_shopping_cart_subtotal() {
		echo '<span>' . esc_html__( 'Total:', 'artezpress' ) . '</span> ' . WC()->cart->get_cart_subtotal(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}


 
function artezpress_theme_setup(){
    add_image_size( 'feature-slider-size', 1120, true , array( 'center', 'center' ));
	add_theme_support( 'editor-styles' ); // if you don't add this line, your stylesheet won't be added
	add_editor_style( 'style-editor.css' ); // tries to include style-editor.css directly from your theme folder
}
add_action( 'after_setup_theme', 'artezpress_theme_setup' );

add_action( 'artezpress_before_single_product_summary', 'woocommerce_show_product_images', 20 );
 
function my_acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    
    // return
    return $path;
    
}
add_filter('acf/settings/save_json', 'my_acf_json_save_point');

/**
 * Fix for Popup Maker Gutenberg compatibility
 * Need to strip out comments, blank lines and empty paragraph tags
 */
add_filter( 'pum_popup_content', 'veer_popup_maker_gutenburg_compat' );

function my_acf_admin_head() {
?>
<style type="text/css">

    .postbox-header h2.hndle {
        font-family: 'Lars';
    }
    .display-block {
        display: block;
    }

    .acf-flexible-content .layout .acf-fc-layout-handle {
        /*background-color: #00B8E4;*/
        background-color: #202428;
        color: #eee;
    }

    .acf-repeater.-row > table > tbody > tr > td,
    .acf-repeater.-block > table > tbody > tr > td {
        border-top: 2px solid #202428;
    }

    .acf-repeater .acf-row-handle {
        vertical-align: top !important;
        padding-top: 16px;
    }

    .acf-repeater .acf-row-handle span {
        font-size: 20px;
        font-weight: bold;
        color: #202428;
    }

    .imageUpload img {
        width: 75px;
    }

    .acf-repeater .acf-row-handle .acf-icon.-minus {
        top: 30px;
    }

</style>
<?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');


function veer_popup_maker_gutenburg_compat($content) {
	$content = preg_replace('!/\*.*?\*/!s', '', $content); // empty lines
	$content = preg_replace('/<!--(.|\s)*?-->/', '', $content); // block editor comments
	$content = preg_replace('/<p[^>]*><\\/p[^>]*>/', '', $content); // empty p tags
	return $content;
} 

function my_get_the_product_thumbnail_url( $size = 'shop_catalog' ) {
  global $post;
  $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
  return get_the_post_thumbnail_url( $post->ID, $image_size );
}

function artezpress_nav() {
    wp_nav_menu(array(
        'theme_location' => 'header-menu',
        'menu' => '',
        'container' => 'div',
        'container_class' => 'navbar-collapse',
        'container_id' => 'navbarNavDropdown',
        'menu_class' => 'nav-item',
        'menu_id' => '',
        'echo' => true,
        'fallback_cb' => 'wp_page_menu',
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'items_wrap' => '<ul class="navbar-nav ml-auto">%3$s</ul>',
        'depth' => 0,
        'walker' => ''
    ));
}

function register_nav() {
    register_nav_menus(array(
        'header-menu' => esc_html('Header Menu', 'artezpress') // Main Navigation
        // 'extra-menu'   => esc_html( 'Extra Menu', 'rentj' )
    ));
}

// Add Menu
add_action('init', 'register_nav');

function ap_aspect_ratio_filter( $class ) {

  $id   = get_post_thumbnail_id( $post->ID );
  $img  = wp_get_attachment_image_src( );

  $width = $img[1];
  $height = $img[2];
    
        if ($width < $height):
            return $class . 'attachment-is-portrait';
            // the_post_thumbnail($size, array( 'class'  => "attachment-".$size." size-".$size." attachment-is-landscape"));
        // else: 
        //     the_post_thumbnail($size, array( 'class'  => "attachment-".$size." size-".$size." ") ); 
        endif;
}

add_filter( 'get_image_tag_class', 'ap_aspect_ratio_filter', 10, 4);

// enqueue js for color extractor
add_action('acf/input/admin_enqueue_scripts', 'my_acf_admin_enqueue_scripts');
	function my_acf_admin_enqueue_scripts() {
		wp_enqueue_script( 'image-process-js', get_stylesheet_directory_uri() . '/js/image-process.js', false, '1.0.0' );
    }
    
// Ajax function for color extractor 
    add_action( 'wp_ajax_extract_colors', 'extract_colors' );	
	function extract_colors () {
		
		include_once("inc/colors.inc.php");
		$ex=new GetMostCommonColors();
		$attachment_id = $_POST['image_url'];
		$attachment_path = wp_get_original_image_path( $attachment_id );
		$colors = $ex->Get_Color($attachment_path, "5");
		
		
		//var_dump($colors);
		
		wp_send_json_success( $colors );
		die();
		
	}
	