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
    
    public function get_script_depends() {
        return [ 'ismoku_skaiciuokle_nemokama_script' ];
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

    protected function render()  {

        $api_url = 'https://osp-rs.stat.gov.lt/rest_json/data/S3R0050_M3060315_1';

        // Fetch data from API
        $response = wp_remote_get( $api_url, array(
            'timeout' => 15,  // Increase timeout to 15 seconds
            'headers' => array(
                'Accept' => 'application/json',
            ),
        ));
    
        if ( is_wp_error( $response ) ) {
            echo 'Error fetching data: ' . $response->get_error_message();
            return;
        }

        if ( is_wp_error( $response ) ) {
            echo 'Error fetching data: ' . $response->get_error_message();
            return;
        }
    
        $status_code = wp_remote_retrieve_response_code( $response );
        $body = wp_remote_retrieve_body( $response );
    
        if ( $status_code !== 200 ) {
            echo 'Error fetching data: HTTP Status ' . $status_code;
            echo '<pre>' . print_r( $body, true ) . '</pre>';
            return;
        }
    
        $data = json_decode( $body, true );
    
        if ( ! $data ) {
            echo 'No data found';
            return;
        }
    
        // Print the raw JSON data for inspection
        echo '<pre>';
        print_r( filter_data($data) );
        echo '</pre>';

        ?>
        <div>
            <form name="formbox" id="ismoku_skaiciuokle_nemokama">
            <fieldset id="fieldset-1">
                <legend>Pažymėkite, kurias išmokas skaičiuoti</legend>
                <label><input type="checkbox" value="1" name="formbox-field-1">Nėštumo ir gimdymo atostogų</label>
                <label><input type="checkbox" value="1" name="formbox-field-2">Tėvystės (30 atostogų dienų)</label>
                <label><input type="checkbox" value="1" name="formbox-field-3">Vaiko priežiūros atostogų (VPA)</label>
            </fieldset>

            <fieldset id="fieldset-2">
                <legend>VPA išmokos gavimo trukmė</legend>
                <label><input type="radio" value="18" name="formbox-field-4">18 mėn.</label>
                <label><input type="radio" value="24" name="formbox-field-4">24 mėn.</label>
            </fieldset>

            <fieldset id="fieldset-3">
                <legend>Vaiko priežiūros atostogomis naudosis:</legend>
                <label><input type="radio" value="1" name="formbox-field-5">mama</label>
                <label><input type="radio" value="2" name="formbox-field-5">tėtis</label>
            </fieldset>

            <fieldset id="fieldset-4">
                <legend>Naudosis 2 neperleidžiamais VPA mėnesiais?</legend>
                <label><input type="radio" value="1" name="formbox-field-6">Taip</label>
                <label><input type="radio" value="2" name="formbox-field-6">Ne</label>
            </fieldset>

            <fieldset id="fieldset-5">
                <legend>Mamos pajamų tipas</legend>
                <label><input type="radio" value="1" name="formbox-field-7">Darbo užmokestis (pagal darbo sutartį)</label>
                <label><input type="radio" value="2" name="formbox-field-7">Individualios veiklos pajamos</label>
            </fieldset>

            <fieldset id="fieldset-6">
                <label> <input type="number" value="0" step="100" min="0" required name="formbox-field-8"> € / mėn.</label>
            </fieldset>

            <fieldset id="fieldset-7">
                <legend>Kaip skaičiuojamos mamos išlaidos?</legend>
                <label><input type="radio" value="1" name="formbox-field-9">30% nuo pajamų</label>
                <label><input type="radio" value="2" name="formbox-field-9">Faktinės išlaidos</label>
            </fieldset>

            <fieldset id="fieldset-8">
                <label>Vidutinės faktinės išlaidos <input type="number" value="0" step="100" min="0" name="formbox-field-10"> € / mėn.</label>
            </fieldset>

            <fieldset id="fieldset-9">
                <legend>Tėčio pajamų tipas</legend>
                <label><input type="radio" value="1" name="formbox-field-11">Darbo užmokestis</label>
                <label><input type="radio" value="2" name="formbox-field-11">Individuali veikla</label>
            </fieldset>

            <fieldset id="fieldset-10">
                <label><input type="number" value="0" step="100" min="0" required name="formbox-field-12"> € / mėn.</label>
            </fieldset>

            <fieldset id="fieldset-11">
                <legend>Kaip skaičiuojamos tėčio išlaidos?</legend>
                <label><input type="radio" value="1" name="formbox-field-13">30% nuo pajamų</label>
                <label><input type="radio" value="2" name="formbox-field-13">Faktinės išlaidos</label>
            </fieldset>

            <fieldset id="fieldset-12">
                <label>Vidutinės faktinės išlaidos <input type="number" value="0" step="100" min="0" name="formbox-field-14"> € / mėn.</label>
            </fieldset>

            <fieldset id="fieldset-13">
                <label>Numatyta gimdymo data <input type="text" name="formbox-field-15" placeholder="yyyy-mm-dd"></label>
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

function filter_data($data) {
    $dimensions = $data['structure']['dimensions']['observation'];
    $observations = $data['dataSets'][0]['observations'];
    
    // Filtrai
    $filters = [
        "EVRK2M3060207" => "Šalies ūkis su individualiosiomis įmonėmis",
        "Lytis" => "Vyrai ir moterys",
        "darboM3060321" => "Bruto",
        "Ekonominės veiklos rūšis" => "Iš viso pagal ekonomines veiklos rūšis",
        "LAIKOTARPIS" => "2024K1",
        "MATVNT" => "EUR"
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
