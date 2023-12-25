<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

include 'inc/woo.php';
include 'inc/ajax-actions.php';
/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style('my-normalize', get_stylesheet_directory_uri() . '/css/normalize.css');
	wp_enqueue_style('my-fonts-1', 'https://fonts.googleapis.com/css2?family=Inter&display=swap');
	wp_enqueue_style('my-fonts-2', 'https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700&display=swap');
	wp_enqueue_style('my-fonts-3', 'https://fonts.googleapis.com/css2?family=Roboto&display=swap');
	wp_enqueue_style('my-font', get_stylesheet_directory_uri() . '/css/font.css');
	wp_enqueue_style('my-fancybox', get_stylesheet_directory_uri() . '/css/jquery.fancybox.min.css');
	wp_enqueue_style('my-nice-select', get_stylesheet_directory_uri() . '/css/nice-select.css');
	wp_enqueue_style('my-swiper', get_stylesheet_directory_uri() . '/css/swiper.min.css');
	wp_enqueue_style('my-styles', get_stylesheet_directory_uri() . '/css/styles.css');
	wp_enqueue_style('air-datepicker', get_stylesheet_directory_uri() . '/css/air-datepicker.css');
	wp_enqueue_style('my-responsive', get_stylesheet_directory_uri() . '/css/responsive.css');
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);

    wp_enqueue_script( 'wc-cart-fragments' );
	wp_enqueue_script('my-swiper', get_stylesheet_directory_uri() . '/js/swiper.js', array(), false, true);
	wp_enqueue_script('my-fancybox', get_stylesheet_directory_uri() . '/js/jquery.fancybox.min.js', array(), false, true);
	wp_enqueue_script('my-nice-select', get_stylesheet_directory_uri() . '/js/jquery.nice-select.min.js', array(), false, true);
	wp_enqueue_script('air-datepicker', get_stylesheet_directory_uri() . '/js/air-datepicker.js', array(), false, true);
	wp_enqueue_script('my-script', get_stylesheet_directory_uri() . '/js/script.js', array(), false, true);
	wp_enqueue_script('actions', get_stylesheet_directory_uri() . '/js/actions.js', array(), false, true);


    if (!is_front_page()) {
        wp_dequeue_style('elementor-global');
        wp_dequeue_style( 'hello-elementor' );
        wp_dequeue_style( 'elementor-frontend' );
        wp_deregister_style( 'elementor-frontend' );
    }

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Main settings',
		'menu_title'	=> 'Theme options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


function custom_language_switcher(){
	$languages = icl_get_languages('skip_missing=0&orderby=id&order=desc');
	if(!empty($languages)){

		echo '<div class="lang-wrap"><div class="nice-select" tabindex="0">';

		foreach($languages as $index => $language){
			if($language['active'] === '1') echo '<span class="current">' . $language['native_name'] . '</span>';
		}

		echo '<ul class="list">';

		foreach($languages as $index => $language){

			$li_class = '';
			if($language['active'] === '1') $li_class = ' focus selected';

			echo '<li data-value="' . $index . '" class="option' . $li_class . '"><a href="' . $language['url'] . '">' . $language['native_name'] . '</a></li>';

			if($index == 'it'){
				echo '</ul>';
			}

		}

		echo '</ul></div></div>';

	}
}


add_filter('bcn_breadcrumb_title', 'my_breadcrumb_title_swapper', 3, 10);
function my_breadcrumb_title_swapper($title, $type, $id)
{
    if(in_array('home', $type))
    {
        $title = __('Home', 'Nairobi');
    }
    return $title;
}


function add_class_content($string, $p_class, $h_class) {

    if (str_contains($string, '<h')) {
        foreach (range(1,6) as $i) {
            $from[] = "<h$i";
            $to[] = '<h'. $i .' class="'. $h_class . '"';
        }
    }
    if (str_contains($string, '<p')){
        $from[] = "<p";
        $to[] = '<p class="'. $p_class . '"';
    }

    return str_replace ($from, $to, $string);

}
