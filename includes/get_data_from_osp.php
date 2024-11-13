<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class GetDataFromOsp { 

    /**
     * Get data from OSP API with optional quarter and year parameters
     *
     * @param string $ketv Quarter (e.g., '1', '2', '3', '4');
     * @param string $metai Year (e.g., '2023');
     * @return array|WP_Error API response data or WP_Error on failure
     */

     public static function get_data_from_osp($ketv = '', $metai = '') {

        if (empty($metai)) {
            $metaiStart = date('Y') - 1;  // Previous year
            $metaiEnd = date('Y');  // Current year
        } elseif (is_array($metai) && isset($metai[0], $metai[1])) {
            // If an array with start and end year is provided
            $metaiStart = $metai[0];
            $metaiEnd = $metai[1];
        } else {
            // If a single year is provided
            $metaiStart = $metai;
            $metaiEnd = $metai;
        }
    
        // Set default values for quarter if not provided
        if (empty($ketv)) {
            $ketvStart = 1;  // Start from Q1
            $ketvEnd = ceil(date('n') / 3);  // Current quarter
        } elseif (is_array($ketv) && isset($ketv[0], $ketv[1])) {
            // If an array with start and end quarter is provided
            $ketvStart = $ketv[0];
            $ketvEnd = $ketv[1];
        } else {
            // If a single quarter is provided
            $ketvStart = $ketv;
            $ketvEnd = $ketv;
        }
    
        $api_url = 'https://osp-rs.stat.gov.lt/rest_json/data/S3R0050_M3060322';
    
        $api_url .= '?startPeriod=' . $metaiStart . '-Q' . $ketvStart . '&endPeriod=' . $metaiEnd . '-Q' . $ketvEnd;
        // Fetch data from API
        $data = [];
        try {
            $response = wp_remote_get( $api_url, array(
                'timeout' => 15,  
                'headers' => array(
                    'Accept' => 'application/json',
                ),
            ));
        
            if ( is_wp_error( $response ) ) {
                error_log('API Error: ' .  $response->get_error_message());
                return [];
            }
        
            $body = wp_remote_retrieve_body( $response );
        
            $data = json_decode( $body, true );
        
            if ( ! $data ) {
                error_log('No data found: ' .  wp_send_json_error());
                return [];
            }

        } catch (Exception $e) {
            error_log('Exception caught in get_data_from_osp: ' . $e->getMessage());
            return [];
        }
        
    
        return $data;
    }

    /**
     * Prepare data from OSP API to reuse it in controls / widget
     *
     * @param array $data API response data to prepare returned array from
     * @return array specifially formatted array to reuse in other functions (array( 'metai' => metai, 'ketv' => ketv, 'vdu' => vdu))
     */


    public static function prepare_vdu_data($data) {
        if(!isset($data['structure']['dimensions']['observation'])) {
            return [];
        }
        $searchKey = array_fill(0, 6, '');
        $results = [];
        $observationKeys = $data['structure']['dimensions']['observation'];
        $laikotarpis = [];
        $laikotarpisKeyPosition = 5;
    
        $searchIdArr = array(
            'Ekon_sektoriusM3061118' => '0in', //"id": "0in",  "name": "Šalies ūkis su individualiosiomis įmonėmis"
            'savivaldybesRegdb' => '00', // "id": "00", "name": "Lietuvos Respublika"
            'darboM3060321' => 'bruto', //"id": "bruto", "name": "Bruto"
            'Lytis' => '0', //"id": "0",  "name": "Vyrai ir moterys"
            'MATVNT'=> 'eur', 
            'LAIKOTARPIS' => ''
        );
    
        foreach($observationKeys as $observationKey) {
            $i = $observationKey['keyPosition'];
            $searchId = $searchIdArr[$observationKey['id']];
    
            if($observationKey['id'] !== 'LAIKOTARPIS') {
    
                foreach ($observationKey['values'] as $index => $value) {
                    // Check if the current element's 'id' matches the search ID
                    if ($value['id'] === $searchId) { 
                        $searchKey[$i] = $index;
                    }
                }
            } else {
                $laikotarpis = $observationKey['values'];
                $laikotarpisKeyPosition = $i;
            }
    
        }
    
        foreach ($laikotarpis as $key => $value) {
            $searchKey[$laikotarpisKeyPosition] = $key;
    
            $thisSearchKey = implode(':', $searchKey);
            if($data['dataSets'][0]['observations']) {
                $results[$key] = array(
                    'metai' => substr($value['id'], 0, 4),
                    'ketv' => substr($value['id'], -1),
                    'vdu' => isset($data['dataSets'][0]['observations'][$thisSearchKey][0]) ? $data['dataSets'][0]['observations'][$thisSearchKey][0] : 0
                );
            }
        }
    
        return $results;
    
    }


}
