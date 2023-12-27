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
    <div class="title">Détails de contact</div>
    <div class="input-wrap input-wrap-login input-wrap-50">
        <label for="billing_first_name">Prénom</label>
        <input type="text" id="billing_first_name" name="billing_first_name" value="<?= $checkout->get_value( 'billing_first_name' ) ?>">
    </div>
    <div class="input-wrap input-wrap-login input-wrap-50">
        <label for="billing_last_name">Nom</label>
        <input type="text" id="billing_last_name" name="billing_last_name" value="<?= $checkout->get_value( 'billing_last_name' ) ?>">
    </div>
    <div class="input-wrap input-wrap-login">
        <label for="billing_email">Adresse mail</label>
        <input type="email" id="billing_email" name="billing_email" value="<?= $checkout->get_value( 'billing_email' ) ?>">
    </div>

</div>
<div class="item-form">
    <div class="title">Où voulez-vous être livré ?</div>
    <div class="input-wrap input-wrap-login">
        <label for="billing_address_1">Rue et numéro</label>
        <input type="text" id="billing_address_1" name="billing_address_1" value="<?= $checkout->get_value( 'billing_address_1' ) ?>">
    </div>
    <div class="input-wrap input-wrap-login input-wrap-50 select-block">
        <label class="form-label" for="region">State/Province</label>

        <?php
        $people_json = file_get_contents(get_stylesheet_directory() . '/inc/france.json');
        $decoded_json = json_decode($people_json, true);

        ?>
        <select id="region" name="billing_state">
            <option value="">Select Your Region</option>
            <?php foreach ($decoded_json as $item) { ?>
                <option <?php selected($checkout->get_value( 'billing_state' ) , $item['name']) ?> value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
            <?php } ?>

        </select>
    </div>
    <div class="input-wrap input-wrap-login input-wrap-50">
        <label for="billing_city">Ville</label>
        <input type="text" id="billing_city" name="billing_city" value="<?= $checkout->get_value( 'billing_city' ) ?>">
    </div>
    <div class="input-wrap input-wrap-login input-wrap-50">
        <label for="billing_postcode">Code postal</label>
        <input type="text" id="billing_postcode" name="billing_postcode" placeholder="00000" class="code" value="<?= $checkout->get_value( 'billing_postcode' ) ?>">
    </div>
    <div class="input-wrap input-wrap-login input-wrap-50">
        <label for="billing_phone">Numéro de téléphone</label>
        <input type="text" id="billing_phone" name="billing_phone" placeholder="(000) 000-000" class="tel" value="<?= $checkout->get_value( 'billing_phone' ) ?>">
    </div>
</div>
<div class="item-form">
    <div class="title">Quand voulez-vous être livré ?</div>
    <div class="input-wrap input-wrap-login input-wrap-50 input-img input-after">
        <label for="date">Date</label>
        <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-17-1.svg" alt="">
        <input type="text" id="date" name="date" class="date1" placeholder="01/12/23" value="<?= WC()->session->get('date'); ?>">
    </div>
    <div class="input-wrap input-wrap-login input-wrap-50 input-img">
        <label for="time">Heure</label>
        <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-17-2.svg" alt="">
        <input type="text" id="time" name="time" placeholder="00-00" class="time" value="<?= WC()->session->get('time'); ?>">
    </div>
</div>

<input type="hidden" name="billing_country" value="FR">




