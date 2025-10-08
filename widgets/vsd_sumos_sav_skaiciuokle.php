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
        $current_month = intval(date('n')); // Get current month number (1-12)
        $current_month_text = array("sausio", "vasario", "kovo", "balandžio", "gegužės", "birželio", "liepos", "rugpjūčio", "rugsėjo", "spalio", "lapkričio", "gruodžio")[$current_month - 1];
?>
        <div class="calculator-widget vsd_sumos_sav_skaiciuokle formbox__skaiciuokles" id="calculator-widget-<?php echo esc_attr($widget_id); ?>"
            data-widget-id="<?php echo esc_attr($widget_id); ?>">
            <!-- Main Calculation Section -->

            <fieldset id="sav-menuo" class="formbox__container has_border">
                <div class="formbox__title">
                    <label for="sav-menuo">Mėnuo, už kurį ketinate teikti SAV pranešimą</label>
                </div>

                <select id="sav-menuo-select">
                    <!-- Get current month selected by default -->
                    <option value="1" <?php selected($current_month, 1); ?>>Sausis</option>
                    <option value="2" <?php selected($current_month, 2); ?>>Vasaris</option>
                    <option value="3" <?php selected($current_month, 3); ?>>Kovas</option>
                    <option value="4" <?php selected($current_month, 4); ?>>Balandis</option>
                    <option value="5" <?php selected($current_month, 5); ?>>Gegužė</option>
                    <option value="6" <?php selected($current_month, 6); ?>>Birželis</option>
                    <option value="7" <?php selected($current_month, 7); ?>>Liepa</option>
                    <option value="8" <?php selected($current_month, 8); ?>>Rugpjūtis</option>
                    <option value="9" <?php selected($current_month, 9); ?>>Rugsėjis</option>
                    <option value="10" <?php selected($current_month, 10); ?>>Spalis</option>
                    <option value="11" <?php selected($current_month, 11); ?>>Lapkritis</option>
                    <option value="12" <?php selected($current_month, 12); ?>>Gruodis</option>
                </select>
            </fieldset>
            <fieldset id="pajamos" class="formbox__container has_border">
                <div class="formbox__title">
                    Bendrai gauta <strong id="current-month-text-income"><?php echo esc_html($current_month_text); ?></strong> mėnesio pajamų suma (gauta tik iš IDV)
                </div>
                <div class="formbox__body">
                    <div class="formbox__field">
                        <div class="formbox__field-text">
                            <input type="text" id="pajamos-input" class="formbox__field-text" />
                        </div>
                    </div>
                </div>
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
                <div class="formbox__title">Nurodykite tikslią <strong id="current-month-text-expense"><?php echo esc_html($current_month_text); ?></strong> mėnesio patirtų išlaidų sumą</div>
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
                <strong>SUMOS, KURIAS TURITE NURODYTI SAV PRANEŠIME:</strong>

                <p id="result-vsd-suma"></p>

                <div class="table-responsive">
                    <table class="sav_pvz">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Mėnuo</th>
                                <th></th>
                                <th>Pajamos, nuo kurių skaičiuojamos įmokos</th>
                                <th></th>
                                <th style="min-width: 80px; text-align: center;">Įmokų tarifas</th>
                                <th></th>
                                <th style="min-width: 120px; text-align: center;">Įmokų suma</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="field_name" data-group="menuo">A35</td>
                                <td class="field_value" name="sav_pvz_menuo" id="sav_pvz_menuo" data-group="menuo" data-label="Mėnuo"></td>
                                <td class="field_name" data-group="pajamos">A23</td>
                                <td class="field_value" name="sav_pvz_pajamos" id="sav_pvz_pajamos" data-group="pajamos" data-label="Pajamos, nuo kurių skaičiuojamos įmokos"></td>
                                <td class="field_name">P3</td>
                                <td class="field_value" name="sav_pvz_tarifas" id="sav_pvz_tarifas" data-label="Įmokų tarifas"></td>
                                <td class="field_name">A24</td>
                                <td class="field_value" name="sav_pvz_imokos" id="sav_pvz_imokos" data-label="Įmokų suma"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <table class="sav_pvz">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Mėnuo</th>
                            <th></th>
                            <th>Pajamos, nuo kurių skaičiuojamos įmokos</th>
                            <th></th>
                            <th style="min-width: 80px; text-align: center;">Įmokų tarifas</th>
                            <th></th>
                            <th style="min-width: 120px; text-align: center;">Įmokų suma</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="field_name" data-group="menuo">A35</td>
                            <td class="field_value" name="sav_pvz_menuo" id="sav_pvz_menuo" data-group="menuo"></td>
                            <td class="field_name" data-group="pajamos">A23</td>
                            <td class="field_value" name="sav_pvz_pajamos" id="sav_pvz_pajamos" data-group="pajamos"></td>
                            <td class="field_name">P3</td>
                            <td class="field_value" name="sav_pvz_tarifas" id="sav_pvz_tarifas"></td>
                            <td class="field_name">A24</td>
                            <td class="field_value" name="sav_pvz_imokos" id="sav_pvz_imokos"></td>
                        </tr>
                    </tbody>
                </table> -->
                <p id="result-paaiskinimas"><?php echo esc_attr($settings['answer_text']); ?></p>
            </div>
        </div>


<?php
    }
}
