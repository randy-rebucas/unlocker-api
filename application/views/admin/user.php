<div class="page-content">

	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-users fa-fw"></i>Users
			</div>
			<div class="actions">
				<a href="<?php echo site_url();?>" class="btn yellow" disabled>
					<i class="fa fa-plus"></i> Add
				</a>
			</div>
		</div>
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover" id="sample_3">
				<thead>
					<tr>
						<th class="table-checkbox">
							<input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/>
						</th>
						<th>
							 Username
						</th>
						<th>
							 Email
						</th>
						<th class="text-center">
							 Status
						</th>
						<th>
							 IP
						</th>
						<th>
							 Created
						</th>
						<th>
							 Funds
						</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php if ($result->num_rows() > 0) {
					
					foreach ($result->result() as $row) { ?>
						<tr class="odd gradeX">
							<td>
								<input type="checkbox" class="checkboxes" value="1"/>
							</td>
							<td>
								 <?php echo $row->username;?>
							</td>
							<td>
								<a href="mailto:<?php echo $row->email;?>">
									<?php echo $row->email;?>
								</a>
							</td>
							<td class="text-center">
								<?php $label = ($row->activated == 1) ? 'success' : 'error' ; ?>
								<?php $text = ($row->activated == 1) ? 'Activated' : 'Not Activated' ; ?>
								<span class="label label-sm label-<?php echo $label;?>">
									<?php echo $text;?>
								</span>
							</td>
							<td>
								<?php echo $row->ip;?>
							</td>
							<td>
								<?php echo $row->created;?>
							</td>
							<td class="text-right"><i class="fa fa-dollar fa-fw"></i>
								<?php 
								echo ($row->bal > 0) ? $row->bal : 0 ;
								?>
							</td>
							<td class="text-center">
								<a href="" data-target="#basic-<?php echo $row->id;?>" data-toggle="modal" class="btn btn-xs yellow">Add funds</a>
								<div class="modal fade" id="basic-<?php echo $row->id;?>" tabindex="-1" role="basic" aria-hidden="true">
									<div class="modal-dialog">
										<?php echo form_open('payment/add_funds/');?>
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
												<h4 class="modal-title">Add funds</h4>
											</div>
											<div class="modal-body">
												<h3><?php echo $row->last_name.','.$row->first_name. '['.$row->username.']';?></h3>
												<br>
												<!--fund_created-->
												<input name="user_id" type="hidden" value="<?php echo $row->user_id;?>" />
												
										            <input name="fund_amount" type="text" value="" class="form-control" placeholder="Add amount here." required="required" maxlength="10"/>

										            <textarea name="notes" data-provide="markdown" data-autofocus="true" class=" form-control" rows="6" >Add note here</textarea>
										        
												
											</div>
											<div class="modal-footer">
												<button type="submit" name="submit" class="btn blue">Add</button>
											</div>
										</div>
										<!-- /.modal-content -->
										<?php echo form_close();?>
									</div>
									<!-- /.modal-dialog -->
								</div>
							</td>
						</tr>
					<?php }
					# code...
				}?>
					
					
				</tbody>
			</table>
		</div>
	</div>
</div>