<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action( 'wp_ajax_generate_nonce_for_ajax', 'generate_nonce_for_ajax' );
add_action( 'wp_ajax_nopriv_generate_nonce_for_ajax', 'generate_nonce_for_ajax' );

add_action('wp_ajax_nemokama_skaiciuokle_send_email', 'nemokama_skaiciuokle_send_email');
add_action('wp_ajax_nopriv_nemokama_skaiciuokle_send_email', 'nemokama_skaiciuokle_send_email');

add_action('wp_ajax_testas_send_email', 'testas_send_email');
add_action('wp_ajax_nopriv_testas_send_email', 'testas_send_email');

add_action('wp_ajax_skaiciuokle_check_omni_api', 'skaiciuokle_check_omni_api');

add_action('wp_ajax_set_vdu', 'set_vdu');
add_action( 'wp_ajax_nopriv_set_vdu', 'set_vdu' );

add_action('process_omnisend_subscription', 'process_omnisend_subscription_function', 10, 5);



function nemokama_skaiciuokle_send_email() {

    if ( ! isset( $_POST['nonce'] ) ) {
        wp_send_json_error( array( 'message' => 'No nonce provided.' ) );
        return;
    }

    $nonce = sanitize_text_field( $_POST['nonce'] );

    // Verify nonce
    if ( ! wp_verify_nonce( $nonce, 'skaiciuokle_nonce_action' ) ) {
        wp_send_json_error( array( 'message' => 'Nonce verification failed.' ) );
        return;
    }

    $formData = $_POST['calcData'];
    
    // Gather form data
    $bendrosSumos = isset($formData['bendrosSumos']) ? $formData['bendrosSumos']: array();
    $vpaIsmokos = isset($formData['vpaIsmokos']) ? $formData['vpaIsmokos']: array();
    $motinystesIsmoka = isset($formData['motinystesIsmoka']) ? $formData['motinystesIsmoka']: array();
    $tevystesIsmoka = isset($formData['tevystesIsmoka']) ? $formData['tevystesIsmoka']: array();
    $paaiskinimai = isset($formData['vpaIsmokuPaaiskinimai']) ? $formData['vpaIsmokuPaaiskinimai']: '';

    // gather other required data
    $post_id = $_POST['post_id'] ? sanitize_text_field($_POST['post_id']) : '' ;
    $widget_id = $_POST['widget_id'] ? sanitize_text_field($_POST['widget_id']) : '';
    $subscriberSource = $_POST['source'] ? sanitize_text_field($_POST['source']) : '';
    $subscriberName = $_POST['name'] ? sanitize_text_field($_POST['name']) : '';
    $subscriberEmail = $_POST['email'] ? sanitize_email($_POST['email']) : '';

    // Prepare email
    $subject = "Jūsų planuojamos VPA išmokos";
    $message = buildEmailMessage($bendrosSumos, $vpaIsmokos, $motinystesIsmoka, $tevystesIsmoka, $paaiskinimai);

    send_custom_email($subscriberEmail, $subscriberName, $post_id, $widget_id, $subscriberSource, $subject, $message);  

}

function testas_send_email() {

    if ( ! isset( $_POST['nonce'] ) ) {
        
        wp_send_json_error( array( 'message' => 'No nonce provided.' ) );
        return;
    }

    $nonce = sanitize_text_field( $_POST['nonce'] );
    // Verify nonce
    if ( ! wp_verify_nonce( $nonce, 'skaiciuokle_nonce_action' ) ) {
        wp_send_json_error( array( 'message' => 'Nonce verification failed.' ) );
        return;
    }

    $post_id = $_POST['post_id'] ? sanitize_text_field($_POST['post_id']) : '' ;
    $widget_id = $_POST['widget_id'] ? sanitize_text_field($_POST['widget_id']) : '';
    $subscriberSource = $_POST['source'] ? sanitize_text_field($_POST['source']) : '';
    $subscriberName = $_POST['name'] ? sanitize_text_field($_POST['name']) : '';
    $subscriberEmail = $_POST['email'] ? sanitize_email($_POST['email']) : '';
    $answer = $_POST['answer'] ? sanitize_text_field($_POST['answer']) : '';


    // Prepare email
    $subject = "Ar jums priklauso VPA išmoka?";
    $message = buildEmailMessageTestui($answer);

    send_custom_email($subscriberEmail, $subscriberName, $post_id, $widget_id, $subscriberSource, $subject, $message);  
}

