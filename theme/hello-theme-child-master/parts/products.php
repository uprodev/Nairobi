<?php
$terms = get_terms( [
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
    'include' => get_queried_object()->taxonomy == 'product_cat' ? [get_queried_object_id()] : ''
] );



?>

<?php if ($terms): ?>
    <?php foreach ($terms as $term):
        if ($_POST['cat'] && $_POST['cat'] !== 'all') {
            if ($term->term_id != (int)$_POST['cat'])
                continue;
        }
        ?>
        <?php if ($term->term_id == apply_filters('wpml_object_id', 45, 'product_cat') || $term->term_id == apply_filters('wpml_object_id', 46, 'product_cat') || $term->term_id == apply_filters('wpml_object_id', 47, 'product_cat')): ?>
            <div class="title-wrap">
                <p class="title"><?= $term->name ?></p>
                <div class="link-wrap">
                    <a class="show-all" href="<?= get_term_link($term->term_id) ?>"><?php _e('View all', 'Nairobi') ?></a>
                </div>
            </div>

            <?php


            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'orderby' => $_POST['orderby'],
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'id',
                        'terms'    => $term->term_id
                    )
                ),
                'paged' => get_query_var('paged')
            );

            if ('price' == $_POST['orderby']) {
                $args['meta_key'] = '_price';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'ASC';
            }
            if ('price-desc' == $_POST['orderby']) {
                $args['meta_key'] = '_price';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
            }

            if ($_POST['features']) {
                $features = [
                    'taxonomy' => 'pa_features',
                    'field'    => 'id',
                    'terms'    => $_POST['features']
                ];
                $args['tax_query'][] = $features;
            }

            $wp_query = new WP_Query($args);
            $loop = 0;
            if($wp_query->have_posts()):

                ?>

                <div class="content">

                    <?php while ($wp_query->have_posts()): $wp_query->the_post();  $loop++; ?>
                        <?php get_template_part('parts/content', 'product', ['loop'=>$loop]) ?>
                    <?php endwhile; ?>

                </div>

            <?php
            endif;
            wp_reset_query();
            ?>

        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>

