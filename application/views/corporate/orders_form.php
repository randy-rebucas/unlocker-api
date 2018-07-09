
  <div class="col-md-12">

    <h3><?php echo $result['SUCCESS'][0]['LIST']['service_name'];?></h3>
   
    <ul class="list-unstyled">
      <li><h3><i class="fa fa-dollar"></i> <?php echo ($this->Item->get_override_info($result['ID'])->o_price) ? $this->Item->get_override_info($result['ID'])->o_price : $result['SUCCESS'][0]['LIST']['credit'];?></h3></li>
      <li><?php echo 'Delivery time : '.$result['SUCCESS'][0]['LIST']['time'];?></h3></li>
      <li><?php if($result['SUCCESS'][0]['LIST']['verifiable'] == 1) echo 'Verefiable' ;?></li>
      <li><?php if($result['SUCCESS'][0]['LIST']['usercan_cancel'] == 1) echo 'Cancelable' ;?></li> 
    </ul>
	<div class="alert alert-info">
	<?php echo '<i class="fa fa-exclamation-triangle fa=fw"></i>'. $result['SUCCESS'][0]['LIST']['features'];?>
	</div>
	<?php 
	//echo '<pre>';
	//print_r($result['SUCCESS']);
	?>
    <hr>
      <div class="panel panel-info">
                <div class="panel-heading"><h3 class="panel-title">Enter information</h3></div>
                    <div class="panel-body">
                    <?php echo form_open_multipart('orders/place_order','class="form-horizontal" role="form"');?>
                      <input type="hidden" name="item_id" value="<?php echo $result['ID'];?>">
                      <input type="hidden" name="service_type" value="<?php echo 'IMEI';?>">
                        <div class="form-body">

                            <div class="form-group">
                              <label class="col-md-3 control-label">IMEI</label>
                                <div class="col-md-9">
                                  <div class="input-group"> 
                                      <input name="service_data" type="text" id="imei" class="form-control" maxlength="15" placeholder="Enter imei" >
                                      
                                      <span class="input-group-btn">
                                        <button class="btn blue" type="button" id="bulk" onclick="addtext()">Add to bulk IMEI</button>
                                      </span>
                                  
                                  </div>
                                </div>    
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label"></label>
                                <div class="col-md-9">

                                   <span class="help-block">Only 15 digit Number (dial <code>*#06#</code> for IMEI Number)</span>
                                </div>

                             </div> 
                            <div class="form-group">
                              <label class="col-md-3 control-label">Bulk IMEI</label>
                              <div class="col-md-9">
                                 <textarea name="bulk_imei" id="bulk-imei" rows="5" class="form-control" placeholder="Enter bulk imei" readonly="readonly" required="readonly"></textarea>
                                 <span class="help-block">You can enter several serial number (separate in comma).Only 15 digit Number (dial <code>*#06#</code> for IMEI Number)</span>
                              </div>
                            </div>
                            
                           <div class="form-group">
                                <label class="col-md-3 control-label">Notes</label>
                                <div class="col-md-9">
                                   <input name="notes" type="text" class="form-control" placeholder="Enter notes" >
                                   <span class="help-block">You can enter any additional notes or information you want including your order here.</span>
                                </div>
                             </div>
                             <div class="form-group">
                                <label class="col-md-3 control-label">Comments</label>
                                <div class="col-md-9">
                                   <textarea name="comments" class="form-control" placeholder="Enter comments"></textarea>
                                   <span class="help-block">For your self, Usefull to remember something about this order (name of your customer)</span>
                                </div>
                             </div>
                             <div class="form-group">
                                <label class="col-md-3 control-label">Response email</label>
                                <div class="col-md-9">
                                   <input name="response_email" type="email" class="form-control" placeholder="Enter email" >
                                   <span class="help-block">The emeil of your customer who will receive your custom reply</span>
                                </div>
                             </div>

                        </div>
                        <div class="form-actions fluid">
                           <div class="col-md-offset-3 col-md-9">
                              <button type="submit" class="btn green">Submit order</button>                             
                           </div>
                        </div>
                    <?php echo form_close();?>
                    </div>
                </div>
    
  </div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
function addtext() {
  var newtext = $('#imei').val();
  $('#bulk-imei').val(newtext +',\n'+ $('#bulk-imei').val() );
  $('#imei').val('');
}
</script>



