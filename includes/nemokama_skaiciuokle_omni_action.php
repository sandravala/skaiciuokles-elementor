<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action('wp_ajax_nemokama_skaiciuokle_omni', 'nemokama_skaiciuokle_omni');
add_action('wp_ajax_nopriv_nemokama_skaiciuokle_omni', 'nemokama_skaiciuokle_omni');

function nemokama_skaiciuokle_omni() {
    error_log('post_id ' . $_POST['post_id']);
    $widget_id = $_POST['post_id'];

    $widgets = \Elementor\Plugin::$instance->documents->get( '11901' )->get_elements_data();


    function find_widget_settings($elements, $widget_id) {
        foreach ($elements as $element) {
            if ($element['id'] === $widget_id) {
                return $element['settings'];
            }
            
            // If the element has children (e.g., it's a section or column)
            if (!empty($element['elements'])) {
                $settings = find_widget_settings($element['elements'], $widget_id);
                if ($settings) {
                    return $settings;
                }
            }
        }
        return null;
    }
    
    $widget_settings = find_widget_settings($widgets, $widget_id);


    // foreach ( $element_data as $element ) {
    //     if ( $element['elType'] === 'widget' && $element['widgetType'] === 'ismoku_skaiciuokle_nemokama' ) {
    //         $settings = $element['settings'];
    //         // Now you have the widget's settings.
    //     }
    // }

    error_log($widget_settings['omni']);
    wp_send_json($widget_settings['omni']);
    

}

    