<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Control_Omni extends \Elementor\Base_Data_Control {
    
    public function get_type() {
        return 'omni_control';
    }


    public function enqueue() {
        wp_register_script('custom-control-omni-script', plugin_dir_url( dirname(__FILE__) ) . '/js/custom-control-omni.js', ['jquery'], '1.0.0', true);
        wp_enqueue_script('custom-control-omni-script');
        wp_localize_script('custom-control-omni-script', 'my_widget_ajax', [
            'ajax_url' => admin_url('admin-ajax.php')
        ]);
    }

    public function content_template() {
        ?>
        <div class="elementor-control-field">
            <label for="omni_input" class="elementor-control-title"><?php _e( 'Omnisend API raktas', TEXT_DOMAIN ); ?></label>
            <input type="text" id="omni_input" class="omni_input" placeholder="<?php esc_attr_e( 'Omnisend API raktas', TEXT_DOMAIN ); ?>">
        </div>
        <div class="elementor-control-field">
            <p id="omni_response" class="omni_response"></p>
        </div>
        <div class="elementor-control-field">
            <div class="elementor-control-input-wrapper">
                <button id="check_api" class="check_api elementor-button elementor-button-default" style="align-items: center; display: flex; text-align: center;">
                    <div id="loader" class="loader" style="margin-right:1rem;"></div>
                    <span class="button-text">Prijungti Omnisend</span></button>
            </div>
            
        </div>
        <?php
    }

}









