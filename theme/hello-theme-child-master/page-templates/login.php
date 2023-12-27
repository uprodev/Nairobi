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
                <h1>Se connecter</h1>
            </div>
            <figure>
                <img src="<?= get_stylesheet_directory_uri() ?>/img/img-1.jpg" alt="">
            </figure>
            <div class="form-wrap">
                <form action="#" class="form-default form-login">
                    <div class="input-wrap input-wrap-login">
                        <label for="login">Email Address</label>
                        <input type="email" id="login" name="email" placeholder="example@mail.com">
                    </div>
                    <p>En continuant, vous accepter de recevoir une newsletter quotidienne ainsi que nos <a href="#">Terms</a> et <a href="#">Privacy Policy</a></p>
                    <div class="input-wrap-submit">
                        <button type="submit" class="btn-default">Continue</button>
                    </div>
                    <div class="link-wrap">
                        <a href="<?php the_permalink(578) ?>">Continuer en tant qu’invité</a>
                    </div>
                    <input type="hidden" name="action" value="login_1">
                    <div class="result"></div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
