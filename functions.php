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

if (!isset($content_width)) {
	$content_width = 1076;
}

// add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue a lot of css
 */
function sf_child_theme_dequeue_style()
{
	wp_dequeue_style('storefront-style');
	wp_deregister_style('storefront-style');
	wp_dequeue_style('storefront-fonts');
	wp_deregister_style('storefront-fonts');

	// storefront-jetpack-widgets-css
	wp_dequeue_style('storefront-jetpack-widgets');
	wp_deregister_style('storefront-jetpack-widgets');

	wp_deregister_style('storefront-woocommerce-style');
}
add_action('wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999);


function artezpress_style()
{
	wp_register_style('artezpress-css', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style('artezpress-css');
	wp_register_style('app-css', get_stylesheet_directory_uri() . '/assets/css/app.css');
	wp_enqueue_style('app-css');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui');
	wp_enqueue_script('waypoints', get_theme_file_uri() . '/js/jquery.waypoints.min.js', [], null, true);
	wp_enqueue_script('masonry');
	wp_enqueue_script('owl-slider', get_theme_file_uri() . '/js/owl.slider.js', [], null, true);
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-slider');
	wp_register_style('jquery-ui-smoothness', '//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui');
	wp_enqueue_script('totitlecase',  get_theme_file_uri() . '/js/totitlecase-min.js', [], null, true);
	wp_enqueue_script('artezpress-script', get_theme_file_uri() . '/js/script.js', [], null, true);
}

add_action('wp_enqueue_scripts', 'artezpress_style');



function ajax_filter_posts_scripts()
{
	// Enqueue script
	wp_register_script(
		'afp_script',
		get_stylesheet_directory_uri() . '/js/ajax-filter.js',
		false,
		null,
		false
	);
	wp_enqueue_script('afp_script');

	wp_localize_script('afp_script', 'afp_vars', array(
		'afp_nonce' => wp_create_nonce('afp_nonce'), // Create nonce which we later will use to verify AJAX request
		'afp_ajax_url' => admin_url('admin-ajax.php')
	));
}

add_action('wp_enqueue_scripts', 'ajax_filter_posts_scripts', 100);


function ap_excerpt_more($more)
{
	return ' ...';
}
add_filter('excerpt_more', 'ap_excerpt_more');


if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' => 'Hero Images',
		'menu_title' => 'Hero Images',
		'menu_slug' => 'hero-img',
		'capability' => 'edit_posts',
		'position' => '9',
		'redirect' => false
	));
}

function artezpress_theme_setup()
{
	add_image_size('feature-slider-size', 1120, true, array('center', 'center'));
	add_editor_style('style-editor.css'); // tries to include style-editor.css directly from your theme folder
	
	add_theme_support('editor-styles'); // if you don't add this line, your stylesheet won't be added
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 150,
		'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 5,
            'min_rows'        => 2,
            'max_rows'        => 30,
            'default_columns' => 4,
            'min_columns'     => 4,
            'max_columns'     => 4,
        ),) );

}

add_action('after_setup_theme', 'artezpress_theme_setup');

add_action('artezpress_before_single_product_summary', 'woocommerce_show_product_images', 20);

/***
 * ACF CUSTOMIZATION
 */

