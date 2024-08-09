<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action('wp_ajax_nemokama_skaiciuokle_send_email', 'nemokama_skaiciuokle_send_email');
add_action('wp_ajax_nopriv_nemokama_skaiciuokle_send_email', 'nemokama_skaiciuokle_send_email');

function nemokama_skaiciuokle_send_email() {

    $formData = $_POST['calcData'];
    
    // Gather form data
    $bendrosSumos = isset($formData['bendrosSumos']) ? $formData['bendrosSumos']: array();
    $vpaIsmokos = isset($formData['vpaIsmokos']) ? $formData['vpaIsmokos']: array();
    $motinystesIsmoka = isset($formData['motinystesIsmoka']) ? $formData['motinystesIsmoka']: array();
    $tevystesIsmoka = isset($formData['tevystesIsmoka']) ? $formData['tevystesIsmoka']: array();
    
    // vpaIsmokos.push({ 'tarifas': rate + ' % ' + npmText, 'men': menuo, 'suma': suma, 'sumaPoMokesciu': sumaPoMokesciu, 'gavejas': receiver });

    // Prepare email
    $to = "sandra.valaviciute@gmail.com";
    $subject = "Form Submission";
    $message = buildEmailMessage($bendrosSumos, $vpaIsmokos, $motinystesIsmoka, $tevystesIsmoka);
    $headers = "From: webmaster@example.com";

    // Send email
    $mail_sent = wp_mail($to, $subject, $message, $headers);


        if ($mail_sent) {
            wp_send_json_success(['message' => 'Form data received and email sent successfully!']);
        } else {
            wp_send_json_error(['message' => 'Form data received but email not sent.']);
        }

    }

    function buildEmailMessage($bendrosSumos, $vpaIsmokos, $motinystesIsmoka, $tevystesIsmoka) {
        $message = trim(createMessage(1));
                                    // <tr>
                                    //     <td
                                    //         style="text-align:center; color:#0b1b28; font-family:Montserrat,Verdana,sans-serif; font-size:15px; line-height:1.5; padding:12px;">
                                    //         [field id="rezultatas_email"]
                                    //     </td>
                                    // </tr>
                                    // ;
            
        
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

    
        $message .= trim(createMessage(2));
    
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

    function createMessage($part) {

        $firstPart = 
            '<!DOCTYPE html><html><head></head><body><table width="600"    cellpadding="0" cellspacing="0" align="center" style="background-color:#fff"><tr><td><table width="100%" cellpadding="0" cellspacing="0"><tr><td style="padding:45px 24px 24px;background-color:#0b1b28"><table width="100%"><tr><td style="text-align:center"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/greta-uzkuraite-header.png" alt="greta uzkuraite header" width="326" style="max-width:100%;height:auto"></td></tr></table></td></tr></table><table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f7f4f2;padding:35px 24px 12px"><tr><td style="text-align:center;color:#0b1b28;font-family:Montserrat,Verdana,sans-serif;font-size:24px;line-height:1.5">Sveiki!</td></tr><tr><td style="text-align:center;color:#0b1b28;font-family:Montserrat,Verdana,sans-serif;font-size:15px;line-height:1.5;padding:12px">dėkojame, kad pasinaudojote nemokama skaičiuokle, skirta įvertinti prognozuojamas motinystės išmokas. Jūsų prognozuojamų išmokų lentelė:</td></tr></table><table id="rezultatuLentele" class="rezultatuLentele" style="border-collapse:separate!important;border-spacing:.2em!important;position:relative"><thead><tr><th style="text-align:left;font-size:.75em;text-transform:uppercase;padding-left:.3em;width:10%">tarifas</th><th style="text-align:left;font-size:.75em;text-transform:uppercase;padding-left:1em">data*</th><th style="text-align:left;font-size:.75em;text-transform:uppercase;padding-left:.3em">suma**</th><th style="text-align:left;font-size:.75em;text-transform:uppercase;padding-left:.3em">suma (į rankas)</th><th style="text-align:left;font-size:.75em;text-transform:uppercase;padding-left:.3em">gavėjas</th></tr></thead><tbody>';
        
        $secondPart = 
            '<tr><td colspan="5" class="segment" style="text-align:center;font-size:.85em;letter-spacing:.1em;text-transform:uppercase;background-color:#d9e1e7;line-height:2">Paaiškinimai:</td></tr><tr><td colspan="5">* - Preliminari teisės į išmoką atsiradimo data, t.y. nuo kada galima kreiptis dėl išmokos.</td></tr><tr><td colspan="5">** - preliminariai apskaičiuota išmokos suma pagal pateiktus duomenis (faktinės išmokos gali nežymiai kisti, priklausomai nuo gimdymo datos, atostogų, ligos ir pan.)</td></tr><tr><td colspan="5">Mamos pajamos viršija maksimalų galimą išmokos dydį, todėl išmokos skaičiuojamos nuo didžiausios galimos sumos (${maxIsmoka.toLocaleString("lt-LT")} Eur).</td></tr><tr><td colspan="5">Mamos pajamos yra mažesnės už šiuo metu galiojantį minimalų dydį, todėl išmokos skaičiuojamos nuo mažiausios galimos sumos (${minIsmoka.toLocaleString("lt-LT")} Eur).</td></tr><tr><td colspan="5">*** - NPM yra 2 neperleidžiami mėnesiai mamai ir 2 neperleidžiami mėnesiai tėčiui. Didesnis tarifas taikomas tik neperleidžiamais VPA mėnesiais (NPM), ir jais atitinkamai gali pasinaudoti tik mama arba tėtis. Jei NPM naudoja tik vienas iš tėvų, išmoka pradingsta, o VPA sutrumpėja</td></tr><tr><td colspan="5">Čia matote preliminariai apskaičiuotas išmokas pilnam mėnesiui. Pirmo ir paskutinio mėnesio (taip pat mėnesio eigoje keičiantis tarifams) VPA išmokų sumos bus mažesnės, priklausomai nuo to, kurią dieną prasidės ir baigsis teisė į VPA išmoką.</td></tr><table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f7f4f2;padding:35px 24px 12px"><tr><td style="text-align:center;color:#0b1b28;font-family:Montserrat,Verdana,sans-serif;font-size:15px;line-height:1.5;padding:12px">Nežinote nuo ko pradėti planuojantis motinystės išmokas? Ieškote informacijos, kurią būtų lengva surasti bei suprasti? Jokių įmantrybių, tiesiog, kad būtų pateikta susitemintai ir žmonių kalba. Jei taip, tuomet galime pasiūlyti net keletą naudingų sprendimų:<ol style="text-align:left"><li>Narystę uždaroje VPA grupėje;</li><li>Seminarą apie motinystės išmokas dirbantiems su IDV ir MB;</li><li>Nemokamą skaičiuoklę, kurios dėka galėsite pasiskaičiuoti prognozuojamaa VPA išmokas ir pasilyginti, kuri išmokų trukmė (18 mėn. ar 24 mėn.) jums būtų finansiškai naudingesnė.</li></ol></td></tr></table><table id="cta" width="100%" cellpadding="0" cellspacing="0"><tr><td style="height:10px;background-color:#fff"></td></tr><tr><td style="text-align:center;color:#0b1b28;font-family:Montserrat,Verdana,sans-serif;font-size:14px;line-height:1.5;background-color:#f7f4f2;padding:24px"><a href="https://gretauzkuraite.lt/product/viskas-apie-nauja-vaiko-prieziuros-atostogu-tvarka/" target="_blank" style="text-decoration:none;color:inherit"><p style="font-size:24px;margin-top:0"><strong>Narystė uždaroje VPA grupėje</strong></p><p>Nepraleiskite galimybės turėti visą aktualią informaciją apie<strong>Motinystės Išmokas ir naują Vaiko Priežiūros Atostogų suteikimo tvarką</strong>vienoje vietoje.</p><p>Prisijunkite prie<strong>uždaros VPA grupės</strong>ir visą informaciją ir patarimus gaukite aiškiai, susistemintai ir žmonių kalba.</p></a></td></tr><tr><td style="text-align:center;padding:0"><a href="https://gretauzkuraite.lt/product/viskas-apie-nauja-vaiko-prieziuros-atostogu-tvarka/" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2022/04/motinystes-ismokos-didesne-ismoka-vpa.png" alt="motinystes ismokos didesne ismoka vpa" width="600" style="max-width:100%;height:auto"></a></td></tr><tr><td style="height:10px;background-color:#fff"></td></tr><tr><td style="text-align:center;color:#0b1b28;font-family:Montserrat,Verdana,sans-serif;font-size:14px;line-height:1.5;background-color:#f7f4f2;padding:24px"><a href="https://gretauzkuraite.lt/product/seminaras-viskas-apie-motinystes-ismokas-dirbant-su-idv/" target="_blank" style="text-decoration:none;color:inherit"><p style="font-size:24px;margin-top:0"><strong>Seminaras apie motinystės išmokas dirbantiems su IDV ir MB</strong></p><p>Dirbate su IDV arba turite savo MB?</p><p>Turbūt ne kartą girdėtoje, kad motinystės ir vaiko priežiūros<strong>išmokos jums nepriklausys</strong>. Arba bus labai mažos?</p>Jei tai tiesa, noriu šį<strong>mitą paneigti</strong>ir pakviesti įsigyti seminaro įrašą „<strong>Viskas apie motinystės išmokas dirbant su IDV ir MB</strong>”.<p>Šio seminaro metu, pasijusime kaip konsultacijoje, o ne paskaitoje ir susipažinsime, kokiu būdų motinystės išmokos yra skiriamos dirbant savarankiškai, bei pastrateguosime, ką galime padaryti, kad tos išmokos būtų didesnės.</p></a>&nbsp;</td></tr><tr><td style="text-align:center;padding:0"><a href="https://gretauzkuraite.lt/product/seminaras-viskas-apie-motinystes-ismokas-dirbant-su-idv/" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/viskas-apie-motinystes-ismokas-su-greta-uzkuraite-3.png" alt="viskas apie motinystes ismokas su greta uzkuraite 3" width="600" style="max-width:100%;height:auto"></a></td></tr><tr><td style="height:10px;background-color:#fff"></td></tr><tr><td style="text-align:center;color:#0b1b28;font-family:Montserrat,Verdana,sans-serif;font-size:14px;line-height:1.5;background-color:#f7f4f2;padding:24px;padding-bottom:0"><a href="https://gretauzkuraite.lt/motinystes-tevystes-ir-vaiko-prieziuros-ismoku-skaiciuokle-nemokama-versija/" target="_blank" style="text-decoration:none;color:inherit"><p style="font-size:24px;margin-top:0"><strong>Nemokama skaičiuoklė</strong></p><p>Nežinote, kokią VPA trukmę pasirinkti?</p><p>Išbandykite<strong>nemokamą VPA skaičiuoklę</strong>jau dabar. Skaičiuoklės dėka galėsite pasiskaičiuoti ne tik prognozuojamas VPA išmokas (kiekvienam VPA mėnesiui), bet ir pasilyginti, kuri išmokų trukmė (18 mėn. ar 24 mėn.) jums būtų finansiškai naudingesnė!</p></a></td></tr><tr><td style="text-align:center;padding:0"><a href="https://gretauzkuraite.lt/motinystes-tevystes-ir-vaiko-prieziuros-ismoku-skaiciuokle-nemokama-versija/" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/07/skaiciuokle-vpa.png" alt="vpa motinystes ismoku skaiciuokle, kokio dydzio motinystes vpa ismokas gausius" width="600" style="max-width:calc(100% - 40px);height:auto;padding:0 20px 40px 20px;background-color:#f7f4f2"></a></td></tr></table><table id="footer-1" border="0" cellspacing="0" cellpadding="0" width="100%"><tbody><tr><td style="padding:35px 24px 0;background-color:#0b1b28"><table width="100%" cellpadding="0" cellspacing="0"><tr><td style="width:552px;vertical-align:top"><table width="552" align="center"><tr><td style="padding:12px" align="center"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/greta-uzkuraite-logo-white.png" alt="greta uzkuraite logo" width="70" height="73" style="max-width:70px;height:auto;vertical-align:middle;font-family:Montserrat,Verdana,sans-serif;font-size:12px;color:#0b1b28;line-height:150%"></td></tr></table><table width="100%" cellpadding="0" cellspacing="0"><tr><td align="center"><table cellpadding="0" cellspacing="0"><tr><td style="padding:25px 12px"><a href="https://www.facebook.com/teisininke.greta.uzkuraite" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/facebook-greta-uzkuraite.png" alt="facebook" width="24" height="24" style="display:block;margin:0 auto;font-family:Montserrat,Verdana,sans-serif;font-size:14px;color:#0b1b28;line-height:150%"></a></td><td style="padding:25px 12px"><a href="https://www.instagram.com/greta.uzkur" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/instagram-greta-uzkuraite.png" alt="instagram" width="24" height="24" style="display:block;margin:0 auto;font-family:Montserrat,Verdana,sans-serif;font-size:14px;color:#0b1b28;line-height:150%"></a></td><td style="padding:25px 12px"><a href="https://www.linkedin.com/in/greta-uzkuraite/" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/linkedin-greta-uzkuraite.png" alt="linkedin" width="24" height="24" style="display:block;margin:0 auto;font-family:Montserrat,Verdana,sans-serif;font-size:14px;color:#0b1b28;line-height:150%"></a></td><td style="padding:25px 12px"><a href="https://www.youtube.com/@greta.uzkuraite" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/youtube-greta-uzkuraite.png" alt="youtube" width="24" height="24" style="display:block;margin:0 auto;font-family:Montserrat,Verdana,sans-serif;font-size:14px;color:#0b1b28;line-height:150%"></a></td><td style="padding:25px 12px"><a href="https://gretauzkuraite.lt/" target="_blank"><img src="https://gretauzkuraite.lt/wp-content/uploads/2024/06/web-greta-uzkuraite.png" alt="website_link" width="24" height="24" style="display:block;margin:0 auto;font-family:Montserrat,Verdana,sans-serif;font-size:14px;color:#0b1b28;line-height:150%"></a></td></tr></table></td></tr></table></td></tr></table></td></tr></tbody></table><table id="footer-2" border="0" cellspacing="0" cellpadding="0" width="100%"><tbody><tr><td style="padding:10px 24px 24px;background-color:#0b1b28"><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td style="width:552px;vertical-align:top"><table border="0" cellspacing="0" cellpadding="0" width="100%" style="word-wrap:anywhere"><tr><td style="color:#fff;font-family:Montserrat,Verdana,sans-serif;font-size:12px;line-height:1.5;padding:12px;text-align:center"><p style="margin:0">© Gretauzkuraite.lt</p><p style="margin:0"><br></p><p style="margin:0">Vilnius, Lithuania.</p><p style="margin:0">Šis laiškas buvo išsiųstas, nes atlikote testą<a style="color:#87a0b6" href="https://gretauzkuraite.lt">gretauzkuraite.lt</a>puslapyje.</p></td></tr></table><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding:6px 12px"><table border="0" cellspacing="0" cellpadding="0" width="65%"><tr><td style="font-size:0;line-height:0;border-top:1px solid #87a0b6">&nbsp;</td></tr></table></td></tr></table><table border="0" cellspacing="0" cellpadding="0" width="100%" style="word-wrap:anywhere"><tr><td style="color:#fff;font-family:Montserrat,Verdana,sans-serif;font-size:12px;line-height:1.5;padding:0 12px;text-align:center"><p style="margin:0"><a style="color:#87a0b6" href="http://gretauzkuraite.lt/privatumo-politika/" target="_blank">Privatumo politika</a></p></td></tr></table><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding:6px 12px"><table border="0" cellspacing="0" cellpadding="0" width="65%"><tr><td style="font-size:0;line-height:0;border-top:1px solid #87a0b6">&nbsp;</td></tr></table></td></tr></table><table border="0" cellspacing="0" cellpadding="0" width="100%" style="word-wrap:anywhere"><tr><td style="color:#fff;font-family:Montserrat,Verdana,sans-serif;font-size:12px;line-height:1.5;padding:0 12px;text-align:center"><p style="margin:0"><a style="color:#87a0b6" href="http://gretauzkuraite.lt/pirkimo-pardavimo-taisykles/" target="_blank">Pirkimo-pardavimo taisyklės</a></p></td></tr></table><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td align="center" style="padding:6px 12px"><table border="0" cellspacing="0" cellpadding="0" width="65%"><tr><td style="font-size:0;line-height:0;border-top:1px solid #87a0b6">&nbsp;</td></tr></table></td></tr></table></td></tr></table></td></tr></tbody></table>';


        return $part === 1 ? $firstPart : $secondPart;

    }
    
    