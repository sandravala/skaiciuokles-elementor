<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action('wp_ajax_skaiciuokles_omni', 'skaiciuokles_omni');
add_action('wp_ajax_nopriv_skaiciuokles_omni', 'skaiciuokles_omni');

function skaiciuokles_omni() {
    $post_id = $_POST['post_id'] ? $_POST['post_id'] : '' ;
    $widget_id = $_POST['widget_id'] ? $_POST['widget_id'] : '';
    $source = $_POST['source'] ? $_POST['source'] : '';

    $widgets = \Elementor\Plugin::$instance->documents->get( $post_id )->get_elements_data();


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


    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.omnisend.com/v5/contacts",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode([
        'firstName' => 'Kt',
        'identifiers' => [
            [
                "type" => "email",
                "id" => "dar.viens@example.com",
                "source" => "vpa-ismoku-skaiciuokle-source",
                "channels" => [
                    "email" => [
                        "status" => "subscribed"
                    ]
                ],
                'consent' => [
                    'createdAt' => date('Y-m-d\TH:i:s\Z', time()),
                    'ip' => getUserIp(),
                    'source' => $source,
                ],
            ]
        ],
        'sendWelcomeEmail' => true,
        'tags' => [
            $source,
        ]
      ]),
      CURLOPT_HTTPHEADER => [
        "X-API-KEY: " . $widget_settings['omni'],
        "accept: application/json",
        "content-type: application/json"
      ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        wp_send_json( "cURL Error #:" . $err);
    } else {
      wp_send_json( $response);
    }    
}

function getUserIp() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP from shared internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP passed from proxies
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // Regular IP address
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}