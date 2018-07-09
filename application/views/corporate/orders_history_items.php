<table class="table table-bordered tree" >
<thead>
							<tr>
								<th class="text-center"></th>
								<th>ID</th>
								<th>
									<select name="status" class="input-sm form-control" id="status">
										<option value="">All</option>
										<option value="Success">Available</option>
										<option value="Rejected">Rejected</option>
										<option value="In Process">Pending</option>
									</select>
								</th>
								<th>
									<select name="items" class="input-sm form-control" id="item">
										<option value="">All</option>
										 <?php foreach($this->Item->get_all()->result_array() as $row) { ?>

                                            <option value="<?php echo $row['item_id'];?>">
                                                <?php echo $row['item_name'];?>
                                            </option>

                                        <?php } ?>

									</select>
								</th>
								<th>
									<input name="imei" class="input-sm form-control" id="imei" placeholder="search IMEI">
								</th>
								<th>Code</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							
							<?php 
							$i = 0; 
							if ($result->num_rows() > 0) {
								foreach ($result->result() as $row) { ?>
									<tr class="group <?php echo 'treegrid-group-'.$row->order_id;?>">
										<td class="text-center"></td>
										<td><?php echo $row->order_id;?></td>
										<td>
											<?php 
											switch ($row->status) {
												case 'In Process':
													$status = 'blue';
													break;
												case 'Success':
													$status = 'green';
													break;
												case 'Rejected':
													$status = 'red';
													break;
												default:
													$status = 'yellow';
													break;
											}
											?>

											<button class="btn btn-xs <?php echo $status;?>"><?php echo $row->status;?></button>
											
										</td>
										<td><?php echo $this->Item->get_info($row->item_id)->item_name;?></td>
										<td><?php echo $row->service_data;?></td>
										<td><?php echo $row->comments;?></td>
										<td>
											<?php 
											if ($row->status == 'In Process') {
												echo 'Locked';
											} elseif ($row->status == 'Rejected') {
												echo '';
											} else { 
												echo  ($row->isVerified == 0) ? '<a href="">Verefy</a>' : 'Verefied';
											} ?>

											</td>
										
									</tr>
									<tr class="subgroup <?php echo 'treegrid-subgroup-'.$i;?> <?php echo 'treegrid-parent-group-'.$row->order_id;?>">
										<td colspan="8">
											<div class="row">
												<div class="col-md-8">
													<dl class="dl-horizontal">
													  	<dl class="dl-horizontal">
														  	<dt>IMEI :</dt>
														  	<dd><?php echo $row->service_data;?></dd>
														  	<dt>Code :</dt>
														  	<dd><span class="label label-danger"><?php echo ($row->feedback) ? $row->feedback : 'No code submited!';?></span></dd>
														  	<dt>Submited on :</dt>
														  	<dd><?php echo $row->order_date;?></dd>
														  	<dt>Replied on :</dt>
														  	<dd><?php echo $row->order_date;?></dd>
														</dl>
													  
													</dl>
												</div>
												<div class="col-md-4">
													<strong><i class="fa fa-dollar fa-fw"></i><?php echo $this->Item->get_info($row->item_id)->item_price;?></strong>
												</div>
											</div>
											
											
										</td>
									</tr>
								<?php $i++; }
							}else{ ?>
								<tr>
									<td colspan="8">
										No record found!
									</td>
								</tr>
							<?php } ?>
							
						
							

						</tbody>
					</table>
					<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
 
$(document).ready(function() {
    $('.tree').treegrid({
        expanderExpandedClass: 'fa fa-minus',
        expanderCollapsedClass: 'fa fa-plus',
        initialState: 'collapsed'
    });

});

</script>

					