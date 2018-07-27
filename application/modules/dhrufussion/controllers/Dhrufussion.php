<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dhrufussion extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->config->load('dhrufussion');

        $params = array(
            'USERNAME'      => $this->config->item('dhru_username'),
            'API_ACCESS_KEY'=> $this->config->item('dhru_access_key'),
            'DHRUFUSION_URL'=> $this->config->item('dhru_url'),
            'REQUESTFORMAT' => $this->config->item('dhru_format'),
        );

        $this->load->library('dhrufusionapi', $params);

        // $this->load->model('mdl_dhrufussion');
    }

    public function index()
    {
        
        echo json_encode($this->dhrufusionapi->action('imeiservicelist'));
        
    }

    function get_account_info() {
        $request = $this->dhrufusionapi->action('accountinfo');

        echo '<pre>';
        print_r($request);
        echo '</pre>';
    }

    function get_file_order_details() {

        $para['ID'] = '60';
        $request = $this->dhrufusionapi->action('getfileorder',$para);


        echo '<pre>';
        print_r($request);
        echo '</pre>';
    }

    function get_fileservice_list() {

        $request = $this->dhrufusionapi->action('fileservicelist');


        echo '<pre>';
        print_r($request);
        echo '</pre>';
    }

    function get_imei_orders_details() {
        $para['ID'] = '34'; // got REFERENCEID from placeimeiorder
        $request = $this->dhrufusionapi->action('getimeiorder', $para);


        echo '<pre>';
        print_r($request);
        echo '</pre>';
    }

    function get imeiservice_list () {

        $request = $this->dhrufusionapi->action('imeiservicelist');


        echo '<pre>';
        print_r($request);
        echo '</pre>';
    }

    function get_mep_list() {

        $request = $this->dhrufusionapi->action('meplist');


        echo '<pre>';
        print_r($request);
        echo '</pre>';
    }

    function get_model_list() {

        $para['ID'] = "23"; // got from 'imeiservicelist' [SERVICEID]
        $request = $this->dhrufusionapi->action('modellist', $para);


        echo '<pre>';
        print_r($request);
        echo '</pre>';
    }

    function get_provider_list() {

        $para['ID'] = "23"; // got from 'imeiservicelist' [SERVICEID]
        $request = $this->dhrufusionapi->action('providerlist', $para);


        echo '<pre>';
        print_r($request);
        echo '</pre>';
    }

    function get_single_imei_service_details() {

        $para['ID'] = "23"; // got from 'imeiservicelist' [SERVICEID]
        $request = $this->dhrufusionapi->action('getimeiservicedetails', $para);

        echo '<pre>';
        print_r($request);
        echo '</pre>';
    }
    
    //@ param string
    //return void
    function place_order($type = 'imei') {

        try { 
            switch ($type) {
                case "file":
                    $para['ID'] = '113';
                    $para['FILENAME'] = 'ORDERID31TEST.txt';
                    $para['FILEDATA'] = base64_encode('TESTDATA');
                    $request = $this->dhrufusionapi->action('placefileorder',$para);

                    break;
                default:
                    $para['IMEI'] = "111111111111116";
                    $para['ID'] = "1382"; // got from 'imeiservicelist' [SERVICEID]
                    // PARAMETRES IS REQUIRED
                    // $para['MODELID'] = "";
                    // $para['PROVIDERID'] = "";
                    // $para['MEP'] = "";
                    // $para['PIN'] = "";
                    // $para['KBH'] = "";
                    // $para['PRD'] = "";
                    // $para['TYPE'] = "";
                    // $para['REFERENCE'] = "";
                    // $para['LOCKS'] = "";
                    $request = $this->dhrufusionapi->action('placeimeiorder', $para);
            }
           
            echo '<pre>';
            print_r($request);
            echo '</pre>';

            if(empty($request)) {
                throw new Exception('no data returned');
            }
        } catch (Exception $e) {
            //alert the user.
            var_dump($e->getMessage());
        }

    }

}

?>