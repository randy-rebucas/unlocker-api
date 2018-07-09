<?php
require_once(APPPATH.'controllers/Secure.php');

class Remote_services extends Secure {


	function __construct() 
	{
		parent::__construct();
		$this->load->helper('security');
		$this->load->library('tank_auth');	
		ini_set('memory_limit', "256M");

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

		$this->template->set_template('admin');

		//<!-- BEGIN PAGE LEVEL STYLES -->
		$this->template->add_css('themes/admin/plugins/select2/select2.css');
		$this->template->add_css('themes/admin/plugins/select2/select2-metronic.css');
		$this->template->add_css('themes/admin/plugins/data-tables/DT_bootstrap.css');
		//<!-- END PAGE LEVEL STYLES -->

		//<!-- BEGIN PAGE LEVEL PLUGINS -->
		$this->template->add_js('themes/admin/plugins/select2/select2.min.js');
		$this->template->add_js('themes/admin/plugins/data-tables/jquery.dataTables.min.js');
		$this->template->add_js('themes/admin/plugins/data-tables/DT_bootstrap.js');
		//<!-- END PAGE LEVEL PLUGINS -->

		//<!-- BEGIN PAGE LEVEL SCRIPTS -->
		$this->template->add_js('themes/admin/scripts/core/app.js');
		$this->template->add_js('themes/admin/scripts/custom/table-managed.js');

		$data['default_action'] = $this->get_actions();

		$default_resource = $this->config->item('dhru_default_resource');
        $config_info = $this->Source->get_info($default_resource);
        $params = array(
            'USERNAME'      => $config_info->USERNAME,
            'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
            'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
            'REQUESTFORMAT' => 'JSON'
        );

        $this->load->library('dhrufusionapi', $params);
        $data['result'] =  $this->dhrufusionapi->action('imeiservicelist');

		$this->template->write('title', 'Remote Services'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'admin/remote_services', $data);
		$this->template->render();
	}

	function get_remote_data(){
        //$this->clear_actions();
        $action = $this->input->post('actions');
        $this->set_actions($action);
        $default_action = $this->get_actions();
        
       	$config_info = $this->Source->get_info($this->config->item('dhru_default_resource'));
		
		$data['result'] = $this->Source->_push_data($default_action, $config_info->DHRUFUSION_URL,  $config_info->USERNAME,  $config_info->API_ACCESS_KEY);

        $this->load->view('dhru/'.$default_action, $data);
    }

    function get_actions()
	{
		if(!$this->session->userdata('remote_action'))
			$this->set_actions('');

		return $this->session->userdata('remote_action');
	}

	function set_actions($remote_data)
	{
		$this->session->set_userdata('remote_action',$remote_data);
	}

	function clear_actions() 	
	{
		$this->session->unset_userdata('remote_action');
	}

}
