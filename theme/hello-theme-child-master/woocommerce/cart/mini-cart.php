<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

$adults = WC()->session->get('adults');
$kids = WC()->session->get('kids');


for ($i=1; $i<=$adults ; $i++ ) {
    $key =  'person';
    $persons[$key.'-'. $i] = __(ucfirst($key), 'nairobi'). ' '. $i;
}

for ($i=1; $i<=$kids; $i++ ) {
    $key =   'kid' ;
    $persons[$key.'-'. $i] = __(ucfirst($key), 'nairobi'). ' '. $i;
}


$person_cart_qty = [];
foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
    if (!$cart_item['meta'])
        continue;

    $person_cart_qty[$cart_item['meta']] += $cart_item['quantity'] ;

}

do_action( 'woocommerce_before_mini_cart' );

?>




<div class="mini-cart">


    <?php foreach ($persons as $key=>$person) { ?>

        <div class="progress-wrap">
            <div class="progress">
                <span class="progress-bg" style="width: <?= $person_cart_qty[$key]  / 4 *100 ?>%"></span>
                <p><span><?= $person_cart_qty[$key]?:0 ?>/4</span>  chosen meals </p>
            </div>
        </div>

        <div class="person-menu">
        <div class="person-item">
            <div class="person-title">
                <p class="name"><?= $person ?></p>

            </div>

            <?php
            do_action( 'woocommerce_before_mini_cart_contents' );

            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                if ($cart_item['meta'] != $key)
                    continue;
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                ?>

                <div class="person-product">
                    <figure>
                        <a >
                            <?= $thumbnail ?>
                        </a>
                    </figure>
                    <div class="text">
                        <p><a href="#"><?= $product_name ?></a>
                            <?php
                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                'woocommerce_cart_item_remove_link',
                                sprintf(
                                    '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                    /* translators: %s is the product name */
                                    esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                    esc_attr( $product_id ),
                                    esc_attr( $cart_item_key ),
                                    esc_attr( $_product->get_sku() )
                                ),
                                $cart_item_key
                            );
                            ?>
                        </p>
                        <div class="input-number ">
                            <div class="btn-count btn-count-plus"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-4-2.svg" alt=""></div>

                                <input type="text"  class="form-control" name="cart[<?= $cart_item_key ?>][qty]" value="<?=  $cart_item['quantity'] ?>"
                                   aria-label="Product quantity"  min="" max="" step="1" placeholder="" inputmode="numeric" autocomplete="off">
                            <div class="btn-count btn-count-minus"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-4-1.svg" alt=""></div>
                        </div>
                    </div>
                </div>

            <?php } ?>


        </div>
    </div>

    <?php } ?>





</div>
