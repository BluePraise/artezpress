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

add_action('after_setup_theme', 'load_child_language');
function load_child_language()
{
	load_child_theme_textdomain('artezpress', get_stylesheet_directory() . '/languages');
}

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
    $ajax_url = admin_url( 'admin-ajax.php' );
	if(is_home()) {
	wp_enqueue_script('artezpress-news-json', get_theme_file_uri() . '/js/news-json.js', [], null, true);
	wp_localize_script( 'artezpress-news-json', 'artez_object', 
		  	array( 
                'site_url' => site_url(),
			) 
		  );
		}
	if(is_single()) {
		global $post;
		wp_enqueue_script('artezpress-single-news-json', get_theme_file_uri() . '/js/single-news-json.js', [], null, true);
	wp_localize_script( 'artezpress-single-news-json', 'artez_object', 
		  	array( 
				'site_url' => site_url(),
				'post_id' => $post->ID
			) 
		  );
		}
	

    wp_enqueue_script('artezpress-script', get_theme_file_uri() . '/js/script.js', [], null, true);
    wp_localize_script( 'artezpress-script', 'artez_object', 
		  	array( 
                'ajax_url' => $ajax_url,
                'nonce' => wp_create_nonce('ajax-nonce')
			) 
		  );
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
	add_image_size( 'cart-thumb', 125, 177, true ); // 100 wide and 100 high
	add_image_size( 'news-portrait', '', 460, false );
	add_editor_style('style-editor.css'); // tries to include style-editor.css directly from your theme folder

	add_theme_support('editor-styles'); // if you don't add this line, your stylesheet won't be added
	add_theme_support('woocommerce', array(
		'thumbnail_image_width' => 150,
		'single_image_width'    => 300,

		'product_grid'          => array(
			'default_rows'    => 5,
			'min_rows'        => 2,
			'max_rows'        => 30,
			'default_columns' => 4,
			'min_columns'     => 4,
			'max_columns'     => 4,
		),
	));
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

function my_acf_admin_head() { 
	if (is_user_logged_in(  )): 
?>
	<style type="text/css">
		.acf-tab-group li.active a {
			font-family: 'Lars';
			color: #0064fd !important;
		}

		#poststuff .stuffbox>h3,
		#poststuff h2,
		#poststuff h3.hndle,
		.postbox-header {
			font-family: 'Lars';
			background: black;
			color: white;
		}

		.acf-one-half .acf-input {
			width: 25% !important;
		}

		.acf-one-third .acf-input {
			width: 33% !important;
		}

		.d-block {
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
	endif;
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
function remove_image_zoom_support()
{
	remove_theme_support('wc-product-gallery-zoom');
}
add_action('wp', 'remove_image_zoom_support', 100);


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
function availability_filter_func($availability)
{
	$availability['availability'] = str_ireplace('Out of stock', 'Out of Print', $availability['availability']);
	return $availability;
}
add_filter('woocommerce_get_availability', 'availability_filter_func');

// enqueue js for color extractor
add_action('acf/input/admin_enqueue_scripts', 'my_acf_admin_enqueue_scripts');
function my_acf_admin_enqueue_scripts()
{
	wp_enqueue_script('image-process-js', get_stylesheet_directory_uri() . '/js/image-process.js', false, '1.0.0');
}

// Ajax function for color extractor 
add_action('wp_ajax_extract_colors', 'extract_colors');
function extract_colors()
{

	include_once("inc/colors.inc.php");
	$ex = new GetMostCommonColors();
	$attachment_id = $_POST['image_url'];
	$attachment_path = wp_get_original_image_path($attachment_id);
	$colors = $ex->Get_Color($attachment_path, "5");


	//var_dump($colors);

	wp_send_json_success($colors);
	die();
}

function wpse39446_modify_featured_image_labels($labels)
{
	$labels->featured_image = __('Book Cover', 'artezpress');
	$labels->set_featured_image = __('Set Book Cover', 'artezpress');
	$labels->remove_featured_image = __('Remove Book Cover', 'artezpress');
	$labels->use_featured_image = __('Use as Book Cover', 'artezpress');

	return $labels;
}
add_filter('post_type_labels_product', 'wpse39446_modify_featured_image_labels', 10, 1);

function change_meta_box_titles()
{
	global $wp_meta_boxes; // array of defined meta boxes
	// cycle through the array, change the titles you want

	$wp_meta_boxes['product']['side']['low']['woocommerce-product-images']['title'] = "Book Inner pages";
}
add_action('add_meta_boxes', 'change_meta_box_titles', 999);



//Prevent Add to cart on reload

add_action('woocommerce_add_to_cart_redirect', 'prevent_duplicate_products_redirect');
function prevent_duplicate_products_redirect($url = false)
{
	// if another plugin gets here first, let it keep the URL
	if (!empty($url)) {
		return $url;
	}
	// redirect back to the original page, without the 'add-to-cart' parameter.
	// we add the 'get_bloginfo' part so it saves a redirect on https:// sites.
	return get_bloginfo('wpurl') . add_query_arg(array(), remove_query_arg('add-to-cart'));
}



add_filter('body_class', function ($classes) {
	global $post;
	$id = $post->ID;
	if (is_product()) {

		$single_product_text_color = get_field('text_color', $id);

		if ($single_product_text_color == "#fff") {
			$classes[] = 'artz-white-text';
		}
	}
	return $classes;
});

add_action('wp_ajax_artez_random_bg', 'artez_random_bg');
add_action('wp_ajax_nopriv_artez_random_bg', 'artez_random_bg');

function artez_random_bg()
{

	$rows = get_field('hero_bg_imgs', 'option'); // get all the rows
	$rand_row = $rows[array_rand($rows)];
	echo $rand_row['bg_images_uploaded'];
	wp_die();
}

// Removes cross-sell products from cart page

remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

function filter_woocommerce_cart_totals_coupon_html($coupon_html, $coupon, $discount_amount_html)
{
	if (is_string($coupon)) {
		$coupon = new WC_Coupon($coupon);
	}

	$coupon_html          = $discount_amount_html . ' <a href="' . esc_url(add_query_arg('remove_coupon', rawurlencode($coupon->get_code()),  wc_get_cart_url())) . '" class="woocommerce-remove-coupon" data-coupon="' . esc_attr($coupon->get_code()) . '">' . __('Remove', 'woocommerce') . '</a>';

	return $coupon_html;
}

add_filter('woocommerce_cart_totals_coupon_html', 'filter_woocommerce_cart_totals_coupon_html', 10, 3);

remove_action("woocommerce_before_checkout_form", "woocommerce_checkout_coupon_form", 10);
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10);
add_action('woocommerce_before_checkout_billing_form', 'woocommerce_checkout_login_form', 10);
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
add_action('woocommerce_checkout_order_payment', 'woocommerce_checkout_payment', 20);


add_action("woocommerce_review_order_after_order_total", function () {
	$out = "<a class='back-to-cart' href='" . wc_get_cart_url() . "'>Modify Cart</a>";
	echo $out;
});

// Hook in
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields($fields)
{
	unset($fields['order']['order_comments']);

	return $fields;
}
