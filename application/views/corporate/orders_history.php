

		<div class="row breadcrumbs">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>Order history</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="active">Order history</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
        <!-- BEGIN CONTAINER -->   
		<div class="container min-hight">
			<div class="row">
				<div class="col-md-12 col-sm-12" >
					<?php echo $table;?>

				</div>
				
			</div>
		</div>	

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
 

$(document).ready(function() {
    $('.tree').treegrid({
        expanderExpandedClass: 'fa fa-minus',
        expanderCollapsedClass: 'fa fa-plus',
        initialState: 'collapsed'
    });

    $('#status').on('change', function() {
        var value = $("#status option:selected").val();
		//alert(value);
		$("table tr").each(function(index) {
			if (index !== 0) {

				$row = $(this);

				var id = $row.find("td button.btn-costum").text();

				if (id.indexOf(value) !== 0) {
					$row.hide();
				}
				else {
					$row.show();
				}
			}
		});
	
    });

    $('#order-services').on('change', function() {
        var value = $("#order-services option:selected").text();
		//alert(value);
		$("table tr").each(function(index) {
			if (index !== 0) {

				$row = $(this);

				var id = $row.find("td.items").text();

				if (id.indexOf(value) !== 0) {
					$row.hide();
				}
				else {
					$row.show();
				}
			}
		});
    });

	$("#imei").on("keyup", function() {
		var value = $(this).val();

		$("table tr").each(function(index) {
			if (index !== 0) {

				$row = $(this);

				var id = $row.find("td.imeis").text();

				if (id.indexOf(value) !== 0) {
					$row.hide();
				}
				else {
					$row.show();
				}
			}
		});
	});
});

</script>

					