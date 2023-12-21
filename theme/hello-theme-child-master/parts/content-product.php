<?php $product = wc_get_product(get_the_ID()) ?>

<div class="item">

    <?php if (has_post_thumbnail()): ?>
        <figure>
            <a href="#product-<?= get_the_ID() ?>" class="fancybox">
                <?php the_post_thumbnail('full') ?>
            </a>
        </figure>
    <?php endif ?>

    <div class="text-wrap">

        <?php $features = wp_get_object_terms(get_the_ID(), 'pa_features') ?>

        <?php if ($features): ?>
            <div class="teg">

                <?php foreach ($features as $feature): ?>
                    <div class="check-item">

                        <?php if ($field = get_field('icon', 'term_' . $feature->term_id)): ?>
                            <?= wp_get_attachment_image($field['ID'], 'full') ?>
                        <?php endif ?>

                        <span class="text"><?= $feature->name ?></span>
                    </div>
                <?php endforeach ?>

            </div>
        <?php endif ?>

        <h6>
            <a href="#product-<?= get_the_ID() ?>" class="fancybox"><?php the_title() ?></a>
        </h6>
        <ul class="info-list">

            <?php if ($time = wp_get_object_terms(get_the_ID(), 'pa_time')): ?>
                <li>
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-11-1.svg" alt="">
                    <?= $time[0]->name . ' ' . __('Minutes', 'Nairobi') ?>
                </li>
            <?php endif ?>

            <?php if ($serves = wp_get_object_terms(get_the_ID(), 'pa_serves')): ?>
                <li>
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-11-2.svg" alt="">
                    <?= $serves[0]->name . ' ' . __('Serves', 'Nairobi') ?>
                </li>
            <?php endif ?>

        </ul>
        <div class="cost-wrap">
            <p class="cost">€ <?= $product->get_price() ?></p>
            <div class="input-number ">
                <div class="btn-count btn-count-plus"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-4-2.svg" alt=""></div>
                <input type="text" name="count" value="2" class="form-control"/>
                <div class="btn-count btn-count-minus"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-4-1.svg" alt=""></div>
            </div>
        </div>
        <div class="brn-wrap">
            <a href="?add-to-cart=<?= get_the_ID() ?>" class="btn-default add_to_cart_button ajax_add_to_cart" data-product_id="<?= get_the_ID() ?>"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-12.svg" alt=""><?php _e('Order Now', 'Nairobi') ?></a>
        </div>
    </div>
</div>
<div id="product-<?= get_the_ID() ?>" class="popup-img-text" style="display: none;">

    <div class="popup-main">

        <?php if (has_post_thumbnail()): ?>
            <figure>
                <?php the_post_thumbnail('full') ?>
            </figure>
        <?php endif ?>

        <div class="text-popup">

            <?php $features = wp_get_object_terms(get_the_ID(), 'pa_features') ?>

            <?php if ($features): ?>
                <div class="teg">

                    <?php foreach ($features as $feature): ?>
                        <div class="check-item">

                            <?php if ($field = get_field('icon', 'term_' . $feature->term_id)): ?>
                                <?= wp_get_attachment_image($field['ID'], 'full') ?>
                            <?php endif ?>

                            <span class="text"><?= $feature->name ?></span>
                        </div>
                    <?php endforeach ?>

                </div>
            <?php endif ?>

            <h6><?php the_title() ?></h6>
            <ul class="info-list">

                <?php if ($time = wp_get_object_terms(get_the_ID(), 'pa_time')): ?>
                    <li>
                        <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-11-1.svg" alt="">
                        <?= $time[0]->name . ' ' . __('Minutes', 'Nairobi') ?>
                    </li>
                <?php endif ?>

                <?php if ($serves = wp_get_object_terms(get_the_ID(), 'pa_serves')): ?>
                    <li>
                        <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-11-2.svg" alt="">
                        <?= $serves[0]->name . ' ' . __('Serves', 'Nairobi') ?>
                    </li>
                <?php endif ?>

                <?php if ($calories = wp_get_object_terms(get_the_ID(), 'pa_calories')): ?>
                    <li>
                        <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-16.svg" alt="">
                        <?= $calories[0]->name . ' ' . __('calories', 'Nairobi') ?>
                    </li>
                <?php endif ?>

            </ul>

            <?php if(have_rows('table')): ?>

                <div class="text-info">
                    <p class="sub-title"><?php _e('Nutrition Values', 'Nairobi') ?></p>
                    <div class="table-product">
                        <div class="table-row table-head">
                            <div class="data data-1"></div>
                            <div class="data data-2"><?php _e('Per serving', 'Nairobi') ?></div>
                        </div>

                        <?php while(have_rows('table')): the_row() ?>

                            <div class="table-row">
                                <div class="data data-1"><?php the_sub_field('title') ?></div>
                                <div class="data data-2"><?php the_sub_field('text') ?></div>
                            </div>

                        <?php endwhile ?>

                    </div>
                </div>

            <?php endif ?>

            <?php if ($field = get_field('text')): ?>
                <div class="text-info">
                    <?= add_class_content($field, '', 'sub-title') ?>
                </div>
            <?php endif ?>

        </div>
    </div>
</div>