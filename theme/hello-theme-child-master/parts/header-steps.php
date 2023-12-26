<?php
$steps = [
    __('Select plan', 'nairobi') =>
        [
            'active complete',
            700
        ],
    __('Register' , 'nairobi') =>
        [
            is_page_template('page-templates/login.php') ? 'current' : (is_page_template('page-templates/delivery.php') ? 'active complete' : ''),
            810
        ],
    __('Address' , 'nairobi') =>
        [
            is_page_template('page-templates/delivery.php') ? 'current' : (is_checkout() ? 'active complete' : ''),
            813
        ],
    __('Payment Details' , 'nairobi') =>
        [
            is_checkout() ? 'current'  : '',
            578
        ]
            ,
];
?>

<div class="top-line">
    <div class="content-width">
        <div class="logo-wrap">
            <a href="/"><img src="<?= get_stylesheet_directory_uri() ?>/img/logo.svg" alt=""></a>
        </div>
        <div class="right">
            <ul class="nav-list">
                <?php foreach ($steps as $name => $step) {
                    $i++?>
                    <li class="<?= $step[0] ?>">
                        <a href="<?= get_permalink($step[1])  ?>">
                            <span class="number"><?= $i ?> <span class="check"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-1.svg" alt=""></span></span>
                            <span class="text"><?= $name ?> </span>
                        </a>
                    </li>
                <?php
                } ?>

            </ul>
            <div class="open-menu">
                <a href="#">
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-6-1.svg" alt="">
                </a>
            </div>
        </div>
    </div>
</div>
