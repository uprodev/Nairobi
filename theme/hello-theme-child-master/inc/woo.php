<?php
/**
 * Display custom item data in the cart
 */
function wk_get_item_data( $item_data, $cart_item_data ) {
    if ( isset( $cart_item_data['meta'] ) ) {
        $item_data[] = array(
            'key'   => __( 'Persons', 'webkul' ),
            'value' => serialize( $cart_item_data['meta'] ),
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

    if ( isset( $cart_item['meta'] ) ) {
        $item->add_meta_data(
            __( 'Data', 'webkul' ),
            $cart_item['meta'] ? $cart_item['meta'] : 232,
            true
        );
    }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'wk_checkout_create_order_line_item', 10, 4 );




function add_order_item_meta($item_id, $values) {
    $key = __('Persons', 'nairobi'); // Define your key here
    $value = json_encode($values['meta']); // Get your value here
    if ($values['meta'])
    woocommerce_add_order_item_meta($item_id, $key, $value);
}
add_action('woocommerce_add_order_item_meta', 'add_order_item_meta', 10, 2);



add_filter( 'woocommerce_add_to_cart_fragments', 'cart_count_fragments', 10, 1 );

function cart_count_fragments( $fragments ) {
    ob_start();
    woocommerce_mini_cart();
    $html = ob_get_clean();
    $fragments['div.mini-cart'] = '<div class="mini-cart">' . $html . '</div>';
    return $fragments;
}
