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
            <li <?php if (is_page("books")): ?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/books"); ?>" title="ArtEZPress Books"><?php _e('Books', 'artezpress') ?></a></li>
            <li <?php if (is_home()):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/news"); ?>" title="ArtEZPress News"><?php _e('News', 'artezpress'); ?></a></li>
            <li <?php if (is_page("about")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/about"); ?>" title="About ArtEZPress"><?php _e('About ', 'artezpress'); ?>ArtEZ Press</a></li>
        <?php else: ?>
            <li <?php if (is_front_page()): ?> class="<?= 'active'?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/" title="ArtEZPress"><?php _e('Home', 'artezpress'); ?></a></li>
            <li <?php if (is_page("books")): ?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/books" title="ArtEZPress Boeken"><?php _e('Books', 'artezpress') ?></a></li>
            <li <?php if (is_home()):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/nieuws" title="ArtEZPress Nieuws"><?php _e('News', 'artezpress'); ?></a></li>
            <li <?php if (is_page("over")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/over" title="Over ArtEZPress"><?php _e('About ', 'artezpress'); ?>ArtEZ Press</a></li>
        <?php endif; ?>
    </ul>
    <div class="newsletter">
        <span><?php _e('Subscribe to our newsletter', 'artezpress'); ?></span>
        <input type="email" />
        <button type="submit" class="btn btn-reg">OK</button>
    </div>
</div>
<div class="nav-column nav-column__secondary">
    <ul class="page-list">

        <?php if($current_lang === 'en'):?>
            <li <?php if (is_page("contact")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/contact"); ?>" title="Contact ArtEZPress">Contact</a></li>
            <li <?php if (is_page("how-can-we-help")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/how-can-we-help"); ?>" title="How Can ArtEZPress Help"><?php _e('How Can We Help?', 'artezpress'); ?></a></li>
            <li <?php if (is_page("for-authors")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/for-authors"); ?>" title="For Authors"><?php _e('For Authors', 'artezpress'); ?></a></li>
            <li <?php if (is_page("terms-and-conditions")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/terms-and-conditions"); ?>" title="ArtEZPress Terms and Conditions"><?php _e('Terms and Conditions', 'artezpress'); ?></a></li>
            <li <?php if (is_page("privacy-policy")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/privacy-policy"); ?>" title="ArtEZPress Privacy Policy"><?php _e('Privacy Policy', 'artezpress'); ?></a></li>
            <li <?php if (is_page("imprint")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url("/imprint"); ?>"><?php _e('Imprint', 'artezpress'); ?></a></li>
        <?php else: ?>
            <li <?php if (is_page("contact")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/contact/" title="Contact ArtEZPress">Contact</a></li>
            <li <?php if (is_page("hoe-kunnen-we-helpen")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/hoe-kunnen-we-helpen/" title="Hoe kunnen we u helpen?"><?php _e('How Can We Help?', 'artezpress'); ?></a></li>
            <li <?php if (is_page("voor-auteurs")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/voor-auteurs/" title="Voor Auteurs"><?php _e('For Authors', 'artezpress'); ?></a></li>
            <li <?php if (is_page("algemene-voorwaarden")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/algemene-voorwaarden/" title="ArtEZPress Terms and Conditions"><?php _e('Terms and Conditions', 'artezpress'); ?></a></li>
            <li <?php if (is_page("privacy-policy")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(); ?>/nl/privacy-policy" title="ArtEZPress Privacy Policy"><?php _e('Privacy Policy', 'artezpress'); ?></a></li>
            <li <?php if (is_page("colofon")):?>class="<?= 'active';?>"<?php endif; ?>><a href="<?php echo site_url(""); ?>/nl/colofon/"><?php _e('Colofon', 'artezpress'); ?></a></li>
        <?php endif; ?>
    </ul>
    <div class="social-menu">
        <ul class="horizontal-list">
            <li>
                <a href="https://www.facebook.com/ArtezPress/" alt="link to facebook"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_fb.svg" alt="Facebook Icon"></a>
                <a href="https://www.instagram.com/artezpress/"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_ig.svg" alt="Instagram Icon"></a>
                <a href="https://twitter.com/ArtezPress"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_tw.svg" alt="Twitter Icon"></a>
            </li>
        </ul>
    </div>
    <div class="part-of">
        ArtEZ Press is part of <br>
        <a class="artez_university_logo" href="https://www.artez.nl/" title="link to ArtEZ">
          <?php //echo file_get_contents( get_stylesheet_directory_uri() . '/assets/icons/artez_university_logo.svg' ); ?>
        </a>
    </div>
</div>
