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
                        <?php
                        $people_json = file_get_contents(get_stylesheet_directory() . '/inc/france.json');
                        $decoded_json = json_decode($people_json, true);

                        ?>
                        <select id="region" name="billing_state">
                            <option value="">Select Your Region</option>
                            <?php foreach ($decoded_json as $item) { ?>
                                <option   value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                            <?php } ?>

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
                    <div class="input-wrap input-wrap-login input-wrap-50 select-block">
                        <label for="time">Heure</label>

                        <select id="region" name="billing_state">
                            <option value="9-12h">9-12h</option>
                            <option value="13-15h">13-15h</option>
                            <option value="18-21h">18-21h</option>


                        </select>

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
