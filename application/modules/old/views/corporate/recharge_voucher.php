
		<div class="row breadcrumbs">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>Recharge Voucher</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="active">Recharge Voucher</li>
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
	                  	<div class="panel-heading"><h3 class="panel-title">Recharge Code</h3></div>
	                    <div class="panel-body">

	                    <?php echo form_open($this->uri->uri_string(),'class="form-horizontal" role="form" id=""');?>
   

	                        <div class="form-body">
	                        		<?php if ($this->session->flashdata('alert_success')) { ?>
								    <div class="alert alert-success">
								        <?php echo $this->session->flashdata('alert_success'); ?>
								        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								    </div>
								    <?php } ?>
	                        		<div class="form-group <?php if(form_error('recharge_code')) echo 'has-error';?>">
		                              <label  class="col-md-3 control-label">Recharge Code</label>
		                              <div class="col-md-9">
		                                 
		                                <input type="text" name="recharge_code" value="" id="recharge_code" class="form-control" >
		                              	<span class="help-block"><?php echo form_error('recharge_code'); ?><?php echo isset($errors['recharge_code'])?$errors['recharge_code']:''; ?></span>
		                              </div>
		                           </div>
		                           
	                        <div class="form-actions fluid">
	                           <div class="col-md-offset-3 col-md-9">
	                              <button type="submit" class="btn green">Recharge</button>                          
	                           </div>
	                        </div>
	                     	                    </div> <?php echo form_close();?>
	                </div>


				</div>


	               

				</div>
				<div class="col-md-3 col-sm-3">
					
				</div>
			</div>
		</div>						

								