<?php
require_once(APPPATH.'controllers/Secure.php');

class Notifications extends Secure {


	function __construct() 
	{
		parent::__construct();
		$this->load->helper('security');
		$this->load->library('tank_auth');	
		$this->load->library('mail');	

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

		$data['result'] = $this->Notification->get_all();

		$this->template->write('title', 'Notifications'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'admin/notifications', $data);
		$this->template->render();
	}

	function create($id){
        
        $this->form_validation->set_rules('message', 'message', 'trim|required|xss_clean'); 
        $this->form_validation->set_rules('subject', 'subject', 'trim|required'); 

               
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
			$data['notification_info'] = $this->Notification->get_info($id);

            $data['title'] = ($id ==-1) ? 'Create' : 'Update' ;
            $this->template->write('title', 'Notifications > '.$data['title']); 
			$this->template->write('meta_description', 'unlockedzpd');
			$this->template->write('meta_keywords', 'gsm unlocker');
			$this->template->write('meta_author', 'Randy Rebucas');
			$this->template->write_view('content', 'admin/notifications_form', $data);
			$this->template->render();
        }
        else
        {  

    		$notification_data=array(
                'subject'       =>$this->input->post('subject'),
                'content'       =>$this->input->post('message'),
				'date'     		=>date('Y-m-d')
            );    

            if($this->Notification->save($notification_data, $id))
            {

                if($id==-1)
                {
                    $this->session->set_flashdata('alert_success', 'Notification '. $notification_data['subject'] .' successfully added');
                    redirect(PREVIOUS_REQUEST);
                }
                else 
                {
                    $this->session->set_flashdata('alert_success', 'Notification '. $notification_data['subject'] .' succesfully updated');
                    redirect(PREVIOUS_REQUEST);
                }

            } else {
        		$this->session->set_flashdata('alert_error', 'Unable to add notification. Please check data provided');
	            redirect(PREVIOUS_REQUEST);
        	}
        }

    }

    function send_notify($notify_id){
    	$id =-1;
    	$data['site_name'] = $this->config->item('website_name', 'tank_auth');
      $notify_info = $this->Notification->get_info($notify_id);
    	$subject = $notify_info->subject;
    	$content = $notify_info->content;

		$success = false;

    	foreach ($this->User_list->get_all()->result_array() as $row) {
           	$data['site_name'] = $this->config->item('website_name', 'tank_auth');
           	$data['email'] = $row['email'];
            $data['subject'] = $subject;
           	$data['content'] = $content;
           	
           	$success = $this->send_email('updates', $data['email'], $data);

        	if ($success) {
        		
        		  $notification_data=array(
	                'type'                  =>'updates',
	                'notification_to'       =>$row['user_id'],
        					'notification_from'     =>$this->tank_auth->get_user_id(),
        					'reference'             =>$content
	            );    
				
				    $success = $this->Notification->save_notifications($notification_data, $id); 

        	}

        }

        if ($success) {
        	 $this->session->set_flashdata('alert_success', 'Notification '. $subject .' successfully send');
                    redirect('admin/notifications');
        } else {
        	$this->session->set_flashdata('alert_error', 'Unable to send notification. Please check data provided');
	           redirect('admin/notifications');
        }
        

    }

    function delete($id)
    {
        $id=$this->input->post("ids");

        if($this->Notification->delete($id)){
            $status = "success"; 
        }else{
           $status = "error"; 
        }

        echo json_encode(array('status' => $status));
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
