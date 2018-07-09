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
								    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
									<div class="form-group">
										<label class="col-md-3 control-label">Item name</label>
										<div class="col-md-4">
											<input name="item_name" type="text" class="form-control" value="<?php echo $item_info->item_name;?>" placeholder="Sample item">

										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-3 control-label">Item description</label>
										<div class="col-md-4">
											<textarea name="item_description" class="form-control"><?php echo $item_info->item_description;?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Services</label>
										<div class="col-md-4">
											<?php echo form_dropdown('services',$services, set_value('services', ( ( !empty($selected_services) ) ? $selected_services : $item_info->service_id) ),' class="form-control"'); ?> 

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Category</label>
										<div class="col-md-4">
											<?php echo form_dropdown('categories',$categories, set_value('categories', ( ( !empty($selected_categories) ) ? $selected_categories : $item_info->category_id) ),' class="form-control"'); ?> 

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Price</label>
										<div class="col-md-4">
											<input name="item_price" type="text" class="form-control" value="<?php echo $item_info->item_price;?>" placeholder="0.00">

										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Delivery time</label>
										<div class="col-md-4">
											<input name="delivery_time" type="text" class="form-control" value="<?php echo $item_info->delivery_time;?>" placeholder="24 hours">

										</div>
									</div>

									<div class="form-group">
		                              <label class="col-md-3 control-label"></label>
		                              <div class="col-md-4">

		                                 <div class="checkbox">
		                                    <label>
		                                    	<input name="hasCalc" type="checkbox" value="1" <?php if($item_info->hasCalc == 1) echo 'checked';?>>
		                                    	Calculator
		                                    </label>
		                                </div>
										<div class="checkbox">
		                                    <label>
		                                    	
		                                    	<input name="isVerifiable" type="checkbox" value="1" <?php if($item_info->isVerifiable == 1) echo 'checked';?>>
		                                    	Verefiable
		                                    </label>
		                                </div>
										<div class="checkbox">
		                                    <label>
		                                    	
		                                    	<input name="isCancelable" type="checkbox" value="1" <?php if($item_info->isCancelable == 1) echo 'checked';?>>
		                                    	Cancelable
		                                    </label>
		                                 </div>
		                              </div>
		                           </div>

		                           <div class="form-group">
		                              <label class="col-md-3 control-label">Activate</label>
		                              <div class="col-md-4">

		                                 <div class="checkbox">
		                                    <label>
		                                    	<input name="item_status" type="checkbox" value="1" <?php if($item_info->item_status == 0) echo 'checked';?>>
		                                    	
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