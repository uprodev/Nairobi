<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<section class="choose-block plans login">
    <div class="content-width">
        <form   name="checkout" method="post" class="form-default checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
            <div class="content">
                <div class="form-wrap form-wrap-70">
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>

                    <div class="item-form">

                        <?php do_action( 'woocommerce_payment_placement' ); ?>

                        <div class="info-security">
                            <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-23.svg" alt="">
                            <p><?php _e('We protect your payment information using encryption to ensure
                                Bank-level security.', 'nairobi') ?></p>
                        </div>
                    </div>
                </div>
                <div class="right">

                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>


            </div>
        </form>
    </div>
</section>


