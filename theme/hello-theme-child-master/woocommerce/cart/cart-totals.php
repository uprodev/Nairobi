<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">
    <?php do_action( 'woocommerce_before_cart_totals' ); ?>
    <p class="sub-title"><?php _e('Totals', 'nairobi') ?> </p>
<!--    <p class="info">3 meals for 4 people per week</p>-->
    <ul>
        <li>
            <p><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></p>
            <p><b><?php wc_cart_totals_subtotal_html(); ?></b></p>
        </li>

        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <li class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <p><?php wc_cart_totals_coupon_label( $coupon ); ?></p>
                <p data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>">
                    <b><?php wc_cart_totals_coupon_html( $coupon ); ?></b></p>
            </li>
        <?php endforeach; ?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <li class="fee">
                <p><?php echo esc_html( $fee->name ); ?></p>
                <p data-title="<?php echo esc_attr( $fee->name ); ?>"><b><?php wc_cart_totals_fee_html( $fee ); ?></b></p>
            </li>
        <?php endforeach; ?>

        <?php if ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

        <li class="shipping">
            <p><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></p>
            <p data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><b><?php woocommerce_shipping_calculator(); ?></b></p>
        </li>

        <?php endif; ?>

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

        <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

        <li class="order-total last">
            <p><?php esc_html_e( 'Total', 'woocommerce' ); ?></p>
            <p data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><b><?php wc_cart_totals_order_total_html(); ?></b></p>
        </li>

        <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

        <?php do_action( 'woocommerce_after_cart_totals' ); ?>

    </ul>

</div>








