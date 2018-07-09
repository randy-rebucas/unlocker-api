<div class="page-content">

<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i> <?php echo $title;?>
							</div>
							
						</div>
						<div class="portlet-body form">
							<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal" id="" role="form"');?>
								<div class="form-body">
									<?php if ($this->session->flashdata('alert_success')) { ?>
								    <div class="alert alert-success">
								        <?php echo $this->session->flashdata('alert_success'); ?>
								        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								    </div>
								    <?php } ?>
									<?php echo form_error('category_name', '<div class="alert alert-danger">', '</div>'); ?>
									<div class="form-group">
										<label class="col-md-3 control-label">DHRUFUSION URL</label>
										<div class="col-md-9">
											<input name="DHRUFUSION_URL" type="text" class="form-control" value="<?php echo $source_info->DHRUFUSION_URL;?>" placeholder="Enter URL">

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">USERNAME</label>
										<div class="col-md-9">
											<input name="USERNAME" type="text" class="form-control" value="<?php echo $source_info->USERNAME;?>" placeholder="Enter Username">

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">API ACCESS KEY</label>
										<div class="col-md-9">
											<input name="API_ACCESS_KEY" type="text" class="form-control" value="<?php echo $source_info->API_ACCESS_KEY;?>" placeholder="Enter API">

										</div>
									</div>
									<div class="form-group">
		                              <label class="col-md-3 control-label">Activate</label>
		                              <div class="col-md-4">

		                                 <div class="checkbox">
		                                    <label>
		                                    	<input name="status" type="checkbox" value="1" <?php if($source_info->status == 1) echo 'checked';?>>
		                                    	
		                                    </label>
		                                </div>
		                              </div>
		                           </div>
								</div>
								<div class="form-actions fluid">
									<div class="col-md-offset-3 col-md-9">
										<button type="button" onclick="goBack()" class="btn default">Back</button>
										<button type="submit" class="btn green">Submit</button>
										
									</div>
								</div>
							<?php echo form_close();?>
						</div>
					</div>

</div>