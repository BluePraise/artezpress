
<?php 
    // here we have two language toggle from polylang.
    // this one is to facilitate desktop
    $langs_array = pll_the_languages(array('dropdown' => 0, 'raw' => 1));
    // this one is to facilitate mobile
    $langs_mobile = pll_the_languages(array('dropdown' => 0, 'raw' => 1));
    // this var helps with keep the active language toggle on desktop 
    // at the bottom
    $current_lang  = pll_current_language();
    ?>
    <?php if ($langs_array) : ?>
        <ul class="language-toggle language-toggle__screen js-language-toggle">

            <li class="lang-item <?= $current_lang; ?>">
                <?php foreach ($langs_array as $lang) : ?>
                    <a href="<?php echo $lang['url']; ?>" class="drop-block__link <?php if ($lang['current_lang']) : ?>active<?php else : ?>inactive<?php endif; ?>">
                        <?php echo $lang['name']; ?>
                    </a>
                <?php endforeach; ?>
            </li>
        </ul>
    <?php endif; ?>
    <?php if ($langs_mobile) : ?>
        <ul class="language-toggle language-toggle__mobile js-language-toggle">

            <li class="lang-item">
                <?php foreach ($langs_mobile as $lang) : ?>
                    <a href="<?= $lang['url']; ?>" class="drop-block__link <?php if ($lang['current_lang']) : ?>active<?php else : ?>inactive<?php endif; ?>">
                        <?= $lang['slug']; ?>
                        <?php if ($lang['slug'] === "en") :?>
                            <span>/</span>
                        <?php endif; ?>    
                    </a>
                <?php endforeach; ?>
            </li>
        </ul>
    <?php endif; ?>
