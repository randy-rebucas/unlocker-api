<div class="page-content">

	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-puzzle-piece fa-fw"></i>Items
			</div>
			<div class="hidden actions">
				<a href="<?php echo site_url('admin/items/create/-1');?>" class="btn yellow">
					<i class="fa fa-plus"></i> Add
				</a>
				<a href="<?php echo site_url('admin/items/delete');?>" class="btn btn-danger" id="delete">
					<i class="fa fa-trash-o"></i> Delete
				</a>
			</div>
		</div>
		<div class="portlet-body" id="data_result">
			<table class="table table-striped table-bordered table-hover" id="sample_3">
                <thead>
                    <tr>
                    	<th class="table-checkbox">
							<input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/>
						</th>
                        <th>Service name </th>
                        <th>Delivery </th>
                        <th>Credit </th>
                        <th>Overide price </th>
						<th>Status</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
	          	//echo '<pre>';
	  			//print_r($result['SUCCESS'][0]['LIST']);//['LIST']
	  			foreach ($result['SUCCESS'][0]['LIST'] as $row) {
	  				//print_r($row);
	  				foreach ($row['SERVICES'] as $key) { ?>
	  					<!-- print_r($key['SERVICENAME'].'<br>'); -->
	  					<tr class="items-id" id="<?php echo $key['SERVICEID'];?>">
                            <td>
								<input type="checkbox" value="<?php echo $key['SERVICEID'];?>" class="checkboxes" />
							</td>
                            <td>
                                <!-- <a href="<?php echo site_url($key['SERVICEID']);?>"></a> -->
                                <?php echo $key['SERVICENAME'];?>
                            </td>
                            
                            
                            <td>
                                <?php echo $key['TIME'];?>
                            </td>
                            <td class="text-right">
                                <?php echo '<i class="fa fa-dollar fa-fw"></i> '. $key['CREDIT'];?></td>
                            <td>
								<input name="oPrice" type="text" class="form-control input-sm oPrice text-right" data-id="<?php echo $key['SERVICEID'];?>" id="in-price-<?php echo $key['SERVICEID'];?>" value="<?php echo ($this->Item->get_override_info($key['SERVICEID'])->o_price) ? $this->Item->get_override_info($key['SERVICEID'])->o_price : ''; ?>" placeholder="enter price">
						
                            </td>
							<td>
								<select name="status" class="form-control input-sm oStatus" data-id="<?php echo $key['SERVICEID'];?>" id="in-status-<?php echo $key['SERVICEID'];?>">
									<option value="0" <?php if($this->Item->get_override_info($key['SERVICEID'])->o_status == 0) echo 'selected'; ?>>Enable</option>
									<option value="1" <?php if($this->Item->get_override_info($key['SERVICEID'])->o_status == 1) echo 'selected'; ?>>Disable</option>
								</select>
							</td>
                        </tr>
	  				<?php }
	  			} ?>
  			 	</tbody>
            </table>
 
		</div>
	</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
var $j = jQuery.noConflict();
// $j is now an alias to the jQuery function; creating the new alias is optional.

var BASE_URL = '<?php echo base_url(); ?>';

//$j('#data_result').load(BASE_URL + 'admin/items/load_ajax/');

$j(document).ready(function() {
	
    $j(".oPrice").on("blur", function() {

        var id = $(this).attr('data-id');
		var price = $(this).val();
        var status = $('#in-status-'+id).val();

        if (price != '') {

        	doOveride(id, price, status, 'price');
        };
       
    });
	
	$j(".oStatus").on("change", function() {

        var id = $(this).attr('data-id');
		var price = $('#in-price-'+id).val();
        var status = $(this).val();
		
		doOveride(id, price, status, 'status');

    });
	
	function doOveride(id, price, status, target){
			$.ajax({
				url: BASE_URL + 'admin/items/overide',
	            data: {
	                ids: id,
	                oprice: price,
					ostatus: status
	            },
	            type: 'POST',
	            beforeSend: function() {
	                if(target == 'status'){
						$("#in-status-"+id).addClass('spinner');
					}else{
						$("#in-price-"+id).addClass('spinner');
					}
	            },
	            success: function(data) {
					if(target == 'status'){
						 $("#in-status-"+id).removeClass('spinner');
					}else{
						 $("#in-price-"+id).removeClass('spinner');
					}
	            }
	        });
	}
	
});


</script>