function send_custom_email($subscriberEmail, $subscriberName, $post_id, $widget_id, $subscriberSource, $subject, $message) {
    $admin_email = get_option('admin_email');

    // Prepare email
    $to = $subscriberEmail;
    $headers = array("Content-Type: text/html; charset=UTF-8","From: Greta Užkuraitė <" . $admin_email . ">");
    
    // Send email
    $mail_sent = wp_mail($to, $subject, $message, $headers);

    // Schedule Omnisend subscription in the background
    schedule_omnisend_subscription($post_id, $widget_id, $subscriberEmail, $subscriberName, $subscriberSource);

    // Return the result of the email process
    if ($mail_sent) {
        wp_send_json_success(['message' => 'Form data received and email sent successfully!']);
    } else {
        wp_send_json_error(['message' => 'Form data received but email not sent.']);
    }
}

function buildEmailMessageTestui($answer) {
    $message = trim(createMessage(1, true));
    $message .= trim('<br>' . $answer);
    $message .= trim(createMessage(2, true));
    return $message;
}

    function buildEmailMessage($bendrosSumos, $vpaIsmokos, $motinystesIsmoka, $tevystesIsmoka, $paaiskinimai) {
            $message = trim(createMessage(1, false));
                
            
            if(!empty($motinystesIsmoka)) {
                $message .= trim(createRow($motinystesIsmoka, 'Nėštumo ir gimdymo atostogų išmoka:'));
            }

            if(!empty($tevystesIsmoka)) {
                $message .= trim(createRow($tevystesIsmoka, 'Tėvystės išmoka:'));
            }

            if(!empty($vpaIsmokos)) {
                $message .= trim(createRow($vpaIsmokos, 'Vaiko priežiūros atostogų išmokos detalizacija:'));
            }

            if(!empty($bendrosSumos)) {
                $message .= trim(createRow($bendrosSumos, 'bendraSuma'));
            }

        
            $message .= trim(createMessage(2, false, $paaiskinimai));
        
            return $message;
    }

    function createRow($data, $ismokuPavadinimas) {
        $rows = '';
    
        if ($ismokuPavadinimas !== '') {
            if ($ismokuPavadinimas === 'bendraSuma') {
                $fontWeight = 'bold';
    
                $rows .= '<tr><td colspan="5" style="text-align: center; font-size: .85em; letter-spacing: .1em; text-transform: uppercase; background-color: #D9E1E7; line-height: 2;">IŠ VISO:</td></tr>';
    
                foreach ($data as $item) {
                    $rows .= '<tr><td colspan="2" style="text-align: left; font-size: .85em; text-transform: uppercase; padding-left: .3em; font-weight: 400;">' . $item['men'] . '</td><td style="text-align: left; font-size: .85em; padding-left: .3em; font-weight: 400;"><div class="bendra-suma">' . $item['suma'] . '</div></td><td style="text-align: left; font-size: .85em; padding-left: .3em; font-weight: 400;"><div class="bendra-suma">' . $item['sumaPoMokesciu'] . '</div></td><td style="text-align: left; font-size: .85em; text-transform: uppercase; padding-left: .3em;">' . $item['gavejas'] . '</td></tr>';
                }
            }  else {
                $rows .= '<tr><td colspan="5" style="text-align: center; font-size: .85em; letter-spacing: .1em; text-transform: uppercase; background-color: #D9E1E7; line-height: 2;">' . $ismokuPavadinimas . '</td></tr>';
    
            foreach ($data as $index => $item) {
                $fontWeight = 'normal';
                $rows .= '<tr><td style="text-align: left; font-size: .75em; text-transform: uppercase; padding-left: .3em;">' . $item['tarifas'] . '</td><td style="text-align: left; font-size: .75em; padding-left: .3em; font-weight: ' . $fontWeight . ';"><div class="datos-laukas">' . $item['men'] . '</div></td><td style="text-align: left; font-size: .75em; padding-left: .3em; font-weight: ' . $fontWeight . ';">' . $item['suma'] . '</td><td style="text-align: left; font-size: .75em; padding-left: .3em; font-weight: ' . $fontWeight . ';">' . $item['sumaPoMokesciu'] . '</td><td style="text-align: left; font-size: .75em; text-transform: uppercase; padding-left: .3em;">' . $item['gavejas'] . '</td></tr>';
            
                // Add a separator row if there are more than 2 items and this is not the last item
                if (count($data) > 2 && $index < count($data) - 1) {
                    $rows .= '<tr><td colspan="5" style="border-bottom:1px solid #D9E1E7;"></td></tr>';
                }
            }
        }
    
        return $rows;
        }
    }

    function createMessage($part, $testui, $paaiskinimai = '') {

        if($part === 1) {
            $partOne = '<!DOCTYPE html><html><head></head><body><table width="600"    cellpadding="0" cellspacing="0" align="center" style="background-color:#fff"><tr><td><table width="100%" cellpadding="0" cellspacing="0"><tr><td style="padding:45px 24px 24px;background-color:#0b1b28"><table width="100%"><tr><td style="text-align:center"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/greta-uzkuraite-header.png" alt="greta uzkuraite header" width="326" style="max-width:100%;height:auto"></td></tr></table></td></tr></table><table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f7f4f2;padding:35px 24px 12px"><tr><td style="text-align:center;color:#0b1b28;font-family:Montserrat,Verdana,sans-serif;font-size:24px;line-height:1.5">Sveiki!</td></tr><tr><td style="text-align:left;color:#0b1b28;font-family:Montserrat,Verdana,sans-serif;font-size:15px;line-height:1.5;padding:12px">';
            $partOne .= $testui ? 'dėkojame, kad pasinaudojote testu, skirtu įvertinti, ar jums priklausys motinystės išmoka.' : 'dėkojame, kad pasinaudojote nemokama skaičiuokle, skirta įvertinti prognozuojamas motinystės išmokas. Jūsų prognozuojamų išmokų lentelė:</td></tr></table><table id="rezultatuLentele" class="rezultatuLentele" style="border-collapse:separate!important;border-spacing:.2em!important;position:relative;padding:2em;"><thead><tr><th style="text-align:left;font-size:.75em;text-transform:uppercase;padding-left:.3em;width:10%">tarifas</th><th style="text-align:left;font-size:.75em;text-transform:uppercase;padding-left:1em">data*</th><th style="text-align:left;font-size:.75em;text-transform:uppercase;padding-left:.3em">suma**</th><th style="text-align:left;font-size:.75em;text-transform:uppercase;padding-left:.3em">suma (į rankas)</th><th style="text-align:left;font-size:.75em;text-transform:uppercase;padding-left:.3em">gavėjas</th></tr></thead><tbody>';

            return $partOne;
        } else {
            $lastPart = $testui ? '</td></tr></table>' : '<tr><td colspan="5" class="segment" style="text-align:left;font-size:.85em;letter-spacing:.1em;text-transform:uppercase;background-color:#D9E1E7;line-height:2;font-family:Montserrat,Verdana,sans-serif;">Paaiškinimai:</td></tr><tr><td colspan="5" style="text-align:left;font-size:.85em;letter-spacing:.1em;line-height:1.5;font-family:Montserrat,Verdana,sans-serif;">* - Preliminari teisės į išmoką atsiradimo data, t.y. nuo kada galima kreiptis dėl išmokos.</td></tr><tr><td colspan="5" style="text-align:left;font-size:.85em;letter-spacing:.1em;line-height:1.5;font-family:Montserrat,Verdana,sans-serif;">** - preliminariai apskaičiuota išmokos suma pagal pateiktus duomenis (faktinės išmokos gali nežymiai kisti, priklausomai nuo gimdymo datos, atostogų, ligos ir pan.)</td></tr><tr><td colspan="5" style="text-align:left;font-size:.85em;letter-spacing:.1em;line-height:1.5;font-family:Montserrat,Verdana,sans-serif;">*** - NPM yra 2 neperleidžiami mėnesiai mamai ir 2 neperleidžiami mėnesiai tėčiui. Didesnis tarifas taikomas tik neperleidžiamais VPA mėnesiais (NPM), ir jais atitinkamai gali pasinaudoti tik mama arba tėtis. Jei NPM naudoja tik vienas iš tėvų, išmoka pradingsta, o VPA sutrumpėja</td></tr><tr><td colspan="5" style="text-align:left;font-size:.85em;letter-spacing:.1em;line-height:1.5;font-family:Montserrat,Verdana,sans-serif;">Čia matote preliminariai apskaičiuotas išmokas nurodytam laikotarpiui. Keičiantis tarifams, pajamoms ir pan. VPA išmokų sumos gali būti mažesnės, priklausomai nuo to, kurią dieną faktiškai prasidės ir baigsis teisė į VPA išmoką.</td></tr><tr><td colspan="5" style="text-align:left;font-size:.85em;letter-spacing:.1em;line-height:1.5;font-family:Montserrat,Verdana,sans-serif;color:red;">' . $paaiskinimai . '</td></tr></tbody></table>';
            
            $lastPart .= '<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f7f4f2;padding:5px 24px 12px"><tr><td style="text-align:left;color:#0b1b28;font-family:Montserrat,Verdana,sans-serif;font-size:15px;line-height:1.5;padding:12px">Nežinote nuo ko pradėti planuojantis motinystės išmokas? Ieškote informacijos, kurią būtų lengva surasti bei suprasti? Jokių įmantrybių, tiesiog, kad būtų pateikta susitemintai ir žmonių kalba. Jei taip, tuomet galime pasiūlyti net keletą naudingų sprendimų:<ol style="text-align:left"><li>Narystę uždaroje VPA grupėje;</li><li>Seminarą apie motinystės išmokas dirbantiems su IDV ir MB;</li><li>Nemokamą skaičiuoklę, kurios dėka galėsite pasiskaičiuoti prognozuojamaa VPA išmokas ir pasilyginti, kuri išmokų trukmė (18 mėn. ar 24 mėn.) jums būtų finansiškai naudingesnė.</li></ol></td></tr></table><table id="cta" width="100%" cellpadding="0" cellspacing="0"><tr><td style="height:10px;background-color:#fff"></td></tr><tr><td style="text-align:center;color:#0b1b28;font-family:Montserrat,Verdana,sans-serif;font-size:14px;line-height:1.5;background-color:#f7f4f2;padding:24px"><a href="https://gretauzkuraite.lt/product/viskas-apie-nauja-vaiko-prieziuros-atostogu-tvarka/" target="_blank" style="text-decoration:none;color:inherit"><p style="font-size:24px;margin-top:0"><strong>Narystė uždaroje VPA grupėje</strong></p><p>Nepraleiskite galimybės turėti visą aktualią informaciją apie <strong>Motinystės Išmokas ir naują Vaiko Priežiūros Atostogų suteikimo tvarką</strong> vienoje vietoje.</p><p>Prisijunkite prie <strong>uždaros VPA grupės</strong> ir visą informaciją ir patarimus gaukite aiškiai, susistemintai ir žmonių kalba.</p><button style="background-color: #071927; color: #fff; justify-content: center; height: auto; padding: 1em; border: 1px solid #071927; border-radius: 0.5em; cursor: pointer; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; text-align: center; text-transform: uppercase; font-size: .85em; font-weight: 600; white-space: nowrap;" type="button">jungtis prie grupės</button></a></td></tr><tr><td style="text-align:center;padding:0"><a href="https://gretauzkuraite.lt/product/viskas-apie-nauja-vaiko-prieziuros-atostogu-tvarka/" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2022/04/motinystes-ismokos-didesne-ismoka-vpa.png" alt="motinystes ismokos didesne ismoka vpa" width="600" style="max-width:100%;height:auto"></a></td></tr><tr><td style="height:10px;background-color:#fff"></td></tr><tr><td style="text-align:center;color:#0b1b28;font-family:Montserrat,Verdana,sans-serif;font-size:14px;line-height:1.5;background-color:#f7f4f2;padding:24px"><a href="https://gretauzkuraite.lt/product/seminaras-viskas-apie-motinystes-ismokas-dirbant-su-idv/" target="_blank" style="text-decoration:none;color:inherit"><p style="font-size:24px;margin-top:0"><strong>Seminaras apie motinystės išmokas dirbantiems su IDV ir MB</strong></p><p>Dirbate su IDV arba turite savo MB?</p><p>Turbūt ne kartą girdėtoje, kad motinystės ir vaiko priežiūros <strong>išmokos jums nepriklausys</strong>. Arba bus labai mažos?</p>Jei tai tiesa, noriu šį <strong>mitą paneigti</strong> ir pakviesti įsigyti seminaro įrašą „<strong>Viskas apie motinystės išmokas dirbant su IDV ir MB</strong>”. <p>Šio seminaro metu, pasijusime kaip konsultacijoje, o ne paskaitoje ir susipažinsime, kokiu būdų motinystės išmokos yra skiriamos dirbant savarankiškai, bei pastrateguosime, ką galime padaryti, kad tos išmokos būtų didesnės.</p><button style="background-color: #071927; color: #fff; justify-content: center; height: auto; padding: 1em; border: 1px solid #071927; border-radius: 0.5em; cursor: pointer; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; text-align: center; text-transform: uppercase; font-size: .85em; font-weight: 600; white-space: nowrap;" type="button">peržiūrėti seminaro įrašą</button></a>&nbsp;</td></tr><tr><td style="text-align:center;padding:0"><a href="https://gretauzkuraite.lt/product/seminaras-viskas-apie-motinystes-ismokas-dirbant-su-idv/" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/viskas-apie-motinystes-ismokas-su-greta-uzkuraite-3.png" alt="viskas apie motinystes ismokas su greta uzkuraite 3" width="600" style="max-width:100%;height:auto"></a></td></tr><tr id="prenumerata"><td style="text-align:center;color:#0b1b28;font-family:Montserrat,Verdana,sans-serif;font-size:15px;line-height:1.5;background-color:#f7f4f2;padding:24px"><a href="https://omniform1.com/forms/v1/landingPage/65d5ba6cf673621aa12ab76c/667485efa11f3dd96311a1f6" target="_blank" style="text-decoration:none;color:inherit"><p style="font-size:15px;margin-top:0">Kviečiu prenumeruoti mano naujienlaiškį, kuriame dalinuosi teisinėmis aktualijomis ir eksperimentais bei apie motinystes išmokas. Nepamirškite pasirinkti sau aktualios temos, bet, žinoma, galite prenumeruoti ir abi.</p><button style="background-color:#071927;color:#fff;justify-content:center; height: auto;padding:1em;border: 1px solid #071927;border-radius: 0.5em;text-align: center;text-transform:uppercase; font-size:.85em;font-weight:600;white-space:nowrap;cursor:pointer;" type="button">Prenumeruoti</button></a></td></tr></table><table id="footer-1" border="0" cellspacing="0" cellpadding="0" width="100%"><tbody><tr><td style="padding:35px 24px 0;background-color:#0b1b28"><table width="100%" cellpadding="0" cellspacing="0"><tr><td style="width:552px;vertical-align:top"><table width="552" align="center"><tr><td style="padding:12px" align="center"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/greta-uzkuraite-logo-white.png" alt="greta uzkuraite logo" width="70" height="73" style="max-width:70px;height:auto;vertical-align:middle;font-family:Montserrat,Verdana,sans-serif;font-size:12px;color:#0b1b28;line-height:150%"></td></tr></table><table width="100%" cellpadding="0" cellspacing="0"><tr><td align="center"><table cellpadding="0" cellspacing="0"><tr><td style="padding:25px 12px"><a href="https://www.facebook.com/teisininke.greta.uzkuraite" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/facebook-greta-uzkuraite.png" alt="facebook" width="24" height="24" style="display:block;margin:0 auto;font-family:Montserrat,Verdana,sans-serif;font-size:14px;color:#0b1b28;line-height:150%"></a></td><td style="padding:25px 12px"><a href="https://www.instagram.com/greta.uzkur" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/instagram-greta-uzkuraite.png" alt="instagram" width="24" height="24" style="display:block;margin:0 auto;font-family:Montserrat,Verdana,sans-serif;font-size:14px;color:#0b1b28;line-height:150%"></a></td><td style="padding:25px 12px"><a href="https://www.linkedin.com/in/greta-uzkuraite/" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/linkedin-greta-uzkuraite.png" alt="linkedin" width="24" height="24" style="display:block;margin:0 auto;font-family:Montserrat,Verdana,sans-serif;font-size:14px;color:#0b1b28;line-height:150%"></a></td><td style="padding:25px 12px"><a href="https://www.youtube.com/@greta.uzkuraite" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/youtube-greta-uzkuraite.png" alt="youtube" width="24" height="24" style="display:block;margin:0 auto;font-family:Montserrat,Verdana,sans-serif;font-size:14px;color:#0b1b28;line-height:150%"></a></td><td style="padding:25px 12px"><a href="https://gretauzkuraite.lt/" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/web-greta-uzkuraite.png" alt="website_link" width="24" height="24" style="display:block;margin:0 auto;font-family:Montserrat,Verdana,sans-serif;font-size:14px;color:#0b1b28;line-height:150%"></a></td></tr></table></td></tr></table></td></tr></table></td></tr></tbody></table><table id="footer-2" border="0" cellspacing="0" cellpadding="0" width="100%"><tbody><tr><td style="padding:10px 24px 24px;background-color:#0b1b28"><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td style="width:552px;vertical-align:top"><table border="0" cellspacing="0" cellpadding="0" width="100%" style="word-wrap:anywhere"><tr><td style="color:#fff;font-family:Montserrat,Verdana,sans-serif;font-size:12px;line-height:1.5;padding:12px;text-align:center"><p style="margin:0">© Gretauzkuraite.lt</p><p style="margin:0"><br></p><p style="margin:0">Vilnius, Lithuania.</p><p style="margin:0">Šis laiškas buvo išsiųstas, nes pasinaudojote skaičiuokle <a style="color:#87a0b6" href="https://gretauzkuraite.lt">gretauzkuraite.lt</a> puslapyje.</p></td></tr></table><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding:6px 12px"><table border="0" cellspacing="0" cellpadding="0" width="65%"><tr><td style="font-size:0;line-height:0;border-top:1px solid #87a0b6">&nbsp;</td></tr></table></td></tr></table><table border="0" cellspacing="0" cellpadding="0" width="100%" style="word-wrap:anywhere"><tr><td style="color:#fff;font-family:Montserrat,Verdana,sans-serif;font-size:12px;line-height:1.5;padding:0 12px;text-align:center"><p style="margin:0"><a style="color:#87a0b6" href="http://gretauzkuraite.lt/privatumo-politika/" target="_blank">Privatumo politika</a></p></td></tr></table><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding:6px 12px"><table border="0" cellspacing="0" cellpadding="0" width="65%"><tr><td style="font-size:0;line-height:0;border-top:1px solid #87a0b6">&nbsp;</td></tr></table></td></tr></table><table border="0" cellspacing="0" cellpadding="0" width="100%" style="word-wrap:anywhere"><tr><td style="color:#fff;font-family:Montserrat,Verdana,sans-serif;font-size:12px;line-height:1.5;padding:0 12px;text-align:center"><p style="margin:0"><a style="color:#87a0b6" href="http://gretauzkuraite.lt/pirkimo-pardavimo-taisykles/" target="_blank">Pirkimo-pardavimo taisyklės</a></p></td></tr></table><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding:6px 12px"><table border="0" cellspacing="0" cellpadding="0" width="65%"><tr><td style="font-size:0;line-height:0;border-top:1px solid #87a0b6">&nbsp;</td></tr></table></td></tr></table></td></tr></table></td></tr></tbody></table>';
            return $lastPart;
        }

    }
    
