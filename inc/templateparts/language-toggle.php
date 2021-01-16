<ul class="language-toggle js-language-toggle">
    <?php $langs_array = pll_the_languages( array( 'dropdown' => 0, 'raw' => 1 ) ); ?>

        <?php if ($langs_array) : ?>
        <li class="lang-item">
            <?php foreach ($langs_array as $lang) : ?>
                <a href="<?php echo $lang['url']; ?>" class="drop-block__link <?php if($lang['current_lang']): ?>active<?php else:?>inactive<?php endif; ?>">
                    <?php echo $lang['name']; ?>
                </a>
            <?php endforeach; ?>
        </li>
    <?php endif; ?>
</ul>
				