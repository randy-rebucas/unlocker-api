<?php
require_once ("Secure.php");

class Orders extends Secure {

	function __construct() 
    {
        parent::__construct();
		
    }

	function _remap($method, $params = array()) 
	{

		if (method_exists($this, $method))
		{
			return call_user_func_array(array($this, $method), $params);
		}
		show_404();

	}

	public function index($params)
	{
		switch ($params) {
			case 'file':
				$data['type'] = 'File';
				$data['service'] = 'fileservicelist';
				break;
			case 'server':
				$data['type'] = 'Server';
				$data['service'] = 'meplist';
				break;
			default://imei
				$data['type'] = 'IMEI';
				$data['service'] = 'imeiservicelist';
				break;
		}
        
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

        $this->template->write('title', 'Place a new '.ucfirst($params).' order'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/orders', $data);
		$this->template->render();
	}
	
	function get_details(){

		if (!$this->input->is_ajax_request()) {
            $this->session->set_flashdata('alert_error', 'Sorry! Page cannot open by new tab');
            redirect(PREVIOUS_REQUEST);
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
        $para['ID'] = $this->input->post('order_services'); // got REFERENCEID from placeimeiorder

        $data['result'] =  $this->dhrufusionapi->action('getimeiservicedetails', $para);

        $data['item_info'] = $this->Item->get_info($this->input->post('order_services'));
        $this->load->view("corporate/orders_form", $data);

	}

	function place_order(){
        // echo '<pre>';
		// $_bulk_imei = $this->input->post('bulk_imei');
		// $_bulk_imei_clean = preg_replace('/\s+/', '', $_bulk_imei);
		// $_bulk_imei_arr = explode(',', $_bulk_imei_clean);
		// if(is_array($_bulk_imei_arr)){
			// foreach($_bulk_imei_arr as $imei){
				// if(isset($imei)){
					// print_r($imei.'<br>');
				// }
			// }
		// }
        // exit();
		
		$id =-1;

        $default_resource = $this->config->item('dhru_default_resource');
        $config_info = $this->Source->get_info($default_resource);
        $params = array(
            'USERNAME'      => $config_info->USERNAME,
            'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
            'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
            'REQUESTFORMAT' => 'JSON'
        );

        $this->load->library('dhrufusionapi', $params);
        $para['ID'] = $this->input->post('item_id'); // got REFERENCEID from placeimeiorder

        $result = $this->dhrufusionapi->action('getimeiservicedetails', $para);

        $price = ($this->Item->get_override_info($result['ID'])->o_price) ? $this->Item->get_override_info($result['ID'])->o_price : $result['SUCCESS'][0]['LIST']['credit'];
        $rem_funds = $this->User_list->bal_funds($this->tank_auth->get_user_id());

        if ($rem_funds >= $price) 
        {

            $order_data=array(
                'user_id'                  =>$this->tank_auth->get_user_id(),
                'item_id'                  =>$this->input->post('item_id'),
                'item_name'                =>$result['SUCCESS'][0]['LIST']['service_name'],
                'service_type'             =>$this->input->post('service_type'),
                'service_data'             =>($this->input->post('bulk_imei') != '') ? $this->input->post('bulk_imei') : $this->input->post('service_data'),
                'notes'                    =>$this->input->post('notes'),
                'comments'                 =>$this->input->post('comments'),
                'response_email'           =>$this->input->post('response_email'),
                'order_date'               =>date('Y-m-d h:i:s A')
            );    

            if($this->Order->save($order_data, $id))
            {
                $fund_data = array(
                    'user_id'   => $this->tank_auth->get_user_id(), 
                    'amount'    => -$price, 
                    'note'      => '', 
                    'type'      => 'Order payment', 
                    'status'    => 'Completed', 
                    'created'   => date('Y-m-d H:i:s')
                );
                
                if ($this->User_list->add_funds($fund_data)) 
                {

                    $data['site_name']  = $this->config->item('website_name', 'tank_auth');
                    $data['email']      = $this->User_list->get_info($this->tank_auth->get_user_id())->email;
                    $data['item_name']  = $result['SUCCESS'][0]['LIST']['service_name'];
                    $data['delivery_time'] = $result['SUCCESS'][0]['LIST']['time'];
                    $data['notification_to'] = $this->tank_auth->get_user_id();
                    $data['order_service_data'] = $order_data['service_data'];
                    $data['order_notes'] = $order_data['notes'];
                    $data['order_comments'] = $order_data['comments'];
                    $data['order_responce_email'] = $order_data['response_email'];
                    $data['order_amount'] = $price;

                    if ($this->send_email('place_order', $data['email'], $data)) {
                        
                        $this->session->set_flashdata('alert_success', 'Order id : '.$order_data['service_data']. ' successfully submitted' );
                        redirect(PREVIOUS_REQUEST);
                    }

                }
                else
                {

                    $this->session->set_flashdata('alert_error', 'Add funds error.' );
                    redirect(PREVIOUS_REQUEST);
                }
                
         
            }
            else
            { 

                $this->session->set_flashdata('alert_error', 'Unsuccessful order.' );
                redirect(PREVIOUS_REQUEST);

            }

        } 
        else 
        {

            $this->session->set_flashdata('alert_error', 'Your funds is not enough to order this services!' );
            redirect(PREVIOUS_REQUEST);

        }

    }

    function get_all_order_history(){

        $status = $this->input->post('order_status');
        $item = $this->input->post('order_item');
        $imei = $this->input->post('order_imei');

        $data['result'] = $this->Order->get_my_order($this->tank_auth->get_user_id(), $status, $item, $imei);

        $this->load->view('corporate/orders_history_items', $data);

    }

    function history(){
		
		$default_resource = $this->config->item('dhru_default_resource');
        $config_info = $this->Source->get_info($default_resource);
        $params = array(
            'USERNAME'      => $config_info->USERNAME,
            'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
            'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
            'REQUESTFORMAT' => 'JSON'
        );

        $this->load->library('dhrufusionapi', $params);
		$service_list =  $this->dhrufusionapi->action('imeiservicelist');

		// echo '<pre>';
		// print_r($order_status);
		// exit();
		$result = $this->Order->get_my_order($this->tank_auth->get_user_id());
		// echo '<pre>';
		// print_r($result->result());
		// exit();
		/*[0] => stdClass Object
        (
            [order_id] => 57
            [user_id] => 1
            [item_id] => 2417
            [item_name] => GSX instant checker - All IPhone 
            [service_type] => IMEI
            [service_data] => 
354377061394312
            [notes] => 
            [comments] => 
            [feedback] => 
            [response_email] => 
            [order_date] => 2015-08-27 10:31:25
            [replied_date] => 2015-08-28
            [status] => Success
            [isVerified] => 0
        ) */
			
		$table='<table class="table table-bordered tree" >';
			$table.='<thead>';
				$table.='<tr>';
					$table.='<th class="text-center"></th>';
					$table.='<th>ID</th>';
					$table.='<th>';
						$table.='<select name="status" class="input-sm form-control" id="status">';
							$table.='<option value="">All</option>';
							$table.='<option value="Success">Available</option>';
							$table.='<option value="Rejected">Rejected</option>';
							$table.='<option value="In Process">Pending</option>';
						$table.='</select>';
					$table.='</th>';
					$table.='<th>';
						
						foreach ($service_list['SUCCESS'] as $results) {
							//print_r($results['MESSAGE'].'<br>');
							//echo '<legend>Service - '.$results['MESSAGE'].'</legend>';
							//start here
							$table.='<select class="form-control select2me select2-offscreen" id="order-services">';
								$table.='<option value="">Select</option>';
							foreach ($results['LIST'] as $groups) {
							  //print_r(' - '.$groups['GROUPNAME'].'<br>');
							  $table.='<optgroup label="'.$groups['GROUPNAME'].'">';
							  foreach ($groups['SERVICES'] as $key) {
								  //print_r(' -- '.$key['SERVICENAME'].'<br>');
								  if($this->Item->get_override_info($key['SERVICEID'])->o_status == 0) {
									$table.='<option value="'.$key['SERVICEID'].'">'.$key['SERVICENAME'].'</option>';
								  }

							  }

							}
							$table.='</select>';
						  }
					$table.='</th>';
					$table.='<th>';
						$table.='<input name="imei" class="input-sm form-control" id="imei" placeholder="search IMEI">';
					$table.='</th>';
					$table.='<th>Code</th>';
					$table.='<th>Action</th>';
				$table.='</tr>';
			$table.='</thead>';
			$table.='<tbody>';

				$i = 0; 
				if ($result->num_rows() > 0) {
				
					foreach ($result->result() as $row) { 
						//status = success[4], rejected[3], waiting[0], in process[1]

						// $para['ID'] = $row->remote_order_id;
						// $order_status = $this->dhrufusionapi->action('getimeiorder', $para);
						// $statuses = $order_status['SUCCESS'][0]['STATUS'];
						
						$table.='<tr class="group treegrid-group-'.$row->order_id.'">';
							$table.='<td class="text-center"></td>';
							$table.='<td>'.$row->order_id.'</td>';
							$table.='<td>';
								
								switch ($row->status) {
									case 1: // in process
										$status = 'blue';
										$label = 'In Process';
										break;
									case 2: // new order
										$status = '';
										$label = 'New Order';
										break;
									case 3: //rejected
										$status = 'red';
										$label = 'Rejected';
										break;
									case 4: //success
										$status = 'green';
										$label = 'Success';
										break;
									default: //0 waiting
										$status = 'yellow';
										$label = 'Waiting';
										break;
								}

								$table.='<button style="width: 100% !important;" class="btn-costum btn btn-xs '.$status.'">'.$label.'</button>';
								
							$table.='</td>';
							$table.='<td class="items">'.$row->item_name.'</td>';
							$table.='<td class="imeis">'.$row->service_data.'</td>';
							$table.='<td>'.$row->feedback.'</td>';
							$table.='<td>';
							//$order_status['SUCCESS'][0]['CODE'] // cancel
								if ($row->status == 1) {
									$table.= 'Locked';
								} elseif ($row->status == 3) {
									$table.= '';
								} else { 
									$table.=  ($row->isVerified == 0) ? '<a href="javascript:;">Verify</a>' : 'Verified';
								}

								$table.='</td>';
							
						$table.='</tr>';
						$table.='<tr class="subgroup treegrid-subgroup-'.$i.' treegrid-parent-group-'.$row->order_id.'">';
							$table.='<td colspan="8">';
								$table.='<div class="row">';
									$table.='<div class="col-md-8">';
										$table.='<dl class="dl-horizontal">';
											$table.='<dl class="dl-horizontal">';
												$table.='<dt>IMEI :</dt><dd>.'.$row->service_data.'</dd>'; 
												
												$table.='<dt>Code :</dt><dd><span class="label label-danger">'.$row->feedback.'</span></dd>';
												
												$table.='<dt>Submited on :</dt><dd>'.$row->order_date.'</dd>';
												
												$table.='<dt>Replied on :</dt><dd>'.$row->replied_date.'</dd>';
											$table.='</dl>';
										  
										$table.='</dl>';
									$table.='</div>';
									$table.='<div class="col-md-4">';
										$table.='<strong>'.($this->Item->get_override_info($row->item_id)->o_price) ? '<i class="fa fa-dollar fa-fw"></i>'.$this->Item->get_override_info($row->item_id)->o_price : '<i class="fa fa-dollar fa-fw"></i>';'</strong>';
									$table.='</div>';
								$table.='</div>';
								
								
							$table.='</td>';
						$table.='</tr>';
						$i++; 
					}
				}else{ 
				
					$table.='<tr>';
						$table.='<td colspan="8">';
							$table.='No record found!';
						$table.='</td>';
					$table.='</tr>';
				}
				
			
				

			$table.='</tbody>';
		$table.='</table>';
		
		$data['table'] = $table;

        $this->template->add_js('themes/plugin/treegrid/js/jquery.treegrid.js');
        $this->template->add_js('themes/plugin/treegrid/js/jquery.treegrid.bootstrap3.js');
		
        $this->template->add_css('themes/plugin/treegrid/css/jquery.treegrid.css');

		$this->template->write('title', 'Order history'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/orders_history', $data);
		$this->template->render();
    }
	
	function show_statuses(){
		//<!-- BEGIN PAGE LEVEL PLUGINS -->
		$this->template->add_js('themes/admin/plugins/ckeditor/ckeditor.js');
		$this->template->add_js('themes/admin/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js');
		$this->template->add_js('themes/admin/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js');
		$this->template->add_js('themes/admin/plugins/bootstrap-markdown/lib/markdown.js');
		$this->template->add_js('themes/admin/plugins/bootstrap-markdown/js/bootstrap-markdown.js');
		//<!-- END PAGE LEVEL PLUGINS -->
		$data['test'] = 'try';
		
		$this->load->view('admin/change_status', $data);
	}
	
    function change_status($order_id){
   
        $order_info = $this->Order->get_info($order_id);

        $default_resource = $this->config->item('dhru_default_resource');
        $config_info = $this->Source->get_info($default_resource);
        $params = array(
            'USERNAME'      => $config_info->USERNAME,
            'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
            'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
            'REQUESTFORMAT' => 'JSON'
        );

        $this->load->library('dhrufusionapi', $params);
        

        $para['ID'] = $order_info->item_id; // got REFERENCEID from placeimeiorder
		
        $result = $this->dhrufusionapi->action('getimeiservicedetails', $para);
		
		$rPrice = (isset($result['SUCCESS'])) ? $result['SUCCESS'][0]['LIST']['credit'] : 0;
	// [order_id] => 106
    // [user_id] => 7
    // [item_id] => 5495
    // [remote_order_id] => 
    // [item_name] => Apple icloud ID Finder by IMEI + UDID (Fast Service) -(1-4 Days)
    // [service_type] => IMEI
    // [service_data] => 354377061394312
    // [notes] => 
    // [comments] => 
    // [feedback] => not found
    // [response_email] => 
    // [order_date] => 2015-09-09 02:15:16
    // [replied_date] => 2015-09-09
    // [status] => 3
    // [isVerified] => 0
		// echo '<pre>';
		        // print_r($status);
		// print_r($feedback);
		// exit();
    	$status = $this->input->post('status');
        $feedback = $this->input->post('feedback');
        $amount = ($this->Item->get_override_info($result['ID'])->o_price) ? $this->Item->get_override_info($result['ID'])->o_price : $rPrice;
        $client = $order_info->user_id;

		$success = false; 
        $success = $this->Order->update($feedback, $status, $order_id, $order_info->remote_order_id);
    	
        if($success)
        {
            if ($status == 3) {

                $fund_data = array(
                    'user_id'   => $client, 
                    'amount'    => $amount, 
                    'note'      => '', 
                    'type'      => 'Return payment order', 
                    'status'    => 'Completed', 
                    'created'   => date('Y-m-d H:i:s')
                );

                $success = $this->User_list->add_funds($fund_data);
                
            }

            $data['site_name'] = $this->config->item('website_name', 'tank_auth');
            $data['email'] = $this->User_list->get_info($client)->email;
            $data['notification_to'] = $client;
            $data['order_status'] = $status;
            $data['order_feedback'] = $feedback;
            $data['order_amount'] = $amount;

            $success = $this->send_email('order_status', $data['email'], $data);

            if ($success) {
                $this->session->set_flashdata('alert_success', 'Order ID : '. $order_id .' and  Amount $ '.$amount.' is refunded successfully');
                redirect(PREVIOUS_REQUEST);
            } else {
                $this->session->set_flashdata('alert_error', 'Problem in returning the amount $ '.$amount );
                redirect(PREVIOUS_REQUEST);
            }
           
        }else{ 

            $this->session->set_flashdata('alert_error', 'Cannot update status' );
            redirect(PREVIOUS_REQUEST);
        }
    }

    function pull_order($order_id){

        $order_info = $this->Order->get_info($order_id);
        
        $default_resource = $this->config->item('dhru_default_resource');
        $config_info = $this->Source->get_info($default_resource);
        $params = array(
            'USERNAME'      => $config_info->USERNAME,
            'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
            'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
            'REQUESTFORMAT' => 'JSON'
        );

        $this->load->library('dhrufusionapi', $params);
        
        $para['IMEI'] = $order_info->service_data;//"111111111111116";
        $para['ID'] = $order_info->item_id; // got from 'imeiservicelist' [SERVICEID]
		$return = $this->dhrufusionapi->action('placeimeiorder', $para);

		if(isset($return['SUCCESS'])){
			$feedback = $return['SUCCESS'][0]['MESSAGE'];
			$REFERENCEID = $return['SUCCESS'][0]['REFERENCEID'];
			
			if ($this->Order->update($feedback, 'In Process', $order_id, $REFERENCEID)) {
                
                $params = array(
                    'USERNAME'      => $config_info->USERNAME,
                    'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
                    'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
                    'REQUESTFORMAT' => 'JSON'
                );

                $this->load->library('dhrufusionapi', $params);

                $para['ID'] = $order_info->item_id; // got REFERENCEID from placeimeiorder

                $result = $this->dhrufusionapi->action('getimeiservicedetails', $para);

                $data['site_name'] = $this->config->item('website_name', 'tank_auth');
                $data['email'] = $this->User_list->get_info($order_info->user_id)->email;
                $data['notification_to'] = $order_info->user_id;
                $data['order_status'] = 'In Process';
                $data['order_feedback'] = $feedback;
                $data['order_amount'] = ($this->Item->get_override_info($result['ID'])->o_price) ? $this->Item->get_override_info($result['ID'])->o_price : $result['SUCCESS'][0]['LIST']['credit'];
            
                if ($this->send_email('order_status', $data['email'], $data)) {
                    $this->session->set_flashdata('alert_success', 'Order ID : '. $order_id .' successfully forwarded!');
                    redirect(PREVIOUS_REQUEST);
                }else{
                    $this->session->set_flashdata('alert_error', 'Problem in sending email notifications.' );
                    redirect(PREVIOUS_REQUEST);
                }

            }else{
                $this->session->set_flashdata('alert_error', 'Cannot update the order status.' );
                redirect(PREVIOUS_REQUEST);
            }
			
		}else{
		
			// $feedback = $return['SUCCESS'][0]['MESSAGE'];
			// print_r($return['ERROR'][0]['FULL_DESCRIPTION'][1]);
			$this->session->set_flashdata('alert_error', 'Cannot forward order.'. $return['ERROR'][0]['FULL_DESCRIPTION'][1] );
            redirect(PREVIOUS_REQUEST);
		}

				// echo '<pre>';
		// print_r($return);
		// if(isset($return['SUCCESS'])){
		// print_r($return['SUCCESS'][0]['REFERENCEID']);
		// }
		// if(isset($return['ERROR'])) {
		// print_r($return['ERROR'][0]['FULL_DESCRIPTION'][1]);
		// }
		// exit();
	// [ID] => 4433
    // [IMEI] => 358807054764234
    // [ERROR] => Array
        // (
            // [0] => Array
                // (
                    // [MESSAGE] => Service Not Active
                    // [FULL_DESCRIPTION] => Array
                        // (
                            // [0] => error
                            // [1] => 
// This IMEI is already available or pending in your Account

                        // )

                // )

        // )

    // [apiversion] => 2.3.1
	
	 	 // [ID] => 3146
    // [IMEI] => 012649009573395
    // [SUCCESS] => Array
        // (
            // [0] => Array
                // (
                    // [MESSAGE] => Order received
                    // [REFERENCEID] => 364852
                // )

        // )

    // [apiversion] => 2.3.1
    }

    function delete($id)
    {
        $id=$this->input->post("ids");

        if($this->Order->delete($id)){
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */