<?php 

class OmniSubscription {

private $post_id;
private $widget_id;
private $subscriberSource;
private $subscriberName;
private $subscriberEmail;


public function __construct($post_id, $widget_id, $subscriberEmail, $subscriberName, $subscriberSource) {
    $this->post_id = $post_id ? $post_id : '';
    $this->widget_id = $widget_id ? $widget_id : '';
    $this->subscriberSource = $subscriberSource ? $subscriberSource : '';
    $this->subscriberEmail = $subscriberEmail ? $subscriberEmail : '';
    $this->subscriberName = $subscriberName ? $subscriberName : '';
}

public function add_subscriber() {
    // Get widget settings from Elementor
    $widgets = \Elementor\Plugin::$instance->documents->get($this->post_id)->get_elements_data();
    $widget_settings = $this->find_widget_settings($widgets, $this->widget_id);

    if (!$widget_settings) {
        // Return error if widget settings are not found
        wp_send_json(new WP_Error('widget_settings_not_found', 'Widget settings not found.'));
        return;
    }

    // Prepare the payload for Omnisend API
    $payload = $this->prepare_payload();

    // Make the cURL request to Omnisend API
    $response = $this->send_request($payload, $widget_settings['omni']);

    if (is_wp_error($response)) {
        // If the request failed, return the error message
        wp_send_json($response);
    } else {
        // If the request succeeded, return the response
        wp_send_json($response);
    }
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

private function send_request($payload, $api_key) {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.omnisend.com/v5/contacts",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => [
            "X-API-KEY: " . $api_key,
            "accept: application/json",
            "content-type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        // Return a WP_Error object if cURL fails
        return new WP_Error('curl_error', 'cURL Error: ' . $err);
    }

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
