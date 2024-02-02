<?php
/*
Template Name: Choose
*/


$max_adults = 8;
$max_kids = 6;
$max_meals = 9;
$min_meals = 4;

?>

<?php get_header(); ?>

<section class="choose-block">
    <div class="content-width">
        <h1><?php the_title() ?></h1>
        <div class="content">
            <form action="#" class="form-default box-form">
                <div class="left">
                    <p class="title"><?php _e('1. Choose your preferences', 'nairobi') ?></p>
                    <p><?php _e('Your preferences help us show you the most relevant recipes first.', 'nairobi') ?></p>
                    <div class="input-wrap input-big-check">
                        <p class="label"><?php _e('Choose options', 'nairobi') ?></p>
                        <div class="wrap wrap-items">

                            <?php
                            $boxes = new WP_Query([
                                'post_type' => 'product',
                                'product_cat' => 'boxes',
                                'orderby' => 'menu_order'

                            ]);



                            while ($boxes->have_posts()) {
                                $boxes->the_post();
                                $i++;
                                global $post;
                                $product = new WC_Product(get_the_id());
                                $desc[get_the_id()] =  $product->get_short_description();
                            ?>
                            <div class="item">
                                <input <?php checked(1, $i) ?> type="radio" data-price="<?= $product->get_price() ?>" value="<?= get_the_id() ?>" id="select-1-<?= $i?>>" name="product">
                                <label for="select-1-<?= $i?>" class="select-label">
										<span class="img-wrap">
											<?php the_post_thumbnail() ?>
										</span>
                                    <span class="text"><?= get_the_title() ?> </span>
                                    <span class="check-img"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-3.svg" alt=""></span>
                                </label>
                            </div>
                            <?php } ?>

                            <div class="item">
                                <input type="radio" id="select-1-3" name="product" value="regular">
                                <label for="select-1-3" class="select-label">
										<span class="img-wrap">
											<img src="<?= get_stylesheet_directory_uri() ?>/img/icon-2-3.svg" alt="">
										</span>
                                    <span class="text"><?php _e('Regular menu', 'nairobi') ?> </span>
                                    <span class="check-img"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-3.svg" alt=""></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="input-wrap input-wrap-number-col">
                        <p class="title"><?php _e('2. Add details', 'nairobi') ?> </p>
                        <div class="number-item num-adults">
                            <p><?php _e('Adults', 'nairobi') ?> </p>
                            <div class="input-number ">
                                <div class="btn-count btn-count-plus"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-4-2.svg" alt=""></div>
                                <input type="text" name="count_adults" max="<?= $max_adults ?>"  min="1" value="2" class="form-control"/>
                                <div class="btn-count btn-count-minus"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-4-1.svg" alt=""></div>
                            </div>
                        </div>
                        <div class="number-item num-kids">
                            <p><?php _e('Kids', 'nairobi') ?></p>
                            <div class="input-number ">
                                <div class="btn-count btn-count-plus"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-4-2.svg" alt=""></div>
                                <input type="text" name="count_kids" max="<?= $max_kids ?>" min="0" value="0" class="form-control"/>
                                <div class="btn-count btn-count-minus"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-4-1.svg" alt=""></div>
                            </div>
                        </div>

                        <div class="number-item num-meals" style="display: none">
                            <p><?php _e('Meals', 'nairobi') ?></p>
                            <div class="input-number ">
                                <div class="btn-count btn-count-plus"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-4-2.svg" alt=""></div>
                                <input type="text" name="count_meals" min="<?= $min_meals ?>" max="<?= $max_meals ?>" value="<?= $min_meals ?>" class="form-control"/>
                                <div class="btn-count btn-count-minus"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-4-1.svg" alt=""></div>
                            </div>
                        </div>

                    </div>
                    <div class="input-wrap input-wrap-characteristics tabs">
                        <p class="title"><?php _e('3. Personal characteristics', 'nairobi') ?></p>
                        <div class="wrap">
                            <div class="select-block">
                                <div class="nice-select tabs-menu">
                                    <span class="current">Person 1</span>
                                    <ul class="list persons">
                                        <li class="option selected"><a href="#">Person 1</a></li>
                                        <li class="option"><a href="#">Person 2</a></li>
                                        <li class="option"><a href="#">Person 3</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="check-new">
                                <input type="checkbox" id="check-new" name="apply-to-all" value="1" checked>
                                <label for="check-new" class="label-new"></label>
                                <span class="text">Apply to all</span>
                            </div>
                        </div>
                        <div class="tab-content tab-content-features">
                            <?php
                            $i = 0;
                            foreach ( range(1,  ($max_adults +  $max_kids) )  as $man) {
                                $i++;
                                ?>
                            <div class="tab-item">
                                <div class="wrap-check">

                                    <?php $features = get_terms(['taxonomy' => 'pa_features', 'hide_empty' => 0]);

                                    if ($features)
                                        foreach ($features as $feature) { ?>
                                            <div class="check-item">
                                                <input type="checkbox" name="feature[<?= $i ?>][]" id="feature-<?= $feature->term_id ?>-<?= $i ?>" value="<?= $feature->term_id ?>">
                                                <label for="feature-<?= $feature->term_id ?>-<?= $i ?>" class="round-check">
                                                    <img src="<?= get_field('icon', $feature)['url'] ?>" alt="">
                                                    <span class="text"><?= $feature->name ?> </span>
                                                </label>
                                            </div>
                                    <?php } ?>

                                </div>
                            </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>
                <div class="total-block">
                    <div class="total-wrap">
                        <p class="sub-title sub-title-box"><?php _e('Discovery box', 'nairobi') ?> </p>

                        <?php foreach ($desc as $id=>$desc_item) { ?>
                        <div class="info" id="desc-<?= $id ?>">
                            <?= $desc_item ?>
                        </div>
                        <?php } ?>

                        <ul>
                            <li>
                                <p><?php _e('Box price', 'nairobi') ?></p>
                                <p><b class="box_price">$71.88</b></p>
                            </li>
                            <li>
                                <p><?php _e('Delivery fee', 'nairobi') ?></p>
                                <p><b class="box_price_pp" data-price="<?= get_lowest_shipping_flat_rate_1() ?>"><?= get_lowest_shipping_flat_rate_1() ?></b></p>
                            </li>
                            <li class="last">
                                <p><?php _e('First box total', 'nairobi') ?></p>
                                <p><b class="box_price_total">$71.88</b></p>
                            </li>
                        </ul>
                    </div>
                    <div class="btn-wrap">
                        <button data-title-reg="<?= __('Choose meal', 'nairobi') ?>" data-title="<?= __('Select', 'nairobi') ?>" type="submit" class="btn-default select-plan"><?php _e('Select', 'nairobi') ?> </button>
                    </div>
                    <div class="check-total">
                        <input type="checkbox" id="total" name="total">
                        <label for="total" class="total-label">
                            <span class="text"><?php _e('I want subscibe to mystery box every week', 'nairobi') ?></span>
                        </label>
                    </div>
                </div>
                <input type="hidden" name="action" value="add_to_cart">
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
