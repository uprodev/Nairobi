<!doctype html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head(); ?>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<header>
		<div class="top-line">
			<div class="content-width">

				<?php if ($field = get_field('logo_h', 'option')): ?>
					<div class="logo-wrap">
						<a href="<?= get_home_url() ?>">
							<?= wp_get_attachment_image($field['ID'], 'full') ?>
						</a>
					</div>
				<?php endif ?>
				
				<div class="right">
					<div class="top-menu">

						<?php wp_nav_menu( array(
							'theme_location'  => 'menu-1',
							'container'       => '',
							'items_wrap'      => '<ul>%3$s</ul>'
						)); ?>

						<?php custom_language_switcher() ?>

						<div class="btn-wrap">
							<a href="<?php the_permalink(apply_filters('wpml_object_id', 579, 'page')) ?>" class="btn-default btn-border-red"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-8.svg" alt=""><?= is_user_logged_in() ? __('My account', 'Nairobi') : __('Login', 'Nairobi') ?></a>
						</div>
					</div>
					<div class="open-menu">
						<a href="#">
							<img src="<?= get_stylesheet_directory_uri() ?>/img/icon-6-1.svg" alt="">
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>


	<div class="menu-responsive" id="menu-responsive" style="display: none">
		<div class="wrap">
			<div class="mob-menu">
				
				<?php wp_nav_menu( array(
					'theme_location'  => 'menu-1',
					'container'       => '',
					'items_wrap'      => '<ul>%3$s</ul>'
				)); ?>

				<?php custom_language_switcher() ?>

				<div class="btn-wrap">
					<a href="<?php the_permalink(apply_filters('wpml_object_id', 579, 'page')) ?>" class="btn-default btn-border-red"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-8.svg" alt=""><?= is_user_logged_in() ? __('My account', 'Nairobi') : __('Login', 'Nairobi') ?></a>
				</div>
			</div>
		</div>
	</div>

	<main>