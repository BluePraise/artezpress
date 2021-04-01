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
    if(!is_admin()) {
        wp_dequeue_style('dashicons-css');
        wp_deregister_style('dashicons-css');
        wp_dequeue_style('wp-block-library-theme');
	    wp_deregister_style('wp-block-library-theme');
        wp_dequeue_style('storefront-gutenberg-blocks');
	    wp_deregister_style('storefront-gutenberg-blocks');
        wp_dequeue_style('wp-block-library');
	    wp_deregister_style('wp-block-library');
        wp_dequeue_style('storefront-icons');
	    wp_deregister_style('storefront-icons');
    }

	// storefront-jetpack-widgets-css
	wp_dequeue_style('storefront-jetpack-widgets');
	wp_deregister_style('storefront-jetpack-widgets');

    wp_dequeue_style('select2');
    wp_deregister_style('select2');

	wp_deregister_style('storefront-woocommerce-style');
}
add_action('wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999);


function artezpress_style()
{
	wp_register_style('artezpress-css', get_stylesheet_directory_uri() . '/style.css');
	wp_register_style('app-css', get_stylesheet_directory_uri() . '/assets/css/app.css');
	wp_register_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
	wp_enqueue_style('artezpress-css');
	wp_enqueue_style('app-css');
	wp_enqueue_style('animate');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui');
	wp_enqueue_script('masonry');

    // USED FOR SEARCH AND FILTER ON ArCHIVe PAGE
    wp_register_script('typed',  get_theme_file_uri() . '/js/lib/typed/typed.min.js', ['jquery'], null, true);
    wp_register_script('filters', get_theme_file_uri() . '/js/filters.js', [], null, true);

    if (is_page()):
        wp_enqueue_script('jquery-ui-accordion');
    endif;
	if(is_archive() || is_front_page()):
        wp_register_script('flickity-theme',  "https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js", ['jquery'], null, false);
        wp_register_script('flickity-fade',  "https://unpkg.com/flickity-fade@1/flickity-fade.js", ['jquery'], null, false);
        wp_register_style('flickity-theme', 'https://unpkg.com/flickity@2/dist/flickity.min.css');
        wp_register_style('flickity-fade', 'https://unpkg.com/flickity-fade@1/flickity-fade.css');
		wp_enqueue_script('flickity-theme',  "https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js", ['jquery'], null, true);
		wp_enqueue_script('flickity-fade',  "https://unpkg.com/flickity-fade@1/flickity-fade.js", ['jquery'], null, true);
		wp_enqueue_style('flickity-theme');
    endif;
    if (is_archive()):
        wp_enqueue_script('typed',  get_theme_file_uri() . '/js/lib/typed/typed.min.js', ['jquery'], null, true);
        wp_enqueue_script('filters', get_theme_file_uri() . '/js/filters.js', [], null, true);
	endif;

	wp_enqueue_script('artezpress-script', get_theme_file_uri() . '/js/script.js', [], null, true);

	$ajax_url = admin_url('admin-ajax.php');
	wp_localize_script(
		'artezpress-script',
		'artez_object',
		array(
			'ajax_url' => $ajax_url,
			'nonce' => wp_create_nonce('ajax-nonce')
		)
	);
}
add_action('wp_enqueue_scripts', 'artezpress_style');


remove_filter('the_content', 'wpautop');




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
		'position' => '8',
		'icon_url' => 'dashicons-welcome-view-site',
		'redirect' => false
	));
	acf_add_options_page(array(
		'page_title' => 'New Releases',
		'menu_title' => 'New Releases',
		'menu_slug' => 'fp-highlights',
		'capability' => 'edit_posts',
		'position' => '9',
		'autoload' => true,
		'icon_url' => 'dashicons-images-alt',
		'redirect' => false,
		'updated_message' => __("Item Updated", 'acf'),
	));
}


function artezpress_theme_setup()
{
	add_image_size('feature-slider-size', 1120, true, array('center', 'center'));
	add_image_size('cart-thumb', 125, 177, true);
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


function register_ap_menu() {
    register_nav_menus([ // Using array to specify more menus if needed
        // 'primary' => __('Primary Menu Nederlands', 'artezpress'), // Main Navigation
        'primary-menu' => __('Primary Menu', 'artezpress'), // Main Navigation
        'secondary-menu' => __('Secondary Menu', 'artezpress'), // Main Navigation
        // 'secondary-menu-nederlands' => __('Secondary Menu Nederlands', 'artezpress'), // Main Navigation
    ]);
}
// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? [] : '';
}