function skaiciuokle_check_omni_api() {
        // gather other required data
        // $post_id = $_POST['post_id'] ? sanitize_text_field($_POST['post_id']) : '' ;
        // $widget_id = $_POST['widget_id'] ? sanitize_text_field($_POST['widget_id']) : '';

        $api_key = $_POST['omni'] ? sanitize_text_field($_POST['omni']) : '';

        $omni_subscribe = new OmniSubscription($api_key);

        $api_connected = $omni_subscribe->check_api_key();

        if(!isset(json_decode($api_connected, true)['error'])) {
            wp_send_json_success(['message' => true]);
        } else {
            wp_send_json_error(['message' => json_decode($api_connected, true)['error']]);
        }

}

function process_omnisend_subscription_function($post_id, $widget_id, $subscriberEmail, $subscriberName, $subscriberSource) {
    // Perform Omnisend subscription
    $omni_subscribe = new OmniSubscription('', $post_id, $widget_id, $subscriberEmail, $subscriberName, $subscriberSource);
    $user_subscribed = $omni_subscribe->add_subscriber();
    $responseData = json_decode($user_subscribed, true);

    // Dynamically get the admin email from WordPress settings
    $admin_email = get_option('admin_email');

    // Prepare admin email
    $err_message = isset($responseData['error']) ?
        "Vartotojas $subscriberEmail neišsaugotas į prenumeratorių duombazę (". $subscriberSource . "). Klaidos pranešimas: " . print_r($responseData, true) . " Persiųsk šį laišką sandra.valaviciute@gmail.com." :
        null ;

    
    // Send admin notification email
    $err_message ?  wp_mail($admin_email, "Omni subscription error", $err_message) : null;
}

