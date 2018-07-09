<?php
require_once ("Secure.php");

class Profile extends Secure {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		//dont do this at this moment
	}

	function _remap($method, $params = array()) 
	{

		if (method_exists($this, $method))
		{
			return call_user_func_array(array($this, $method), $params);
		}
		show_404();

	}

	public function index()
	{
		
		$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('first_name', 'first name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'last name', 'trim|required|xss_clean'); 
		$this->form_validation->set_rules('contact_no', 'contact no', 'trim|required|xss_clean'); 
		$this->form_validation->set_rules('address_1', 'address 1', 'trim|required|xss_clean'); 
		$this->form_validation->set_rules('address_2', 'address 2', 'trim|xss_clean');  
		$this->form_validation->set_rules('city', 'city', 'trim|required|xss_clean'); 
		$this->form_validation->set_rules('state', 'state', 'trim|required|xss_clean'); 
		$this->form_validation->set_rules('postal_code', 'postal code', 'trim|required|xss_clean'); 
		$this->form_validation->set_rules('country', 'country', 'trim|required|xss_clean'); 
		$this->form_validation->set_rules('skype_id', 'skype id', 'trim|xss_clean'); 
		$this->form_validation->set_rules('gsmndwich_username', 'gsmsandwich username', 'trim|xss_clean'); 
        $this->form_validation->set_rules('website', 'website', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE)
        {

            $data['country'] = $this->input->post('country');
          
            $countries = array();
            foreach($this->Country->get_all()->result_array() as $row)
            {
              $countries[$row['id']] = ucfirst(strtolower($row['name']));
            }
            $data['countries']=$countries;

            
	      	$this->template->add_css('themes/corporate/plugins/fancybox/source/jquery.fancybox.css');
	   		$this->template->add_css('themes/corporate/plugins/uniform/css/uniform.default.css');
		    //<!-- END CORE PLUGINS -->

		    //<!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
		    $this->template->add_js('themes/corporate/plugins/fancybox/source/jquery.fancybox.pack.js');
		    $this->template->add_js('themes/corporate/plugins/uniform/jquery.uniform.min.js');
		    $this->template->add_js('themes/corporate/scripts/app.js');

			$this->template->write('title', 'My Profile'); 
			$this->template->write('meta_description', 'unlockedzpd');
			$this->template->write('meta_keywords', 'gsm unlocker');
			$this->template->write('meta_author', 'Randy Rebucas');
			$this->template->write_view('content', 'corporate/profile', $data);
			$this->template->render();
			
        }
        else
        {  
        	$user_data = array(
                'username'            =>$this->input->post('username')
            ); 

            $profile_data=array(
                'first_name'            =>$this->input->post('first_name'),
                'last_name'             =>$this->input->post('last_name'),
                'contact_no'            =>$this->input->post('contact_no'),
                'address_1'             =>$this->input->post('address_1'),
                'address_2'             =>$this->input->post('address_2'),
                'city'                  =>$this->input->post('city'),
                'state'                 =>$this->input->post('state'),
                'postal_code'           =>$this->input->post('postal_code'),
                'country'               =>$this->input->post('country'),
                'skype'              	=>$this->input->post('skype_id'),
                'gsmndwich_username'    =>$this->input->post('gsmndwich_username'),
                'website'               =>$this->input->post('website')
            );    

            if($this->User_list->save($user_data, $profile_data, $this->tank_auth->get_user_id()))
            {

                $this->session->set_flashdata('alert_success', $profile_data['first_name'] .' '. $profile_data['last_name'] .' succesfully updated');
                redirect(PREVIOUS_REQUEST);
                                
            }else{ 

                $this->session->set_flashdata('alert_error', 'Unable to add profile. Please check data provided');
                redirect(PREVIOUS_REQUEST);
            } 
            
        }
	}
	/**
	* Change password
	*/
	function change_password(){

		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

        if ($this->form_validation->run() == FALSE)
        {

         
	      	$this->template->add_css('themes/corporate/plugins/fancybox/source/jquery.fancybox.css');
	   		$this->template->add_css('themes/corporate/plugins/uniform/css/uniform.default.css');
		    //<!-- END CORE PLUGINS -->

		    //<!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
		    $this->template->add_js('themes/corporate/plugins/fancybox/source/jquery.fancybox.pack.js');
		    $this->template->add_js('themes/corporate/plugins/uniform/jquery.uniform.min.js');
		    $this->template->add_js('themes/corporate/scripts/app.js');

			$this->template->write('title', 'Change password'); 
			$this->template->write('meta_description', 'unlockedzpd');
			$this->template->write('meta_keywords', 'gsm unlocker');
			$this->template->write('meta_author', 'Randy Rebucas');
			$this->template->write_view('content', 'auth/change_password_form');
			$this->template->render();
			
        }
        else
        {  

            if($this->tank_auth->change_password(
						$this->input->post('old_password'),
						$this->input->post('new_password')))
            {

                $this->session->set_flashdata('alert_success', 'Password succesfully updated');
                redirect(PREVIOUS_REQUEST);
                                
            }else{ 

                $this->session->set_flashdata('alert_error', 'Unable to change password. Please check data provided');
                redirect(PREVIOUS_REQUEST);
            } 
            
        }
	}
	/**
	* My invoice
	*/
	function invoice(){

		$this->template->add_css('themes/corporate/plugins/fancybox/source/jquery.fancybox.css');
   		$this->template->add_css('themes/corporate/plugins/uniform/css/uniform.default.css');
	    //<!-- END CORE PLUGINS -->

	    //<!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
	    $this->template->add_js('themes/corporate/plugins/fancybox/source/jquery.fancybox.pack.js');
	    $this->template->add_js('themes/corporate/plugins/uniform/jquery.uniform.min.js');
	    $this->template->add_js('themes/corporate/scripts/app.js');

		$this->template->write('title', 'My invoice'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/invoice');
		$this->template->render();

	}

	/**
	* My mail
	*/
	function mail(){

		$this->template->add_css('themes/corporate/plugins/fancybox/source/jquery.fancybox.css');
   		$this->template->add_css('themes/corporate/plugins/uniform/css/uniform.default.css');
	    //<!-- END CORE PLUGINS -->

	    //<!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
	    $this->template->add_js('themes/corporate/plugins/fancybox/source/jquery.fancybox.pack.js');
	    $this->template->add_js('themes/corporate/plugins/uniform/jquery.uniform.min.js');
	    $this->template->add_js('themes/corporate/scripts/app.js');

		$this->template->write('title', 'My mail'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/mail');
		$this->template->render();

	}

	/**
	* My statement
	*/
	function statement(){

		$this->template->add_css('themes/corporate/plugins/fancybox/source/jquery.fancybox.css');
   		$this->template->add_css('themes/corporate/plugins/uniform/css/uniform.default.css');
	    //<!-- END CORE PLUGINS -->

	    //<!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
	    $this->template->add_js('themes/corporate/plugins/fancybox/source/jquery.fancybox.pack.js');
	    $this->template->add_js('themes/corporate/plugins/uniform/jquery.uniform.min.js');
	    $this->template->add_js('themes/corporate/scripts/app.js');

		$this->template->write('title', 'My statement'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/statement');
		$this->template->render();

	}

	/**
	* My recharge voucher
	*/
	function recharge_voucher(){

		$this->template->add_css('themes/corporate/plugins/fancybox/source/jquery.fancybox.css');
   		$this->template->add_css('themes/corporate/plugins/uniform/css/uniform.default.css');
	    //<!-- END CORE PLUGINS -->

	    //<!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
	    $this->template->add_js('themes/corporate/plugins/fancybox/source/jquery.fancybox.pack.js');
	    $this->template->add_js('themes/corporate/plugins/uniform/jquery.uniform.min.js');
	    $this->template->add_js('themes/corporate/scripts/app.js');

		$this->template->write('title', 'Recharge voucher'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/recharge_voucher');
		$this->template->render();

	}

	/**
	* My email_preferences
	*/
	function email_preferences(){

		$this->template->add_css('themes/corporate/plugins/fancybox/source/jquery.fancybox.css');
   		$this->template->add_css('themes/corporate/plugins/uniform/css/uniform.default.css');
	    //<!-- END CORE PLUGINS -->

	    //<!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
	    $this->template->add_js('themes/corporate/plugins/fancybox/source/jquery.fancybox.pack.js');
	    $this->template->add_js('themes/corporate/plugins/uniform/jquery.uniform.min.js');
	    $this->template->add_js('themes/corporate/scripts/app.js');

		$this->template->write('title', 'Email preferences'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/email_preferences');
		$this->template->render();

	}
	
	/**
	* My tickets
	*/
	function tickets(){

		$this->template->add_css('themes/corporate/plugins/fancybox/source/jquery.fancybox.css');
   		$this->template->add_css('themes/corporate/plugins/uniform/css/uniform.default.css');
	    //<!-- END CORE PLUGINS -->

	    //<!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
	    $this->template->add_js('themes/corporate/plugins/fancybox/source/jquery.fancybox.pack.js');
	    $this->template->add_js('themes/corporate/plugins/uniform/jquery.uniform.min.js');
	    $this->template->add_js('themes/corporate/scripts/app.js');

		$this->template->write('title', 'My tickets'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/my_tickets');
		$this->template->render();

	}

	/**
	* My submit_tickets
	*/
	function submit_tickets(){

		$this->template->add_css('themes/corporate/plugins/fancybox/source/jquery.fancybox.css');
   		$this->template->add_css('themes/corporate/plugins/uniform/css/uniform.default.css');
	    //<!-- END CORE PLUGINS -->

	    //<!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
	    $this->template->add_js('themes/corporate/plugins/fancybox/source/jquery.fancybox.pack.js');
	    $this->template->add_js('themes/corporate/plugins/uniform/jquery.uniform.min.js');
	    $this->template->add_js('themes/corporate/scripts/app.js');

		$this->template->write('title', 'Submit tickets'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/submit_ticket');
		$this->template->render();

	}

	/**
	* My service_status
	*/
	function service_status(){

		$this->template->add_css('themes/corporate/plugins/fancybox/source/jquery.fancybox.css');
   		$this->template->add_css('themes/corporate/plugins/uniform/css/uniform.default.css');
	    //<!-- END CORE PLUGINS -->

	    //<!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
	    $this->template->add_js('themes/corporate/plugins/fancybox/source/jquery.fancybox.pack.js');
	    $this->template->add_js('themes/corporate/plugins/uniform/jquery.uniform.min.js');
	    $this->template->add_js('themes/corporate/scripts/app.js');

	    //$data['result'] = $this->Item->get_all();
	    $default_resource = $this->config->item('dhru_default_resource');
        $config_info = $this->Source->get_info($default_resource);
        $param = array(
            'USERNAME'      => $config_info->USERNAME,
            'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
            'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
            'REQUESTFORMAT' => 'JSON'
        );

        $this->load->library('dhrufusionapi', $param);
        $data['result'] =  $this->dhrufusionapi->action('imeiservicelist');

		$this->template->write('title', 'Service status'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/service_status', $data);
		$this->template->render();

	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */