<?php
/*
Template Name: Delivery
*/



?>

<?php get_header(); ?>

<section class="choose-block login delivery">
    <div class="content-width">

        <div class="content">
            <div class="title-wrap">
                <h1><?php _e('Delivery information', 'nairobi') ?></h1>
            </div>
            <figure>
                <img src="<?= get_stylesheet_directory_uri() ?>/img/img-1.jpg" alt="">
            </figure>
            <div class="form-wrap">
                <form action="#" class="form-default form-login">
                    <div class="sub-title"><?php _e('Street and number', 'nairobi') ?></div>
                    <div class="input-wrap input-wrap-login">
                        <label for="street"><?php _e('Street', 'nairobi') ?></label>
                        <input type="text" id="street" name="street" >
                    </div>
                    <div class="input-wrap input-wrap-login">
                        <label for="home"><?php _e('House number', 'nairobi') ?></label>
                        <input type="text" id="home" name="home" >
                    </div>

                    <div class="input-wrap input-wrap-login input-wrap-50 select-block">
                        <label class="form-label" for="region"><?php _e('State/Province', 'nairobi') ?></label>
                        <?php
                        $people_json = file_get_contents(get_stylesheet_directory() . '/inc/france.json');
                        $decoded_json = json_decode($people_json, true);

                        ?>
                        <select id="region" name="billing_state">
                            <option value=""><?php _e('Select Your Region', 'nairobi') ?></option>
                            <?php foreach ($decoded_json as $item) { ?>
                                <option   value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="input-wrap input-wrap-login input-wrap-50">
                        <label for="ville"><?php _e('City', 'nairobi') ?></label>
                        <input type="text" id="ville" name="ville" >
                    </div>
                    <div class="input-wrap input-wrap-login input-wrap-50">
                        <label for="code"><?php _e('Postal code', 'nairobi') ?></label>
                        <input type="text" id="code" name="code" placeholder="00000" class="code">
                    </div>
                    <div class="input-wrap input-wrap-login input-wrap-50">
                        <label for="tel"><?php _e('Phone number', 'nairobi') ?></label>
                        <input type="text" id="tel" name="tel" placeholder="(000) 000-000" class="tel">
                        <input type="hidden" name="billing_code">
                    </div>

                    <div class="sub-title"><?php _e('Where and when do you want it delivered?', 'nairobi') ?></div>
                    <div class="input-wrap input-wrap-login input-wrap-50 input-img input-after">
                        <label for="date"><?php _e('Date', 'nairobi') ?></label>
                        <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-17-1.svg" alt="">
                        <input type="text" id="date" name="date" class="date1" placeholder="01/12/23">
                    </div>
                    <div class="input-wrap input-wrap-login input-wrap-50 select-block">
                        <label for="time"><?php _e('Hour', 'nairobi') ?></label>

                        <select id="region" name="billing_state">
                            <option value="9-12h">9-12h</option>
                            <option value="13-15h">13-15h</option>
                            <option value="18-21h">18-21h</option>


                        </select>

                    </div>
                    <div class="input-wrap-submit">
                        <button type="submit" class="btn-default"><?php _e('Continue', 'nairobi') ?></button>
                    </div>
                    <input type="hidden" name="action" value="login_2">
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
