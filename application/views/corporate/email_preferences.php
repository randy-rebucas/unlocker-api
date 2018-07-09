
		<div class="row breadcrumbs">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>Email preference</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="active">Email preference</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
        <!-- BEGIN CONTAINER -->   
		<div class="container min-hight">
			<div class="row">
				<div class="col-md-9 col-sm-9">
					

				<div class="panel panel-info">
	                  	<div class="panel-heading"><h3 class="panel-title">Email preference</h3></div>
	                    <div class="panel-body">

	                    <?php echo form_open($this->uri->uri_string(),'class="form-horizontal" role="form" id=""');?>
   

	                        <div class="form-body">
	                        		<?php if ($this->session->flashdata('alert_success')) { ?>
								    <div class="alert alert-success">
								        <?php echo $this->session->flashdata('alert_success'); ?>
								        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								    </div>
								    <?php } ?>
	                        		<table class="table table-bordered">
										<thead>
											<tr>
												<th><input type="checkbox" name="all" id="select-all"></th>
												<th>Name</th>
											</tr>
										</thead>
										<tbody>
											

											 <tr>
												<td><input type="checkbox" name="email_prefs[]" value="1"></td>
												<td> File Order success
		                                 </td>
												
											</tr>
		                                 <tr>
												<td>
		                                 <input type="checkbox" name="email_prefs[]" value="2"></td>
												<td> Order Canceled
		                                 </td>
												
											</tr>
		                                  <tr>
												<td>
		                                 <input type="checkbox" name="email_prefs[]" value="3"></td>
												<td> Order success notification
		                                 </td>
												
											</tr>
		                                 <tr>
												<td>
		                                 <input type="checkbox" name="email_prefs[]" value="4"></td>
												<td> Send shipping details
		                                </td>
												
											</tr>
		                                 <tr>
												<td>
		                                 <input type="checkbox" name="email_prefs[]" value="5"></td>
												<td> Order Rejected
		                                 </td>
												
											</tr>
		                                 <tr>
												<td>
		                                 <input type="checkbox" name="email_prefs[]" value="6"></td>
												<td> Server Order successfull</td>
												
											</tr>
		                                 <tr>
		                                 	<td colspan="2">
		                                 		<button type="submit" class="btn green pull-right">Save</button>      
		                                 	</td>
		                                 </tr>
										</tbody>
									</table>
									

	                     	                    </div> <?php echo form_close();?>
	                </div>


				</div>


				</div>
				<div class="col-md-3 col-sm-3">
					
				</div>
			</div>
		</div>						

								