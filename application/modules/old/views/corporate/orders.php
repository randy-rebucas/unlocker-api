<style>
@import url('http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css');
@import url('http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2-bootst


</style>
		<div class="row breadcrumbs">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1><?php echo $type;?> SERVICE</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="active">Place a new <?php echo $type;?> order</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
        <!-- BEGIN CONTAINER -->   
		<div class="container min-hight">
			<div class="row">
				<div class="col-md-9 col-sm-9">
					<?php if ($this->session->flashdata('alert_success')) { ?>
			        <div class="alert alert-success fade in">
				        <?php echo $this->session->flashdata('alert_success'); ?>
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				    </div>
				    <?php } ?>
				    <?php if ($this->session->flashdata('alert_error')) { ?>
			        <div class="alert alert-danger fade in">
				        <?php echo $this->session->flashdata('alert_error'); ?>
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				    </div>
				    <?php } ?>
				    
				    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

	<?php 
          //echo '<pre>';

            foreach ($result['SUCCESS'] as $results) {
                //print_r($results['MESSAGE'].'<br>');
                echo '<legend>Service - '.$results['MESSAGE'].'</legend>';
                //start here
                echo '<select class="" id="order-services">';
                	echo '<option value="">Select</option>';
                foreach ($results['LIST'] as $groups) {
                  //print_r(' - '.$groups['GROUPNAME'].'<br>');
                  echo '<optgroup label="'.$groups['GROUPNAME'].'">';
                  foreach ($groups['SERVICES'] as $key) {
                      //print_r(' -- '.$key['SERVICENAME'].'<br>');
					  if($this->Item->get_override_info($key['SERVICEID'])->o_status == 0) {
						echo '<option value="'.$key['SERVICEID'].'">'.$key['SERVICENAME'].'</option>';
					  }

                  }

                }
                 echo '</select>';
              }

   ?>
		
			        <div id="result">
						<p class="text-center" style="margin: 115px auto;"><i class="fa fa-hdd-o fa-5x"></i><br>
						Select services list on top</p>
			        </div>
					<div class="col-md-12">
						
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					
					
					<?php 
          //echo '<pre>';
            $index = 0;
            foreach ($result['SUCCESS'] as $results) {

                echo '<legend>Service - '.$results['MESSAGE'].'</legend>';
               
                foreach ($results['LIST'] as $groups) { ?>


						<div id="accordion<?php echo $index;?>" class="panel-group">
			                        <div class="panel panel-default">
			                            <div class="panel-heading">
			                                <h4 class="panel-title">
			                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion<?php echo $index;?>" href="#accordion<?php echo $index;?>_1">
			                                    <?php echo $groups['GROUPNAME'];?>
			                                    </a>
			                                </h4>
			                            </div>
			                            <div id="accordion<?php echo $index;?>_1" class="panel-collapse collapse" style="height: 0px;">
			                                <div class="panel-body">
			                                    <ul class="nav sidebar-categories margin-bottom-40">
                                                <?php foreach ($groups['SERVICES'] as $key) { ?>

                                                    <li>
                                                    <li><a href="#"><?php echo $key['SERVICENAME'];?></a></li>
                                                    </li>       
                                                <?php } ?>
										</ul>
			                                </div>
			                            </div>
			                        </div>         
			                    </div>
                        <?php $index++; 
				} 

            }

?>
				</div>
			</div>
		</div>	
<script type="text/javascript">
     

</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.min.js"></script>
<script type="text/javascript">
     
// $.getScript('http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.min.js',function(){
           
  // /* dropdown and filter select */
  // var select = $('#order-services').select2();


// }); //script  
var $j = jQuery.noConflict();
// $j is now an alias to the jQuery function; creating the new alias is optional.
 
$j(document).ready(function() {
	$j('#order-services').select2();
	$j('.select2-container').css('cssText', 'width: 100% !important');

    $j( "#order-services" ).change(function() {

	  	var _val = $j(this).val();
        //console.log(_val);
        if (_val != '') {

        	$.ajax({
	            type: "POST",
	            url: BASE_URL + 'orders/get_details/',
	            data: {
	                order_services: _val
	            },
				beforeSend: function() {
					$("#result").html('<p class="text-center" style="margin: 115px auto;"><i class="fa fa-cog fa-spin fa-5x"></i><br>Loading...</p>');
				},
	            success: function(data) {
	                $("#result").html(data);
	            }
	        })
	        
        }else{
        	alert('Please select a service.');
        };	
    	
       
	}); 
 
});

</script>
					