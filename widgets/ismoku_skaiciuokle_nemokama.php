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
		return [ 'custom-skaiciuokles-style-1' ];
	}

    public function get_keywords()
    {
        return ['vpa', 'skaiciuokle', 'skaičiuoklė', 'ismoku', 'išmokų', 'nemokama'];
    }

    protected function _register_controls()
    {
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
            ]
        );

        $this->add_control(
            'motinystes_tarifas',
            [
                'label' => esc_html__('Motinystės tarifas, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
            ]
        );

        $this->add_control(
            'npm_tarifas',
            [
                'label' => esc_html__('Neperleidžiamų mėnesių tarifas, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
            ]
        );

        $this->add_control(
            'vpa_18_tarifas',
            [
                'label' => esc_html__('VPA 18 mėn. tarifas, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
            ]
        );

        $this->add_control(
            'vpa_24_tarifas_1',
            [
                'label' => esc_html__('VPA 24 mėn. tarifas 1, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
            ]
        );

        $this->add_control(
            'vpa_24_tarifas_2',
            [
                'label' => esc_html__('VPA 24 mėn. tarifas 2, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
            ]
        );

        $this->add_control(
            'mokesciu_tarifas',
            [
                'label' => esc_html__('Mokesčiai nuo išmokų, %', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 78.00,
            ]
        );

        $this->add_control(
            'bazine_soc_ismoka',
            [
                'label' => esc_html__('Bazinė soc išmoka, €', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 55,
            ]
        );

        $this->add_control(
            'minimumas',
            [
                'label' => esc_html__('Minimalus darbo užmokestis, €', TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 924,
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
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {

        ?>
        <div>
            <form name="formbox" id="ismoku_skaiciuokle_nemokama" class="formbox__skaiciuokles">
            <fieldset id="fieldset-1" class="formbox__container has_border">
                <div class="formbox__title">Pažymėkite, kurias išmokas skaičiuoti</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-checkbox">
                            <input type="checkbox" value="1" name="formbox-field-1" id="formbox-field-1_1">
                            <label for="formbox-field-1_1">Nėštumo ir gimdymo atostogų</label>
                        </div>
                        <div class="formbox__field-checkbox">
                            <input type="checkbox" value="1" name="formbox-field-2" id="formbox-field-2_1">
                            <label for="formbox-field-2_1">Tėvystės (30 atostogų dienų)</label>
                        </div>
                        <div class="formbox__field-checkbox">
                            <input type="checkbox" value="1" name="formbox-field-3" id="formbox-field-3_1">
                            <label for="formbox-field-3_1">Vaiko priežiūros atostogų (VPA)</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fieldset-2" class="formbox__container has_border">
                <div class="formbox__title">VPA išmokos gavimo trukmė</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="18" name="formbox-field-4" id="formbox-field-4_1">
                            <label for="formbox-field-4_1">18 mėn.</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="24" name="formbox-field-4" id="formbox-field-4_2">
                            <label for="formbox-field-4_2">24 mėn.</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fieldset-3" class="formbox__container has_border">
                <div class="formbox__title">Vaiko priežiūros atostogomis naudosis:</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="1" name="formbox-field-5" id="formbox-field-5_1">
                            <label for="formbox-field-5_1">mama</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="2" name="formbox-field-5" id="formbox-field-5_2">
                            <label for="formbox-field-5_2">tėtis</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fieldset-4" class="formbox__container has_border">
                <div class="formbox__title">Naudosis 2 neperleidžiamais VPA mėnesiais?</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="1" name="formbox-field-6" id="formbox-field-6_1">
                            <label for="formbox-field-6_1">Taip</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="2" name="formbox-field-6" id="formbox-field-6_2">
                            <label for="formbox-field-6_2">Ne</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fieldset-5" class="formbox__container has_border">
                <div class="formbox__title">Mamos pajamų tipas</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="1" name="formbox-field-7" id="formbox-field-7_1">
                            <label for="formbox-field-7_1">Darbo užmokestis (pagal darbo sutartį)</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="2" name="formbox-field-7" id="formbox-field-7_2">
                            <label for="formbox-field-7_2">Individualios veiklos pajamos</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fieldset-6" class="formbox__container has_border">
                <div class="formbox__title">Mamos pajamos</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <label for="formbox-field-8_1">
                            <input type="number" value="0" step="100" min="0" required name="formbox-field-8" id="formbox-field-8_1"> € / mėn.
                        </label>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fieldset-7" class="formbox__container has_border">
                <div class="formbox__title">Kaip skaičiuojamos mamos išlaidos?</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="1" name="formbox-field-9" id="formbox-field-9_1">
                            <label for="formbox-field-9_1">30% nuo pajamų</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="2" name="formbox-field-9" id="formbox-field-9_2">
                            <label for="formbox-field-9_2">Faktinės išlaidos</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fieldset-8" class="formbox__container has_border">
                <div class="formbox__title">Vidutinės faktinės išlaidos</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <label for="formbox-field-10_1">
                            <input type="number" value="0" step="100" min="0" name="formbox-field-10" id="formbox-field-10_1"> € / mėn.
                        </label>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fieldset-9" class="formbox__container has_border">
                <div class="formbox__title">Tėčio pajamų tipas</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="1" name="formbox-field-11" id="formbox-field-11_1">
                            <label for="formbox-field-11_1">Darbo užmokestis</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="2" name="formbox-field-11" id="formbox-field-11_2">
                            <label for="formbox-field-11_2">Individuali veikla</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fieldset-10" class="formbox__container has_border">
                <div class="formbox__title">Tėčio pajamos</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <label for="formbox-field-12_1">
                            <input type="number" value="0" step="100" min="0" required name="formbox-field-12" id="formbox-field-12_1"> € / mėn.
                        </label>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fieldset-11" class="formbox__container has_border">
                <div class="formbox__title">Kaip skaičiuojamos tėčio išlaidos?</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="1" name="formbox-field-13" id="formbox-field-13_1">
                            <label for="formbox-field-13_1">30% nuo pajamų</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="2" name="formbox-field-13" id="formbox-field-13_2">
                            <label for="formbox-field-13_2">Faktinės išlaidos</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fieldset-12" class="formbox__container has_border">
                <div class="formbox__title">Vidutinės faktinės išlaidos</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <label for="formbox-field-14_1">
                            <input type="number" value="0" step="100" min="0" name="formbox-field-14" id="formbox-field-14_1"> € / mėn.
                        </label>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fieldset-13" class="formbox__container has_border">
                <div class="formbox__title">Numatyta gimdymo data</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <label for="formbox-field-15_1">
                            <input type="text" name="formbox-field-15" id="date-picker" placeholder="yyyy-mm-dd">
                        </label>
                    </div>
                </div>
            </fieldset>


            <fieldset id="fieldset-14">
                <button type="submit">Skaičiuoti</button>
                <button type="reset">Išvalyti duomenis</button>
            </fieldset>

            </form>
            <div id="message-container-skaiciuokle">test</div>
        </div>

		<?php

    }

    protected function _content_template()
    {

    }

}

function filter_data($data)
{
    $dimensions = $data['structure']['dimensions']['observation'];
    $observations = $data['dataSets'][0]['observations'];

    // Filtrai
    $filters = [
        "EVRK2M3060207" => "Šalies ūkis su individualiosiomis įmonėmis",
        "Lytis" => "Vyrai ir moterys",
        "darboM3060321" => "Bruto",
        "Ekonominės veiklos rūšis" => "Iš viso pagal ekonomines veiklos rūšis",
        "LAIKOTARPIS" => "2024K1",
        "MATVNT" => "EUR",
    ];

    $key_parts = [];

    // Iteruojame per kiekvieną dimensiją ir randame atitinkamą indeksą
    foreach ($dimensions as $dimension) {
        $dimension_name = $dimension['id'];
        if (array_key_exists($dimension_name, $filters)) {
            foreach ($dimension['values'] as $index => $value) {
                if ($value['name'] == $filters[$dimension_name]) {
                    $key_parts[] = $index;
                    break;
                }
            }
        }
    }

    // Sukurkite raktą iš indeksų
    $key = implode(':', $key_parts);

    // Patikrinkite, ar raktas egzistuoja stebėjimų masyve
    if (isset($observations[$key])) {
        $filtered_value = $observations[$key][0]; // Paimkite pirmąją reikšmę iš masyvo
        return $filtered_value;
    } else {
        return 'No matching data found';
    }
}
