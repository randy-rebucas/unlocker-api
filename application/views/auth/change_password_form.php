<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'value' => set_value('old_password'),
	'class' => 'form-control',
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'class' => 'form-control',
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'class' => 'form-control',
);
?>

		<div class="row breadcrumbs">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>Change password</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="active">Change password</li>
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
	                  	<div class="panel-heading"><h3 class="panel-title">Change password</h3></div>
	                    <div class="panel-body">

	                    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal" role="form" id=""');?>   

	                        <div class="form-body">
	                        	<?php if ($this->session->flashdata('alert_success')) { ?>
								    <div class="alert alert-success">
								        <?php echo $this->session->flashdata('alert_success'); ?>
								        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								    </div>
								    <?php } ?>
	                        		<div class="form-group <?php if(form_error($old_password['name'])) echo 'has-error';?>">
		                              <label  class="col-md-3 control-label">Old password</label>
		                              <div class="col-md-9">
		                                 
		                                <?php echo form_password($old_password); ?>
		                              	<span class="help-block"><?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']])?$errors[$old_password['name']]:''; ?></span>
		                              </div>
		                           </div>
		                           <div class="form-group <?php if(form_error($new_password['name'])) echo 'has-error';?>">
		                              <label  class="col-md-3 control-label">New password</label>
		                              <div class="col-md-9">
		                                 
		                                <?php echo form_password($new_password); ?>
		                              	<span class="help-block"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></span>
		                              </div>
		                           </div>
		                           <div class="form-group <?php if(form_error($confirm_new_password['name'])) echo 'has-error';?>">
		                              <label  class="col-md-3 control-label">Comfirm New password</label>
		                              <div class="col-md-9">
		                                 
		                                <?php echo form_password($confirm_new_password); ?>
		                              	<span class="help-block"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?></span>
		                              </div>
		                           </div>
	                        <div class="form-actions fluid">
	                           <div class="col-md-offset-3 col-md-9">
	                              <button type="submit" class="btn green">Submit</button>
	                              <button type="button" class="btn default">Cancel</button>                              
	                           </div>
	                        </div>
	                     <?php echo form_close();?>
	                    </div>
	                </div>


				</div>
				<div class="col-md-3 col-sm-3">
					
				</div>
			</div>
		</div>						

								