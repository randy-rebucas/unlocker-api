<style>
.content-error{
	color:red !important;
}
.chat-body ul li.message img {
    width: 50px;
    height: auto;
}
.editable.editable-click {
    color: #383838 !important;
    border-bottom: dashed 1px #383838;
}
.connections-list img, .followers-list img {
    width: 35px;
    height: auto;
}
</style>
<!-- Bread crumb is created dynamically -->
<!-- row -->
<div class="row">

	<!-- col -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h1 class="page-title txt-color-blueDark">
			<?php echo sprintf($this->lang->line(strtolower($module).'_welcome'), $user_info->username);?> 
		</h1>
	</div>
	<!-- end col -->

</div>
<!-- end row -->

<!--
The ID "widget-grid" will start to initialize all widgets below
You do not need to use widgets if you dont want to. Simply remove
the <section></section> and you can use wells or panels instead
-->


<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">
		<div class="col-sm-12 col-md-8 col-lg-8">

			<div class="alert alert-info fade in">
				
				<strong id="result-count">0 </strong>
				<i class="fa-fw fa fa-info-circle pull-right"></i>
			</div>

			<div id="result"></div>

			<!-- append post here -->

		</div>
		<div class="col-sm-12 col-md-4 col-lg-4" >
			<!--<h1><small>Followers</small></h1>
			<ul class="list-inline followers-list"></ul>

			<h1><small>Connections</small></h1>
			<ul class="list-inline connections-list"></ul>-->
			
		</div>
	</div>

	<!-- end row -->

</section>
<!-- end widget grid -->
<script type="text/javascript">

	/* DO NOT REMOVE : GLOBAL FUNCTIONS!
	 *
	 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
	 *
	 * // activate tooltips
	 * $("[rel=tooltip]").tooltip();
	 *
	 * // activate popovers
	 * $("[rel=popover]").popover();
	 *
	 * // activate popovers with hover states
	 * $("[rel=popover-hover]").popover({ trigger: "hover" });
	 *
	 * // activate inline charts
	 * runAllCharts();
	 *
	 * // setup widgets
	 * setup_widgets_desktop();
	 *
	 * // run form elements
	 * runAllForms();
	 *
	 ********************************
	 *
	 * pageSetUp() is needed whenever you load a page.
	 * It initializes and checks for all basic elements of the page
	 * and makes rendering easier.
	 *
	 */

	

	pageSetUp();
	
	/*
	 * PAGE RELATED SCRIPTS
	 */

	// pagefunction
	
	var pagefunction = function() {
		
		//load all patients encounter today	
		$.ajax({
			url: BASE_URL+'patients/load_ajax/',
			type: 'post', 
			data: {
				filter: '<?php echo date('Y-m-d');?>'
			},               
			dataType: 'json',
			success: function (response) {
				
				var items = [];
				$.each(response.data, function(index, val) {
					
					if(val.avatar){
						picture =  '<img src="'+BASE_URL+'uploads/'+client_id+'/profile-picture/'+val.avatar+'" alt="'+val.username+'" style="width:50px;" />';
					}else{
						picture =  '<img src="<?php echo $this->gravatar->get("'+row['email']+'", 50);?>" />';
					}
						
					item =	'<div class="user" title="'+val.email+'">'+
								picture+'<a href="javascript:void(0);">'+val.fullname+'</a>'+
								'<div class="email">'+val.email+'</div>'+
							'</div>';	

					items.push(item);
				});

				$('#result-count').html(response.recordsTotal +' encounter as of today!');
				$('#result').append(items);

			}
		});
		
	};
	
	// end pagefunction

	// destroy generated instances 
	// pagedestroy is called automatically before loading a new page
	// only usable in AJAX version!

	var pagedestroy = function(){
		
		

	}

	// end destroy
	
	// run pagefunction on load
	pagefunction();
	
	
</script>
