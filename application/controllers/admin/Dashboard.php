<?php
require_once(APPPATH.'controllers/Secure.php');

class Dashboard extends Secure {


	function __construct() 
	{
		parent::__construct();
		$this->load->library('unlockBase');	
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
		
		$this->template->set_template('admin');

		$this->template->add_css('themes/admin/plugins/gritter/css/jquery.gritter.css');
		$this->template->add_css('themes/admin/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css');
		$this->template->add_css('themes/admin/plugins/fullcalendar/fullcalendar/fullcalendar.css');
		$this->template->add_css('themes/admin/plugins/jqvmap/jqvmap/jqvmap.css');
		$this->template->add_css('themes/admin/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css');

		$this->template->add_js('themes/admin/plugins/jqvmap/jqvmap/jquery.vmap.js');
		$this->template->add_js('themes/admin/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js');
		$this->template->add_js('themes/admin/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js');
		$this->template->add_js('themes/admin/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js');
		$this->template->add_js('themes/admin/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js');
		$this->template->add_js('themes/admin/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js');
		$this->template->add_js('themes/admin/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js');
		$this->template->add_js('themes/admin/plugins/flot/jquery.flot.min.js');
		$this->template->add_js('themes/admin/plugins/flot/jquery.flot.resize.min.js');
		$this->template->add_js('themes/admin/plugins/flot/jquery.flot.categories.min.js');
		$this->template->add_js('themes/admin/plugins/jquery.pulsate.min.js');
		$this->template->add_js('themes/admin/plugins/bootstrap-daterangepicker/moment.min.js');
		$this->template->add_js('themes/admin/plugins/bootstrap-daterangepicker/daterangepicker.js');
		$this->template->add_js('themes/admin/plugins/gritter/js/jquery.gritter.js');
		//IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support 
		$this->template->add_js('themes/admin/plugins/fullcalendar/fullcalendar/fullcalendar.min.js');
		$this->template->add_js('themes/admin/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js');
		$this->template->add_js('themes/admin/plugins/jquery.sparkline.min.js" type="text/javascript');

		//<!-- BEGIN PAGE LEVEL SCRIPTS -->
		$this->template->add_js('themes/admin/scripts/core/app.js');
		$this->template->add_js('themes/admin/scripts/custom/index.js');
		$this->template->add_js('themes/admin/scripts/custom/tasks.js');
		//<!-- END PAGE LEVEL SCRIPTS -->
		$account_info =  UnlockBase::CallAPI ('AccountInfo');
		//$data['account_info'] =  json_encode($account_info);

		//$a = json_decode(json_encode((array) simplexml_load_string($s)),1);
		$data['account_info'] =  $this->xmlstr_to_array($account_info);

		$default_resource = $this->config->item('dhru_default_resource');
        $config_info = $this->Source->get_info($default_resource);
        $params = array(
            'USERNAME'      => $config_info->USERNAME,
            'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
            'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
            'REQUESTFORMAT' => 'JSON'
        );

        $this->load->library('dhrufusionapi', $params);
        $data['result'] =  $this->dhrufusionapi->action('accountinfo');

        $data['default_api'] = $config_info->DHRUFUSION_URL;
        
		$this->template->write('title', 'Admin dashboard'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'admin/dashboard',$data);
		$this->template->render();
	}
	/**
	 * convert xml string to php array - useful to get a serializable value
	 *
	 * @param string $xmlstr 
	 * @return array
	 * @author Adrien aka Gaarf
	 */
	function xmlstr_to_array($xmlstr) {
	  $doc = new DOMDocument();
	  $doc->loadXML($xmlstr);
	  return $this->domnode_to_array($doc->documentElement);
	}
	function domnode_to_array($node) {
	  $output = array();
	  switch ($node->nodeType) {
	   case XML_CDATA_SECTION_NODE:
	   case XML_TEXT_NODE:
	    $output = trim($node->textContent);
	   break;
	   case XML_ELEMENT_NODE:
	    for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) { 
	     $child = $node->childNodes->item($i);
	     $v = $this->domnode_to_array($child);
	     if(isset($child->tagName)) {
	       $t = $child->tagName;
	       if(!isset($output[$t])) {
	        $output[$t] = array();
	       }
	       $output[$t][] = $v;
	     }
	     elseif($v) {
	      $output = (string) $v;
	     }
	    }
	    if(is_array($output)) {
	     if($node->attributes->length) {
	      $a = array();
	      foreach($node->attributes as $attrName => $attrNode) {
	       $a[$attrName] = (string) $attrNode->value;
	      }
	      $output['@attributes'] = $a;
	     }
	     foreach ($output as $t => $v) {
	      if(is_array($v) && count($v)==1 && $t!='@attributes') {
	       $output[$t] = $v[0];
	      }
	     }
	    }
	   break;
	  }
	  return $output;
	}
}