function my_acf_json_save_point($path)
{
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
add_filter('pum_popup_content', 'veer_popup_maker_gutenburg_compat');

function my_acf_admin_head()
{
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

		.acf-repeater.-row>table>tbody>tr>td,
		.acf-repeater.-block>table>tbody>tr>td {
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


function veer_popup_maker_gutenburg_compat($content)
{
	$content = preg_replace('!/\*.*?\*/!s', '', $content); // empty lines
	$content = preg_replace('/<!--(.|\s)*?-->/', '', $content); // block editor comments
	$content = preg_replace('/<p[^>]*><\\/p[^>]*>/', '', $content); // empty p tags
	return $content;
}


/**********************************
*
* All WooCommerce Functions
* 
**********************************/



/* Woocommerce filters */

/*
* Mini cart with total counter not total price
*
*/

function add_to_cart_fragment($fragments)
{

	global $woocommerce;
	$count = $woocommerce->cart->cart_contents_count;

	if ($count > 0) {
		$fragments['.cart-counter'] = '<span class="cart-counter">' . $count . '</span>';
	} else {
		$fragments['.cart-counter'] = '<span class="cart-counter hide">' . $count . '</span>';
	}

	return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'add_to_cart_fragment', 10, 1);

//Turn off irritating zoom hover effect 
function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );


if (!function_exists('woocommerce_widget_shopping_cart_subtotal')) {
	/**
	 * Output to view cart subtotal.
	 *
	 * @since 3.7.0
	 */
	function woocommerce_widget_shopping_cart_subtotal()
	{
		echo '<span>' . esc_html__('Total:', 'artezpress') . '</span> ' . WC()->cart->get_cart_subtotal(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}


if (!function_exists('array_flatten_iterator')) {
	function array_flatten_iterator(array $array)
	{
		foreach ($array as $value) {
			if (is_array($value)) {
				yield from array_flatten_iterator($value);
			} else {
				yield $value;
			}
		}
	}
}

if (!function_exists('array_flatten')) {
	function array_flatten(array $array)
	{
		return iterator_to_array(array_flatten_iterator($array), false);
	}
}


// Script for getting posts
function ajax_filter_get_posts($taxonomy)
{
	// Verify nonce
	if (
		!isset($_POST['afp_nonce']) ||
		!wp_verify_nonce($_POST['afp_nonce'], 'afp_nonce')
	) {
		die('Permission denied');
	}

	$taxonomy = json_decode(stripslashes($_POST['taxonomy']));

	// WP Query
	$args = [
		'post_type' => 'product',
		'posts_per_page' => -1,
		'tax_query' => [
			[
				'taxonomy' => 'product_tag',
				'field' => 'slug',
				'terms' => $taxonomy
				//              'terms' => implode(',', $taxonomy),
			]
		]
	];

	// If taxonomy is not set, remove key from array and get all posts
	if (!$taxonomy) {
		unset($args['tax_query']);
	}

	$query = new WP_Query($args);
	$authors = [];
	$years = [];

	if ($query->have_posts()) :
		while ($query->have_posts()) {
			$query->the_post();
			wc_get_template_part('content', 'product');
			$authors[] = explode(',', get_field('author'));
			if (strlen(get_field('publishing_year'))) {
				$years[] = get_field('publishing_year');
			}
		}
		$authors = array_unique(array_flatten($authors), SORT_REGULAR);
		$years = array_unique($years, SORT_REGULAR);
	?>

		<ul class="hidden-filter-authors">
			<?php foreach ($authors as $author) : ?>
				<li><a href=""><?= $author ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php if (count($years)) : ?>
			<ul class="hidden-filter-years">
				<?php foreach ($years as $year) : ?>
					<li><a href=""><?= $year ?></a></li>
				<?php endforeach; ?>
			</ul>
<?php endif;

	else :
		echo '<h2>No posts found</h2>';
	endif;

	die();
}

add_action('wp_ajax_filter_posts', 'ajax_filter_get_posts');
add_action('wp_ajax_nopriv_filter_posts', 'ajax_filter_get_posts');



// A function to change the text on the single shop file.
function availability_filter_func($availability) {
	$availability['availability'] = str_ireplace('Out of stock', 'Out of Print', $availability['availability']);
	return $availability;
}
add_filter('woocommerce_get_availability', 'availability_filter_func');

// enqueue js for color extractor
function my_acf_admin_enqueue_scripts() {
	wp_enqueue_script( 'image-process-js', get_stylesheet_directory_uri() . '/js/image-process.js', false, '1.0.0' );
}

// function mode_theme_update_mini_cart() {
//     echo wc_get_template( 'cart/mini-cart.php' );
//     die();
// }
// add_filter( 'wp_ajax_nopriv_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );
// add_filter( 'wp_ajax_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );

// add_action( 'template_redirect', 'quadlayers_add_to_cart_programmatically' );
   
// function quadlayers_add_to_cart_programmatically() {
 
//    $product_id = 1326;
 
//    $product_cart_id = WC()->cart->generate_cart_id( $product_id );
   
//    if(!WC()->cart->find_product_in_cart( $product_cart_id )) {
//        WC()->cart->add_to_cart( $product_id);
//        wc_print_notice( 'Product ID ' . $product_id . ' is in the Cart!', 'notice' );
//    }
 
// }

//Prevent Add to cart on reload

add_action( 'woocommerce_add_to_cart_redirect', 'prevent_duplicate_products_redirect' );
function prevent_duplicate_products_redirect( $url = false ) {
  // if another plugin gets here first, let it keep the URL
  if( !empty( $url ) ) {
    return $url;
  }
  // redirect back to the original page, without the 'add-to-cart' parameter.
  // we add the 'get_bloginfo' part so it saves a redirect on https:// sites.
  return get_bloginfo( 'wpurl' ).add_query_arg( array(), remove_query_arg( 'add-to-cart' ) );
} 
