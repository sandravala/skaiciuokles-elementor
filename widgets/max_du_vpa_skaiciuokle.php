<?php
if (! defined('ABSPATH')) {
    exit;
}

class Max_DU_VPA_Skaiciuokle extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'max_du_vpa_skaiciuokle';
    }

    public function get_title()
    {
        return __('Maksimalaus DU esant VPA skaičiuoklė', TEXT_DOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-calculator';
    }

    public function get_categories()
    {
        return ['custom-skaiciuokles'];
    }

    public function get_script_depends()
    {
        return ['max_du_vpa_skaiciuokle_script'];
    }

    public function get_style_depends()
    {
        return ['custom-skaiciuokles-style-1', 'jquery-ui-css'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'plugin-name'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Main answer text coming from widget settings.
        $this->add_control(
            'answer_text',
            [
                'label'   => __('Paaiškinimai po atsakymu', TEXT_DOMAIN),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('', TEXT_DOMAIN),
            ]
        );

        // Calculate the currently available quarter/year
        $period = $this->getPeriod();
        $availableQuarter = $period[0];
        $availableYear = $period[1];

        // Default VDU value - we'll update controls if needed, but avoid API call here
        $default_vdu = $this->get_latest_vdu_data();

        $this->add_control(
            'vdu',
            [
                'label'   => __('VDU (' . $availableYear . 'K' . $availableQuarter . ')', TEXT_DOMAIN),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __($default_vdu, TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'vdu_quarter',
            [
                'label'   => __('VDU Quarter', TEXT_DOMAIN),
                'type'    => \Elementor\Controls_Manager::HIDDEN,
                'default' => $availableQuarter,
            ]
        );

        $this->add_control(
            'vdu_year',
            [
                'label'   => __('VDU Year', TEXT_DOMAIN),
                'type'    => \Elementor\Controls_Manager::HIDDEN,
                'default' => $availableYear,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings  = $this->get_settings_for_display();
        $widget_id = $this->get_id();
?>
        <div class="calculator-widget max_du_vpa_skaiciuokle formbox__skaiciuokles" id="calculator-widget-<?php echo esc_attr($widget_id); ?>"
            data-widget-id="<?php echo esc_attr($widget_id); ?>"
            data-vdu="<?php echo esc_attr($settings['vdu']); ?>">
            <!-- Main Calculation Section -->
            <div class="main-calculation">
                <div class="form-group">
                    <div class="input-container">
                        <label for="ismoka">PATEIKITE PASKIRTĄ VPA IŠMOKĄ NR. 1 IŠ PAVYZDŽIO</label>
                        <input type="text" id="ismoka" />
                    </div>

                    <div class="input-container">
                        <label for="du_suma">PATEIKITE KOMPENSUOJAMĄ UŽDARBIO SUMĄ NR. 2 IŠ PAVYZDŽIO</label>
                        <input type="text" id="du_suma" />
                    </div>

                </div>

                <div class="error-msg is-hidden" id="error-msg-main">
                    <p>Patikrinkite, ar įvedėte visą reikiamą informaciją</p>
                </div>

                <button type="button" id="main-calc-btn">SKAIČIUOTI</button>
                <!-- Clear Data Button -->
                <button type="button" id="main-clear-btn" class="is-hidden">IŠVALYTI DUOMENIS</button>


                <div class="main-results is-hidden" id="main-results">
                    <strong>ATSAKYMAS:</strong>

                    <p id="result-du"></p>
                    <p id="result-ismoka"><?php echo esc_attr($settings['answer_text']); ?></p>
                </div>
            </div>

            <!-- Additional Calculation Section (hidden by default) -->
            <div class="additional-calculation" id="additional-calc" style="display: none; margin-top: 20px;">
                <div class="checkbox-container">
                    <input type="checkbox" id="additional-calc-check" />
                    <label for="additional-calc-check">PASKAIČIUOTI GALIMĄ DARBO ETATĄ?</label>
                </div>

                <div id="additional-calc-fields" class="is-hidden">
                    <div class="radio-container">
                        <label>
                            <input type="radio" name="etato_tipas" value="fiksuotas" checked /> DU FIKSUOTAS
                        </label>
                        <label>
                            <input type="radio" name="etato_tipas" value="valandinis" /> DU VALANDINIS
                        </label>
                    </div>

                    <div class="form-group">
                        <div class="input-container">
                            <label for="du_is_ds">JŪSŲ DU (BRUTO) IŠ DARBO SUTARTIES:</label>
                            <input type="text" id="du_is_ds" />
                        </div>

                        <div class="input-container" id="etatas_is_ds_container">
                            <label for="etatas_is_ds">ETATO DYDIS SUTARTYJE:</label>
                            <input type="text" id="etatas_is_ds" />
                        </div>
                    </div>
                </div>


            </div>

            <div class="error-msg is-hidden" id="error-msg">
                <p>Patikrinkite, ar įvedėte visą reikiamą informaciją</p>
            </div>

            <!-- Clear Data Button -->
            <div style="margin-top: 20px;">
                <button type="button" id="additional-calc-btn" class="is-hidden">SKAIČIUOTI</button>
                <button type="button" id="additional-clear-btn" class="is-hidden">IŠVALYTI DUOMENIS</button>
            </div>

            <!-- Additional Result Display -->
            <div class="additional-result is-hidden" style="margin-top: 10px;">
                <strong>ATSAKYMAS:</strong>
                <p id="main-result-du"></p>
                <p id="main-result-etatas"></p>
                <p id="paaiskinimai"><?php echo esc_attr($settings['answer_text']); ?></p>
            </div>
        </div>
<?php
    }

    // Add a new method to get and cache VDU data only when needed
    private function get_latest_vdu_data()
    {
        // Calculate the currently available quarter/year
        $period = $this->getPeriod();
        $availableQuarter = $period[0];
        $availableYear = $period[1];

        // Use WP option to store/retrieve cached data
        $option_key = 'vdu_last_fetched';
        $last_fetched = get_option($option_key, []);

        // Check if we have data for current quarter/year
        if (
            !empty($last_fetched) &&
            isset($last_fetched['quarter']) &&
            isset($last_fetched['year']) &&
            isset($last_fetched['vdu']) &&
            $last_fetched['quarter'] == $availableQuarter &&
            $last_fetched['year'] == $availableYear
        ) {

            // We already have data for this quarter/year
            //error_log("VDU Debug: Using cached data from WP options for Year: $availableYear, Quarter: $availableQuarter");
            return $last_fetched['vdu'];
        }

        // Fetch new data
        //error_log("VDU Debug: Fetching new VDU data for Year: $availableYear, Quarter: $availableQuarter");
        $default_data = $this->getVduDataFromOsp();
        $vdu_value = $default_data["vdu"] ?? 2322.20;

        // Save the fetched data for future use
        update_option($option_key, $default_data);

        return $vdu_value;
    }

    private function getPeriod()
    {
        // Start logging
        // VDU Debug: Starting available quarter calculation.

        $today = new DateTime();
        $year = (int)$today->format('Y');

        // Define update thresholds for each quarter
        $q1Update = new DateTime("$year-06-12"); // Q1 update date (data for Q1 becomes available)
        $q2Update = new DateTime("$year-09-10"); // Q2 update date
        $q3Update = new DateTime("$year-12-11"); // Q3 update date
        $q4Update = new DateTime(($year + 1) . "-03-13"); // Q4 update date (in next year)

        // Determine available quarter based on current date.
        // If the current date hasn't reached the update date for the next quarter,
        // then the available quarter is the previous one.
        if ($today < $q1Update) {
            $availableQuarter = 4;
            $availableYear = $year - 1;
        } elseif ($today < $q2Update) {
            $availableQuarter = 1;
            $availableYear = $year;
        } elseif ($today < $q3Update) {
            $availableQuarter = 2;
            $availableYear = $year;
        } elseif ($today < $q4Update) {
            $availableQuarter = 3;
            $availableYear = $year;
        } else {
            $availableQuarter = 4;
            $availableYear = $year;
        }

        return array($availableQuarter, $availableYear);
    }

    private function getVduDataFromOsp()
    {

        $period = $this->getPeriod();
        $availableQuarter = $period[0];
        $availableYear = $period[1];



        // Now, pass these parameters to fetch just the needed data from OSP.
        $default_vdu = 'default_value';
        try {
            $dataFromOsp = GetDataFromOsp::get_data_from_osp($availableQuarter, $availableYear);

            if (isset($dataFromOsp['structure']['dimensions']['observation'])) {
                $dataToSave = GetDataFromOsp::prepare_vdu_data($dataFromOsp);


                foreach ($dataToSave as $key => $value) {
                    if (
                        isset($value['metai'], $value['ketv'], $value['vdu']) &&
                        $value['metai'] == $availableYear && $value['ketv'] == $availableQuarter
                    ) {
                        $default_vdu = $value['vdu'];
                        break;
                    } else {
                        $default_vdu = 2300.20;
                    }
                }
            }
            return array("quarter" => $availableQuarter, "year" => $availableYear, "vdu" => $default_vdu);
        } catch (Exception $e) {
            error_log("VDU Debug: Exception fetching OSP data: " . $e->getMessage());
        }
    }
}
