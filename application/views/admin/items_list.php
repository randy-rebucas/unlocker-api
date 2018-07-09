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