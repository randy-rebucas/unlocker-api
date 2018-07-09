<?php
require_once ("Secure.php");

class Payment extends Secure {

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

            if($this->User_list->save($profile_data, $this->tank_auth->get_user_id()))
            {

                $this->session->set_flashdata('alert_success', $profile_data['first_name'] .' '. $profile_data['last_name'] .' succesfully updated');
                redirect(PREVIOUS_REQUEST);
                                
            }else{ 

                $this->session->set_flashdata('alert_error', 'Unable to add profile. Please check data provided');
                redirect(PREVIOUS_REQUEST);
            } 
            
        }
	}

	function add_funds(){
        $success = false;

        $fund_data = array(
        	'user_id' 	=> $this->input->post('user_id'), 
        	'amount' 	=> $this->input->post('fund_amount'), 
            'note'      => $this->input->post('notes'), 
            'type'      => 'Load Funds', 
            'status'    => 'Completed', 
        	'created' 	=> date('Y-m-d H:i:s')
        );
        $success = $this->User_list->add_funds($fund_data);
        if($success)
        {
            $data['site_name'] = $this->config->item('website_name', 'tank_auth');
            $data['email'] = $this->User_list->get_info($this->input->post('user_id'))->email;
            $data['notification_to'] = $this->input->post('user_id');
            $data['status'] = $fund_data['status'];
            $data['notes'] = $fund_data['note'];
            $data['amount'] = $fund_data['amount'];

            $success = $this->send_email('funds', $data['email'], $data);
            
            if ($success) {
                $this->session->set_flashdata('alert_success', 'Funds succesfully added');
                redirect(PREVIOUS_REQUEST);
            }else{

                $this->session->set_flashdata('alert_error', 'Unable to send notification.');
                redirect(PREVIOUS_REQUEST);
            }
            
                            
        }else{ 

            $this->session->set_flashdata('alert_error', 'Unable to add funds. Please check data provided');
            redirect(PREVIOUS_REQUEST);
        } 
            
        
	}

    function send_email($type, $email, &$data){

      $this->load->library('email');//notification_subject_updates
      $this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
      $this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
      $this->email->to($email);
      $this->email->subject(sprintf($this->lang->line('notification_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
      $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
      $this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
      return $this->email->send();
   } 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */