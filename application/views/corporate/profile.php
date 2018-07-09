
		<div class="row breadcrumbs">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>My profile</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="active">My profile</li>
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
	                  	<div class="panel-heading"><h3 class="panel-title">User Details</h3></div>
	                    <div class="panel-body">

	                    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal" role="form" id=""');?>   

	                        <div class="form-body">
	                        	<?php if ($this->session->flashdata('alert_success')) { ?>
								    <div class="alert alert-success">
								        <?php echo $this->session->flashdata('alert_success'); ?>
								        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								    </div>
								    <?php } ?>
								    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
	                        	<legend>Contact Details</legend>
	                        		<div class="form-group">
		                              <label  class="col-md-3 control-label">Username</label>
		                              <div class="col-md-9">
		                                 <input type="text" name="username" class="form-control"  value="<?php echo $user_info->username;?>" placeholder="Username">
		                                 <p class="form-control-static hidden"><?php echo $user_info->username;?></p>
		                              </div>
		                           </div>
		                           <div class="form-group">
		                              <label  class="col-md-3 control-label">Email</label>
		                              <div class="col-md-9">

		                                   
		                                 <p class="form-control-static"><?php echo $user_info->email;?></p>
		                              </div>
		                           </div>

		                           <div class="form-group">
		                              <label  class="col-md-3 control-label">First Name</label>
		                              <div class="col-md-9">
		 
		                                    <input type="text" name="first_name" class="form-control"  value="<?php echo $user_info->first_name;?>" placeholder="First Name">
		                                  
		                              </div>
		                           </div>
		                           <div class="form-group">
		                              <label  class="col-md-3 control-label">Last Name</label>
		                              <div class="col-md-9">
		 
		                                    <input type="text" name="last_name" class="form-control"  value="<?php echo $user_info->last_name;?>" placeholder="Last Name">
		                                  
		                              </div>
		                           </div>
		                           
		                          	<div class="form-group">
		                              <label  class="col-md-3 control-label">Contact no</label>
		                              <div class="col-md-9">
		 
		                                    <input type="text" name="contact_no" class="form-control"  value="<?php echo $user_info->contact_no;?>" placeholder="Contact no">
		                                  
		                              </div>
		                           </div>

								<legend>Address</legend>
					
								<div class="form-group">
	                              <label  class="col-md-3 control-label">Address 1</label>
	                              <div class="col-md-9">
	                                 <textarea name="address_1" class="form-control" rows="3"><?php echo $user_info->address_1;?></textarea>
	                              </div>
	                           </div>
	                           <div class="form-group">
	                              <label  class="col-md-3 control-label">Address 2</label>
	                              <div class="col-md-9">
	                                 <textarea name="address_2" class="form-control" rows="3"><?php echo $user_info->address_2;?></textarea>
	                              </div>
	                           </div>

									<div class="form-group">
	                              <label  class="col-md-3 control-label">City</label>
	                              <div class="col-md-9">
	                                 <input type="text" name="city" class="form-control" value="<?php echo $user_info->city;?>"  placeholder="City">

	                              </div>
	                           </div>
	                           <div class="form-group">
	                              <label  class="col-md-3 control-label">State</label>
	                              <div class="col-md-9">
	                                 <input type="text" name="state" class="form-control"  value="<?php echo $user_info->state;?>" placeholder="State">

	                              </div>
	                           </div>
	                           <div class="form-group">
	                              <label  class="col-md-3 control-label">Postal code</label>
	                              <div class="col-md-9">
	                                 <input type="text" name="postal_code" class="form-control" value="<?php echo $user_info->postal_code;?>"  placeholder="Postal code">

	                              </div>
	                           </div>
	                           <div class="form-group">
	                              <label  class="col-md-3 control-label">Country</label>
	                              <div class="col-md-9">
	                                 <?php echo form_dropdown('country',$countries,set_value('country', ( ( !empty($country) ) ? $country : $user_info->country) ),' class="form-control" id="country"'); ?> 
	                              </div>
	                           </div>

								<legend>Extra Information</legend>

	                           	<div class="form-group">
	                              <label  class="col-md-3 control-label">Skype id</label>
	                              <div class="col-md-9">
	                                 <input type="text" name="skype_id" class="form-control" value="<?php echo $user_info->skype ;?>" placeholder="Skype id">
	     
	                              </div>
	                           </div>
	                           <div class="form-group">
	                              <label  class="col-md-3 control-label">Website</label>
	                              <div class="col-md-9">
	                                 <input type="text" name="website" class="form-control" value="<?php echo $user_info->website;?>" placeholder="Website">
	     
	                              </div>
	                           </div>
	                           <div class="form-group">
		                              <label  class="col-md-3 control-label">GSMsandwich username</label>
		                              <div class="col-md-9">

		                                   <input type="text" name="gsmndwich_username" class="form-control" value="<?php echo $user_info->gsmndwich_username;?>" placeholder="GSMsandwich username">
		                                 
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

								