<?php
    // Note for Maggie: the path construction needs to be: site_url/current_lang/page_name
    // Or use dynamic WP Navigation
    $current_lang      = pll_current_language();
?>
<div class="nav-column nav-column__main">
    <div class="search">
        <a href="<?php echo site_url("/books"); ?>" title="Search ArtEZPress Books"><?php _e('Search', 'artezpress'); ?></a>
    </div>
    <ul class="page-list">

        <?php if($current_lang === 'en'):?>
            <li <?php if (is_front_page()): ?> class="<?= 'active'?>"<?php endif; ?>><a href="<?php echo site_url(); ?>" title="ArtEZPress"><?php _e('Home', 'artezpress'); ?></a></li>
            <li <?php if (is_shop()): ?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/books"); ?>" title="ArtEZPress Books"><?php _e('Books', 'artezpress') ?></a></li>
            <li <?php if (is_archive("author") && !is_shop()): ?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/authors"); ?>" title="ArtEZPress Authors"><?php _e('Authors', 'artezpress') ?></a></li>
            <li <?php if (is_home() || is_single()):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/news"); ?>" title="ArtEZPress News"><?php _e('News', 'artezpress'); ?></a></li>
            <li <?php if (is_page("about")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/about"); ?>" title="About ArtEZPress"><?php _e('About ', 'artezpress'); ?> ArtEZ Press</a></li>
            <li <?php if (is_page("contact")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/contact"); ?>" title="Contact ArtEZPress">Contact</a></li>
        <?php else: ?>
            <li <?php if (is_front_page()): ?> class="<?= 'active'?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/" title="ArtEZPress"><?php _e('Home', 'artezpress'); ?></a></li>
            <li <?php if (is_shop()): ?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/boeken" title="ArtEZPress Boeken"><?php _e('Books', 'artezpress') ?></a></li>
            <li <?php if (is_archive("author") && !is_shop()): ?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("nl/autheurs"); ?>" title="ArtEZPress Authors"><?php _e('Authors', 'artezpress') ?></a></li>
            <li <?php if (is_home() || is_single()):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/nieuws" title="ArtEZPress Nieuws"><?php _e('News', 'artezpress'); ?></a></li>
            <li <?php if (is_page("over")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/over" title="Over ArtEZPress">Over ArtEZ Press</a></li>
            <li <?php if (is_page("contact")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/contact/" title="Contact ArtEZPress">Contact</a></li>
        <?php endif; ?>
    </ul>
    <div class="newsletter">
        <?php get_template_part('inc/templateparts/mailchimp'); ?>
    </div>
</div>
<div class="nav-column nav-column__secondary">
    <ul class="page-list">

        <?php if($current_lang === 'en'):?>
            <li <?php if (is_page("how-can-we-help")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/how-can-we-help"); ?>" title="How Can ArtEZPress Help"><?php _e('How Can We Help?', 'artezpress'); ?></a></li>
            <li <?php if (is_page("terms-and-conditions")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/terms-and-conditions"); ?>" title="ArtEZPress Terms and Conditions"><?php _e('Terms and Conditions', 'artezpress'); ?></a></li>
            <li <?php if (is_page("privacy-policy")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/privacy-policy"); ?>" title="ArtEZPress Privacy Policy"><?php _e('Privacy Policy', 'artezpress'); ?></a></li>
            <li <?php if (is_page("colophon")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/colophon"); ?>"><?php _e('Colophon', 'artezpress'); ?></a></li>
        <?php else: ?>
            <li <?php if (is_page("hoe-kunnen-we-helpen")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/hoe-kunnen-we-helpen/" title="Hoe kunnen we u helpen?"><?php _e('How Can We Help?', 'artezpress'); ?></a></li>
            <li <?php if (is_page("algemene-voorwaarden")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/algemene-voorwaarden/" title="ArtEZPress Terms and Conditions"><?php _e('Terms and Conditions', 'artezpress'); ?></a></li>
            <li <?php if (is_page("privacy-beleid")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/privacy-beleid" title="ArtEZPress Privacy Policy">Privacy Beleid</a></li>
            <li <?php if (is_page("colofon")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(""); ?>/nl/colofon/"><?php _e('Colophon', 'artezpress'); ?></a></li>
        <?php endif; ?>
    </ul>
    <div class="social-menu">
        <ul class="horizontal-list flex">
            <li>
                <a href="https://www.facebook.com/ArtezPress/" alt="link to facebook"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_fb.svg" alt="Facebook Icon"></a>
            </li>
            <li>
                <a href="https://www.instagram.com/artezpress/"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_ig.svg" alt="Instagram Icon"></a>
            </li>
            <li> <a href="https://www.linkedin.com/company/artez-press/"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_li.svg" alt="LinkedIn Icon"></a></li>
        </ul>
    </div>
    <div class="part-of">
        ArtEZ Press is <?php _e('publisher of', 'artezpress'); ?> APRIA
    </div>
    <div class="part-of">
        ArtEZ Press <?php _e('is part of', 'artezpress'); ?> <br>
        <a class="artez_university_logo" href="https://www.artez.nl/" title="link to ArtEZ">
          <svg id="artez_university_logo" data-name="artez_university_logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240.7 19.93"><path d="M10,10.35H4.35l-1,2.29A3.61,3.61,0,0,0,3,13.9a.73.73,0,0,0,.32.58,2.7,2.7,0,0,0,1.36.33v.4H.11v-.4a2.51,2.51,0,0,0,1.18-.42A6.49,6.49,0,0,0,2.5,12.31L7.6.37H8L13,12.44a5.43,5.43,0,0,0,1.11,1.88,2.26,2.26,0,0,0,1.38.49v.4H9.79v-.4A2.08,2.08,0,0,0,11,14.52a.72.72,0,0,0,.31-.6,4.53,4.53,0,0,0-.43-1.48Zm-.3-.79L7.2,3.7,4.68,9.56Z"/><path d="M19.72,5.12V7.33c.82-1.47,1.66-2.21,2.53-2.21a1.37,1.37,0,0,1,1,.36,1.11,1.11,0,0,1,.39.83,1,1,0,0,1-.28.7.88.88,0,0,1-.67.29,1.39,1.39,0,0,1-.83-.37,1.4,1.4,0,0,0-.69-.36.64.64,0,0,0-.42.21,5.26,5.26,0,0,0-1,1.44v4.7a2.83,2.83,0,0,0,.21,1.23,1.08,1.08,0,0,0,.49.48,2.13,2.13,0,0,0,1,.19v.39h-5v-.39a2.14,2.14,0,0,0,1.11-.23,1,1,0,0,0,.38-.55A6.29,6.29,0,0,0,18,13V9.21a15.12,15.12,0,0,0-.07-2,.8.8,0,0,0-.26-.48.71.71,0,0,0-.46-.15,2.1,2.1,0,0,0-.75.17l-.11-.39,3-1.2Z"/><path d="M27.19,2.19V5.41h2.29v.75H27.19v6.35a2,2,0,0,0,.28,1.28.84.84,0,0,0,.7.34,1.27,1.27,0,0,0,.68-.22,1.46,1.46,0,0,0,.51-.65h.42a3.37,3.37,0,0,1-1.06,1.58,2.27,2.27,0,0,1-1.41.53,1.81,1.81,0,0,1-1-.28,1.61,1.61,0,0,1-.7-.78,4.09,4.09,0,0,1-.22-1.56V6.16H23.88V5.81a4.25,4.25,0,0,0,1.2-.8,6.29,6.29,0,0,0,1.1-1.33,12.47,12.47,0,0,0,.68-1.49Z"/><path d="M34.52,1.5V7.23h3.19a2.59,2.59,0,0,0,1.66-.38A2.42,2.42,0,0,0,40,5.12h.39v5.05H40a5.49,5.49,0,0,0-.3-1.36,1.39,1.39,0,0,0-.63-.59A3.33,3.33,0,0,0,37.71,8H34.52v4.78A4.23,4.23,0,0,0,34.61,14a.6.6,0,0,0,.3.33,1.8,1.8,0,0,0,.81.13h2.46A6.3,6.3,0,0,0,40,14.24,2.49,2.49,0,0,0,41,13.57a7.9,7.9,0,0,0,1.36-2h.43l-1.25,3.64H30.39v-.4h.52a2,2,0,0,0,1-.25.9.9,0,0,0,.47-.51,5.13,5.13,0,0,0,.12-1.4V3.23a3.06,3.06,0,0,0-.28-1.7,1.63,1.63,0,0,0-1.28-.43h-.52V.71H41.57l.16,3.17h-.42a4.76,4.76,0,0,0-.5-1.57,1.68,1.68,0,0,0-.8-.65A4.79,4.79,0,0,0,38.5,1.5Z"/><path d="M55.74.71,46.22,14.33h5.94a3.22,3.22,0,0,0,2.1-.6,5.07,5.07,0,0,0,1.3-2.43l.36.07-.69,3.84H43.43v-.4l9.3-13.24H48.09a4.28,4.28,0,0,0-1.68.25,1.86,1.86,0,0,0-.79.73,6.24,6.24,0,0,0-.49,1.78h-.41L45,.71Z"/><path d="M71.42,1.1V.71h5.13V1.1H76a1.48,1.48,0,0,0-1.32.72,3.27,3.27,0,0,0-.22,1.54V9.24A10.31,10.31,0,0,1,74,12.62a4.23,4.23,0,0,1-1.7,2.07,6.07,6.07,0,0,1-3.45.86,6.47,6.47,0,0,1-3.6-.83,4.38,4.38,0,0,1-1.74-2.21,12.19,12.19,0,0,1-.34-3.57V3.27a2.87,2.87,0,0,0-.37-1.75,1.53,1.53,0,0,0-1.2-.42h-.54V.71h6.26V1.1H66.8a1.42,1.42,0,0,0-1.28.57,3.11,3.11,0,0,0-.27,1.6V9.59a14.4,14.4,0,0,0,.15,1.94,4.29,4.29,0,0,0,.56,1.7,3.16,3.16,0,0,0,1.18,1,4,4,0,0,0,1.87.4A5.23,5.23,0,0,0,71.56,14a3.3,3.3,0,0,0,1.53-1.59,9.08,9.08,0,0,0,.41-3.28V3.27a3,3,0,0,0-.3-1.7A1.57,1.57,0,0,0,72,1.1Z"/><path d="M79.67,7.2C80.82,5.81,81.91,5.12,83,5.12a2.39,2.39,0,0,1,1.38.4,2.69,2.69,0,0,1,.92,1.32,6,6,0,0,1,.24,2V13a3.5,3.5,0,0,0,.15,1.26.82.82,0,0,0,.38.42,2.1,2.1,0,0,0,1,.15v.39H82.14v-.39h.2a1.62,1.62,0,0,0,1-.21,1.09,1.09,0,0,0,.38-.61,6.26,6.26,0,0,0,0-1V9A4,4,0,0,0,83.37,7a1.24,1.24,0,0,0-1.17-.6,3.5,3.5,0,0,0-2.53,1.39V13a3.57,3.57,0,0,0,.12,1.23,1,1,0,0,0,.41.46,2.66,2.66,0,0,0,1.06.14v.39H76.42v-.39h.21a1.15,1.15,0,0,0,1-.38A2.7,2.7,0,0,0,77.9,13V9.36a14.64,14.64,0,0,0-.08-2.15.94.94,0,0,0-.24-.53.69.69,0,0,0-.45-.14,2.05,2.05,0,0,0-.71.17l-.16-.39,2.95-1.2h.46Z"/><path d="M90.84,5.12V13A3.65,3.65,0,0,0,91,14.22a.93.93,0,0,0,.4.45,2.08,2.08,0,0,0,.95.15v.39H87.56v-.39a2.31,2.31,0,0,0,1-.14,1,1,0,0,0,.39-.46A3.61,3.61,0,0,0,89.06,13V9.22A14.45,14.45,0,0,0,89,7.15a.83.83,0,0,0-.24-.47.66.66,0,0,0-.44-.14,2.15,2.15,0,0,0-.73.17l-.15-.39,3-1.2ZM90,0a1,1,0,0,1,.76.32,1,1,0,0,1,.32.76,1.06,1.06,0,0,1-.32.77,1,1,0,0,1-.76.32,1.06,1.06,0,0,1-.77-.32,1.06,1.06,0,0,1-.32-.77,1,1,0,0,1,.31-.76A1.06,1.06,0,0,1,90,0Z"/><path d="M92.16,5.41h4.61v.4h-.3a.85.85,0,0,0-.63.2.7.7,0,0,0-.22.54,2.26,2.26,0,0,0,.22.89l2.28,5.41,2.29-5.61a2.71,2.71,0,0,0,.24-.91.41.41,0,0,0-.08-.25.57.57,0,0,0-.3-.21,2.88,2.88,0,0,0-.74-.06v-.4h3.2v.4A1.33,1.33,0,0,0,102,6a2.78,2.78,0,0,0-.68,1.07l-3.47,8.41h-.44l-3.5-8.27a2.79,2.79,0,0,0-.45-.83A1.63,1.63,0,0,0,92.88,6a2.26,2.26,0,0,0-.72-.18Z"/><path d="M104.34,9.1a5.07,5.07,0,0,0,1.06,3.42,3.21,3.21,0,0,0,2.51,1.24,2.7,2.7,0,0,0,1.68-.53,3.88,3.88,0,0,0,1.19-1.81l.33.21a5.08,5.08,0,0,1-1.3,2.67,3.5,3.5,0,0,1-2.71,1.21,4,4,0,0,1-3-1.38,5.24,5.24,0,0,1-1.26-3.69,5.58,5.58,0,0,1,1.29-3.92,4.21,4.21,0,0,1,3.24-1.41,3.57,3.57,0,0,1,2.7,1.09,4,4,0,0,1,1.06,2.9Zm0-.62h4.54a4.15,4.15,0,0,0-.23-1.33,2.14,2.14,0,0,0-.79-.94,2.12,2.12,0,0,0-1.11-.34,2.22,2.22,0,0,0-1.59.69A3,3,0,0,0,104.34,8.48Z"/><path d="M115,5.12V7.33c.82-1.47,1.66-2.21,2.52-2.21a1.35,1.35,0,0,1,1,.36,1.11,1.11,0,0,1,.39.83,1,1,0,0,1-.28.7.87.87,0,0,1-.66.29,1.39,1.39,0,0,1-.84-.37,1.4,1.4,0,0,0-.69-.36.64.64,0,0,0-.42.21,5.06,5.06,0,0,0-1,1.44v4.7a2.86,2.86,0,0,0,.2,1.23,1.14,1.14,0,0,0,.49.48,2.18,2.18,0,0,0,1,.19v.39h-5v-.39a2.14,2.14,0,0,0,1.11-.23.93.93,0,0,0,.38-.55,6.29,6.29,0,0,0,0-1V9.21a15.12,15.12,0,0,0-.07-2,.75.75,0,0,0-.26-.48.69.69,0,0,0-.46-.15,2.1,2.1,0,0,0-.75.17l-.11-.39,3-1.2Z"/><path d="M125.49,5.12V8.46h-.35a4.37,4.37,0,0,0-1-2.14,2.36,2.36,0,0,0-1.62-.57,1.77,1.77,0,0,0-1.21.4,1.14,1.14,0,0,0-.46.88,1.57,1.57,0,0,0,.34,1A3.84,3.84,0,0,0,122.5,9l1.56.76c1.45.71,2.17,1.64,2.17,2.79a2.66,2.66,0,0,1-1,2.16,3.53,3.53,0,0,1-2.26.82,7.49,7.49,0,0,1-2-.33,2.13,2.13,0,0,0-.58-.1.43.43,0,0,0-.39.28h-.35v-3.5h.35a4,4,0,0,0,1.15,2.26,2.78,2.78,0,0,0,1.89.76,1.69,1.69,0,0,0,1.2-.44,1.37,1.37,0,0,0,.47-1,1.68,1.68,0,0,0-.52-1.24,9,9,0,0,0-2.07-1.27,6.31,6.31,0,0,1-2-1.39A2.42,2.42,0,0,1,119.55,8a2.71,2.71,0,0,1,.83-2,2.92,2.92,0,0,1,2.14-.81,4.88,4.88,0,0,1,1.4.25,3.11,3.11,0,0,0,.73.16.46.46,0,0,0,.27-.08,1.21,1.21,0,0,0,.22-.33Z"/><path d="M130.34,5.12V13a3.94,3.94,0,0,0,.13,1.23,1,1,0,0,0,.4.45,2.1,2.1,0,0,0,1,.15v.39h-4.76v-.39a2.22,2.22,0,0,0,1-.14.86.86,0,0,0,.39-.46,3.31,3.31,0,0,0,.15-1.23V9.22a13.93,13.93,0,0,0-.1-2.07.83.83,0,0,0-.24-.47.63.63,0,0,0-.43-.14,2.1,2.1,0,0,0-.73.17l-.15-.39,3-1.2ZM129.45,0a1.06,1.06,0,0,1,.77.32,1,1,0,0,1,.31.76,1.08,1.08,0,0,1-1.08,1.09,1.07,1.07,0,0,1-.77-.32,1.06,1.06,0,0,1-.32-.77,1,1,0,0,1,.32-.76A1.06,1.06,0,0,1,129.45,0Z"/><path d="M135.58,2.19V5.41h2.29v.75h-2.29v6.35a2.11,2.11,0,0,0,.28,1.28.84.84,0,0,0,.7.34,1.27,1.27,0,0,0,.68-.22,1.46,1.46,0,0,0,.51-.65h.42a3.37,3.37,0,0,1-1.06,1.58,2.27,2.27,0,0,1-1.41.53,1.81,1.81,0,0,1-1-.28,1.66,1.66,0,0,1-.7-.78,4.09,4.09,0,0,1-.22-1.56V6.16h-1.55V5.81a4.25,4.25,0,0,0,1.2-.8,6.29,6.29,0,0,0,1.1-1.33,12.47,12.47,0,0,0,.68-1.49Z"/><path d="M138,5.41h4.57v.4h-.23a1.12,1.12,0,0,0-.72.2.67.67,0,0,0-.24.52,3,3,0,0,0,.35,1.16l2.39,4.94,2.19-5.41a2.26,2.26,0,0,0,.18-.87.48.48,0,0,0-.07-.29.61.61,0,0,0-.27-.18,1.89,1.89,0,0,0-.64-.07v-.4h3.19v.4a1.31,1.31,0,0,0-.61.17,1.53,1.53,0,0,0-.47.48,5.62,5.62,0,0,0-.37.82l-4,9.78a5.12,5.12,0,0,1-1.51,2.15,3,3,0,0,1-1.8.72,1.51,1.51,0,0,1-1-.36,1.1,1.1,0,0,1-.41-.83,1,1,0,0,1,.3-.73,1.15,1.15,0,0,1,.81-.27,2.87,2.87,0,0,1,1,.24,2.64,2.64,0,0,0,.53.16,1.06,1.06,0,0,0,.7-.34,3.37,3.37,0,0,0,.77-1.28l.69-1.7-3.51-7.39a6.09,6.09,0,0,0-.52-.82,2.13,2.13,0,0,0-.44-.5,2.09,2.09,0,0,0-.79-.3Z"/><path d="M158.33,5.12a4.34,4.34,0,0,1,3.57,1.69,5.16,5.16,0,0,1,1.15,3.32,6.27,6.27,0,0,1-.63,2.66,4.51,4.51,0,0,1-4.21,2.72,4.14,4.14,0,0,1-3.51-1.77,5.42,5.42,0,0,1-1.1-3.34,6,6,0,0,1,.66-2.67,4.61,4.61,0,0,1,1.76-2A4.48,4.48,0,0,1,158.33,5.12Zm-.33.7a2.26,2.26,0,0,0-1.14.33,2.35,2.35,0,0,0-.92,1.19,5.55,5.55,0,0,0-.36,2.17,7.68,7.68,0,0,0,.85,3.69,2.55,2.55,0,0,0,2.24,1.55,2.1,2.1,0,0,0,1.72-.86,4.93,4.93,0,0,0,.67-2.94,6.78,6.78,0,0,0-1.12-4.11A2.32,2.32,0,0,0,158,5.82Z"/><path d="M167.44,6.18v6.44a3.13,3.13,0,0,0,.3,1.73,1.34,1.34,0,0,0,1.06.47h.89v.39h-5.85v-.39h.44a1.52,1.52,0,0,0,.78-.21,1.19,1.19,0,0,0,.49-.58,5.2,5.2,0,0,0,.13-1.41V6.18h-1.9V5.41h1.9V4.77a5.93,5.93,0,0,1,.47-2.48A3.74,3.74,0,0,1,167.59.65,3.88,3.88,0,0,1,169.76,0a3.29,3.29,0,0,1,2.07.73,1.37,1.37,0,0,1,.62,1.08.84.84,0,0,1-.28.6.82.82,0,0,1-.6.29,1,1,0,0,1-.52-.18,3,3,0,0,1-.67-.76,2.71,2.71,0,0,0-.72-.79,1.44,1.44,0,0,0-.74-.2,1.33,1.33,0,0,0-.83.26,1.5,1.5,0,0,0-.5.82,15.15,15.15,0,0,0-.15,2.84v.7H170v.77Z"/><path d="M177.67,2.19V5.41H180v.75h-2.29v6.35a2,2,0,0,0,.28,1.28.84.84,0,0,0,.7.34,1.27,1.27,0,0,0,.68-.22,1.46,1.46,0,0,0,.51-.65h.42a3.37,3.37,0,0,1-1.06,1.58,2.27,2.27,0,0,1-1.41.53,1.81,1.81,0,0,1-1-.28,1.61,1.61,0,0,1-.7-.78,4.09,4.09,0,0,1-.22-1.56V6.16h-1.55V5.81a4.25,4.25,0,0,0,1.2-.8,6.29,6.29,0,0,0,1.1-1.33,12.47,12.47,0,0,0,.68-1.49Z"/><path d="M184,0V7.17a8.19,8.19,0,0,1,1.89-1.68,3,3,0,0,1,1.39-.37,2.33,2.33,0,0,1,1.43.46A2.72,2.72,0,0,1,189.56,7a10.51,10.51,0,0,1,.2,2.5V13a3.57,3.57,0,0,0,.15,1.27.8.8,0,0,0,.36.41,2.08,2.08,0,0,0,.94.15v.39H186.4v-.39h.23a1.6,1.6,0,0,0,1-.21A1.08,1.08,0,0,0,188,14a6.44,6.44,0,0,0,0-1V9.53a8.34,8.34,0,0,0-.17-2.11,1.41,1.41,0,0,0-.53-.75,1.47,1.47,0,0,0-.88-.25,2.54,2.54,0,0,0-1.09.27A5.39,5.39,0,0,0,184,7.82V13a3.76,3.76,0,0,0,.12,1.25.92.92,0,0,0,.41.42,2.46,2.46,0,0,0,1.06.16v.39h-4.86v-.39a2.24,2.24,0,0,0,1-.2.75.75,0,0,0,.34-.41,3.54,3.54,0,0,0,.13-1.22V4.13a15.56,15.56,0,0,0-.08-2.07.9.9,0,0,0-.25-.52.66.66,0,0,0-.44-.14,2.81,2.81,0,0,0-.73.17l-.15-.37L183.47,0Z"/><path d="M193.05,9.1a5,5,0,0,0,1.06,3.42,3.21,3.21,0,0,0,2.51,1.24,2.72,2.72,0,0,0,1.68-.53,3.88,3.88,0,0,0,1.19-1.81l.33.21a5.08,5.08,0,0,1-1.3,2.67,3.53,3.53,0,0,1-2.71,1.21,3.94,3.94,0,0,1-3-1.38,5.24,5.24,0,0,1-1.26-3.69,5.58,5.58,0,0,1,1.29-3.92,4.21,4.21,0,0,1,3.24-1.41,3.59,3.59,0,0,1,2.7,1.09,4,4,0,0,1,1.06,2.9Zm0-.62h4.53a4.21,4.21,0,0,0-.22-1.33,2.1,2.1,0,0,0-.8-.94,2.06,2.06,0,0,0-1.1-.34,2.22,2.22,0,0,0-1.59.69A3,3,0,0,0,193.05,8.48Z"/><path d="M213.48,10.35h-5.62l-1,2.29a3.61,3.61,0,0,0-.36,1.26.71.71,0,0,0,.31.58,2.75,2.75,0,0,0,1.37.33v.4h-4.57v-.4a2.51,2.51,0,0,0,1.18-.42,6.51,6.51,0,0,0,1.2-2.08L211.11.37h.38l5,12.07a5.29,5.29,0,0,0,1.1,1.88,2.29,2.29,0,0,0,1.39.49v.4h-5.72v-.4a2.14,2.14,0,0,0,1.17-.29.74.74,0,0,0,.3-.6,4.29,4.29,0,0,0-.43-1.48Zm-.3-.79L210.72,3.7,208.2,9.56Z"/><path d="M223.11,5.12V7.33c.82-1.47,1.66-2.21,2.52-2.21a1.39,1.39,0,0,1,1,.36,1.13,1.13,0,0,1,.38.83.94.94,0,0,1-.28.7.84.84,0,0,1-.66.29,1.39,1.39,0,0,1-.84-.37,1.4,1.4,0,0,0-.69-.36.64.64,0,0,0-.42.21,5.06,5.06,0,0,0-1,1.44v4.7a3,3,0,0,0,.2,1.23,1.14,1.14,0,0,0,.49.48,2.18,2.18,0,0,0,1,.19v.39h-5v-.39a2.2,2.2,0,0,0,1.12-.23,1,1,0,0,0,.37-.55,5.27,5.27,0,0,0,.05-1V9.21a15.12,15.12,0,0,0-.07-2,.79.79,0,0,0-.25-.48.73.73,0,0,0-.47-.15,2.1,2.1,0,0,0-.75.17l-.1-.39,3-1.2Z"/><path d="M230.73,2.19V5.41H233v.75h-2.29v6.35a2.12,2.12,0,0,0,.27,1.28.87.87,0,0,0,.7.34,1.28,1.28,0,0,0,.69-.22,1.46,1.46,0,0,0,.51-.65h.42a3.37,3.37,0,0,1-1.06,1.58,2.32,2.32,0,0,1-1.41.53,1.81,1.81,0,0,1-1-.28,1.61,1.61,0,0,1-.7-.78,4.09,4.09,0,0,1-.22-1.56V6.16h-1.55V5.81a4.25,4.25,0,0,0,1.2-.8,6.25,6.25,0,0,0,1.09-1.33,10.73,10.73,0,0,0,.69-1.49Z"/><path d="M240,5.12V8.46h-.35a4.37,4.37,0,0,0-1-2.14,2.36,2.36,0,0,0-1.62-.57,1.75,1.75,0,0,0-1.21.4,1.14,1.14,0,0,0-.46.88,1.57,1.57,0,0,0,.34,1A3.84,3.84,0,0,0,237,9l1.56.76c1.45.71,2.17,1.64,2.17,2.79a2.66,2.66,0,0,1-1,2.16,3.55,3.55,0,0,1-2.26.82,7.62,7.62,0,0,1-2.06-.33,2,2,0,0,0-.57-.1.42.42,0,0,0-.39.28h-.35v-3.5h.35a4,4,0,0,0,1.15,2.26,2.78,2.78,0,0,0,1.89.76,1.69,1.69,0,0,0,1.2-.44,1.37,1.37,0,0,0,.47-1,1.68,1.68,0,0,0-.52-1.24,9,9,0,0,0-2.07-1.27,6.31,6.31,0,0,1-2-1.39A2.42,2.42,0,0,1,234,8a2.74,2.74,0,0,1,.82-2A3,3,0,0,1,237,5.12a4.88,4.88,0,0,1,1.4.25,3.11,3.11,0,0,0,.73.16.4.4,0,0,0,.26-.08,1,1,0,0,0,.23-.33Z"/><rect y="17.98" width="136.95" height="1"/><rect x="144.33" y="17.98" width="96.37" height="1"/></svg>
        </a>
    </div>
</div>
