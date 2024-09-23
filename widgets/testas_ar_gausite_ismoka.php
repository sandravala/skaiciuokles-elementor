<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Testas_Ar_Gausite_Ismoka extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'testas_ar_gausite_ismoka';
    }

    public function get_title()
    {
        return esc_html__('Testas Ar Gausite Išmoką', TEXT_DOMAIN);
    }

    public function get_icon()
    {
        return 'testas_ar_gausite_ismoka_icon';
    }

    public function get_categories()
    {
        return ['custom-skaiciuokles'];
    }

    public function get_script_depends()
    {
        return ['testas_ar_gausite_ismoka_script'];
    }

    public function get_style_depends() {
    	return [ 'custom-skaiciuokles-style-1', 'jquery-ui-css' ];
    }

    public function get_keywords()
    {
        return ['testas', 'gausite', 'ismoka', 'išmoką', 'ar gausite ismoka'];
    }


    protected function _register_controls()
    {

        
        $this->start_controls_section(
            'omnisend-test',
            [
                'label' => __('OMNISEND', TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'omni',
            [
                 'type' => 'omni_control',
				'frontend_available' => false,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $widget_id = $this->get_id();
        global $post;
        $post_id = $post->ID;

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
                'kur_dirbo',
                'Kur dirbote?',
                array(
                    'Dirbau Lietuvoje' => 'lt',
                    'Dirbau užsienyje' => 'uzsienis',
                    'Buvau vaiko priežiūros atostogose su prieš tai gimusiu vaiku (-ais)' => 'vpa'
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
                'nepertraukiamai_dirbo_ilgiau',
                'Ar su darbo sutartimi nepertraukiamai dirbote 12 mėnesių ir ilgiau?',
                array(
                    'Taip' => 'taip',
                    'Ne' => 'ne',
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

        <form id="testo_forma" name="testas" novalidate style="display:grid;" class="formbox__skaiciuokles">
            <input type="hidden" id="widget_id" value="<?php echo $widget_id ?>">
            <input type="hidden" id="post_id" value="<?php echo $post_id ?>">
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
                <p id="cta-txt" class="nerodyti">Detalesnę informaciją gausite įvedę savo el. pašto adresą:</p>

                <div id="send-div" class="nerodyti">

                <fieldset id="email" class="formbox__container has_border" style="padding-bottom: 1em; padding-left: 0; display:block;">
                    <fieldset id="emailInputFieldset" class="formbox__container">
                        <div class="formbox__title">Jūsų el. pašto adresas</div>
                        <div class="formbox__body">
                            <div class="formbox__field">
                                <label for="email">
                                    <input type="email" name="email" id="emailInput" class="formbox__field-input" style="width: 100%;">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset id="nameInputFieldset" class="formbox__container">
                        <div class="formbox__title">Jūsų vardas</div>
                        <div class="formbox__body">
                            <div class="formbox__field">
                                <label for="name">
                                    <input type="text" name="name" id="nameInput" class="formbox__field-input" style="width: 100%;">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </fieldset>

                <fieldset id="alert" class="formbox__container nerodyti" style="padding-top: 1em; padding-bottom: 1em;">
                    <div id="alert-container-skaiciuokle" style="color: red; "></div>
                </fieldset>



                <fieldset class="formbox__container" style="display: flex;justify-content: center; padding-bottom: 0;">

                    <div class="formbox__body" style="display: flex;">
                        <div class="formbox__btn">
                            <button type="button" class="formbox__btn-send">
                            NORIU GAUTI DAUGIAU INFORMACIJOS</button>
                        </div>
                        <div class="formbox__btn nerodyti">
                            <button type="button" disabled class="formbox__btn">
                                <div id="loader" class="loader"></div>
                                Siunčiama...
                            </button>
                        </div>

                        <div id="check" style="padding-right: 1em;" class="nerodyti">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                            </svg>
                            <div style="align-content: center; padding-left: .5em; color: green;">Išsiųsta</div>
                        </div>

                        <div class="formbox__btn nerodyti">
                            <button type="reset" class="formbox__btn-reset">Išvalyti duomenis</button>
                        </div>
                    </div>
                </fieldset>
                </div>
            </div>
        </form>

        <?php
    }

    protected function _content_template() {}
}
