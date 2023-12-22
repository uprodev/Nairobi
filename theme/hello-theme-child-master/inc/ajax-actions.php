<?php


$actions = [

    'add_to_cart',
    'filter'


];
foreach ($actions as $action) {
    add_action("wp_ajax_{$action}", $action);
    add_action("wp_ajax_nopriv_{$action}", $action);
}


/**
 * add_to_cart
 *
 * @return void
 * @throws Exception
 */
function add_to_cart()
{

        $product_id = (int)$_POST['product'];
        $count = (int)$_POST['count_kids'] + (int)$_POST['count_adults'];
        $features = $_POST['feature'];
        $features = array_slice($features, 0, $count);

//    $variation_id = (int)$_GET['variation_id'];
//    $qty = $_GET['qty'] > 0 ? (int)$_GET['qty'] : 1;
    $added = WC()->cart->add_to_cart($product_id, $count, '','', ['meta' => $features]);
//
//
//
//    $count = WC()->cart->get_cart_contents_count();

    wp_send_json_success(
        [
            'count' => $features,
            'd' => $_POST,
        ]
    );

    //   WC_AJAX::get_refreshed_fragments();
    wp_die();
}


function filter()
{

    ob_start();
    get_template_part('parts/products');
    $html = ob_get_clean();

    wp_send_json([
        'data' => $_POST,
        'html' => $html
    ]);
}
