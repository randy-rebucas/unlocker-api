
		<div class="row breadcrumbs">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1><?php echo $type;?> SERVICE</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="active"><?php echo $type;?> Services / <?php echo character_limiter($result['SUCCESS'][0]['LIST']['service_name'], 20);?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
        <!-- BEGIN CONTAINER -->   
		<div class="container min-hight">
			<div class="row">
				<div class="col-md-9 col-sm-9">
					<?php echo '<legend>Service - '. character_limiter($result['SUCCESS'][0]['LIST']['service_name'], 50).'</legend>'; ?>
					<div class="well">
						
						
	<h3><?php echo $result['SUCCESS'][0]['LIST']['service_name'];?></h3>
   
    <ul class="list-unstyled">
      <li><h3><?php 
							if (!$this->tank_auth->is_logged_in()) 
							{
								echo '<i class="fa fa-dollar"></i> <a href="'.site_url('login').'">Please login to see the Price!</a>';
							}else{ ?>
								<i class="fa fa-dollar"></i> <?php echo ($this->Item->get_override_info($result['ID'])->o_price) ? $this->Item->get_override_info($result['ID'])->o_price : $result['SUCCESS'][0]['LIST']['credit'];?>
							<?php } ?></li>
      <li><?php echo 'Delivery time : '.$result['SUCCESS'][0]['LIST']['time'];?></h3></li>
      <li><?php if($result['SUCCESS'][0]['LIST']['verifiable'] == 1) echo 'Verefiable' ;?></li>
      <li><?php if($result['SUCCESS'][0]['LIST']['usercan_cancel'] == 1) echo 'Cancelable' ;?></li> 
    </ul>

					</div>

				</div>
				<div class="col-md-3 col-sm-3">
					<?php 
          //echo '<pre>';
            $index = 0;
            foreach ($list_result['SUCCESS'] as $results) {

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

								