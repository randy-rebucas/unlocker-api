<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * MyClinicSoft
 * 
 * A web based clinical system
 *
 * @package		MyClinicSoft
 * @author		Randy Rebucas
 * @copyright	Copyright (c) 2016 - 2018 MyClinicSoft, LLC
 * @license		http://www.myclinicsoft.com/license.txt
 * @link		http://www.myclinicsoft.com
 * 
 */

class Secure extends CI_Controller {
	
    public $client_id;
    public $role_id;
    public $user_id;
    public $is_login;
    public $is_ajax;
    public $admin_role_id;
    public $patient_role_id;
	
    function __construct() 
    {
        parent::__construct();

        $this->load->helper('encode');

        $this->load->library('auth/tank_auth');

        $this->load->model('user/User_model');
        $this->load->model('settings/Setting');
        $this->load->model('modules/Module');
        $this->load->model('common/Common');

        $this->load->model('roles/Role');

        $this->client_id 	    = $this->tank_auth->get_client_id();
        $this->role_id 	        = $this->tank_auth->get_role_id();
        $this->user_id 		    = $this->tank_auth->get_user_id();
        $this->is_login 	    = $this->tank_auth->is_logged_in();
        $this->is_ajax 		    = $this->input->is_ajax_request();
       	//add this on config

        $this->admin_role_id    = $this->Role->get_by_role_slug('administrator', $this->client_id);
        $this->patient_role_id  = $this->Role->get_by_role_slug('patient', $this->client_id);
		 //get subcription information
        $data['user_info'] 	    = $this->User_model->get_profile_info($this->user_id);

        $data['client_info']      = $this->Setting->get_client_info($this->client_id);

		if (!$this->is_login) 
		{

            redirect('auth/login');

        } 

		$this->load->vars($data);
		
    }

    public function _set_layout($data)
    {

        $this->layout
            ->set_partial('header', 'include/header', $data) 
            ->set_partial('sidebar', 'include/sidebar', $data) 
            ->set_partial('ribbon', 'include/ribbon', $data) 
            ->set_partial('footer', 'include/footer', $data) 
            ->set_partial('shortcut', 'include/shortcut', $data) 
            ->set_metadata('author', 'Randy Rebucas')
            ->set_layout('full-column');
    }

    public function display_error_log($directory, $class_name, $method) {
        $page = "'" . $directory . "\\" . $class_name . "\\" . $method . "' is not found";
        show_404($page);
    }

}
