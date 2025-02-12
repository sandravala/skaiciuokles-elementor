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
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('Paaiškinimai...', TEXT_DOMAIN),
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
            data-answer-text="">
            <!-- Main Calculation Section -->
            <div class="main-calculation">
                <div class="form-group">
                    <div class="input-container">
                        <label for="vdu_metinis">VDU Metinis:</label>
                        <input type="number" id="vdu_metinis" step="any" />
                    </div>

                    <div class="input-container">
                        <label for="ismoka_npm">Ismoka NPM:</label>
                        <input type="number" id="ismoka_npm" step="any" />
                    </div>
                </div>


                <button type="button" id="main-calc-btn">SKAIČIUOTI</button>

                <div class="main-results">
                    <p id="result-du"></p>
                    <p id="result-ismoka"></p>
                </div>
            </div>

            <!-- Additional Calculation Section (hidden by default) -->
            <div class="additional-calculation" id="additional-calc" style="display: none; margin-top: 20px;">
                <div class="checkbox-container">
                    <input type="checkbox" id="additional-calc-btn" />
                    <label for="additional-calc-btn">SKAIČIUOTI GALIMA ETATA</label>
                </div>

                <div class="radio-container is-hidden">
                    <label>
                        <input type="radio" name="etato_tipas" value="fiksuotas" checked /> DU FIKSUOTAS
                    </label>
                    <label>
                        <input type="radio" name="etato_tipas" value="valandinis" /> DU VALANDINIS
                    </label>
                </div>

                <div class="inputs-container is-hidden">
                    <label for="du_is_ds">Du is DS:</label>
                    <input type="number" id="du_is_ds" step="any" />

                    <label for="etatas_is_ds">Etatas is DS:</label>
                    <input type="number" id="etatas_is_ds" step="any" />
                </div>
            </div>


            <!-- Clear Data Button -->
            <div style="margin-top: 20px;">
                <button type="button" id="clear-btn">IŠVALYTI DUOMENIS</button>
            </div>

            <!-- Additional Result Display -->
            <div class="additional-result" style="margin-top: 10px;">
                <p id="result-etatas"></p>
            </div>
            <div class="paaiskinimai">
                <p id="paaiskinimai"><?php echo esc_attr($settings['answer_text']); ?></p>
            </div>
        </div>
<?php
    }
}
