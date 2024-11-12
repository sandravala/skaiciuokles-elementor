<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Control_VDU extends \Elementor\Base_Data_Control {
    
    public function get_type() {
        return 'vdu';
    }

    public function get_default_settings() {
        // error_log('Control_VDU: get_default_settings called');

        // $current_year = date('Y');
        // $initial_metai = $current_year - 1;

        // error_log('Control_VDU: retrieving data from OSP');
        // //$dataToSet = GetDataFromOsp::prepare_vdu_data(get_data_from_osp());

        // try {
        //     error_log('Control_VDU: calling get_data_from_osp()');
        //     $rawData = get_data_from_osp();
        //     error_log('Control_VDU: get_data_from_osp() returned - ' . print_r($rawData, true));
        
        //     error_log('Control_VDU: calling prepare_vdu_data()');
        //     $dataToSet = GetDataFromOsp::prepare_vdu_data($rawData);
        //     error_log('Control_VDU: prepare_vdu_data() returned - ' . print_r($dataToSet, true));
        // } catch (Exception $e) {
        //     error_log('Control_VDU: Exception caught - ' . $e->getMessage());
        //     return [];
        // }

        // if (empty($dataToSet)) {
        //     error_log('Control_VDU: data retrieval failed or returned empty');
        //     return [];
        // }
    
        // // Log retrieved data
        // error_log('Control_VDU: data retrieved - ' . print_r($dataToSet, true));
        // $initialData = [];
        // foreach ($dataToSet as $val) {
        //     $initialData[$val['metai']]['vdu_' . $val['ketv']] = $val['vdu'];
        // }

        // error_log('Control_VDU: settings prepared - ' . print_r($initialData, true));

        $initialData = [];
        return [
            'custom_control_table' => $initialData
        ];
    }


    // public function get_default_value() {
    //     // Fetch the data only when needed
    //     error_log('Control_VDU: get_default_value called');
    //     //$dataToSet = GetDataFromOsp::get_data_from_osp();



    //     if (empty($dataToSet)) {
    //         error_log('Control_VDU: No data returned from get_data_from_osp');
    //         $dataToSet = [];
    //     }

    //     // Return the data as the default value
    //     return [
    //         'custom_control_table' => $dataToSet,
    //     ];
    // }


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