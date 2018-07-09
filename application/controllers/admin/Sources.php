<?php
require_once(APPPATH.'controllers/Secure.php');
//require_once(APPPATH.'third_party/api/dhrufusionapi.class.php');

class Sources extends Secure {


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

		$data['result'] = $this->Source->get_all();

        //--------------
		$this->template->write('title', 'Sources API'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'admin/sources', $data);
		$this->template->render();
	}

	function create($id){
        
        $this->form_validation->set_rules('DHRUFUSION_URL', 'dhru fussion url', 'trim|required|xss_clean'); 
        $this->form_validation->set_rules('USERNAME', 'username', 'trim|required|xss_clean'); 
        $this->form_validation->set_rules('API_ACCESS_KEY', 'api access key', 'trim|required|xss_clean'); 
       
        if ($this->form_validation->run() == FALSE)
        {

            $this->template->set_template('admin');

			$this->template->add_js('themes/admin/scripts/core/app.js');
			
            $data['source_info'] = $this->Source->get_info($id);
            
            $data['title'] = ($id ==-1) ? 'Create' : 'Update' ;
            $this->template->write('title', 'Services > '.$data['title']); 
			$this->template->write('meta_description', 'unlockedzpd');
			$this->template->write('meta_keywords', 'gsm unlocker');
			$this->template->write('meta_author', 'Randy Rebucas');
			$this->template->write_view('content', 'admin/services_form', $data);
			$this->template->render();
        }
        else
        {  
            $source_data=array(
                'DHRUFUSION_URL'        =>$this->input->post('DHRUFUSION_URL'),
                'USERNAME'              =>$this->input->post('USERNAME'),
                'API_ACCESS_KEY'        =>$this->input->post('API_ACCESS_KEY'),
                'status'                =>$this->input->post('status')
            );    

            if($this->Source->save($source_data, $id))
            {
                if($id==-1)
                {
                    $this->session->set_flashdata('alert_success', 'Source '. $source_data['DHRUFUSION_URL'] .' successfully added');
                    redirect(PREVIOUS_REQUEST);
                }
                else 
                {
                    $this->session->set_flashdata('alert_success', 'Source '. $source_data['DHRUFUSION_URL'] .' succesfully updated');
                    redirect(PREVIOUS_REQUEST);
                }                
            }else{ 

                $this->session->set_flashdata('alert_error', 'Unable to add Source. Please check data provided');
                redirect(PREVIOUS_REQUEST);
            } 
            
        }
    }

    function delete($id)
    {
        $id=$this->input->post("ids");

        if($this->Service->delete($id)){
            $status = "success"; 
        }else{
           $status = "error"; 
        }

        echo json_encode(array('status' => $status));
    }

}
