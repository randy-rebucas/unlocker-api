<?php
require_once(APPPATH.'controllers/Secure.php');

class Items extends Secure {


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

		//$data['result'] = $this->Item->get_all(null, null);

        $config_info = $this->Source->get_info($this->config->item('dhru_default_resource'));
        $params = array(
            'USERNAME'      => $config_info->USERNAME,
            'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
            'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
            'REQUESTFORMAT' => 'JSON'
        );

        $this->load->library('dhrufusionapi', $params);
        $data['result'] =  $this->dhrufusionapi->action('imeiservicelist');

		$this->template->write('title', 'Items'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'admin/items', $data);
		$this->template->render();
	}
	
	function load_ajax(){
	
		$config_info = $this->Source->get_info($this->config->item('dhru_default_resource'));
        $params = array(
            'USERNAME'      => $config_info->USERNAME,
            'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
            'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
            'REQUESTFORMAT' => 'JSON'
        );

        $this->load->library('dhrufusionapi', $params);
        $data['result'] =  $this->dhrufusionapi->action('imeiservicelist');
		
		$this->load->view('admin/items_list', $data);
	}
	
	function create($id){
        
        $this->form_validation->set_rules('item_name', 'item name', 'trim|required|xss_clean'); 
        $this->form_validation->set_rules('item_description', 'item description', 'trim|required|xss_clean'); 
        $this->form_validation->set_rules('services', 'services', 'trim|required|xss_clean'); 
        $this->form_validation->set_rules('categories', 'category', 'trim|required|xss_clean'); 
        $this->form_validation->set_rules('item_price', 'item price', 'trim|required|xss_clean'); 
        $this->form_validation->set_rules('delivery_time', 'delivery time', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE)
        {

            $data['selected_services'] = $this->input->post('services');
            $data['selected_categories'] = $this->input->post('categories');        

            $services = array(''=>'Select services');
            foreach($this->Service->get_all()->result_array() as $row)
            {
              $services[$row['service_id']] = ucfirst($row['service_name']);
            }
            $data['services']=$services;

            $categories = array(''=>'Select categories');
            foreach($this->Category->get_all()->result_array() as $row)
            {
              $categories[$row['category_id']] = ucfirst($row['category_name']);
            }
            $data['categories']=$categories;

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
			
            $data['item_info'] = $this->Item->get_info($id);
            
            $data['title'] = ($id ==-1) ? 'Create' : 'Update' ;
            $this->template->write('title', 'Items > '.$data['title']); 
			$this->template->write('meta_description', 'unlockedzpd');
			$this->template->write('meta_keywords', 'gsm unlocker');
			$this->template->write('meta_author', 'Randy Rebucas');
			$this->template->write_view('content', 'admin/items_form', $data);
			$this->template->render();
        }
        else
        {  
            $item_data=array(
                'item_name'                     =>$this->input->post('item_name'),
                'item_description'              =>$this->input->post('item_description'),
                'service_id'                    =>$this->input->post('services'),
                'category_id'                   =>$this->input->post('categories'),
                'item_price'                    =>$this->input->post('item_price'),
                'delivery_time'                 =>$this->input->post('delivery_time'),
                'hasCalc'                  		=>$this->input->post('hasCalc') ? 1 : 0,
                'isVerifiable'                  =>$this->input->post('isVerifiable') ? 1 : 0,
                'isCancelable'                  =>$this->input->post('isCancelable') ? 1 : 0,
                'item_status'                   =>$this->input->post('item_status')
            );    

            if($this->Item->save($item_data, $id))
            {
                if($id==-1)
                {
                    $this->session->set_flashdata('alert_success', 'Item '. $item_data['item_name'] .' successfully added');
                    redirect(PREVIOUS_REQUEST);
                }
                else 
                {
                    $this->session->set_flashdata('alert_success', 'Item '. $item_data['item_name'] .' succesfully updated');
                    redirect(PREVIOUS_REQUEST);
                }                
            }else{ 

                $this->session->set_flashdata('alert_error', 'Unable to add item. Please check data provided');
                redirect(PREVIOUS_REQUEST);
            } 
            
        }
    }

    function overide(){

        $id=$this->input->post("ids");
        $price=$this->input->post("oprice");
		$status=$this->input->post("ostatus");

        if($this->Item->override($id, $price, $status)){
            $status = "success"; 
        }else{
           $status = "error"; 
        }

        echo json_encode(array('status' => $status));
    }

    function delete($id)
    {
        $id=$this->input->post("ids");

        if($this->Item->delete($id)){
            $status = "success"; 
        }else{
           $status = "error"; 
        }

        echo json_encode(array('status' => $status));
    }
}
