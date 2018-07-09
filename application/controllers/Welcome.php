<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
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
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('my-dashboard');

		} 
		//<!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
	    $this->template->add_css('themes/corporate/plugins/fancybox/source/jquery.fancybox.css');          
	    $this->template->add_css('themes/corporate/plugins/revolution_slider/css/rs-style.css');
	    $this->template->add_css('themes/corporate/plugins/revolution_slider/rs-plugin/css/settings.css');
	    $this->template->add_css('themes/corporate/plugins/bxslider/jquery.bxslider.css');
		$this->template->add_css('themes/corporate/pages/css/animate.css');
		$this->template->add_css('themes/corporate/plugins/owl.carousel/assets/owl.carousel.css');

        //<!-- END PAGE LEVEL PLUGIN STYLES -->
	    $this->template->add_js('themes/corporate/plugins/fancybox/source/jquery.fancybox.pack.js');
	    $this->template->add_js('themes/corporate/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js');
	    $this->template->add_js('themes/corporate/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js');
	    $this->template->add_js('themes/corporate/plugins/bxslider/jquery.bxslider.min.js');

	    $this->template->add_js('themes/corporate/scripts/app.js');
	    $this->template->add_js('themes/corporate/scripts/index.js');

		$this->template->write('title', 'Welcome'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/intro');
		$this->template->render();
	}

	function item_details($params, $item){
		switch ($params) {
			case 'file':
				$data['type'] = 'File';
				break;
			case 'server':
				$data['type'] = 'Server';
				break;
			default://imei
				$data['type'] = 'IMEI';
				break;
		}
		// $data['item_info'] = $this->Item->get_info($item);
		if ($this->tank_auth->is_logged_in()) {
			$data['user_info'] = $this->users->get_info($this->tank_auth->get_user_id());
		}
		
		$default_resource = $this->config->item('dhru_default_resource');
        $config_info = $this->Source->get_info($default_resource);
        $params = array(
            'USERNAME'      => $config_info->USERNAME,
            'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
            'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
            'REQUESTFORMAT' => 'JSON'
        );

        $this->load->library('dhrufusionapi', $params);
        $para['ID'] = $item; // got REFERENCEID from placeimeiorder

        $data['result'] =  $this->dhrufusionapi->action('getimeiservicedetails', $para);

        $data['list_result'] =  $this->dhrufusionapi->action('imeiservicelist');

		$this->template->write('title', ucfirst('IMEI').' services - '.$data['result']['SUCCESS'][0]['LIST']['service_name']); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/item_details', $data);

		$this->template->render();
	}

	public function services($params)
	{
		/* switch ($params) {
			case 'file':
				$data['type'] = 'File';
				$service = 2;
				break;
			case 'server':
				$data['type'] = 'Server';
				$service = 3;
				break;
			default://imei
				$data['type'] = 'IMEI';
				$service = 1;
				break;
		} */
		//$data['result'] = $this->Item->get_all($service);
		$default_resource = $this->config->item('dhru_default_resource');
        $config_info = $this->Source->get_info($default_resource);
        $param = array(
            'USERNAME'      => $config_info->USERNAME,
            'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
            'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
            'REQUESTFORMAT' => 'JSON'
        );
		
		$data['type'] = 'IMEI';
		$service = 1;
		
        $this->load->library('dhrufusionapi', $param);
        $data['result'] =  $this->dhrufusionapi->action('imeiservicelist');
		
		$this->template->write('title', ucfirst($params).' services'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/services', $data);
		
		$this->template->render();
	}

	public function contact()
	{
		//<!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
	    $this->template->add_css('themes/corporate/plugins/fancybox/source/jquery.fancybox.css');            
	    //<!-- END PAGE LEVEL PLUGIN STYLES -->
	    $this->template->add_js('themes/corporate/plugins/fancybox/source/jquery.fancybox.pack.js');
	    $this->template->add_js('themes/corporate/plugins/gmaps/gmaps.js" type="text/javascript');
	    $this->template->add_js('themes/corporate/scripts/contact-us.js');
	    $this->template->add_js('themes/corporate/scripts/app.js');
	    
		$this->template->write('title', 'Contact'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/contact');
		$this->template->render();
	}

	public function submit_ticket()
	{
		$this->template->write('title', 'Submit Ticket'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/submit_ticket');
		$this->template->render();
	}

	public function testimonial()
	{
		$data['result'] = $this->Testimonial->get_all();

		$this->template->write('title', 'Testimonial'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/testimonial', $data);
		$this->template->render();
	}

	public function knowledgebase()
	{
		$this->template->write('title', 'Knowledgebase'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/knowledgebase');
		$this->template->render();
	}

}
