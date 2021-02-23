
    <?php $langs_array = pll_the_languages(array('dropdown' => 0, 'raw' => 1)); ?>

    <?php $langs_mobile = pll_the_languages(array('dropdown' => 0, 'raw' => 1)); ?>
    <?php if ($langs_array) : ?>
        <ul class="language-toggle language-toggle__screen js-language-toggle">

            <li class="lang-item">
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
                <?php foreach ($langs_array as $lang) : ?>
                    <a href="<?php echo $lang['url']; ?>" class="drop-block__link <?php if ($lang['current_lang']) : ?>active<?php else : ?>inactive<?php endif; ?>">
                        <?php echo $lang['slug']; ?>
                    </a>
                <?php endforeach; ?>
            </li>
        </ul>
    <?php endif; ?>
