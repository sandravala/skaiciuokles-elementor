<?php
if (! defined('ABSPATH')) {
    exit;
}

class VSD_sumos_SAV_skaiciuokle extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'vsd_sumos_sav_skaiciuokle';
    }

    public function get_title()
    {
        return __('VSD sumos SAV pranešimui skaičiuoklė', TEXT_DOMAIN);
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
        return ['vsd_sumos_sav_skaiciuokle_script'];
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

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings  = $this->get_settings_for_display();
        $widget_id = $this->get_id();
?>
        <div class="calculator-widget max_du_vpa_skaiciuokle formbox__skaiciuokles" id="calculator-widget-<?php echo esc_attr($widget_id); ?>"
            data-widget-id="<?php echo esc_attr($widget_id); ?>">
            <!-- Main Calculation Section -->

            <fieldset id="pajamos" class="formbox__container has_border">
                    <label for="pajamos">Bendrai gauta mėnesinė pajamų suma</label>
                    <input type="text" id="pajamos-input" />
            </fieldset>
            <fieldset id="islaidu-tipas" class="formbox__container has_border">
                <div class="formbox__title">Kokį išlaidų taikymo modelį taikysite deklaruojant metines pajamas?</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="islaidos30" name="islaidu-tipas" id="islaidos30" checked>
                            <label for="islaidos30">30% nuo pajamų</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="islaidosFaktas" name="islaidu-tipas" id="islaidosFaktas">
                            <label for="islaidosFaktas">Faktinės išlaidos</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="faktines-islaidos" class="formbox__container has_border" style="display: none;">
                <div class="formbox__title">Nurodykite vidutines mėnesines išlaidas susijusias su IDV veikla</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <label for="formbox-field-10_1">
                            <input type="text" name="faktines-islaidos" id="faktinesIslaidosInput" class="formbox__field-input"><span> € / mėn.</span>
                        </label>
                    </div>
                </div>
            </fieldset>






            <fieldset id="papildomas-pensiju-kaupimas" class="formbox__container has_border">
                <div class="formbox__title">Ar dalyvaujate papildomame pensijų kaupime (II pakopa)?</div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-radio">
                            <input type="radio" value="taip" name="papildomas-pensiju-kaupimas" id="pensijuKaupimasTaip" checked>
                            <label for="pensijuKaupimasTaip">Taip</label>
                        </div>
                        <div class="formbox__field-radio">
                            <input type="radio" value="ne" name="papildomas-pensiju-kaupimas" id="pensijuKaupimasNe" checked>
                            <label for="pensijuKaupimasNe">Ne</label>
                        </div>
                    </div>
                </div>
            </fieldset>



            <div class="error-msg is-hidden" id="error-msg-main">
                <p>Patikrinkite, ar įvedėte visą reikiamą informaciją</p>
            </div>
            <div class="error-msg is-hidden" id="error-msg-number-format">
                <p>Atrodo, kad įvedėte sumą netinkamu formatu</p>
            </div>

             <fieldset id="buttons" class="formbox__container has_border">
            <button type="button" id="main-calc-btn">SKAIČIUOTI</button>
            <!-- Clear Data Button -->
            <button type="button" id="main-clear-btn" class="is-hidden">IŠVALYTI DUOMENIS</button>
             </fieldset>

<div class="main-results is-hidden" id="main-results">
                <strong>ATSAKYMAS:</strong>

                <p id="result-vsd-suma"></p>
                <p id="result-paaiskinimas"><?php echo esc_attr($settings['answer_text']); ?></p>
            </div>
        </div>


<?php
    }
}
