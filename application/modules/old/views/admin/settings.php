<div class="page-content">

<?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal" id="app_settings"');?>
<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i> Application Settings
							</div>
							<div class="tools">
								<a href="" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="" class="reload">
								</a>
								<a href="" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<form class="form-horizontal" role="form">
								<div class="form-body">
									<!-- <div class="form-group">
										<label for="exampleInputFile" class="col-md-3 control-label">
											Logo </label>
										<div class="col-md-9">
											<input type="file" id="exampleInputFile" name="">

										</div>
									</div> -->
									<?php if ($this->session->flashdata('alert_success')) { ?>
								    <div class="alert alert-success">
								        <?php echo $this->session->flashdata('alert_success'); ?>
								        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								    </div>
								    <?php } ?>
								    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
									<legend>Business Information</legend>
									<div class="form-group">
										<label class="col-md-3 control-label">Business Name</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="business_name" placeholder="" value="<?php echo $this->config->item('business_name');?>">

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Contact number</label>
										<div class="col-md-4">
											<input type="text" class="form-control input-inline input-medium" name="contact_number" placeholder="" value="<?php echo $this->config->item('contact_number');?>">

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Email</label>
										<div class="col-md-4">

											<input type="email" class="form-control" name="email" placeholder="" value="<?php echo $this->config->item('email');?>">

										</div>
									</div>
									

									<div class="form-group">
										<label class="col-md-3 control-label">Address 1</label>
										<div class="col-md-4">
											<textarea class="form-control" rows="3" name="address1"><?php echo $this->config->item('address1');?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Address 2</label>
										<div class="col-md-4">
											<textarea class="form-control" rows="3" name="address2"><?php echo $this->config->item('address2');?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Country</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="country" placeholder="" value="<?php echo $this->config->item('country');?>">

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">City</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="city" placeholder="" value="<?php echo $this->config->item('city');?>">

										</div>
									</div>
								
									<div class="form-group">
										<label class="col-md-3 control-label">State</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="state" placeholder="" value="<?php echo $this->config->item('state');?>">

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Postal code</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="postal_code" placeholder="" value="<?php echo $this->config->item('postal_code');?>">

										</div>
									</div>
									<legend>Localizations</legend>
									<div class="form-group">
										<label class="col-md-3 control-label">Language</label>
										<div class="col-md-4">
											<select class="form-control input-medium" name="language">
												<option value="">Select</option>
												<option value="<?php echo $this->config->item('language');?>" <?php if($this->config->item('language') == 'english') echo 'selected';?>>English</option>
												
											</select>
										</div>
									</div>
									<!-- <div class="form-group">
										<label class="col-md-3 control-label">Time Zone</label>
										<div class="col-md-9">
											<select class="form-control input-medium">
												<option>English</option>
												
											</select>
										</div>
									</div> -->
									<legend>Social Media</legend>
									<div class="form-group">
										<label class="col-md-3 control-label">Skype</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="skype" placeholder="" value="<?php echo $this->config->item('skype');?>">

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Twitter</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="twitter" placeholder="" value="<?php echo $this->config->item('twitter');?>">

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Youtube</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="youtube" placeholder="" value="<?php echo $this->config->item('youtube');?>">

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Facebook</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="facebook" placeholder="" value="<?php echo $this->config->item('facebook');?>">

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Google plus</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="google_plus" placeholder="" value="<?php echo $this->config->item('google_plus');?>">

										</div>
									</div>
									<legend>Unlockbase API's</legend>
									<div class="form-group">
										<label class="col-md-3 control-label">API key</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="unlockbase_api" placeholder="" value="<?php echo $this->config->item('unlockbase_API');?>">

										</div>
									</div>
									<legend>DHRU Resource API's</legend>
									<div class="form-group">
										<label class="col-md-3 control-label">Set Default Resource</label>
										<div class="col-md-4">
											<select name="dhru_default_resource" class="form-control input-medium">

											<?php foreach ($this->Source->get_all()->result_array() as $row) { ?>
												<option value="<?php echo $row['source_id'];?>" <?php if($this->config->item('dhru_default_resource') == $row['source_id']) echo 'selected';?>> <?php echo $row['DHRUFUSION_URL'];?></option>
											<?php } ?>
											</select>
										</div>
									</div>

									<legend>GEO Location</legend>
									<div class="form-group">
										<label class="col-md-3 control-label">Latitude</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="lat" placeholder="" value="<?php echo $this->config->item('lat');?>">

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Longitude</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="lng" placeholder="" value="<?php echo $this->config->item('lng');?>">

										</div>
									</div>
									<!-- <div class="form-group">
										<label class="control-label col-md-3">Slider</label>
										<div class="col-md-4">
											<textarea class="wysihtml5 form-control" rows="6"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">After slider</label>
										<div class="col-md-4">
											<textarea class="wysihtml5 form-control" rows="6"></textarea>
										</div>
									</div> -->
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-3 col-md-4">
										<button type="submit" class="btn green">Submit</button>
										<button type="button" class="btn default">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
<?php echo form_close();?>
</div>