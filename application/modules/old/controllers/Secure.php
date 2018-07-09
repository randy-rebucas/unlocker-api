<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secure extends CI_Controller 
{

	function __construct($module_uri=null)
	{

		parent::__construct();

		$this->load->model('tank_auth/users');

		if (!$this->tank_auth->is_logged_in()) {
            
            
			redirect('auth/login');

		} else {

			//if admin
			$this->output->set_header("Expires: ".gmdate("D, d M Y H:i:s", time()+600)." GMT");
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
			$this->output->set_header("Pragma: no-cache");
			//get active user information
			$data['user_info'] = $this->users->get_info($this->tank_auth->get_user_id());

			$this->load->vars($data);

		}

	}

}