add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}

add_action('artezpress_before_single_product_summary', 'woocommerce_show_product_images', 20);


function add_custom_text_after_cart_item_name( $cart_item, $cart_item_key ) {
    
    $product = $cart_item['data'];

    $edition = get_post_meta( $product->get_id(), 'ap_language', true );
    if ($edition === "nl"):
        $html = '<div class="d-block edition-language">(Nederlandse ed.)</div>';
    else: 
        $html = '<div class="d-block edition-language">(English ed.)</div>';
    endif;
    echo $html;

}
add_action( 'woocommerce_after_cart_item_name', 'add_custom_text_after_cart_item_name', 10, 2 );

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


/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
/**
 * Hide shipping rates when free shipping is available: https://docs.woothemes.com/document/hide-other-shipping-methods-when-free-shipping-is-available/
 *
 * @param array $rates Array of rates found for the package
 * @param array $package The package array/object being shipped
 * @return array of modified rates
 */
function hide_shipping_when_free_is_available( $rates, $package ) {
    // Only modify rates if free_shipping is present
    $free_shipping_rate_key = false;

    foreach ( $rates as $rate_key => $rate ) {
        $rate_key_exploded = explode( ' ', $rate_key );
        if ( $rate_key_exploded[0] === 'free_shipping' ) {
            $free_shipping_rate_key = $rate_key;
        }
    }

    if ( $free_shipping_rate_key ) {
        foreach ( $rates as $rate_key => $rate ) {
            if ( $rate_key !== $free_shipping_rate_key ) {
                unset( $rates[ $rate_key ] );
            }
        }
    }

    return $rates;

}

add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );


/* Woocommerce filters */
add_filter( 'wc_add_to_cart_message_html', '__return_false' );

/*
* Unset the labels in the checkout
*
*/

function custom_override_checkout_fields($fields) {
    unset($fields['order']['order_comments']);
   // unsetting fields takes a little bit of research for me. So for this round 
   // I am going to use CSS to not show the labels.
    // unset($fields['billing']['billing_address_1']);
//  $fields['shipping']['shipping_first_name']['placeholder'] = 'First Name';
//  $fields['shipping']['shipping_last_name']['placeholder'] = 'Last Name';
//  $fields['shipping']['shipping_company']['placeholder'] = 'Company Name'; 
//  $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
//  $fields['billing']['billing_email']['placeholder'] = 'Email Address ';
//  $fields['billing']['billing_phone']['placeholder'] = 'Phone ';
    return $fields;
 }
 add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

/*
* Mini cart with total counter not total price
*
*/

function add_to_cart_fragment($fragments){

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


// CHANGE THE MESSAGE FOR LOGIN PROPERLY VIA THIS FILTER
function ap_return_customer_message() {
    return '<div class="woocommerce-ap-custom form-title"><span>'. esc_html__('Already a Customer?', 'artezpress') .'</span> <a href="#" class="showlogin">' . esc_html__( 'Login', 'artezpress' ) . '</a></div>';
}
add_filter( 'woocommerce_checkout_login_message', 'ap_return_customer_message' );

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

add_filter('get_post_metadata', 'add_dynamic_post_meta', 10, 4);


/**
 * Change number of related products output
 */ 
function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 6;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 4; // 4 related products
	$args['columns'] = 4; // arranged in 2 columns
	return $args;
}

/**
 * Add dynamically-generated "post meta" to `\WP_Post` objects
 *
 * This makes it possible to access dynamic data related to a post object by simply referencing `$post->foo`.
 * That keeps the calling code much cleaner than if it were to have to do something like
 * `$foo = some_custom_logic( get_post_meta( $post->ID, 'bar', true ) ); echo esc_html( $foo )`.
 *
 * @param mixed  $value
 * @param int    $post_id
 * @param string $meta_key
 * @param int    $single   @todo handle the case where this is false
 *
 * @return mixed
 *      `null` to instruct `get_metadata()` to pull the value from the database
 *      Any non-null value will be returned as if it were pulled from the database
 */
