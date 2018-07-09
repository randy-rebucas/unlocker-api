<?php
require_once(APPPATH.'controllers/Secure.php');

class Settings extends Secure {


	function __construct() 
	{
		parent::__construct();
		$this->load->helper('security');
		$this->load->library('tank_auth');	

		if ($this->tank_auth->get_role_id() != 1) {

			redirect('my-dashboard');
		}
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

		$this->form_validation->set_rules('business_name', 'business name', 'trim|required|xss_clean|max_length[200]');
		$this->form_validation->set_rules('contact_number', 'contact number', 'trim|required|xss_clean|max_length[14]');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('address1', 'address1', 'trim|required|xss_clean|max_length[300]');
		$this->form_validation->set_rules('address2', 'address2', 'trim|required|xss_clean|max_length[300]');
		$this->form_validation->set_rules('country', 'country', 'trim|required|xss_clean');
		$this->form_validation->set_rules('city', 'city', 'trim|required|xss_clean|max_length[150]');
		$this->form_validation->set_rules('state', 'state', 'trim|required|xss_clean|max_length[150]');
		$this->form_validation->set_rules('postal_code', 'postal code', 'trim|required|xss_clean|max_length[6]');
		$this->form_validation->set_rules('language', 'language', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skype', 'skype', 'trim|xss_clean|max_length[50]');
		$this->form_validation->set_rules('twitter', 'twitter', 'trim|xss_clean');
		$this->form_validation->set_rules('youtube', 'youtube', 'trim|xss_clean');
		$this->form_validation->set_rules('facebook', 'facebook', 'trim|xss_clean');
		$this->form_validation->set_rules('google_plus', 'google plus', 'trim|xss_clean');
		$this->form_validation->set_rules('unlockbase_api', 'unlockbase', 'trim|required|xss_clean|max_length[21]');
		$this->form_validation->set_rules('dhru_default_resource', 'dhru default resource', 'trim|required|xss_clean');
		$this->form_validation->set_rules('lat', 'latitude', 'trim|required|xss_clean|max_length[10]');
		$this->form_validation->set_rules('lng', 'longitude', 'trim|required|xss_clean|max_length[10]');

        if ($this->form_validation->run() == FALSE) 
        {
			$this->template->set_template('admin');
			$this->template->add_css('themes/admin/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css');
			$this->template->add_css('themes/admin/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css');

			//<!-- BEGIN PAGE LEVEL PLUGINS -->
			$this->template->add_js('themes/admin/plugins/ckeditor/ckeditor.js');
			$this->template->add_js('themes/admin/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js');
			$this->template->add_js('themes/admin/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js');
			$this->template->add_js('themes/admin/plugins/bootstrap-markdown/lib/markdown.js');
			$this->template->add_js('themes/admin/plugins/bootstrap-markdown/js/bootstrap-markdown.js');
			//<!-- END PAGE LEVEL PLUGINS -->
			//<!-- BEGIN PAGE LEVEL SCRIPTS -->
			$this->template->add_js('themes/admin/scripts/core/app.js');
			$this->template->add_js('themes/admin/scripts/custom/components-editors.js');

			$this->template->add_js('themes/admin/scripts/core/app.js');

			$this->template->write('title', 'Settings'); 
			$this->template->write('meta_description', 'unlockedzpd');
			$this->template->write('meta_keywords', 'gsm unlocker');
			$this->template->write('meta_author', 'Randy Rebucas');
			$this->template->write_view('content', 'admin/settings');
			$this->template->render();
		}
		else
		{
			$batch_save_data = array(
                'business_name'     => $this->input->post('business_name'),
                'contact_number'    => $this->input->post('contact_number'),
                'email'             => $this->input->post('email'),
                'address1'          => $this->input->post('address1'),
                'address2'          => $this->input->post('address2'),
                'country'           => $this->input->post('country'),
                'city'              => $this->input->post('city'),
                'state'             => $this->input->post('state'),
                'postal_code'       => $this->input->post('postal_code'),
                'language'          => $this->input->post('language'),
                'skype'             => $this->input->post('skype'),
                'twitter'           => $this->input->post('twitter'),
                'youtube'           => $this->input->post('youtube'),
                'facebook'          => $this->input->post('facebook'),
                'google_plus'       => $this->input->post('google_plus'),
                'unlockbase_API'    => $this->input->post('unlockbase_api'),//(8D36-0FB2-BB61-F445)
                'dhru_default_resource'    => $this->input->post('dhru_default_resource'),//(8D36-0FB2-BB61-F445)
                'lat'           	=> $this->input->post('lat'),
                'lng'           	=> $this->input->post('lng')
            );
        
            //print_r($batch_save_data); die;
            if ($this->App_config->batch_save($batch_save_data)) {
                $this->session->set_flashdata('alert_error', 'Configuration updated');
            	redirect(PREVIOUS_REQUEST);
            }
        }
	}

}
