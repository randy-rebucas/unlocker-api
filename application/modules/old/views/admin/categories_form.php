<div class="page-content">

<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i> <?php echo $title;?>
							</div>
							
						</div>
						<div class="portlet-body form">
							<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal" id="app_settings" role="form"');?>
								<div class="form-body">
									<?php if ($this->session->flashdata('alert_success')) { ?>
								    <div class="alert alert-success">
								        <?php echo $this->session->flashdata('alert_success'); ?>
								        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								    </div>
								    <?php } ?>
									<?php echo form_error('category_name', '<div class="alert alert-danger">', '</div>'); ?>
									<div class="form-group">
										<label class="col-md-3 control-label">Category name</label>
										<div class="col-md-9">
											<input name="category_name" type="text" value="<?php echo $category_info->category_name;?>" class="form-control" placeholder="Enter text">

										</div>
									</div>
									<div class="form-group">
		                              <label class="col-md-3 control-label">Activate</label>
		                              <div class="col-md-4">

		                                 <div class="checkbox">
		                                    <label>
		                                    	<input name="category_status" type="checkbox" value="1" <?php if($category_info->category_status == 0) echo 'checked';?>>
		                                    	
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