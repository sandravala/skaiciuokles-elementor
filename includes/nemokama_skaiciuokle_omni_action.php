<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action('wp_ajax_nemokama_skaiciuokle_omni', 'nemokama_skaiciuokle_omni');
add_action('wp_ajax_nopriv_nemokama_skaiciuokle_omni', 'nemokama_skaiciuokle_omni');

function nemokama_skaiciuokle_omni() {

    $widgetId = $_POST['id'];
    
    $document = \Elementor\Plugin::$instance->documents->get( $post_id );
    $element_data = $document->get_elements_data();

    foreach ( $element_data as $element ) {
        if ( $element['elType'] === 'widget' && $element['widgetType'] === 'ismoku_skaiciuokle_nemokama' ) {
            $settings = $element['settings'];
            // Now you have the widget's settings.
        }
    }

    return $settings;
    

    }

    