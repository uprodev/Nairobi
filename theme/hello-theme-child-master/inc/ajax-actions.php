<?php


$actions = [

    'add_to_cart',
    'select_meals',
    'filter',
    'qty_cart',
    'login_1',
    'login_2',
    'apply_coupon',
    'remove_item_from_cart',
    'dynamic_cart',


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



    $qty =  $_POST['qty'];
    WC()->session->get('meals');
    $meals = WC()->session->get('meals');
    if ($_POST['count_kids'] || $_POST['count_adults']) {
        //boxes

    }

    //meals
    else {
        //validation max
        $person_cart_qty = [];
        $persons = get_persons();
        foreach ($persons as $key => $person) {
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                if ($key !== $cart_item['meta'])
                    continue;
                $person_cart_qty[$cart_item['meta']] += $cart_item['quantity'] ;

            }
        }

        if ($qty+$person_cart_qty[$_POST['meta']] > $meals) {
            $msg = sprintf(__('You have reached max %s meals for that person', 'nairobi'), $meals);
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

    WC()->cart->empty_cart();
    WC()->session->set_customer_session_cookie(true);
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
    WC()->customer->set_billing_address_2($_POST['home']);
    WC()->customer->set_billing_state($_POST['billing_state']);
    WC()->customer->set_billing_city($_POST['ville']);
    WC()->customer->set_billing_phone($_POST['tel']);
    WC()->customer->set_billing_postcode($_POST['code']);
    WC()->session->set('date', $_POST['date']);
    WC()->session->set('time',$_POST['time']);
    WC()->session->set('billing_code',$_POST['billing_code']);

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

/**
 * remove_item_from_cart
 * @return void
 */

function remove_item_from_cart()
{
    $cart_item_keys = $_POST['hash'];

    foreach ($cart_item_keys as $cart_item_key) {
        WC()->cart->remove_cart_item($cart_item_key);
        $count = WC()->cart->get_cart_contents_count();
    }
    wp_send_json(
        [
            'count' => $count,
        ]
    );
    die();
}


/**
 * dynamic_cart
 */


add_action( 'woocommerce_cart_calculate_fees', 'wpf_wc_add_cart_fees_by_cart_total_weight' );
function wpf_wc_add_cart_fees_by_cart_total_weight( $cart ) {
    /**
     * wpf_wc_add_cart_fees_by_cart_total_weight.
     */
    if ($_POST['product'] == 696) {
        if ($cd = $_POST['count_deserts']) {
            $fee = $cd * 3.99;
            WC()->cart->add_fee(__('Dessert x ', 'nairoby') .$cd , $fee);
        }
        if ($_POST['count_drinks']) {
            $fee = $_POST['count_drinks'] * 3.99;
            WC()->cart->add_fee(__('Drinks x ', 'nairoby') .$_POST['count_drinks'] , $fee);
        }
    }

}


function dynamic_cart() {
    $features = $_POST['feature'];
    $product_id = (int)$_POST['product'];
    if ($_POST['count_kids'] || $_POST['count_adults']) {
        WC()->cart->empty_cart();
        WC()->session->set_customer_session_cookie(true);
        WC()->session->set('adults', $_POST['count_adults']);
        WC()->customer->set_billing_country('BE');
        $persons = get_persons();

        foreach ($persons as $key => $person) {
            $feature = $features[$key];
            WC()->cart->add_to_cart($product_id, 1, '','', ['meta' => $key, 'features' => $feature]);

        }

    }
    add_action( 'woocommerce_cart_calculate_fees', 'wpf_wc_add_cart_fees_by_cart_total_weight' );



    ob_start();
    ?>


    <li>
        <p><?php _e('Box price', 'nairobi') ?></p>
        <p><b class="box_price"><?= wc_cart_totals_subtotal_html() ?></b></p>
    </li>

    <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
        <li class="fee">
            <p><?php echo esc_html( $fee->name ); ?></p>
            <p data-title="<?php echo esc_attr( $fee->name ); ?>"><b><?php wc_cart_totals_fee_html( $fee ); ?></b></p>
        </li>
    <?php endforeach; ?>

    <?php
    if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
        $taxable_address = WC()->customer->get_taxable_address();
        $estimated_text  = '';

        if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
            /* translators: %s location. */
            $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
        }

        if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
            foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                ?>
                <li class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <p><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    <p data-title="<?php echo esc_attr( $tax->label ); ?>"><b><?php echo wp_kses_post( $tax->formatted_amount ); ?></b></p>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="tax-total">
                <p><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                <p data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><b><?php wc_cart_totals_taxes_total_html(); ?></b></p>
            </li>
            <?php
        }
    }
    ?>

    <li>
        <p><?php _e('Delivery fee', 'nairobi') ?></p>
        <p><b class="box_price_pp" ><?= WC()->cart->get_cart_shipping_total() ?></b></p>
    </li>
    <li class="last">
        <p><?php _e('First box total', 'nairobi') ?></p>
        <p><b class="box_price_total"><?php wc_cart_totals_order_total_html(); ?></b></p>
    </li>
<?php
    $html = ob_get_clean();

    wp_send_json([
        'html' => $html
    ]);
}
