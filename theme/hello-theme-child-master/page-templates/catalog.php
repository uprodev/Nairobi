<?php
/*
Template Name: Catalog
*/
?>

<?php get_header(); ?>

<section class="catalog">
    <div class="top">
        <div class="content-width">
            <ul class="breadcrumb">
                <?php if(function_exists('bcn_display')) bcn_display() ?>
            </ul>
            <h1><?php the_title() ?></h1>
        </div>
    </div>
    <div class="wrap-content">
        <form action="#" class="form-default filter-form">
            <div class="content-width">
                <div class="filter-line">
                    <div class="left" id="filter">
                        <div class="filter" >
                            <div class="slider-wrap">
                                <div class="swiper filter-slider filter-slider-1">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <input type="checkbox" id="filter-1-1" name="filter-1" checked>
                                            <label for="filter-1-1">All</label>
                                        </div>

                                        <?php
                                        $terms = get_terms(
                                            [
                                                'taxonomy' => 'product_cat',
                                                'exclude' => 'boxes'
                                            ]
                                        );

                                        foreach ($terms as $term) {
                                            $i++
                                            ?>
                                            <div class="swiper-slide">
                                                <input type="checkbox" id="filter-1-<?= $i ?>" name="cats[]">
                                                <label for="filter-1-<?= $i ?>"><?= $term->name ?></label>
                                            </div>
                                        <?php
                                        }
                                        ?>


                                    </div>

                                </div>
                                <div class="swiper-button-prev prev-filter-1"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-10-1.svg" alt=""></div>
                                <div class="swiper-button-next next-filter-1"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-10-1.svg" alt=""></div>
                            </div>

                        </div>

                        <?php
                        $terms = get_terms( [
                            'taxonomy' => 'pa_features',
                            'hide_empty' => false,
                        ] );
                        ?>

                        <?php if ($terms): ?>
                            <div class="input-wrap-characteristics">
                                <div class="wrap-check">

                                    <?php foreach ($terms as $term): ?>
                                        <div class="check-item">
                                            <input type="checkbox" id="feature-<?= $term->term_id ?>" value="<?= $term->term_id ?>" name="features[]">
                                            <label for="feature-<?= $term->term_id ?>" class="round-check">

                                                <?php if ($field = get_field('icon', 'term_' . $term->term_id)): ?>
                                                    <?= wp_get_attachment_image($field['ID'], 'full') ?>
                                                <?php endif ?>

                                                <span class="text"><?= $term->name ?></span>
                                            </label>
                                        </div>
                                    <?php endforeach ?>

                                </div>
                            </div>
                        <?php endif ?>

                    </div>
                    <div class="right">
                        <p><?php _e('Sort by', 'Nairobi') ?>:</p>
                        <div class="select-block ">
                            <label class="form-label" for="lang"></label>
                            <select id="lang">
                                <option value="0">Latest</option>
                                <option value="1">Feature</option>
                                <option value="2">Release date</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mob-btn">
                    <a href="#filter" class="btn"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-13.svg" alt=""><?php _e('Filters', 'Nairobi') ?></a>
                    <a href="#sort" class="btn-img"><?php _e('Sort by', 'Nairobi') ?>: <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-14.svg" alt=""></a>
                </div>


                <div class="filter_output">
                    <?php get_template_part('parts/products') ?>
                </div>


        </div>

            <input type="hidden" name="action" value="filter">
    </form>

</div>
</section>

<section class="bg-info">
    <div class="bg">

        <?php if ($field = get_field('image')): ?>
            <?= wp_get_attachment_image($field['ID'], 'full') ?>
        <?php endif ?>

        <?php if ($field = get_field('image_mobile')): ?>
            <?= wp_get_attachment_image($field['ID'], 'full', false, array('class' => 'mob')) ?>
        <?php endif ?>

    </div>
    <div class="content-width">
        <div class="content">

            <?php if ($field = get_field('title')): ?>
                <p class="title"><?= $field ?></p>
            <?php endif ?>

            <?php if ($field = get_field('link')): ?>
                <div class="btn-wrap">
                    <a href="<?= $field['url'] ?>" class="btn-default btn-red"<?php if($field['target']) echo ' target="_blank"' ?>><?= $field['title'] ?></a>
                </div>
            <?php endif ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>
