
		<div class="row breadcrumbs">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>Service status</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="active">Service status</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
        <!-- BEGIN CONTAINER -->   
		<div class="container min-hight">
			<div class="row">
				<div class="col-md-12 col-sm-12">

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
                                                <th style="width:50%"> Service Name</th>
                                                <th style="width:20%">Price</th>
                                     
                                                <th style="width:10%">Delivery Time</th>
                                                <th style="width:10%" class="text-center">Status</th>
                                            </tr>
                                                <?php foreach ($groups['SERVICES'] as $key) { ?>
                                                    <tr>    
                                                        <td><a href="<?php echo site_url('item-details/'.strtolower('IMEI').'/'.$key['SERVICEID']);?>" class="searchme"><?php echo $key['SERVICENAME'];?></a> </td>
                                                        <td> <?php echo '<i class="fa fa-dollar fa-fw"></i> '. $key['CREDIT'];?></td>
                
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
			</div>
		</div>