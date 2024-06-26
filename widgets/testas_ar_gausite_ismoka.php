<?php
class Testas_Ar_Gausite_Ismoka extends \Elementor\Widget_Base {

	public function get_name() {
		return 'testas_ar_gausite_ismoka';
	}

	public function get_title() {
		return esc_html__( 'Testas Ar Gausite Išmoką', 'skaiciuokles-elementor' );
	}

	public function get_icon() {
		return 'testas_ar_gausite_ismoka_icon';
	}

	public function get_categories() {
		return [ 'custom-skaiciuokles' ];

	}

	public function get_keywords() {
		return [ 'testas', 'gausite', 'ismoka', 'išmoką' ];
	}


    protected function _register_controls() {
        $this->start_controls_section(
            'section_form',
            [
                'label' => __( 'Form', 'skaiciuokles-elementor' ),
            ]
        );


       

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $testoDuomenys = array(
            "Ar per paskutinius 24 mėnesius dirbote ar vykdėte savo veiklą?" => array(
                "Ne" => "Išmokos galimai nepriklauso, jei dirbote trumpiau nei 12 mėnesių per paskutinius 24 mėnesius iki teisės į išmoką dienos. Socialiniam motinystės stažui sukaupti reikia bent 12 mėnesių per paskutinius 24 metus.",
                "Taip" => array(
                    "Kokiu principu dirbote?" => array(
                        "DS" => "Tikėtina, kad reikiamą socialinį motinystės stažą būsite sukaupę, kurio reikia bent 12 mėnesių per paskutinius 24 metus ir motinystės išmokas gausite. Dirbant su DS (darbo sutartimi), šis stažas kaupiasi nuo sutarties pasirašymo dienos ir neturi įtakos, jeigu keitėte darbovietes per šį laikotarpį.",
                        "VL" => "Deja, dirbantiems tik su veiklos liudijimu, išmokos galimai nepriklauso.",
                        "dirbau miksuotai" => "Visos draudžiamosios pajamos, nuo kurių mokėjote pilnas VSD įmokas, bus įtrauktos į išmokų apskaičiavimą. Pvz., dirbote su DS ir su IDV, tuomet vertinamos tiek iš DS, tiek iš IDV gaunamos draudžiamosios pajamos. Bet jei dirbote su VL ir MB - tuomet jau kyla klausimų, ar tikrai priklausys motinystės išmokos, nes galimai neturite pilno valstybinio socialinio draudimo. Visus kompleksiniu atvejus yra naudingiau vertinti individualiai, kadangi skirtingoms situacijoms, gali būti randami skirtingi sprendimai ir galimybės.Tai padaryti galime individualios konsultacijos metu.",
                        "turiu savo MB" => array(
                            "Ar gaunate pajamas tik pagal civilinę paslaugų teikimo sutartį arba pasiskirstant pelną?" => array(
                                "Taip" => "Greičiausiai nesate drausti valstybiniu socialiniu draudimu ir tikėtina, kad motinystės išmokos jums nepriklausys.",
                                "Ne" => array(
                                    "Ar mokėjote VSD įmokas savarankiškai?" => array(
                                        "Taip" => "Tikėtina, kad gausite išmokas. Visgi, dėl komplikuoto MB ir socialinių garantijų santykio, praverstų detaliau įsivertinti, kokias įmokas ir kokiu formatu mokėjote. Tai galima būtų padaryti individualios konsultacijos metu",
                                        "Ne" => "Greičiausiai nesate drausti valstybiniu socialiniu draudimu ir tikėtina, kad motinystės išmokos jums nepriklausys."
                                    ),
                                ),
                            ),
                        ),
                        "IDV" => array(
                            "Ar naudojotės valstybės skirtomis  lengvatomis, kurios atleidžia nuo mokesčių mokėjimo?" => array(
                                "Taip" => "Deja, vykdant individualią veiklą ir naudojantis lengvatomis, atleidžiančiomis  nuo mokesčių, išmokos galimai nepriklauso.",
                                "Ne" => array(
                                    "Jūsų bendros metinės pajamos iš veiklos buvo:" => array(
                                        "Mažesnės, nei 18 000 €" => "Reikėtų individualiai vertinti, ar uždirbtų pajamų kiekis suteiks reikalingą socialinį motinystės stažą, kuris yra reikalingas išmokos gauti. Tai galima padaryti individualios konsultacijos metu.",
                                        "18 000 € ir didesnės" => array(
                                            "Kaip mokate mokesčius?" => array(
                                                "Kartą per metus" => "Tikėtina, kad motinystės išmokos Jums priklausys, tik gali būti neišmokėtos laiku, kai mokesčiai mokami kartą metuose. Tokiu atveju rekomenduojama pradėti daryti avansinius mokėjimus ir siųsti SAV pranešimus Sodrai kas mėnesį. Detalias gaires, kaip tai padaryti su vaizdiniais pavyzdžiais ir paaiškinimais galite rasti prisijungę prie uždaros VPA grupės.",
                                                "Kas mėnesį (pervedu avansinius mokėjimus SODRAI)" => "Puiku! Jei mokesčiai mokami avansu - tikėtina, kad motinystės išmokos Jums priklauso ir gausite jas laiku."
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        )
                    ),
                ),
                
            ),
            
        );


        $fieldsArray = array(
            array('ar_vykde_veikla', 'Ne', 'nevykde_veiklos_ats'), 
            ['ar_vykde_veikla', 'Taip', 'kokiu_principu_dirbo'],
            ['kokiu_principu_dirbo', 'DS', 'dirbo_su_DS_ats'],
            ['kokiu_principu_dirbo', 'VL', 'dirbo_su_VL_ats'],
            ['kokiu_principu_dirbo', 'dirbau miksuotai', 'dirbo_miksuotai_ats'],
            ['kokiu_principu_dirbo', 'turiu savo MB', 'kaip_gauna_pajamas_MB'],
            
            ['kaip_gauna_pajamas_MB', 'Taip', 'MB_pajamos_paslaugos_pelnas_ats'],
            ['kaip_gauna_pajamas_MB', 'Ne', 'ar_moka_VSD_MB'],
            ['ar_moka_VSD_MB', 'Taip', 'MB_vsd_imokos_savarankiskai_ats'],
            ['ar_moka_VSD_MB', 'Ne', 'MB_be_vsd_imoku_ats'],
            
            ['kokiu_principu_dirbo', 'IDV', 'ar_naudojosi_lengvatom'],    
            ['ar_naudojosi_lengvatom', 'Taip', 'IDV_naudojosi_lengvatomis_ats'],
            ['ar_naudojosi_lengvatom', 'Ne', 'metines_IDV_pajamos'],
            ['metines_IDV_pajamos', 'maziau', 'IDV_pajamos_mazesnes_ats'],
            ['metines_IDV_pajamos', 'daugiau', 'kaip_moka_mokescius_IDV'],
            ['kaip_moka_mokescius_IDV', 'kas metus', 'IDV_mokesciai_karta_per_metus_ats'],
            ['kaip_moka_mokescius_IDV', 'kas menesi', 'IDV_mokesciai_kas_menesi_ats'],
        );

        $klausimaiAtsakymai = array(
            "Ar per paskutinius 24 mėnesius dirbote ar vykdėte savo veiklą?" => array( "Ne", "Taip"),
            "Kokiu principu dirbote?" => array( "DS", "VL", "dirbau miksuotai", "turiu savo MB", "IDV"),                      
            "Ar gaunate pajamas tik pagal civilinę paslaugų teikimo sutartį arba pasiskirstant pelną?" => array( "Taip", "Ne"),
            "Ar mokėjote VSD įmokas savarankiškai?" => array( "Taip", "Ne"),
            "Ar naudojotės valstybės skirtomis  lengvatomis, kurios atleidžia nuo mokesčių mokėjimo?" => array( "Taip", "Ne"),
            "Jūsų bendros metinės pajamos iš veiklos buvo:" => array( "Mažesnės, nei 18 000 €", "18 000 € ir didesnės" ),
            "Kaip mokate mokesčius?" => array( "Kartą per metus", "Kas mėnesį (pervedu avansinius mokėjimus SODRAI)"),
        );

        $rezultatai = array(
            "" => "Išmokos galimai nepriklauso, jei dirbote trumpiau nei 12 mėnesių per paskutinius 24 mėnesius iki teisės į išmoką dienos. Socialiniam motinystės stažui sukaupti reikia bent 12 mėnesių per paskutinius 24 metus.",
            "" => "Tikėtina, kad reikiamą socialinį motinystės stažą būsite sukaupę, kurio reikia bent 12 mėnesių per paskutinius 24 metus ir motinystės išmokas gausite. Dirbant su DS (darbo sutartimi), šis stažas kaupiasi nuo sutarties pasirašymo dienos ir neturi įtakos, jeigu keitėte darbovietes per šį laikotarpį.",
            "" => "Deja, dirbantiems tik su veiklos liudijimu, išmokos galimai nepriklauso.",
            "" => "Visos draudžiamosios pajamos, nuo kurių mokėjote pilnas VSD įmokas, bus įtrauktos į išmokų apskaičiavimą. Pvz., dirbote su DS ir su IDV, tuomet vertinamos tiek iš DS, tiek iš IDV gaunamos draudžiamosios pajamos. Bet jei dirbote su VL ir MB - tuomet jau kyla klausimų, ar tikrai priklausys motinystės išmokos, nes galimai neturite pilno valstybinio socialinio draudimo. Visus kompleksiniu atvejus yra naudingiau vertinti individualiai, kadangi skirtingoms situacijoms, gali būti randami skirtingi sprendimai ir galimybės.Tai padaryti galime individualios konsultacijos metu.",
            "" =>  "Greičiausiai nesate drausti valstybiniu socialiniu draudimu ir tikėtina, kad motinystės išmokos jums nepriklausys.",
            "" =>  "Tikėtina, kad gausite išmokas. Visgi, dėl komplikuoto MB ir socialinių garantijų santykio, praverstų detaliau įsivertinti, kokias įmokas ir kokiu formatu mokėjote. Tai galima būtų padaryti individualios konsultacijos metu",
            "" => "Deja, vykdant individualią veiklą ir naudojantis lengvatomis, atleidžiančiomis  nuo mokesčių, išmokos galimai nepriklauso.",
            "" => "Reikėtų individualiai vertinti, ar uždirbtų pajamų kiekis suteiks reikalingą socialinį motinystės stažą, kuris yra reikalingas išmokos gauti. Tai galima padaryti individualios konsultacijos metu.",
            "" => "Tikėtina, kad motinystės išmokos Jums priklausys, tik gali būti neišmokėtos laiku, kai mokesčiai mokami kartą metuose. Tokiu atveju rekomenduojama pradėti daryti avansinius mokėjimus ir siųsti SAV pranešimus Sodrai kas mėnesį. Detalias gaires, kaip tai padaryti su vaizdiniais pavyzdžiais ir paaiškinimais galite rasti prisijungę prie uždaros VPA grupės.",
            "" => "Puiku! Jei mokesčiai mokami avansu - tikėtina, kad motinystės išmokos Jums priklauso ir gausite jas laiku."
        );

        if ( ! empty( $settings['questions_list'] ) ) {
            ?>
            <div class="conditional-form">
                <form id="conditional-form">
                    <?php foreach ( $settings['questions_list'] as $index => $question ) : ?>
                        <div class="form-step" id="step-<?php echo $index; ?>" <?php echo $index > 0 ? 'style="display:none;"' : ''; ?>>
                            <label><?php echo $question['question_text']; ?></label><br>
                            <?php foreach ( $question['options_list'] as $option_index => $option ) : ?>
                                <input type="radio" name="step-<?php echo $index; ?>" value="<?php echo $option['next_step']; ?>" id="option-<?php echo $index; ?>-<?php echo $option_index; ?>"><?php echo $option['option_text']; ?><br>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                    <?php foreach ( $settings['results_list'] as $result_index => $result ) : ?>
                        <div class="form-result" id="result-<?php echo $result_index; ?>" style="display:none;">
                            <p><?php echo $result['result_text']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </form>
            </div>
            <script>
                (function($) {
                    $(document).ready(function() {
                        $('#conditional-form input[type="radio"]').on('change', function() {
                            var nextStep = $(this).val();
                            $('.form-step').hide();
                            $('.form-result').hide();
                            if (nextStep.startsWith('result_')) {
                                $('#' + nextStep).show();
                            } else {
                                $('#step-' + nextStep).show();
                            }
                        });
                    });
                })(jQuery);
            </script>
            <?php
        }
    }
    
    protected function _content_template() {
        ?>
        <#
        var settings = settings;
        if ( settings.questions_list.length ) {
        #>
            <div class="conditional-form">
                <form id="conditional-form">
                    <# _.each( settings.questions_list, function( question, index ) { #>
                        <div class="form-step" id="step-{{{ index }}}" {{{ index > 0 ? 'style="display:none;"' : '' }}}>
                            <label>{{{ question.question_text }}}</label><br>
                            <# _.each( question.options_list, function( option, option_index ) { #>
                                <input type="radio" name="step-{{{ index }}}" value="{{{ option.next_step }}}" id="option-{{{ index }}}-{{{ option_index }}}">{{{ option.option_text }}}<br>
                            <# }); #>
                        </div>
                    <# }); #>
                    <# _.each( settings.results_list, function( result, result_index ) { #>
                        <div class="form-result" id="result-{{{ result_index }}}" style="display:none;">
                            <p>{{{ result.result_text }}}</p>
                        </div>
                    <# }); #>
                </form>
            </div>
            <script>
                (function($) {
                    $(document).ready(function() {
                        $('#conditional-form input[type="radio"]').on('change', function() {
                            var nextStep = $(this).val();
                            $('.form-step').hide();
                            $('.form-result').hide();
                            if (nextStep.startsWith('result_')) {
                                $('#' + nextStep).show();
                            } else {
                                $('#step-' + nextStep).show();
                            }
                        });
                    });
                })(jQuery);
            </script>
        <#
        }
        #>
        <?php
    }


}