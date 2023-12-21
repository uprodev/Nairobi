</main>
<footer>
	<div class="content-width">
		<div class="content">
			<div class="left">

				<?php if ($field = get_field('logo_h', 'option')): ?>
					<div class="logo-wrap">
						<a href="<?= get_home_url() ?>">
							<?= wp_get_attachment_image($field['ID'], 'full') ?>
						</a>
					</div>
				<?php endif ?>
				
				<nav class="footer-menu">

					<?php wp_nav_menu( array(
						'theme_location'  => 'menu-2',
						'container'       => '',
						'items_wrap'      => '<ul>%3$s</ul>'
					)); ?>

				</nav>
			</div>

			<?php if ($field = get_field('form_f', 'option')['form']): ?>
				<div class="form-wrap">

					<?php if ($title = get_field('form_f', 'option')['title']): ?>
						<p class="title"><?= $title ?></p>
					<?php endif ?>
					
					<?= do_shortcode('[contact-form-7 id="' . $field . '" html_class="footer-form"]') ?>

					<?php if ($text = get_field('form_f', 'option')['text']): ?>
						<?= $text ?>
					<?php endif ?>
					
				</div>
			<?php endif ?>

		</div>
	</div>
	<div class="bottom">
		<div class="content-width">

			<?php if(have_rows('links_f', 'option')): ?>

				<ul class="bottom-menu">

					<?php while(have_rows('links_f', 'option')): the_row() ?>

						<?php if ($field = get_sub_field('link')): ?>
							<li>
								<a href="<?= $field['url'] ?>"<?php if($field['target']) echo ' target="_blank"' ?>><?= $field['title'] ?></a>
							</li>
						<?php endif ?>

					<?php endwhile ?>

				</ul>

			<?php endif ?>

			<?php if ($field = get_field('copyright_f', 'option')): ?>
				<div class="text">
					<p><?= $field ?></p>
				</div>
			<?php endif ?>
			
		</div>
	</div>
</footer>
<?php wp_footer() ?>
</body>
</html>