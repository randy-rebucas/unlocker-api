<?php
ini_set('memory_limit', '-1');

require_once(APPPATH.'controllers/Secure.php');

class Orders extends Secure {


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

		//<!-- BEGIN PAGE LEVEL STYLES -->
		$this->template->add_css('themes/admin/plugins/select2/select2.css');
		$this->template->add_css('themes/admin/plugins/select2/select2-metronic.css');
		$this->template->add_css('themes/admin/plugins/data-tables/DT_bootstrap.css');
		//<!-- END PAGE LEVEL STYLES -->
		$this->template->add_css('themes/admin/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css');
			$this->template->add_css('themes/admin/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css');
			
		//<!-- BEGIN PAGE LEVEL PLUGINS -->
		$this->template->add_js('themes/admin/plugins/select2/select2.min.js');
		$this->template->add_js('themes/admin/plugins/data-tables/jquery.dataTables.min.js');
		$this->template->add_js('themes/admin/plugins/data-tables/DT_bootstrap.js');
		//<!-- END PAGE LEVEL PLUGINS -->
//<!-- BEGIN PAGE LEVEL PLUGINS -->
		$this->template->add_js('themes/admin/plugins/ckeditor/ckeditor.js');
		$this->template->add_js('themes/admin/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js');
		$this->template->add_js('themes/admin/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js');
		$this->template->add_js('themes/admin/plugins/bootstrap-markdown/lib/markdown.js');
		$this->template->add_js('themes/admin/plugins/bootstrap-markdown/js/bootstrap-markdown.js');
		//<!-- END PAGE LEVEL PLUGINS -->

		//<!-- BEGIN PAGE LEVEL SCRIPTS -->
		$this->template->add_js('themes/admin/scripts/core/app.js');
		$this->template->add_js('themes/admin/scripts/custom/table-managed.js');

		$this->template->add_js('themes/admin/scripts/custom/components-editors.js');

		$default_resource = $this->config->item('dhru_default_resource');
        $config_info = $this->Source->get_info($default_resource);
        $params = array(
            'USERNAME'      => $config_info->USERNAME,
            'API_ACCESS_KEY'=> $config_info->API_ACCESS_KEY,
            'DHRUFUSION_URL'=> $config_info->DHRUFUSION_URL,
            'REQUESTFORMAT' => 'JSON'
        );

        $this->load->library('dhrufusionapi', $params);
		// $para['ID'] = '364860';
		// $request = $this->dhrufusionapi->action('getimeiorder', $para);
		// echo '<pre>';
		// print_r($request);
		//print_r((isset($request['SUCCESS'])) ? $request['SUCCESS'][0]['STATUS'] : $request['ERROR'][0]['MESSAGE']);//['SUCCESS'][0]['STATUS']
		// exit();
// Array
// (
    // [ID] => 54
    // [ERROR] => Array
        // (
            // [0] => Array
                // (
                    // [MESSAGE] => NoResultFound
                // )

        // )

    // [apiversion] => 2.3.1
// )	
// Array
// (
    // [ID] => 364852
    // [SUCCESS] => Array
        // (
            // [0] => Array
                // (
                    // [IMEI] => 012649009573395
                    // [STATUS] => 1
                    // [CODE] => 
                    // [COMMENTS] => 
                // )

        // )

    // [apiversion] => 2.3.1
// )
		$result = $this->Order->get_all();
		
