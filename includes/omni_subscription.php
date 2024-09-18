<?php 

class OmniSubscription {

private $api_key;
private $post_id;
private $widget_id;
private $subscriberSource;
private $subscriberName;
private $subscriberEmail;


public function __construct($api_key, $post_id = '', $widget_id = '', $subscriberEmail = '', $subscriberName = '', $subscriberSource = '') {
    $this->api_key = $api_key;
    $this->post_id = $post_id;
    $this->widget_id = $widget_id;
    $this->subscriberSource = $subscriberSource;
    $this->subscriberEmail = $subscriberEmail;
    $this->subscriberName = $subscriberName;
}

public function add_subscriber() {

    $widget_settings = $this->get_widget_settings();

    if(!$widget_settings ) {
        return '{"error": "Widget settings not found."}';
    } 

    $omniApi = isset($widget_settings['omni']['omniApi']) ? $widget_settings['omni']['omniApi'] : null;

    // Prepare the payload for Omnisend API
    $payload = $this->prepare_payload();

    // Make the cURL request to Omnisend API
    $response = $this->send_request($payload, $omniApi);

    return $response;
}

public function check_api_key() {
    // $widget_settings = $this->get_widget_settings();
    return $this->send_request("", $this->api_key, true);
}

private function get_widget_settings() {
        // Get widget settings from Elementor
        $widgets = \Elementor\Plugin::$instance->documents->get($this->post_id)->get_elements_data();
        $widget_settings = $this->find_widget_settings($widgets, $this->widget_id);
    
        // if (!$widget_settings) {
        //     // Return error if widget settings are not found
        //     $widget_settings = '{"error": "Widget settings not found."}';
        // }

        return $widget_settings;
}

private function find_widget_settings($elements, $widget_id) {
    foreach ($elements as $element) {
        if ($element['id'] === $widget_id) {
            return $element['settings'];
        }

        // If the element has children (e.g., it's a section or column)
        if (!empty($element['elements'])) {
            $settings = $this->find_widget_settings($element['elements'], $widget_id);
            if ($settings) {
                return $settings;
            }
        }
    }
    return null;
}

private function prepare_payload() {
    return json_encode([
        'firstName' => $this->subscriberName,
        'identifiers' => [
            [
                "type" => "email",
                "id" => $this->subscriberEmail,
                "source" => $this->subscriberSource,
                "channels" => [
                    "email" => [
                        "status" => "subscribed"
                    ]
                ],
                'consent' => [
                    'createdAt' => date('Y-m-d\TH:i:s\Z', time()),
                    'ip' => $this->getUserIp(),
                    'source' => $this->subscriberSource,
                ],
            ]
        ],
        'sendWelcomeEmail' => true,
        'tags' => [
            $this->subscriberSource,
        ]
    ]);
}

private function send_request($payload, $api_key, $check_api = false) {
   
    $curl = curl_init();

    $curl_options = [
        CURLOPT_URL => "https://api.omnisend.com/v5/contacts",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => [
            "X-API-KEY: " . $api_key,
            "accept: application/json",
            "content-type: application/json"
        ],
    ];
    
    // Adjust options based on the condition
    if ($check_api) {
        $curl_options[CURLOPT_CUSTOMREQUEST] = "GET";
    } else {
        $curl_options[CURLOPT_CUSTOMREQUEST] = "POST";
        $curl_options[CURLOPT_POSTFIELDS] = $payload;
    }

    curl_setopt_array($curl, $curl_options);

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

private function getUserIp() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
}
