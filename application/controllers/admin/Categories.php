<?php
require_once(APPPATH.'controllers/Secure.php');

class Categories extends Secure {


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

		$data['result'] = $this->Category->get_all();

		$this->template->write('title', 'Categories'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'admin/categories', $data);
		$this->template->render();
	}

	function create($id){
        
        $this->form_validation->set_rules('category_name', 'category name', 'trim|required|xss_clean'); 
               
        if ($this->form_validation->run() == FALSE)
        {

            // $data['country'] = $this->input->post('country');
            // $data['city'] = $this->input->post('city');
            // $data['state'] = $this->input->post('state');            

            // $countries = array();
            // foreach($this->Common->get_all_countries()->result_array() as $row)
            // {
            //   $countries[$row['location_id']] = ucfirst(strtolower($row['name']));
            // }
            // $data['countries']=$countries;
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
			$data['category_info'] = $this->Category->get_info($id);

            $data['title'] = ($id ==-1) ? 'Create' : 'Update' ;
            $this->template->write('title', 'Categories > '.$data['title']); 
			$this->template->write('meta_description', 'unlockedzpd');
			$this->template->write('meta_keywords', 'gsm unlocker');
			$this->template->write('meta_author', 'Randy Rebucas');
			$this->template->write_view('content', 'admin/categories_form', $data);
			$this->template->render();
        }
        else
        {  
            $category_data=array(
                'category_name'                  =>$this->input->post('category_name'),
                'category_status'                  =>$this->input->post('category_status')
            );    

            if($this->Category->save($category_data, $id))
            {
                if($id==-1)
                {
                    $this->session->set_flashdata('alert_success', 'Category '. $category_data['category_name'] .' successfully added');
                    redirect(PREVIOUS_REQUEST);
                }
                else 
                {
                    $this->session->set_flashdata('alert_success', 'Category '. $category_data['category_name'] .' succesfully updated');
                    redirect(PREVIOUS_REQUEST);
                }                
            }else{ 

                $this->session->set_flashdata('alert_error', 'Unable to add category. Please check data provided');
                redirect(PREVIOUS_REQUEST);
            } 
            
        }
    }

    function delete($id)
    {
        $id=$this->input->post("ids");

        if($this->Category->delete($id)){
            $status = "success"; 
        }else{
           $status = "error"; 
        }

        echo json_encode(array('status' => $status));
    }

}
