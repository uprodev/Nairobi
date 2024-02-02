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
	wp_enqueue_style('intlTelInput',  'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css');
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'2.0.0'
	);

    wp_enqueue_script( 'wc-cart-fragments' );
	wp_enqueue_script('my-swiper', get_stylesheet_directory_uri() . '/js/swiper.js', array(), false, true);
	wp_enqueue_script('my-fancybox', get_stylesheet_directory_uri() . '/js/jquery.fancybox.min.js', array(), false, true);
	wp_enqueue_script('my-nice-select', get_stylesheet_directory_uri() . '/js/jquery.nice-select.min.js', array(), false, true);
	wp_enqueue_script('air-datepicker', get_stylesheet_directory_uri() . '/js/air-datepicker.js', array(), false, true);
	wp_enqueue_script('mask', get_stylesheet_directory_uri() . '/js/jquery.mask.js', array(), false, true);
	wp_enqueue_script('my-script', get_stylesheet_directory_uri() . '/js/script.js', array(), false, true);
    wp_enqueue_script('intlTelInput',  'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput-jquery.min.js', array(), false, 2);
    wp_enqueue_script('intlTelInpututils',  'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.min.js', array(), false, 2);
    wp_enqueue_script('actions', get_stylesheet_directory_uri() . '/js/actions.js?v=2', array(), false, rand(0,99999));


    if( is_page_template( [
        'page-templates/catalog.php',
        'page-templates/checkout.php',
        'page-templates/choose.php',
        'page-templates/delivery.php',
        'page-templates/login.php' ] ) ) {

        wp_dequeue_style('elementor-global');
        wp_dequeue_style( 'hello-elementor' );
        wp_dequeue_style( 'elementor-frontend' );
        wp_deregister_style( 'elementor-frontend' );
    }

//    if (!is_front_page() && !is_account_page()) {
//
//    }

    wp_enqueue_style('woocommerce_stylesheet',false,'1.0',"all");

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


function get_persons() {
    $adults = WC()->session->get('adults');
    $kids = WC()->session->get('kids');
    $persons = [];


    for ($i=1; $i<=$adults ; $i++ ) {
        $key =  'person';
        $persons[$key.'-'. $i] = __(ucfirst($key), 'nairobi'). ' '. $i;
    }

    for ($i=1; $i<=$kids; $i++ ) {
        $key =   'kid' ;
        $persons[$key.'-'. $i] = __(ucfirst($key), 'nairobi'). ' '. $i;

    }

    return $persons;
}


add_action('template_redirect', function(){
    if (is_shop() || is_product()) {
        wp_redirect(home_url());
    }

    if (
       // is_page_template('page-templates/login.php') ||
        is_page_template('page-templates/delivery.php')     ) {
        $adults = WC()->session->get('adults');
        $kids = WC()->session->get('kids');
        if (!$adults && !$kids)
            wp_redirect(home_url());
    }

});



function get_lowest_shipping_flat_rate_1()
{
    $delivery_zones = WC_Shipping_Zones::get_zones();

    //define the array outside of the loop
    $shipping_costs = [];
    $min_zone = "";

    //get all costs in a loop and store them in the array
    foreach ((array) $delivery_zones as $key => $the_zone ) {

        foreach ($the_zone['shipping_methods'] as $value) {
            $shipping_costs[] = $value->cost;
            if(min($shipping_costs) == $value->cost) $min_zone = $the_zone['zone_name'];
        }
    }

    $content =   min($shipping_costs);

    return $content;
}
