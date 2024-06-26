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

function my_plugin_stylesheets() {
    wp_register_style( 'custom-skaiciuokles-style-1', plugins_url( '/css/style.css', __FILE__ ) );
    wp_enqueue_style( 'custom-skaiciuokles-style-1' );
}

add_action( 'elementor/editor/after_enqueue_styles', 'my_plugin_stylesheets' );


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