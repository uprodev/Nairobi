<?php
/*
Template Name: Login
*/



?>

<?php get_header(); ?>

<section class="choose-block login">
    <div class="content-width">

        <div class="content">
            <div class="title-wrap">
                <h1><?php the_title() ?></h1>
            </div>
            <figure>
                <img src="<?= get_stylesheet_directory_uri() ?>/img/img-1.jpg" alt="">
            </figure>
            <div class="form-wrap">
                <form action="#" class="form-default form-login">
                    <div class="input-wrap input-wrap-login">
                        <label for="login"><?php _e('Email Address', 'nairobi') ?></label>
                        <input type="email" id="login" name="email" placeholder="example@mail.com">
                    </div>
                    <p><?php _e('By continuing, you agree to receive a daily newsletter as well as our', 'nairobi') ?> <a href="#"><?php _e('Terms', 'nairobi') ?></a> <?php _e('and', 'nairobi') ?> <a href="#"><?php _e('Privacy Policy', 'nairobi') ?></a></p>
                    <div class="input-wrap-submit">
                        <button type="submit" class="btn-default"><?php _e('Keep on going', 'nairobi') ?></button>
                    </div>
                    <div class="link-wrap">
                        <a href="<?php the_permalink(578) ?>"><?php _e('Continue as a guest', 'nairobi') ?></a>
                    </div>
                    <input type="hidden" name="action" value="login_1">
                    <div class="result"></div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
