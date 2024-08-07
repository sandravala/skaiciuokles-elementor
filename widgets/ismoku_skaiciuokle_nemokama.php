<?php
class Ismoku_Skaiciuokle_Nemokama extends \Elementor\Widget_Base

{

    public function get_name()
    {
        return 'ismoku_skaiciuokle_nemokama';
    }

    public function get_title()
    {
        return esc_html__('Nemokama VPA išmokų skaičiuoklė', TEXT_DOMAIN);
    }

    public function get_icon()
    {
        return 'ismoku_skaiciuokle_nemokama_icon';
    }

    public function get_categories()
    {
        return ['custom-skaiciuokles'];

    }

    public function get_script_depends()
    {
        return ['ismoku_skaiciuokle_nemokama_script'];
    }

    public function get_style_depends() {
		return [ 'custom-skaiciuokles-style-1', 'jquery-ui-css' ];
	}

    public function get_keywords()
    {
        return ['vpa', 'skaiciuokle', 'skaičiuoklė', 'ismoku', 'išmokų', 'nemokama'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'skaiciuokles_tipo_pasirinkimas',
            [
                'label' => __('Ar mokama skaičiuoklė', TEXT_DOMAIN),
            ]
        );
        
        $this->add_control(
            'skaiciuokles_tipas',
            [
                'label' => esc_html__( 'Mokama skaičiuoklė?', TEXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Taip', TEXT_DOMAIN ),
                'label_off' => esc_html__( 'Ne', TEXT_DOMAIN ),
                'return_value' => 'yes',
                'default' => 'no',
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();
        
        
        $this->start_controls_section(
            'koeficientai',
            [
                'label' => __('Koeficientai', TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'tevystes_tarifas',
            [
                'label' => esc_html__('Tėvystės tarifas, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
				'frontend_available' => true,
            ]
        );

        $this->add_control(
            'motinystes_tarifas',
            [
                'label' => esc_html__('Motinystės tarifas, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
				'frontend_available' => true,
            ]
        );

        $this->add_control(
            'npm_tarifas',
            [
                'label' => esc_html__('Neperleidžiamų mėnesių tarifas, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
				'frontend_available' => true,
            ]
        );

        $this->add_control(
            'vpa_18_tarifas',
            [
                'label' => esc_html__('VPA 18 mėn. tarifas, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
				'frontend_available' => true,
            ]
        );

        $this->add_control(
            'vpa_24_tarifas_1',
            [
                'label' => esc_html__('VPA 24 mėn. tarifas 1, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
				'frontend_available' => true,
            ]
        );

        $this->add_control(
            'vpa_24_tarifas_2',
            [
                'label' => esc_html__('VPA 24 mėn. tarifas 2, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
				'frontend_available' => true,
            ]
        );

        $this->add_control(
            'mokesciu_tarifas',
            [
                'label' => esc_html__('Mokesčiai nuo išmokų, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
				'frontend_available' => true,
            ]
        );

        $this->add_control(
            'bazine_soc_ismoka',
            [
                'label' => esc_html__('Bazinė soc išmoka, €', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 55,
				'frontend_available' => true,
            ]
        );

        $this->add_control(
            'minimumas',
            [
                'label' => esc_html__('Minimalus darbo užmokestis, €', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 924,
				'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'vdu',
            [
                'label' => __('VDU duomenys', TEXT_DOMAIN),
            ]
        );

            $this->add_control(
                'vdu_control',
                [
                    'label' => __('Custom Control Table', TEXT_DOMAIN),
                    'type' => 'vdu',
                    'frontend_available' => true,
                ]
            );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
		

        ?>
        <div class="motinystes-ismoku-skaiciuokle">
            <form name="formbox" id="ismoku_skaiciuokle" class="formbox__skaiciuokles">
            <?  if ( 'yes' === $settings['skaiciuokles_tipas'] ) {  ?> 
            <fieldset id="kuria-ismoka-rodyti" class="formbox__container has_border">
            <div class="formbox__title">Pažymėkite, kurias išmokas skaičiuoti</div>
            <div class="formbox__body">
                <div class="formbox__field">
                    <div class="formbox__field-checkbox">
                        <input type="checkbox" value="1" name="kuria-ismoka-rodyti" id="motinystesCheck">
                        <label for="motinystesCheck">Nėštumo ir gimdymo atostogų</label>
                    </div>
                    <div class="formbox__field-checkbox">
                        <input type="checkbox" value="1" name="kuria-ismoka-rodyti" id="tevystesCheck">
                        <label for="tevystesCheck">Tėvystės (30 atostogų dienų)</label>
                    </div>
                    <div class="formbox__field-checkbox">
                        <input type="checkbox" value="1" name="kuria-ismoka-rodyti" id="vpaCheck">
                        <label for="vpaCheck">Vaiko priežiūros atostogų (VPA)</label>
                    </div>
                </div>
            </div>
            </fieldset>
                <? } ?>
            <fieldset id="vpa-trukme" class="formbox__container has_border <? if ( 'yes' === $settings['skaiciuokles_tipas'] ) { echo 'nerodyti';} ?> ">
                <div class="formbox__title">VPA išmokos gavimo trukmė</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="18" name="vpa-trukme" id="vpaTrukme18Radio">
                            <label for="vpaTrukme18Radio">18 mėn.</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="24" name="vpa-trukme" id="vpaTrukme24Radio">
                            <label for="vpaTrukme24Radio">24 mėn.</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="vpa-ims" class="formbox__container has_border <? if ( 'yes' === $settings['skaiciuokles_tipas'] ) { echo 'nerodyti';} ?>">
                <div class="formbox__title">Vaiko priežiūros atostogomis naudosis:</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="1" name="vpa-ims" id="mamosRadio">
                            <label for="mamosRadio">mama</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="2" name="vpa-ims" id="tecioRadio">
                            <label for="tecioRadio">tėtis</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="npm-naudosis" class="formbox__container has_border nerodyti">
                <div id="npm-naudosis-label" class="formbox__title">Naudosis 2 neperleidžiamais VPA mėnesiais?</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="1" name="npm-naudosis" id="npmTaipRadio">
                            <label for="npmTaipRadio">Taip</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="2" name="npm-naudosis" id="npmNeRadio">
                            <label for="npmNeRadio">Ne</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <?  if ( 'yes' === $settings['skaiciuokles_tipas'] ) {  ?> 
            <fieldset id="mamos-pajamu-tipas" class="formbox__container has_border nerodyti">
                <div class="formbox__title">Mamos pajamų tipas</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="1" name="mamos-pajamu-tipas" id="mamosDUpajamos">
                            <label for="mamosDUpajamos">Darbo užmokestis (pagal darbo sutartį)</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="2" name="mamos-pajamu-tipas" id="mamosIVpajamos">
                            <label for="mamosIVpajamos">Individualios veiklos pajamos</label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <? } ?>

            <fieldset id="mamos-pajamos" class="formbox__container has_border nerodyti">
                <div id="mamos-pajamos-label" class="formbox__title">Mamos pajamos</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <label for="mamosPajamuInput">
                            <input type="number" value="0" step="100" min="0" required name="mamos-pajamos" id="mamosPajamuInput" class="formbox__field-input"><span> € / mėn.</span>
                        </label>
                    </div>
                </div>
            </fieldset>

            <?  if ( 'yes' === $settings['skaiciuokles_tipas'] ) {  ?> 
            <fieldset id="mamos-islaidu-tipas" class="formbox__container has_border nerodyti">
                <div class="formbox__title">Kaip skaičiuojamos mamos išlaidos?</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="1" name="mamos-islaidu-tipas" id="mamosIslaidos30">
                            <label for="mamosIslaidos30">30% nuo pajamų</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="2" name="mamos-islaidu-tipas" id="mamosIslaidosFaktas">
                            <label for="mamosIslaidosFaktas">Faktinės išlaidos</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="mamos-faktines-islaidos" class="formbox__container has_border nerodyti">
                <div class="formbox__title">Vidutinės faktinės išlaidos</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <label for="formbox-field-10_1">
                            <input type="number" value="0" step="100" min="0" name="mamos-faktines-islaidos" id="mamosIslaiduInput" class="formbox__field-input"><span> € / mėn.</span>
                        </label>
                    </div>
                </div>
            </fieldset>

            <fieldset id="tecio-pajamu-tipas" class="formbox__container has_border nerodyti">
                <div class="formbox__title">Tėčio pajamų tipas</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="1" name="tecio-pajamu-tipas" id="tecioDUpajamos">
                            <label for="tecioDUpajamos">Darbo užmokestis</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="2" name="tecio-pajamu-tipas" id="tecioIVpajamos">
                            <label for="tecioIVpajamos">Individuali veikla</label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <? } ?>

            <fieldset id="tecio-pajamos" class="formbox__container has_border nerodyti">
                <div id="tecio-pajamos-label" class="formbox__title">Tėčio pajamos</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <label for="tecioPajamuInput">
                            <input type="number" value="0" step="100" min="0" required name="tecio-pajamos" id="tecioPajamuInput"  class="formbox__field-input"><span> € / mėn.</span>
                        </label>
                    </div>
                </div>
            </fieldset>

            <?  if ( 'yes' === $settings['skaiciuokles_tipas'] ) {  ?> 
            <fieldset id="tecio-islaidu-tipas" class="formbox__container has_border nerodyti">
                <div class="formbox__title">Kaip skaičiuojamos tėčio išlaidos?</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="1" name="tecio-islaidu-tipas" id="tecioIslaidos30">
                            <label for="tecioIslaidos30">30% nuo pajamų</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="2" name="tecio-islaidu-tipas" id="tecioIslaidosFaktas">
                            <label for="tecioIslaidosFaktas">Faktinės išlaidos</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="tecio-faktines-islaidos" class="formbox__container has_border nerodyti">
                <div class="formbox__title">Vidutinės faktinės išlaidos</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <label for="tecioIslaiduInput">
                            <input type="number" value="0" step="100" min="0" name="tecio-faktines-islaidos" id="tecioIslaiduInput" class="formbox__field-input"><span> € / mėn.</span>
                        </label>
                    </div>
                </div>
            </fieldset>
            <? } ?>

            <fieldset id="gimdymo-data" class="formbox__container has_border <? if ( 'yes' === $settings['skaiciuokles_tipas'] ) { echo 'nerodyti';} ?>">
                <div class="formbox__title">Numatyta gimdymo data</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                            <input type="text" name="gimdymo-data" id="gimdymoDatosInput" placeholder="yyyy-mm-dd">
                    </div>
                </div>
            </fieldset>

            <fieldset id="mygtukai" class="formbox__container has_border nerodyti" style="display: flex;justify-content: center;">
                <div class="formbox__body">
                    <div class="formbox__btn">
                        <button type="submit" class="formbox__btn-calc">Skaičiuoti</button>
                        <button type="reset" class="formbox__btn-reset">Išvalyti duomenis</button>
                    </div>
                </div>
            </fieldset>

            </form>
            <fieldset id="rezultatai" class="formbox__container has_border nerodyti">
                <div id="message-container-skaiciuokle">message</div>
                <div id="result-container-skaiciuokle">result</div>
            </fieldset>

        </div>

		<?php
    }

    protected function _content_template()
    {

    }

}

