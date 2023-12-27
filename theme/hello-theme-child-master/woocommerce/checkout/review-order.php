<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;

$person_cart_qty = $person_cart_totals = $person_cart_valid = $person_cart = [];

$persons = get_persons();

foreach ($persons as $key=>$person) {
    $person_cart_qty[$key] = 0;
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        if ($cart_item['meta'] != $key)
            continue;
        $person_cart_qty[$key] += $cart_item['quantity'] ;
        $person_cart[$key][] = $cart_item;
       // $person_cart2[$cart_item['meta']] = $cart_item['features'];
        $person_cart_totals[$key] += $cart_item['line_subtotal'] ;

    }
}



?>
<div class="shop_table woocommerce-checkout-review-order-table">
<div class="item-aside item-aside-mob">
    <div class="title title-product">Récapitulatif de la commande</div>

    <div class="wrap">
        <p class="h6"><?= WC()->cart->get_cart_contents_count() ?> éléments dans le panier</p>
        <?php
        foreach ($person_cart as $key=>$person) {  ?>
            <div class="user-item">
                <div class="title-user"><?= $persons[$key] ?></div>
                <div class="wrap-user">

                    <?php
                    foreach ($person as $cart_item) {
                        $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $other_data = apply_filters( 'woocommerce_get_item_data', array(), $cart_item );
                        $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                        $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                        $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );


                        ?>
                        <div class="product-info cart-qty">

                            <div class="item-product">
                                <figure>
                                    <?= $thumbnail ?>
                                </figure>
                                <div class="text">
                                    <p><?= $product_name ?> x <?= $cart_item['quantity'] ?></p>

<!--                                    <div class="input-number ">-->
<!--                                        <div class="btn-count btn-count-plus"><img src="--><?//= get_stylesheet_directory_uri() ?><!--/img/icon-4-2.svg" alt=""></div>-->
<!---->
<!--                                        <input type="text"  class="form-control" name="cart[--><?//= $cart_item_key ?><!--][qty]" value="--><?//=  $cart_item['quantity'] ?><!--"-->
<!--                                               aria-label="Product quantity"  min="" max="" step="1" placeholder="" inputmode="numeric" autocomplete="off">-->
<!--                                        <div class="btn-count btn-count-minus"><img src="--><?//= get_stylesheet_directory_uri() ?><!--/img/icon-4-1.svg" alt=""></div>-->
<!--                                    </div>-->

                                    <div class="cost-wrap">
                                        <p class="price"><?= $product_price ?></p>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <?php
                            $features = $cart_item['features'];
                            if ($features) { ?>

                                <ul>
                                    <?php
                                    foreach ($features as $feature) {
                                        $feature = get_term($feature); ?>

                                        <li>
                                            <img src="<?= get_field('icon', $feature)['url'] ?>" alt="">
                                            <span class="text"><?= $feature->name ?> </span>
                                        </li>

                                    <?php } ?>
                                </ul>

                            <?php } ?>


                        </div>
                    <?php } ?>

                </div>
            </div>
        <?php } ?>


    </div>

</div>

<?php if ( wc_coupons_enabled() ) { ?>
    <div class="item-aside">
        <div class="title title-product ">Code promo</div>
        <div class="wrap form-wrap" >
            <?php do_action( 'woocommerce_cart_coupon' ); ?>
            <div class="input-wrap input-wrap-login mb-0">
                <label for="code">Entrez votre code promo</label>
                <input type="text"   name="code" id="code" placeholder="Gift card or discount code">
                <br>
                <a    value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" class="btn-default apply_coupon_checkout">APPLY</a>

            </div>
        </div>
    </div>
<?php } ?>


<div class="total-block">
    <div class="total-wrap">

        <?php wc_get_template('cart/cart-totals.php'); ?>

    </div>

    <div class="btn-wrap">
        <button type="submit" class="btn-default">Payer <?php wc_cart_totals_order_total_html(); ?></button>
    </div>
</div>


</div>

