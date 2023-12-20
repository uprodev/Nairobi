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
        <form action="#" class="form-default">
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
                                        <div class="swiper-slide">
                                            <input type="checkbox" id="filter-1-2" name="filter-1">
                                            <label for="filter-1-2">Main+Sides</label>
                                        </div>
                                        <div class="swiper-slide">
                                            <input type="checkbox" id="filter-1-3" name="filter-1">
                                            <label for="filter-1-3">Main+Sides</label>
                                        </div>
                                        <div class="swiper-slide">
                                            <input type="checkbox" id="filter-1-4" name="filter-1">
                                            <label for="filter-1-4">Main+Sides</label>
                                        </div>
                                        <div class="swiper-slide">
                                            <input type="checkbox" id="filter-1-5" name="filter-1">
                                            <label for="filter-1-5">Main+Sides</label>
                                        </div>
                                        <div class="swiper-slide">
                                            <input type="checkbox" id="filter-1-6" name="filter-1">
                                            <label for="filter-1-6">Main+Sides</label>
                                        </div>
                                        <div class="swiper-slide">
                                            <input type="checkbox" id="filter-1-7" name="filter-1">
                                            <label for="filter-1-7">Main+Sides</label>
                                        </div>
                                        <div class="swiper-slide">
                                            <input type="checkbox" id="filter-1-8" name="filter-1">
                                            <label for="filter-1-8">Main+Sides</label>
                                        </div>

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
                                            <input type="checkbox" id="feature-<?= $term->term_id ?>" name="features">
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

                <?php 
                $terms = get_terms( [
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                ] );
                ?>

                <?php if ($terms): ?>
                    <?php foreach ($terms as $term): ?>
                        <?php if ($term->term_id == apply_filters('wpml_object_id', 45, 'product_cat') || $term->term_id == apply_filters('wpml_object_id', 46, 'product_cat') || $term->term_id == apply_filters('wpml_object_id', 47, 'product_cat')): ?>
                        <div class="title-wrap">
                            <p class="title"><?= $term->name ?></p>
                            <div class="link-wrap">
                                <a href="<?= get_term_link($term->term_id) ?>"><?php _e('View all', 'Nairobi') ?></a>
                            </div>
                        </div>

                        <?php 
                        $args = array(
                            'post_type' => 'product', 
                            'posts_per_page' => 4,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field'    => 'id',
                                    'terms'    => $term->term_id
                                )
                            ),
                            'paged' => get_query_var('paged')
                        );
                        $wp_query = new WP_Query($args);
                        if($wp_query->have_posts()): 
                            ?>

                            <div class="content">

                                <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                                    <?php get_template_part('parts/content', 'product') ?>
                                <?php endwhile; ?>

                            </div>

                            <?php 
                        endif;
                        wp_reset_query(); 
                        ?>

                    <?php endif ?>
                <?php endforeach ?>
            <?php endif ?>

        </div>
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
