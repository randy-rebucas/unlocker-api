<div class="page-content">

    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-sitemap fa-fw"></i>Remote Services
            </div>

        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12">
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
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Service name </th>
                                                    <th>Credit </th>
                                                    <th>Type </th>
                                                    <th>Delivery </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($groups['SERVICES'] as $key) { ?>

                                                    <tr class="items-id" id="<?php echo $key['SERVICEID'];?>">
                                                        <td>
                                                            <a href="<?php echo site_url($key['SERVICEID']);?>">
                                                                <?php echo $key['SERVICENAME'];?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php echo '<i class="fa fa-dollar fa-fw"></i> '. $key['CREDIT'];?></td>
                                                        <td>
                                                            <?php //echo $key['SERVICENAME'];?><i class="fa fa-calculator"></i></td>
                                                        <td>
                                                            <?php echo $key['TIME'];?>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>

               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <?php $index++; } 

                         }

?>
                </div>
            </div>

        </div>
    </div>




</div>
<script type="text/javascript">
    //var BASE_URL = '<?php echo base_url(); ?>';
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
    // var $j = jQuery.noConflict();

    // $j(document).ready(function() {

    //     //$j("#actions").trigger('change');
    //  $('input[name=actions]').trigger('change');

    //     $("#actions").on("change", function() {
    //         var _val = $(this).val(); 

    //          $.ajax({
    //             url: BASE_URL + 'admin/remote_services/get_remote_data/',
    //             data: {
    //                 actions: _val
    //             },
    //             type: 'POST',
    //             success: function(data) {
    //                 $('#remote-result').html(data);
    //             }
    //         });

    //     });

    // });
</script>