function add_dynamic_post_meta($value, $post_id, $meta_key, $single)
{
	$post = get_post($post_id);

	if ('page' != $post->post_type) {
		return $value;
	}

	switch ($meta_key) {
		case 'verbose_page_template':
			$value = "The page template is " . ($post->_wp_page_template ?: 'not assigned');
			break;
	}

	return $value;
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
			]
		]
	];

	// If taxonomy is not set, remove key from array and get all posts
	if (!$taxonomy) {
		unset($args['tax_query']);
	}

	$query = new WP_Query($args);
	$languages = [];
	$years = [];

	if ($query->have_posts()) :
		while ($query->have_posts()) {
			$query->the_post();
			wc_get_template_part('content', 'product');
			// $authors[] = explode(',', get_field('author'));
			if (strlen(get_field('publishing_year'))) {
				$years[] = get_field('publishing_year');
			}
		}
		// $authors = array_unique(array_flatten($authors), SORT_REGULAR);
		$years = array_unique($years, SORT_REGULAR);
	?>

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

	$wp_meta_boxes['product']['side']['low']['woocommerce-product-images']['title'] = "Book Inner Pages";
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

	return sprintf(
		"%s://%s%s",
		isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
		$_SERVER['SERVER_NAME'],
		add_query_arg(array(), remove_query_arg('add-to-cart'))
	);
}


// BODY CLASS FUNCTION
// Add specific CSS class by filter.

add_filter('body_class', function ($classes) {

    global $post;
    $id = $post->ID;

	$single_product_text_color = get_field('text_color', $id);
	if (is_product() && $single_product_text_color) :
		if ($single_product_text_color == "#00000") :
			return array_merge($classes, array('set-text-black'));

		elseif ($single_product_text_color == "#f2f2f2") :
			return array_merge($classes, array('set-text-white'));
		endif;
	endif;

    $current_lang = pll_current_language();
    if ($current_lang === 'en') :
        $lang_class[] = 'lang-en';
        return $lang_class;
    endif;
});

function artez_random_bg()
{

	$rows = get_field('hero_bg_imgs', 'option'); // get all the rows
	$rand_row = $rows[array_rand($rows)];
	echo $rand_row['bg_images_uploaded'];
	wp_die();
}
add_action('wp_ajax_nopriv_artez_random_bg', 'artez_random_bg');


// add_filter('woocommerce_cart_totals_coupon_html', 'filter_woocommerce_cart_totals_coupon_html', 10, 3);

add_action("woocommerce_checkout_order_review", function () {
	$out = '<a class="back-to-cart" href="' . wc_get_cart_url() . '">' . __('Modify Cart', 'artezpress') . "</a>";
	echo $out;
});

// hide coupon field on the checkout page
function disable_coupon_field_on_checkout($enabled)
{
	if (is_checkout()) {
		$enabled = false;
	}
	return $enabled;
}
add_filter('woocommerce_coupons_enabled', 'disable_coupon_field_on_checkout');

// THIS IS TO HIDE COLONS AFTER THE SHIPPING LABELS `\_--_/
function ace_hide_shipping_title( $label ) {
	
	return str_replace( ':', ' ', $label);
}
add_filter( 'woocommerce_cart_shipping_method_full_label', 'ace_hide_shipping_title' );

// ALLOW TRANSLATION OF CUSTOM FIELDS AND OTHER PLUGIN DATA
add_filter('pll_translate_post_meta', 'translate_post_meta', 10, 3);

// Allows plugins to copy taxonomy terms when a new post (or page) translation is created or synchronize
function translate_post_meta($value, $key, $lang)
{
	if ('_thumbnail_id' === $key) {
		$value = pll_get_post($value, $lang);
	}
	return $value;
}

add_filter('pll_copy_taxonomies', 'copy_tax', 10, 2);

function copy_tax($taxonomies, $sync)
{
	$taxonomies[] = 'my_custom_tax';
	return $taxonomies;
}

// Disable Woocommerce Header in WP Admin
add_action('admin_head', 'Hide_WooCommerce_Breadcrumb');

function Hide_WooCommerce_Breadcrumb()
{
	echo '<style>
    .woocommerce-layout__header {
        display: none;
    }
    .woocommerce-layout__activity-panel-tabs {
        display: none;
    }
    .woocommerce-layout__header-breadcrumbs {
        display: none;
    }
    .woocommerce-embed-page .woocommerce-layout__primary{
        display: none;
    }
    .woocommerce-embed-page #screen-meta, .woocommerce-embed-page #screen-meta-links{top:0;}
    </style>';
}

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
