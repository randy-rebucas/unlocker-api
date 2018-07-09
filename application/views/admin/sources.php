<div class="page-content">

	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-sitemap fa-fw"></i>Sources API's
			</div>
			<div class="actions">
				<a href="<?php echo site_url('admin/sources/create/-1');?>" class="btn yellow">
					<i class="fa fa-plus"></i> Add
				</a>
				<a href="<?php echo site_url('admin/sources/delete');?>" class="btn btn-danger" id="delete">
					<i class="fa fa-trash-o"></i> Delete
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
							DHRUFUSION URL
						</th>
						<th>
							USERNAME
						</th>
						<th>
							API ACCESS KEY
						</th>
						<th class="text-center">
							 Status
						</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php 
				// echo '<pre>';
				// print_r($result->result());

				if ($result->num_rows() > 0) {
					
					foreach ($result->result() as $row) { ?>
						<tr class="odd gradeX">
							<td>
								<input type="checkbox" class="checkboxes" value="<?php echo $row->source_id;?>"/>
							</td>
							<td>
								 <?php echo $row->DHRUFUSION_URL;?>
							</td>
							<td>
								 <?php echo $row->USERNAME;?>
							</td>
							<td>
								 <?php echo $row->API_ACCESS_KEY;?>
							</td>
							<td>
									
								 <?php echo ($row->status == 1) ? '<span class="label label-sm label-success">
									Active </span>' : '<span class="label label-sm label-warning">
									InActive </span>' ;?>
							</td>
							<td class="text-center">
								<a href="<?php echo site_url('admin/sources/create/'.$row->source_id);?>" class="btn btn-xs btn-success"><i class="fa fa-edit fa-fw"></i>Edit</a>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
var $j = jQuery.noConflict();
// $j is now an alias to the jQuery function; creating the new alias is optional.
 
$j(document).ready(function() {
    
    $j("#delete").on("click", function(event) {
        var link = $j(this).attr('href'); 
        var sel = false;
        var ch = $j('#sample_3').find('tbody input[type=checkbox]');
        var c = confirm('Continue delete?');
        if (c) {
            ch.each(function() {
                var _this = $j(this);
                if (_this.is(':checked')) {
                    sel = true; //set to true if there is/are selected row

                    var chk_val = $j(this).val(); //split checkbox value
                    
                    $j.ajax({
                        url: link,  
                        type: 'post',
                        data: {
                            ids: chk_val
                        },
                        success: function(data) {
                            if (data.status != 'error') {
                                _this.parents('tr').fadeOut(function() {
                                    _this.remove();
                                });
                            }
                        }
                    });
                }
            });

            if (!sel) alert('No data selected');

        }
        return false;
    });

});

</script>
