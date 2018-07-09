<!-- BEGIN BREADCRUMBS -->   
        <div class="row breadcrumbs margin-bottom-40">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1> My Dashboard</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active"> My Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
        <!-- BEGIN CONTAINER -->   
        <div class="container">

            <div class="row">
				
                <div class="col-md-6 col-sm-6">
                    <div class="well account-details">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h3><?php echo $user_info->username;?></h3>
                                <address>
                                    <strong>Address</strong><br>
                                    <?php echo $user_info->address_1;?>, <?php echo $user_info->address_1;?><br>
                                    <?php echo $user_info->city;?>, <?php echo $user_info->state;?> <?php echo $user_info->postal_code;?><br>
                                    <abbr title="Phone">P:</abbr> <?php echo $user_info->contact_no;?>
                                </address>
                                <address>
                                    <strong>Full Name</strong><br>
                                    <?php echo $user_info->first_name.', '.$user_info->last_name;?> <br>
                                    
                                </address>
                                <address>
                                    <strong>Email</strong><br>
                                    <a href="mailto:<?php echo $user_info->email;?>"><?php echo $user_info->email;?></a>
                                </address>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <ul class="list-unstyled">
									<li><a href="javascript:;">Submit Ticket</a></li> 
									<li><a href="javascript:;">My Statement</a></li>
									<li><a href="javascript:;">View Monthly Orders</a></li>
									<li><a href="javascript:;">Login History</a></li>
								</ul>
								<hr>
								<strong>Last login</strong><br>
                                    <?php echo $user_info->last_login;?>
								<hr>
								<strong>Last IP</strong><br>
                                    <?php echo $user_info->last_ip;?>
                            </div>     
                        </div>
                    </div>
                </div>
				<div class="col-md-3 col-sm-3">
					<div class="well credit-details">

						<div class="list-group">
						  <a href="#" class="list-group-item active">
							<h4 class="list-group-item-heading">$
											<?php $rem_funds = $this->User_list->bal_funds($user_info->user_id);
												echo ($rem_funds > 0) ? $rem_funds : 0 ?> USD</h4>
							<p class="list-group-item-text">Available Balance</p>
						  </a>
						</div>
                        <hr>
                        <ul class="list-unstyled">
							<li>Total receipt <span class="badge pull-right">0</span></li>
                               
						</ul>
                           
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
					<div class="well order-summary">
						<ul class="list-group">
							<li class="list-group-item">Available <span class="badge"><?php echo $total_success_orders;?></span></li>
                            <li class="list-group-item">In Process <span class="badge"><?php echo $total_pending_orders;?></span></li>
							<li class="list-group-item">Rejected <span class="badge"><?php echo $total_failed_orders;?></span></li>
						</ul>

                    </div>
                </div>
            </div>
			
			<div class="row">
				<div class="col-md-12 col-sm-12" >
				<h2>Quick View</h2>
					<?php echo $table;?>

				</div>
				
			</div>
        </div>
        <!-- END CONTAINER -->
		
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