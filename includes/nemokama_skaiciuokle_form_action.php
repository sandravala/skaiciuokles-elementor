<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action('wp_ajax_nemokama_skaiciuokle_send_email', 'nemokama_skaiciuokle_send_email');
add_action('wp_ajax_nopriv_nemokama_skaiciuokle_send_email', 'nemokama_skaiciuokle_send_email');

function nemokama_skaiciuokle_send_email() {

    $formData = $_POST['data'];
    error_log(print_r($formData, true));
    // Gather form data
    $field1 = $formData['bendrosSumos'] ? $formData['bendrosSumos']: 'nera bendrosSumos';
    $field2 = $formData['vpaIsmokos'] ? $formData['vpaIsmokos'] : 'nera vpaIsmokos';
    // Process other fields

    // vpaIsmokos.push({ 'tarifas': rate + ' % ' + npmText, 'men': menuo, 'suma': suma, 'sumaPoMokesciu': sumaPoMokesciu, 'gavejas': receiver });

    // Prepare email
    $to = "sandra.valaviciute@gmail.com";
    $subject = "Form Submission";
    $message = "Field 1: $field1\nField 2: $field2\n...";
    $headers = "From: webmaster@example.com";

    // Send email
    $mail_sent = wp_mail($to, $subject, $message, $headers);


        if ($mail_sent) {
            wp_send_json_success(['message' => 'Form data received and email sent successfully!']);
        } else {
            wp_send_json_error(['message' => 'Form data received but email not sent.']);
        }

    }

    function buildEmailMessage($title, $introText, $questionAnswers, $contactInfo) {
        $message = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Email</title>
            <style> @import url("https://fonts.googleapis.com/css2?family=Hind:wght@400&family=Montserrat:wght@400;700&display=swap"); </style>
        </head>
        <body style="font-family: \'Hind\'; font-weight: normal; font-size: 18pt; padding: 1em; text-align: justify;">
            <h1 style="font-family: \'Montserrat\';font-weight: bold;font-size: 24pt;">' . $title . '</h1>
            <div style="background-color: #cc7c54; width: 60px; height: 18px;"></div>
            <h2 style="font-family: \'Montserrat\';font-weight: normal;font-size: 20pt;">' . $introText . '</h2>
            <h2 style="font-family: \'Montserrat\';font-weight: normal;font-size: 20pt;">Contact Information</h2>
            <ul style="padding-left: 0;">';
            
        foreach ($contactInfo as $field => $value) {
            $message .= '<li style="position: relative;left: 0;list-style: none;border-left: 10px solid #05b3bc;padding-left: 1em;">
                <span style="font-family: \'Montserrat\';font-weight: bold;font-size: 18pt;">' . ucfirst(esc_html($field)) . ':</span> ' . esc_html($value) . '</li>';
        }
        
        $message .= '</ul><h2 style="font-family: \'Montserrat\';font-weight: normal;font-size: 20pt;">Boat Configuration</h2><ul style="padding-left: 0;">';
        
        foreach ($questionAnswers as $question => $answer) {
            $message .= '<li style="position: relative;left: 0;list-style: none;border-left: 10px solid #05b3bc;padding-left: 1em;margin-bottom: 2em;">
                <span style="font-family: \'Montserrat\';font-weight: bold;font-size: 18pt;">' . esc_html($question) . '</span><br>' . 
                esc_html($answer['text']) . 
                (!empty($answer['color']) ? ' (' . esc_html($answer['color']) . ')' : '') . '<br>';
            if (!empty($answer['imgUrl'])) {
                $message .= '<img src="' . esc_url($answer['imgUrl']) . '" alt="' . esc_attr($answer['text']) . '" style="max-width: 200px;"><br>';
            }
            if (!empty($answer['color'])) {
                $message .= '<div style="width: 100px; height: 100px; background-color: ' . esc_attr($answer['color']) . '; border-radius: .2em;"></div>';
            }
            $message .= '</li>';
        }
    
        $message .= '</ul></body></html>';
    
        return $message;
    }
    