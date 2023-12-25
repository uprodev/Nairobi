<?php


$actions = [

    'add_to_cart',
    'select_meals',
    'filter',
    'qty_cart'


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

        $product_id = (int)$_POST['product_id'] ? (int)$_POST['product_id'] : (int)$_POST['product'];
        $count = (int)$_POST['count_kids'] + (int)$_POST['count_adults'];
        $features = $_POST['feature'];
        $features = array_slice($features, 0, $count);

        if ($_POST['meta']) {
            $features = $_POST['meta'];
            $count = $_POST['qty'] ?  $_POST['qty'] : 1;
        }


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


/**
 *
 * filter
 * @return void
 */

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

/**
 *
 * select_meals
 * @return void
 */

function select_meals() {
    $count = (int)$_POST['count_kids'] + (int)$_POST['count_adults'];
    $features = $_POST['feature'];
    $features = array_slice($features, 0, $count);
    WC()->cart->empty_cart();
    WC()->session->set('adults', $_POST['count_adults']);
    WC()->session->set('kids', $_POST['count_kids']);


    wp_send_json([
        'data' => $_POST,
        'url' => get_permalink(776)
    ]);
}

/**
 * qty_cart
 *
 *
 * @return void
 */


function qty_cart()
{

    $cart_item_key = $_POST['hash'];
    $product_values = WC()->cart->get_cart_item($cart_item_key);
    $product_quantity = apply_filters('woocommerce_stock_amount_cart_item', apply_filters('woocommerce_stock_amount', preg_replace("/[^0-9\.]/", '', filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT))), $cart_item_key);
    $passed_validation  = apply_filters('woocommerce_update_cart_validation', true, $cart_item_key, $product_values, $product_quantity);


    if ($passed_validation) {
        WC()->cart->set_quantity($cart_item_key, $product_quantity, true);
    }

    die();
}
