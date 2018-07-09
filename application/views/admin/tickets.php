<div class="page-content">

	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-table fa-fw"></i>Tickets
			</div>
			<div class="actions hidden">
				<a href="#" class="btn green">
					<i class="fa fa-plus"></i> Add
				</a>
				<a href="#" class="btn yellow">
					<i class="fa fa-print"></i> Print
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
							Subject
						</th>
						<th>
							Description
						</th>
						<th>
							Submited by
						</th>
						<th>
							Created
						</th>
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
								 <?php echo $row->ticket_subject;?>
							</td>
							<td>
									
								 <?php echo $row->ticket_description;?>
							</td>
							<td>
									
								 <?php echo $row->user_id;?>
							</td>
							<td>
									
								 <?php echo $row->ticket_created;?>
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