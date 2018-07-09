<?php
require_once ("Secure.php");

class Home extends Secure {

	function __construct()
	{
		parent::__construct();

		
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
		
		$data['total_pending_orders'] = $this->Order->count_all($this->tank_auth->get_user_id(), '1');
		$data['total_failed_orders'] = $this->Order->count_all($this->tank_auth->get_user_id(), '3');
		$data['total_success_orders'] = $this->Order->count_all($this->tank_auth->get_user_id(), '2');
		
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
		$result = $this->Order->get_my_order($this->tank_auth->get_user_id(), 20);
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
		
		$this->template->write('title', 'My dashboard'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'corporate/home', $data);
		$this->template->render();
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */