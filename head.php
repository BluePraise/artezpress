<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<?php if ( is_single() ) : ?>
			<meta name="description" content="<?php echo wp_strip_all_tags( get_the_excerpt(), true ); ?>" />
		<?php endif; ?>
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/favicon.ico" type="image/x-icon" />
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/a214b22300f3656fb3ad76337/6dfbd0aa9b3c8e4c8f93fa98a.js");</script>
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

