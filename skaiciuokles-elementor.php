<?php
/**
 * Plugin Name: Skaičiuoklės Elementor
 * Description: Custom Skaičiuoklės motinystės išmokų centrui
 * Version:     1.0.0
 * Author:      Sandra Valavičiūtė
 * Author URI:  https://www.12gm.lt
 * Text Domain: skaiciuokles-elementor
 *
*
* Requires Plugins: elementor
* Elementor tested up to: 3.5.0
* Elementor Pro tested up to: 3.5.0
*/

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define('TEXT_DOMAIN', 'skaiciuokles-elementor');

include_once plugin_dir_path(__FILE__) . '/includes/nemokama_skaiciuokle_form_action.php';
include_once plugin_dir_path(__FILE__) . '/includes/nemokama_skaiciuokle_omni_action.php';

function my_custom_widget_scripts() {
    wp_register_script('ismoku_skaiciuokle_nemokama_script', plugin_dir_url(__FILE__) . '/js/ismoku_skaiciuokle_nemokama_script.js', ['elementor-frontend', 'jquery', 'jquery-ui-datepicker'], null, true);
	wp_localize_script('ismoku_skaiciuokle_nemokama_script', 'my_widget_ajax', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);

    wp_register_script('testas_ar_gausite_ismoka_script', plugin_dir_url(__FILE__) . '/js/testas_ar_gausite_ismoka_script.js', ['elementor-frontend', 'jquery'], null, true);
    
}
add_action('wp_enqueue_scripts', 'my_custom_widget_scripts');

function my_plugin_stylesheets() {
    wp_register_style( 'custom-skaiciuokles-style-1', plugins_url( '/css/style.css', __FILE__ ) );
    wp_enqueue_style( 'custom-skaiciuokles-style-1' );
    wp_enqueue_style('jquery-ui-css', 'https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css');
}

add_action( 'elementor/editor/after_enqueue_styles', 'my_plugin_stylesheets' );
add_action( 'elementor/frontend/before_enqueue_styles', 'my_plugin_stylesheets' );


function register_custom_control_vdu($controls_manager) {
	require_once(__DIR__ . '/controls/control-vdu.php');
    $controls_manager->register_control('vdu', new Control_VDU());
};

add_action('elementor/controls/controls_registered', 'register_custom_control_vdu');



function register_custom_skaiciuokles_widget( $widgets_manager ) {


   require_once( __DIR__ . '/widgets/testas_ar_gausite_ismoka.php' );

   $widgets_manager->register( new \Testas_Ar_Gausite_Ismoka() );

   require_once( __DIR__ . '/widgets/ismoku_skaiciuokle_nemokama.php' );

   $widgets_manager->register( new \Ismoku_Skaiciuokle_Nemokama() );
   

}
add_action( 'elementor/widgets/register', 'register_custom_skaiciuokles_widget' );

function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'custom-skaiciuokles',
		[
			'title' => esc_html__( 'Custom Skaičiuoklės', 'skaiciuokles-elementor' ),
			'icon' => 'fa-regular fa-hand-peace',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

