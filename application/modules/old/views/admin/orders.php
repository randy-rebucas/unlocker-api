<style>
a.btn {
    width: 100% !important;
}
</style>

<div class="page-content">
	<?php if ($this->session->flashdata('alert_error')) { ?>
		<div class="alert alert-error">
			<?php echo $this->session->flashdata('alert_error'); ?>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		</div>
	<?php } ?>

	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-file-text fa-fw"></i> Site Orders [ Source selected : <?php echo $this->Source->get_info($this->config->item('dhru_default_resource'))->DHRUFUSION_URL ;?>]
			</div>
			<div class="actions">

				<a href="<?php echo site_url('orders/delete');?>" class="btn btn-danger" id="delete">
					<i class="fa fa-trash-o"></i> Delete
				</a>
			</div>
		</div>
		<div class="portlet-body">
			
			<?php echo $table;?>
		
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