// Schedule the cron job to process Omnisend subscription
function schedule_omnisend_subscription($post_id, $widget_id, $subscriberEmail, $subscriberName, $subscriberSource) {
    wp_schedule_single_event(time(), 'process_omnisend_subscription', [$post_id, $widget_id, $subscriberEmail, $subscriberName, $subscriberSource]);
}

function get_widget_settings($post_id, $widget_id) {

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

    return $widget_settings;
}

function set_vdu() {

    $ketv = $_POST['ketvirtis']; 
    $metai = $_POST['metai']; 
    $postId = $_POST['post_id']; 
    $widgetId = $_POST['widget_id']; 
    
    $data = GetDataFromOsp::get_data_from_osp($ketv, $metai);

        if(isset($data['structure']['dimensions']['observation'])) {
            $dataToSave = GetDataFromOsp::prepare_vdu_data($data);

            $widget_settings = get_widget_settings($postId, $widgetId);


            foreach ($dataToSave as $key => $value) {
                $widget_settings['vdu_control'][$value['metai']]['vdu_' . $value['ketv']] = $value['vdu'];
            }

            save_widget_settings($postId, $widgetId, $widget_settings);
            
            return wp_send_json_success( [ 'data' =>  $widget_settings]);

        }


        return wp_send_json_error( [ 'data' => $data]);
}


function save_widget_settings($post_id, $widget_id, $updated_settings) {
    // Get existing widget data
    $document = \Elementor\Plugin::$instance->documents->get($post_id);
    $widgets = $document->get_elements_data();

    // Function to find and update the widget settings
    function update_widget_settings(&$elements, $widget_id, $updated_settings) {
        foreach ($elements as &$element) {
            if ($element['id'] === $widget_id) {
                $element['settings'] = $updated_settings;
                return true;
            }

            if (!empty($element['elements'])) {
                $updated = update_widget_settings($element['elements'], $widget_id, $updated_settings);
                if ($updated) {
                    return true;
                }
            }
        }
        return false;
    }

    // Update the settings for the widget
    update_widget_settings($widgets, $widget_id, $updated_settings);

    // Save updated widgets back to the post meta
    $document->save(array('elements' => $widgets));
}


function generate_nonce_for_ajax() {

    // Generate the nonce
    $nonce = wp_create_nonce( 'skaiciuokle_nonce_action' );

    // Return the nonce to the frontend
    wp_send_json_success( [ 'nonce' => $nonce ] );
}





    