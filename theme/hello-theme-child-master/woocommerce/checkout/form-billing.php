<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;



?>

<div class="item-form">
    <div class="title"><?php _e('Contact details', 'nairobi') ?></div>
    <div class="input-wrap input-wrap-login input-wrap-50">
        <label for="billing_first_name"><?php _e('First name', 'nairobi') ?></label>
        <input type="text" id="billing_first_name" name="billing_first_name" value="<?= $checkout->get_value( 'billing_first_name' ) ?>">
    </div>
    <div class="input-wrap input-wrap-login input-wrap-50">
        <label for="billing_last_name"><?php _e('Last Name', 'nairobi') ?></label>
        <input type="text" id="billing_last_name" name="billing_last_name" value="<?= $checkout->get_value( 'billing_last_name' ) ?>">
    </div>
    <div class="input-wrap input-wrap-login">
        <label for="billing_email"><?php _e('Email address', 'nairobi') ?></label>
        <input type="email" id="billing_email" name="billing_email" value="<?= $checkout->get_value( 'billing_email' ) ?>">
    </div>

</div>
<div class="item-form">
    <div class="title"><?php _e('Where do you want to be delivered?', 'nairobi') ?></div>
    <div class="input-wrap input-wrap-login">
        <label for="billing_address_1"><?php _e('Street', 'nairobi') ?></label>
        <input type="text" id="billing_address_1" name="billing_address_1" value="<?= $checkout->get_value( 'billing_address_1' ) ?>">
    </div>
    <div class="input-wrap input-wrap-login">
        <label for="billing_address_2"><?php _e('House number', 'nairobi') ?></label>
        <input type="text" id="billing_address_2" name="billing_address_2" value="<?= $checkout->get_value( 'billing_address_2' ) ?>">
    </div>
    <div class="input-wrap input-wrap-login input-wrap-50 select-block">
        <label class="form-label" for="region"><?php _e('State province', 'nairobi') ?></label>

        <?php
        $people_json = file_get_contents(get_stylesheet_directory() . '/inc/france.json');
        $decoded_json = json_decode($people_json, true);

        ?>
        <select id="region" name="billing_state">
            <option value=""><?php _e('Select Your Region', 'nairobi') ?></option>
            <?php foreach ($decoded_json as $item) { ?>
                <option <?php selected($checkout->get_value( 'billing_state' ) , $item['name']) ?> value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
            <?php } ?>

        </select>
    </div>
    <div class="input-wrap input-wrap-login input-wrap-50">
        <label for="billing_city"><?php _e('City', 'nairobi') ?></label>
        <input type="text" id="billing_city" name="billing_city" value="<?= $checkout->get_value( 'billing_city' ) ?>">
    </div>
    <div class="input-wrap input-wrap-login input-wrap-50">
        <label for="billing_postcode"><?php _e('Postal code', 'nairobi') ?></label>
        <input type="text" id="billing_postcode" name="billing_postcode" placeholder="00000" class="code" value="<?= $checkout->get_value( 'billing_postcode' ) ?>">
    </div>
    <div class="input-wrap input-wrap-login input-wrap-50">
        <label for="billing_phone"><?php _e('Phone number', 'nairobi') ?></label>
        <input type="text" id="billing_phone" name="billing_phone" placeholder="(000) 000-0000" class="tel" value="<?= $checkout->get_value( 'billing_phone' ) ?>">
        <input type="hidden" name="billing_code">

    </div>
</div>
<div class="item-form">
    <div class="title"><?php _e('When do you want it delivered?', 'nairobi') ?></div>
    <div class="input-wrap input-wrap-login input-wrap-50 input-img input-after">
        <label for="date"><?php _e('Date', 'nairobi') ?></label>
        <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-17-1.svg" alt="">
        <input type="text" id="date" name="date" class="date1" placeholder="01/03/24" value="<?= WC()->session->get('date'); ?>">
    </div>

    <div class="input-wrap input-wrap-login input-wrap-50 select-block">
        <label for="time"><?php _e('Hour', 'nairobi') ?></label>

        <select id="region" name="billing_state">
            <option <?php selected( WC()->session->get('time') , '9-12h') ?> value="9-12h">9-12h</option>
            <option <?php selected( WC()->session->get('time') , '13-15h') ?> value="13-15h">13-15h</option>
            <option <?php selected( WC()->session->get('time') , '18-21h') ?> value="18-21h">18-21h</option>


        </select>

    </div>

</div>

<input type="hidden" name="billing_country" value="BE">




