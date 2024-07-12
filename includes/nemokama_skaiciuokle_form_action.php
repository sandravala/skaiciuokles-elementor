<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action('wp_ajax_nemokama_skaiciuokle_send_email', 'nemokama_skaiciuokle_send_email');
add_action('wp_ajax_nopriv_nemokama_skaiciuokle_send_email', 'nemokama_skaiciuokle_send_email');

function nemokama_skaiciuokle_send_email() {

    // Gather form data
    $field1 = isset($_POST['formbox-field-1']) ? $_POST['formbox-field-1'] : '';
    $field2 = isset($_POST['formbox-field-2']) ? $_POST['formbox-field-2'] : '';
    // Process other fields

    // Prepare email
    $to = "sandra.valaviciute@gmail.com";
    $subject = "Form Submission";
    $message = "Field 1: $field1\nField 2: $field2\n...";
    //$headers = "From: webmaster@example.com";

    // Send email
    $mail_sent = wp_mail($to, $subject, $message, $headers);


        if ($mail_sent) {
            wp_send_json_success(['message' => 'Form data received and email sent successfully!']);
        } else {
            wp_send_json_error(['message' => 'Form data received but email not sent.']);
        }

    }