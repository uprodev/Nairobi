<?php
/**
 * Display custom item data in the cart
 */
function wk_get_item_data( $item_data, $cart_item_data ) {
    if ( isset( $cart_item_data['meta'] ) ) {
        $item_data[] = array(
            'key'   => __( 'Persons', 'nairobi' ),
            'value' =>  $cart_item_data['meta'],
        );
    }

    if ( isset( $cart_item_data['features'] ) ) {
        $item_data[] = array(
            'key'   => __( 'Features', 'nairobi' ),
            'value' =>  ( $cart_item_data['features'] ),
        );
    }

    return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'wk_get_item_data', 999, 2 );



/**
 * Add custom meta to order
 */
function wk_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
    $cart_item = WC()->cart->get_cart_item( $cart_item_key );
    $persons = get_persons();
    if ( isset( $cart_item['meta'] ) ) {
        $item->add_meta_data(
            __( 'Data', 'nairobi' ),
            $persons[$cart_item['meta']] ,
            true
        );
    }
    if ( isset( $cart_item['features'] ) ) {

        $features = $cart_item['features'];
        $features_meta = [];
        foreach ($features as $feature) {
            $feature = get_term($feature);
            $features_meta[] = $feature->name;
        }

        $item->add_meta_data(
            __( 'Features', 'nairobi' ),
            implode(', ', $features_meta) ,
            true
        );
    }

}
add_action( 'woocommerce_checkout_create_order_line_item', 'wk_checkout_create_order_line_item', 10, 4 );



//
//function add_order_item_meta($item_id, $values) {
//    $key = __('Persons', 'nairobi'); // Define your key here
//    $value = json_encode($values['meta']); // Get your value here
//    if ($values['meta'])
//    woocommerce_add_order_item_meta($item_id, $key, $value);
//}
//add_action('woocommerce_add_order_item_meta', 'add_order_item_meta', 10, 2);



add_filter( 'woocommerce_add_to_cart_fragments', 'cart_count_fragments', 10, 1 );

function cart_count_fragments( $fragments ) {
    ob_start();
    woocommerce_mini_cart();
    $html = ob_get_clean();
    $fragments['div.mini-cart'] = '<div class="mini-cart">' . $html . '</div>';
    return $fragments;
}


remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
add_action('woocommerce_payment_placement', 'woocommerce_checkout_payment', 20);
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );




add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {


    if ( ! empty( $_POST['date'] ) )
        update_post_meta( $order_id, 'date', sanitize_text_field( $_POST['date'] ) );

    if ( ! empty( $_POST['time'] ) )
        update_post_meta( $order_id, 'time', sanitize_text_field( $_POST['time'] ) );

    if ( ! empty( $_POST['billing_code'] ) )
        update_post_meta( $order_id, 'billing_code', sanitize_text_field( $_POST['billing_code'] ) );


}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );


function my_custom_checkout_field_display_admin_order_meta($order){

    echo '<p><strong>Date:</strong> ' . get_post_meta($order->id, 'date', true) . '</p>';
    echo '<p><strong>Time:</strong> ' . get_post_meta($order->id, 'time', true) . '</p>';
    echo '<p><strong>Tel code:</strong> ' . get_post_meta($order->id, 'billing_code', true) . '</p>';


}


// WooCommerce Rename Checkout Fields
add_filter( 'woocommerce_checkout_fields' , 'custom_rename_wc_checkout_fields' );

// Change placeholder and label text
function custom_rename_wc_checkout_fields( $fields ) {

    $fields['billing']['billing_first_name']['label'] = __('Prénom','nairobi');
    $fields['billing']['billing_last_name']['label'] = __('Nom','nairobi');
    $fields['billing']['billing_email']['label'] = __('Adresse mail','nairobi');
    $fields['billing']['billing_address_1']['label'] = __('Rue et numéro','nairobi');
    $fields['billing']['billing_city']['label'] = __('Ville','nairobi');
    $fields['billing']['billing_postcode']['label'] = __('Code postal','nairobi');
    $fields['billing']['billing_postcode']['label'] = __('Code postal','nairobi');
    $fields['billing']['billing_phone']['label'] = __('Numéro de téléphone','nairobi');
    $fields['billing']['billing_address_2']['required'] = true;

    return $fields;
}

add_filter( 'woocommerce_add_error', 'woocommerceAddError' );

/**
 * Remove billing from the validation message
 * @see wc_add_notice
 *
 * @param $error
 * @return string|string[]
 */
function woocommerceAddError ( $error )
{
    if ( strpos( $error, 'Billing ' ) !== false ) {
        $error = str_replace( "Billing ", "", $error );
    }
    if ( strpos( $error, 'Facturering ' ) !== false ) {
        $error = str_replace( "Facturering ", "", $error );
    }
    return $error;
}
