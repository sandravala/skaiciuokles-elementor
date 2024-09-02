<?php
class Testas_Ar_Gausite_Ismoka extends \Elementor\Widget_Base {

	public function get_name() {
		return 'testas_ar_gausite_ismoka';
	}

	public function get_title() {
		return esc_html__( 'Testas Ar Gausite Išmoką', TEXT_DOMAIN );
	}

	public function get_icon() {
		return 'testas_ar_gausite_ismoka_icon';
	}

	public function get_categories() {
		return [ 'custom-skaiciuokles' ];

	}

    public function get_script_depends()
    {
        return ['testas_ar_gausite_ismoka_script'];
    }

    // public function get_style_depends() {
	// 	return [ 'custom-skaiciuokles-style-1', 'jquery-ui-css' ];
	// }

	public function get_keywords() {
		return [ 'testas', 'gausite', 'ismoka', 'išmoką', 'ar gausite ismoka' ];
	}


    protected function _register_controls() {
        
        $this->start_controls_section(
            'testo_atsakymai',
            [
                'label' => __('Testo atsakymai el. paštu', TEXT_DOMAIN),
            ]
            );

            $this->add_control(
                'nevykde_veiklos_ats',
                [
                    'label' => esc_html__( 'Kai per paskutinius 12 mėn. nevykdė veiklos:', TEXT_DOMAIN ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( '', TEXT_DOMAIN ),
                    'placeholder' => esc_html__( 'Kai per paskutinius 12 mėn. nevykdė veiklos', TEXT_DOMAIN ),
                ]
            );
            
            $this->add_control(
                'dirbo_su_DS_ats',
                [
                    'label' => esc_html__( 'Kai dirbo su DS:', TEXT_DOMAIN ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( '', TEXT_DOMAIN ),
                    'placeholder' => esc_html__( 'Kai dirbo su DS', TEXT_DOMAIN ),
                ]
            );

            $this->add_control(
                'dirbo_su_VL_ats',
                [
                    'label' => esc_html__( 'Kai dirbo su VL:', TEXT_DOMAIN ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( '', TEXT_DOMAIN ),
                    'placeholder' => esc_html__( 'Kai dirbo su VL', TEXT_DOMAIN ),
                ]
            );

            $this->add_control(
                'dirbo_miksuotai_ats',
                [
                    'label' => esc_html__( 'Kai dirbo miksuotai:', TEXT_DOMAIN ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( '', TEXT_DOMAIN ),
                    'placeholder' => esc_html__( 'Kai dirbo miksuotai', TEXT_DOMAIN ),
                ]
            );

            $this->add_control(
                'MB_pajamos_paslaugos_pelnas_ats',
                [
                    'label' => esc_html__( 'Kai dirba su MB ir pajamas gauna pagal paslaugų teikimo sut. arba per pelną:', TEXT_DOMAIN ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( '', TEXT_DOMAIN ),
                    'placeholder' => esc_html__( 'Kai dirba su MB ir pajamas gauna pagal paslaugų teikimo sutartį arba pasiskirstant pelną', TEXT_DOMAIN ),
                ]
            );

            $this->add_control(
                'MB_vsd_imokos_savarankiskai_ats',
                [
                    'label' => esc_html__( 'Kai dirba su MB ir VSD įmokas mokėjo savarankiškai:', TEXT_DOMAIN ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( '', TEXT_DOMAIN ),
                    'placeholder' => esc_html__( 'Kai dirba su MB ir VSD įmokas mokėjo savarankiškai', TEXT_DOMAIN ),
                ]
            );

            $this->add_control(
                'MB_be_vsd_imoku_ats',
                [
                    'label' => esc_html__( 'Kai dirba su MB ir VSD įmokų nemokėjo:', TEXT_DOMAIN ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( '', TEXT_DOMAIN ),
                    'placeholder' => esc_html__( 'Kai dirba su MB ir VSD įmokų nemokėjo', TEXT_DOMAIN ),
                ]
            );

            $this->add_control(
                'IDV_naudojosi_lengvatomis_ats',
                [
                    'label' => esc_html__( 'Kai dirba su IDV ir naudojosi mokestinėmis lengvatomis:', TEXT_DOMAIN ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( '', TEXT_DOMAIN ),
                    'placeholder' => esc_html__( 'Kai dirba su IDV ir naudojosi mokestinėmis lengvatomis', TEXT_DOMAIN ),
                ]
            );

            $this->add_control(
                'IDV_pajamos_mazesnes_ats',
                [
                    'label' => esc_html__( 'Kai dirba su IDV ir metinės pajamos mažesnės, nei 18 000 €:', TEXT_DOMAIN ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( '', TEXT_DOMAIN ),
                    'placeholder' => esc_html__( 'Kai dirba su IDV ir metinės pajamos mažesnės, nei 18 000 €', TEXT_DOMAIN ),
                ]
            );

            $this->add_control(
                'IDV_mokesciai_karta_per_metus_ats',
                [
                    'label' => esc_html__( 'Kai dirba su IDV ir metinės pajamos didesnės, nei 18 000 €, bet mokesčius moka 1 k. / metus:', TEXT_DOMAIN ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( '', TEXT_DOMAIN ),
                    'placeholder' => esc_html__( 'Kai dirba su IDV ir metinės pajamos didesnės, nei 18 000 €, bet mokesčius moka 1 k. / metus', TEXT_DOMAIN ),
                ]
            );

            $this->add_control(
                'IDV_mokesciai_kas_menesi_ats',
                [
                    'label' => esc_html__( 'Kai dirba su IDV ir metinės pajamos didesnės, nei 18 000 €, ir mokesčius moka 1 k. / mėnesį:', TEXT_DOMAIN ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( '', TEXT_DOMAIN ),
                    'placeholder' => esc_html__( 'Kai dirba su IDV ir metinės pajamos didesnės, nei 18 000 €, ir mokesčius moka 1 k. / mėnesį', TEXT_DOMAIN ),
                ]
            );
        

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();


        $fieldsArray = array(
            array('ar_vykde_veikla', 'Ne', 'nevykde_veiklos_ats'), 
            ['ar_vykde_veikla', 'Taip', 'kokiu_principu_dirbo'],
            ['kokiu_principu_dirbo', 'DS', 'dirbo_su_DS_ats'],
            ['kokiu_principu_dirbo', 'VL', 'dirbo_su_VL_ats'],
            ['kokiu_principu_dirbo', 'miksuotai', 'dirbo_miksuotai_ats'],
            ['kokiu_principu_dirbo', 'MB', 'kaip_gauna_pajamas_MB'],
            
            ['kaip_gauna_pajamas_MB', 'Taip', 'MB_pajamos_paslaugos_pelnas_ats'],
            ['kaip_gauna_pajamas_MB', 'Ne', 'ar_moka_VSD_MB'],
            ['ar_moka_VSD_MB', 'Taip', 'MB_vsd_imokos_savarankiskai_ats'],
            ['ar_moka_VSD_MB', 'Ne', 'MB_be_vsd_imoku_ats'],
            
            ['kokiu_principu_dirbo', 'IDV', 'ar_naudojosi_lengvatom'],    
            ['ar_naudojosi_lengvatom', 'Taip', 'IDV_naudojosi_lengvatomis_ats'],
            ['ar_naudojosi_lengvatom', 'Ne', 'metines_IDV_pajamos'],
            ['metines_IDV_pajamos', 'maziau', 'IDV_pajamos_mazesnes_ats'],
            ['metines_IDV_pajamos', 'daugiau', 'kaip_moka_mokescius_IDV'],
            ['kaip_moka_mokescius_IDV', 'kas_metus', 'IDV_mokesciai_karta_per_metus_ats'],
            ['kaip_moka_mokescius_IDV', 'kas_menesi', 'IDV_mokesciai_kas_menesi_ats'],
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

        $kl = array(
            array(
                'ar_vykde_veikla',
                'Ar per paskutinius 24 mėnesius dirbote ar vykdėte savo veiklą?', 
                array(
                    'Taip' => 'Taip',
                    'Ne' => 'Ne',
                ),
            ),
            array(
                'kokiu_principu_dirbo',
                'Kokiu principu dirbote?', 
                array(
                    'Darbo sutartis' => 'DS',
                    'IDV' => 'IDV',
                    'VL' => 'VL',
                    'Turiu savo MB' => 'MB',
                    'Dirbau miksuotai' => 'miksuotai',
                ),
            ),
            array(
                'ar_naudojosi_lengvatom',
                'Ar naudojotės valstybės skirtomis lengvatomis, kurios atleidžia nuo mokesčių mokėjimo?', 
                array(
                    'Taip' => 'Taip',
                    'Ne' => 'Ne',
                ),
            ),
            array(
                'metines_IDV_pajamos',
                'Jūsų bendros metinės pajamos iš veiklos buvo:', 
                array(
                    '18 000 € ir didesnės' => 'daugiau',
                    'Mažesnės, nei 18 000 €' => 'maziau',
                ),
            ),
            array(
                'kaip_moka_mokescius_IDV',
                'Kaip mokate mokesčius?', 
                array(
                    'Kartą per metus' => 'kas_metus',
                    'Kas mėnesį (pervedu avansinius mokėjimus SODRAI)' => 'kas_menesi',
                ),
            ),
            array(
                'kaip_gauna_pajamas_MB',
                'Ar gaunate pajamas tik pagal civilinę paslaugų teikimo sutartį arba pasiskirstant pelną?', 
                array(
                    'Taip' => 'Taip',
                    'Ne' => 'Ne',
                ),
            ),
            array(
                'ar_moka_VSD_MB',
                'Ar mokėjote VSD įmokas savarankiškai?', 
                array(
                    'Taip' => 'Taip',
                    'Ne' => 'Ne',
                ),
            ),
        );


            ?>

            <form method="post" id="testo_forma" name="testas" novalidate style="display:grid;">
                <div class="container" style="justify-self:center;width:auto;">

                    <?
                        foreach ($kl as $q) {

                            $classNerodyti = array_search($q, $kl) > 0 ? 'nerodyti' : '';
                           
                            echo '<div id="q-' . $q[0] . '" class="' . $classNerodyti . '"><label for="form-field-' . $q[0] . '" class="question">' . $q[1] . '</label><div class="radioDiv">';
                            
                            $optionCount = 0;
                            
                            foreach ($q[2] as $optionText => $optionValue) {
                                echo '<input type="radio" value="' . $optionValue . '" id="form-field-' . $q[0] . '-' . $optionCount . '" name="' . $q[0] . '"><label for="form-field-' . $q[0] . '-' . $optionCount . '">' . $optionText . '</label>';
                                $optionCount++;
                            };
                
                            echo '</div></div>';
                        }
                    ?>
                   
                        <p id="ats" class="nerodyti"><strong>ATSAKYMAS: </strong></p>
                        <p id="ats-txt" class="nerodyti"></p>

                    <div id="q-email" class="nerodyti">
                        <label for="form-field-testo_forma_email" class="">Jūsų el. paštas </label>
                        <input type="email" name="form_fields[testo_forma_email]" id="form-field-testo_forma_email" class="">
                    </div>
                   
                    <div id="buttons">
                        <div id="reset-div" class="nerodyti">
                            <button type="reset" class="" id="reset_mygtukas">
                                <span>
                                    <span class=""> </span> <span class="">IŠ NAUJO</span>
                                </span>
                            </button>
                        </div>
                        <div id="send-div" class="nerodyti">
                            <button type="button" class="" id="send_mygtukas">
                                <span>
                                    <span class=""> </span> <span class="">NORIU GAUTI DAUGIAU INFORMACIJOS</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>               

            <?php
    }
    
    protected function _content_template() {
        ?>
       
        <?php
    }


}