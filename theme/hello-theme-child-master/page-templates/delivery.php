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
                <h1>Informations de livraison</h1>
            </div>
            <figure>
                <img src="<?= get_stylesheet_directory_uri() ?>/img/img-1.jpg" alt="">
            </figure>
            <div class="form-wrap">
                <form action="#" class="form-default form-login">
                    <div class="sub-title">Adresse</div>
                    <div class="input-wrap input-wrap-login">
                        <label for="street">Rue et numéro</label>
                        <input type="text" id="street" name="street" >
                    </div>
                    <div class="input-wrap input-wrap-login input-wrap-50 select-block">
                        <label class="form-label" for="region">State/Province</label>
                        <select id="region">
                            <option value="0">Select Your Region</option>
                            <option value="1">Region 1</option>
                            <option value="2">Region 2</option>
                            <option value="3">Region 3</option>
                        </select>
                    </div>
                    <div class="input-wrap input-wrap-login input-wrap-50">
                        <label for="ville">Ville</label>
                        <input type="text" id="ville" name="ville" >
                    </div>
                    <div class="input-wrap input-wrap-login input-wrap-50">
                        <label for="code">Code postal</label>
                        <input type="text" id="code" name="code" placeholder="00000" class="code">
                    </div>
                    <div class="input-wrap input-wrap-login input-wrap-50">
                        <label for="tel">Numéro de téléphone</label>
                        <input type="text" id="tel" name="tel" placeholder="(000) 000-000" class="tel">
                    </div>

                    <div class="sub-title">Où et quand voulez-vous être livré ?</div>
                    <div class="input-wrap input-wrap-login input-wrap-50 input-img input-after">
                        <label for="date">Date</label>
                        <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-17-1.svg" alt="">
                        <input type="text" id="date" name="date" class="date1" placeholder="01/12/23">
                    </div>
                    <div class="input-wrap input-wrap-login input-wrap-50 input-img">
                        <label for="time">Heure</label>
                        <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-17-2.svg" alt="">
                        <input type="text" id="time" name="time" placeholder="00-00" class="time">
                    </div>
                    <div class="input-wrap-submit">
                        <button type="submit" class="btn-default">Continue</button>
                    </div>
                    <input type="hidden" name="action" value="login_2">
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