			$table='<table class="table table-striped table-bordered table-hover" id="sample_3">';
				$table.='<thead>';
					$table.='<tr>';
						$table.='<th class="table-checkbox" >';
							$table.='<input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/>';
						$table.='</th>';
						$table.='<th></th>';
						$table.='<th>Order date</th>';
						$table.='<th>Item</th>';
						$table.='<th>Data</th>';
						$table.='<th>Client</th>';
						$table.='<th></th>';
						$table.='<th></th>';
					$table.='</tr>';
				$table.='</thead>';
				$table.='<tbody>';
				if ($result->num_rows() > 0) {
					
					foreach ($result->result() as $row) {
				
					//$statuses = (isset($request['SUCCESS'])) ? $request['SUCCESS'][0]['STATUS'] : $request['ERROR'][0]['MESSAGE'];

						$table.='<tr class="odd gradeX">';
							$table.='<td>';
								$table.='<input type="checkbox" class="checkboxes" value="'. $row->order_id.'"/>';
							$table.='</td>';
							$table.='<td>';
								
								//$table.=$row->remote_order_id;
								$table.='<a href="" data-target="#check-status-'.$row->remote_order_id.'" data-toggle="modal" class="link">'.$row->remote_order_id.'</a>';
								$table.='<div class="modal fade" id="check-status-'.$row->remote_order_id.'" tabindex="-1" role="basic" aria-hidden="true">';
									$table.='<div class="modal-dialog">';
										$table.='<div class="modal-content">';
											//Content will be loaded here from "remote.php" file
										$table.='</div>';
									$table.='</div>';
								$table.='</div>';
							$table.='</td>';
							$table.='<td>';
								 $table.= date('F d, Y', strtotime($row->order_date));
							$table.='</td>';

							$table.='<td>';
								
								 $table.=$row->item_name;
								
							$table.='</td>';
							$table.='<td>';
									
								//$table.= $row->service_data;
	
								$array = explode(' ', $row->service_data);
				
								for ($i = 0; $i < count($array); ++$i) {
									$table.= $array[$i].'<br/>';
								}
								//character_limiter($row->service_data, 15);
							$table.='</td>';
							$table.='<td>';
								
								$client_info = $this->users->get_info($row->user_id);
								$table.= $client_info->last_name.','.$client_info->first_name. '['.$client_info->username.']';
							$table.='</td>';
							$table.='<td class="text-left">';

								switch ($row->status) {
									case 1: // in process
										$status = 'blue';
										$label = 'In Process';
										break;
									case 2: // new order
										$status = 'default';
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

								$table.='<a href="" data-target="#basic-'.$row->order_id.'" data-toggle="modal" class="btn btn-xs '.$status.'">'.$label.'</a>';
								
								$table.='<div class="modal fade" id="basic-'.$row->order_id.'" tabindex="-1" role="basic" aria-hidden="true">';
									$table.='<div class="modal-dialog">';
										$table.=form_open('orders/change_status/'.$row->order_id);
										$table.='<div class="modal-content">';
											$table.='<div class="modal-header">';
												$table.='<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>';
												$table.='<h4 class="modal-title">Change status</h4>';
											$table.='</div>';
											$table.='<div class="modal-body"><h3>'.$client_info->last_name.','.$client_info->first_name. '['.$client_info->username.']</h3>';			$table.='<br>';
												$table.='<input type="hidden" name="client" value="'.$row->user_id.'/>';
												$table.='<input type="text" name="item_id" value="'.$row->item_id.'/>';
												$table.='<p>Note</p>';
												
												$table.='<input type="text" class="form-control" placeholder"Add feedback here" />';
												$table.='<textarea name="feedback" class="form-control"></textarea>';
												$table.='<br>';
												$table.='<div class="radio-list">';
													$table.='<label class="radio-inline">';
															$table.='<span>';
																$table.='<input type="radio" name="status" id="waiting" value="0" ';
																if($row->status == 0){
																	$table.='checked ';
																}
																$table.='>';
																
															$table.='</span>';
														$table.='Waiting';
													$table.='</label>';
													$table.='<label class="radio-inline">';
															$table.='<span>';
																$table.='<input type="radio" name="status" id="in_process" value="1" ';
																if($row->status == 1){
																	$table.='checked ';
																}
																$table.='>';
																
															$table.='</span>';
														$table.='In Process';
													$table.='</label>';
													$table.='<label class="radio-inline">';
															$table.='<span>';
																$table.='<input type="radio" name="status" id="new_order" value="2" ';
																if($row->status == 2){
																	$table.='checked ';
																}
																$table.='>';
																
															$table.='</span>';
														$table.='New Order';
													$table.='</label>';
													$table.='<label class="radio-inline">';
															$table.='<span>';
																$table.='<input type="radio" name="status" id="rejected" value="3" ';
																if($row->status == 3){
																	$table.='checked ';
																}
																$table.='>';
															$table.='</span>';
														$table.='Rejected';
													$table.='</label>';
													$table.='<label class="radio-inline">';
															$table.='<span>';
																$table.='<input type="radio" name="status" id="success" value="4" ';
																if($row->status == 4){
																	$table.='checked ';
																}
																$table.='>';
															$table.='</span>';
														$table.='Success';
													$table.='</label>';
												$table.='</div>';
											$table.='</div>';
											$table.='<div class="modal-footer">';
												$table.='<button type="submit" name="submit" class="btn blue">Save changes</button>';
											$table.='</div>';
										$table.='</div>';
										$table.=form_close();
									$table.='</div>';
								$table.='</div>';
							$table.='</td>';
							$table.='<td>';	
								$table.='<a href="" data-target="#order-basic-'.$row->order_id.'" data-toggle="modal" class="btn btn-xs default">Forward Order</a>';
								$table.='<div class="modal fade" id="order-basic-'.$row->order_id.'" tabindex="-1" role="basic" aria-hidden="true">';
									$table.='<div class="modal-dialog">';
										$table.=form_open('orders/pull_order/'.$row->order_id);
										$table.='<div class="modal-content">';
											$table.='<div class="modal-header">';
												$table.='<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>';
												$table.='<h4 class="modal-title">Forward Order</h4>';
											$table.='</div>';
											$table.='<div class="modal-body">';
												$table.='<h3>Order from : '.$client_info->last_name.','.$client_info->first_name. '['.$client_info->username.']'.'</h3>';
												$table.='<br>';
												$table.='<p>You are about to forward order.</p>';
												$table.='<h2>IMEI : '.$row->service_data.'</h2>';
												$table.='<div class="alert alert-info">This order will be submitted to Default API. If you want to submit in other resource please change the application settings Dhru API. </div>';
												$table.='<p>'. $this->Source->get_info($this->config->item('dhru_default_resource'))->DHRUFUSION_URL .'</p>';
											$table.='</div>';
											$table.='<div class="modal-footer">';
												$table.='<button type="submit" name="submit" class="btn blue">Proceed</button>';
											$table.='</div>';
										$table.='</div>';
										$table.=form_close();
									$table.='</div>';
								$table.='</div>';
							$table.='</td>';

						$table.='</tr>';
					}
				}
					
					
				$table.='</tbody>';
			$table.='</table>';
		$data['table'] = $table;
		
		$this->template->write('title', 'Orders'); 
		$this->template->write('meta_description', 'unlockedzpd');
		$this->template->write('meta_keywords', 'gsm unlocker');
		$this->template->write('meta_author', 'Randy Rebucas');
		$this->template->write_view('content', 'admin/orders', $data);
		$this->template->render();
		// Array
// (
    // [ID] => 118801
    // [SUCCESS] => Array
        // (
            // [0] => Array
                // (
                    // [IMEI] => 354377061394312
                    // [STATUS] => 4
                    // [CODE] =>  	 IMEI: 354377061394312 S/N: FK1NGXFHG5R1 Model: IPHONE 6 PLUS SILVER 128GB-GBR ICCID: 8944110065413619256 Activated: Yes iOS: 8.1.2 First Activation Date: 2014-10-19 Last Activation Date: 2014-10-19 Warranty Ends on: 2015-10-17 Purchase Date: 2014-10-08 Bluetooth Mac Address: E0B52D137002 WiFi Mac Address: E0B52D137001 Find my iPhone: ON ZIP/SSN Required: N/A Initial Activation Policy Description: 235 - Retail Unlock Applied Activation Policy Description: 235 - Retail Unlock Next Tether Policy Details: 235 - Retail Unlock Lock Status: Unlocked 
                    // [COMMENTS] => 
                // )

        // )

    // [apiversion] => 2.3.1
// )
	}

}
