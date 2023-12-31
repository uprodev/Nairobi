<?php


$actions = [

    'add_to_cart',
    'select_meals',
    'filter',
    'qty_cart',
    'login_1',
    'login_2',
    'apply_coupon',


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
    $persons = get_persons();
    $qty =  $_POST['qty'];

    //boxes
    if ($_POST['count_kids'] || $_POST['count_adults']) {
        WC()->cart->empty_cart();
        WC()->session->set('adults', $_POST['count_adults']);
        WC()->session->set('kids', $_POST['count_kids']);


        foreach ($persons as $key => $person) {
            $feature = $features[$key];
            WC()->cart->add_to_cart($product_id, 1, '','', ['meta' => $key, 'features' => $feature]);

        }
        $url = get_permalink(810);
    }
    //meals
    else {
        //validation max
        $person_cart_qty = [];
        foreach ($persons as $key => $person) {
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                if ($key !== $cart_item['meta'])
                    continue;
                $person_cart_qty[$cart_item['meta']] += $cart_item['quantity'] ;

            }
        }

        if ($qty+$person_cart_qty[$_POST['meta']] > 9) {
            $msg = __('You have reached max 9 meals for that person', 'nairobi');
        }

        if (!$msg)
            $added = WC()->cart->add_to_cart($product_id, $_POST['qty'], '','', ['meta' => $_POST['meta']]);
    }

    wp_send_json(
        [
            'count' => $_POST['feature'],
            'd' => $test,
            'msg' => $msg,
            'url' => $url
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
    WC()->session->set('meals', $_POST['count_meals']);


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


    if ($product_quantity > 9) {
        $msg = __('You have reached max 9 meals for that person');
    }

    if ($passed_validation && !$msg) {
        WC()->cart->set_quantity($cart_item_key, $product_quantity, true);
    } else {
        wp_send_json([
            'msg' => $msg,

        ]);
    }

    die();
}


/**
 * login
 */

function login_1() {
   if (is_email($_POST['email'])) {
        $url = get_permalink(813);
        WC()->customer->set_billing_email($_POST['email']);
   } else {
       $msg = '<br><p>' .  __('E-mail is incorrect', 'nairobi') .'</p>';
   }

    wp_send_json([
        'email' => is_email($_POST['email']),
        'url' => $url,
        'msg' => $msg
    ]);

}

function login_2() {
    $url = get_permalink(578);
    WC()->customer->set_billing_address_1($_POST['street']);
    WC()->customer->set_billing_state($_POST['billing_state']);
    WC()->customer->set_billing_city($_POST['ville']);
    WC()->customer->set_billing_postcode($_POST['code']);
    WC()->session->set('date', $_POST['date']);
    WC()->session->set('time',$_POST['time']);

    wp_send_json([

        'url' => $url,
        'msg' => $msg
    ]);

}

/**
 * apply_coupon
 *
 * @return void
 */

function apply_coupon()
{
    $coupon = $_POST['coupon'];

    WC()->cart->apply_coupon( $coupon );


    wp_send_json(
        [
            'coupon' => $coupon,
        ]
    );
    die();
}
