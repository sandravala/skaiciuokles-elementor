<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Control_VDU extends \Elementor\Base_Data_Control {
    
    public function get_type() {
        return 'vdu';
    }

    public function get_default_settings() {

        $initialData = [];
        return [
            'custom_control_table' => $initialData
        ];
    }


    public function enqueue() {
        // Enqueue CSS and JS if needed
        wp_register_script('custom-control-table-script', plugin_dir_url( dirname(__FILE__) ) . '/js/custom-control-table.js', ['jquery'], '1.0.0', true);
        wp_enqueue_script('custom-control-table-script');
    }

    public function content_template() {
        $control_uid = $this->get_control_uid();
        ?>
        <div class="elementor-control-field">
            <div class="elementor-control-input-wrapper">
                <table class="custom-table" id="<?php echo esc_attr( $control_uid ); ?>">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Metai</th>
                            <th>I ketv.</th>
                            <th>II ketv.</th>
                            <th>III ketv.</th>
                            <th>IV ketv.</th>
                        </tr>
                    </thead>
                    <tbody id="dynamic-rows">

                    </tbody>
                </table>
                <button id="add-control-row-button" class="elementor-button elementor-button-success"><?php _e('Pridėti', TEXT_DOMAIN); ?></button>
            </div>
        </div>
        <?php
    }

}