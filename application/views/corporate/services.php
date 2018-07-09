
		<div class="row breadcrumbs">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1><?php echo $type;?> SERVICE</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="active"><?php echo $type;?> Services</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
        <!-- BEGIN CONTAINER -->   
		<div class="container min-hight">
			<div class="row">
				<div class="col-md-9 col-sm-9">
										            <?php 
            // echo '<pre>';
            // print_r($result['SUCCESS']);

            $index = 0;
            foreach ($result['SUCCESS'] as $results) {

                echo '<legend>Service - '.$results['MESSAGE'].'</legend>';
               
                foreach ($results['LIST'] as $groups) { ?>


                        <div class="accordian">
                             
                                <div>                    
                                    <h4 id="g0">
                                        <span>
                                            <?php echo $groups['GROUPNAME'];?>                     
                                        </span>
                                    </h4>
                                    
                                    <table class="table table-bordered"> 
                                        <tbody>
                                            <tr>    
                                                <th style="width:70%"> Service Name</th>
                                                <th style="width:20%">Delivery Time</th>
                                                <th style="width:10%" class="text-center">Status</th>
                                            </tr>
                                                <?php foreach ($groups['SERVICES'] as $key) { ?>
                                                    <tr>    
                                                        <td><a href="<?php echo site_url('item-details/'.strtolower('IMEI').'/'.$key['SERVICEID']);?>" class="searchme"><?php echo $key['SERVICENAME'];?></a> </td>
                
                                                        <td><?php echo $key['TIME'];?></td>
                                                        <td class="text-center"><?php echo '<span class="label label-success">Active</span>';?></td>
                                                    </tr> 
                                                    
                                                    <?php } ?>

               
                                            </tbody></table> 
                                                       
                                     <div class="clear"></div>
                                     <br> 
                                </div>        
      
                             <div style="clear:both"></div>
                             </div>
                        <?php $index++; } 

                         }

?>
					
				    
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

								