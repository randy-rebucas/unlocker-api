<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">

		<!-- Use the .htaccess and remove these lines to avoid edge case issues -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>MyClinic</title>
		<meta name="description" content="">
		<meta name="author" content="Randy Rebucas">

		<meta name="viewport" content="width=device-width,initial-scale=1">

		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

		<script src="<?php echo base_url(); ?>assets/default/js/libs/modernizr-2.0.6.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-1.7.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-ui-1.10.3.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/bootstrap.min.js"></script>

        <script type="text/javascript">

            $(function()
            {
                $('.nav-tabs').tab();
                $('.tip').tooltip();
				
                $('.datepicker').datepicker({ format: '<?php echo date_format_datepicker(); ?>'});
		
                $('.create-invoice').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_create_invoice'); ?>");
                });
				
                $('.create-quote').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_create_quote'); ?>");
                });
				
				$('.create-appointment').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('appointments/ajax/modal_create_appointment'); ?>");
				});
				
                $('#btn_quote_to_invoice').click(function() {
                    quote_id = $(this).data('quote-id');
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_quote_to_invoice'); ?>/" + quote_id);
                });
				
                $('#btn_copy_invoice').click(function() {
                    invoice_id = $(this).data('invoice-id');
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_copy_invoice'); ?>", {invoice_id: invoice_id});
                });
                
                $('#btn_copy_quote').click(function() {
                    quote_id = $(this).data('quote-id');
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_copy_quote'); ?>", {quote_id: quote_id});
                });
                
                $('.patient-create-invoice').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('invoices/ajax/modal_create_invoice'); ?>", {
                        client_name: $(this).data('patient-name')
                    });
                });
                $('.patient-create-quote').click(function() {
                    $('#modal-placeholder').load("<?php echo site_url('quotes/ajax/modal_create_quote'); ?>", {
                        client_name: $(this).data('patient-name')
                    });
                });
				$(document).on('click', '.invoice-add-payment', function() {
                    invoice_id = $(this).data('invoice-id');
                    invoice_balance = $(this).data('invoice-balance');
                    $('#modal-placeholder').load("<?php echo site_url('payments/ajax/modal_add_payment'); ?>", {invoice_id: invoice_id, invoice_balance: invoice_balance });
                });

            });

        </script>

	</head>

	<body>

		<nav class="navbar navbar-inverse">

			<div class="navbar-inner">

				<div class="container">

					<ul class="nav">

						<li><?php echo anchor('dashboard', lang('dashboard')); ?></li>
						<li><?php echo anchor('appointments', lang('appointments')); ?></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('patients'); ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('patients/form', lang('add_patient')); ?></li>
								<li><?php echo anchor('patients', lang('view_patients')); ?></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('quotes'); ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#" class="create-quote"><?php echo lang('create_quote'); ?></a></li>
								<li><?php echo anchor('quotes', lang('view_quotes')); ?></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('invoices'); ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#" class="create-invoice"><?php echo lang('create_invoice'); ?></a></li>
								<li><?php echo anchor('invoices/index', lang('view_invoices')); ?></li>
                                <li><?php echo anchor('invoices/recurring', lang('view_recurring_invoices')); ?></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('payments'); ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('payments/form', lang('enter_payment')); ?></li>
								<li><?php echo anchor('payments', lang('view_payments')); ?></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('reports'); ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('reports/invoice_aging', lang('invoice_aging')); ?></li>
								<li><?php echo anchor('reports/payment_history', lang('payment_history')); ?></li>
								<li><?php echo anchor('reports/sales_by_patient', lang('sales_by_patient')); ?></li>
							</ul>
						</li>

					</ul>

					<?php if (isset($filter_display) and $filter_display == TRUE) { ?>
					<?php $this->layout->load_view('filter/jquery_filter'); ?>
					<form class="navbar-search pull-left">
						<input type="text" class="search-query" id="filter" placeholder="<?php echo $filter_placeholder; ?>">
					</form>
					<?php } ?>

					<ul class="nav pull-right settings">
                        <li><a href="#"><?php echo lang('welcome') . ' ' . $this->session->userdata('user_name'); ?></a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="http://docs.fusioninvoice.com/1.3/" target="_blank" class="tip icon" data-original-title="Documentation" data-placement="bottom"><i class="icon-question-sign"></i></a></li>
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="#" class="tip icon dropdown-toggle" data-toggle="dropdown" data-original-title="<?php echo lang('settings'); ?>" data-placement="bottom"><i class="icon-cog"></i></a>
							<ul class="dropdown-menu">
                                <li><?php echo anchor('custom_fields', lang('custom_fields')); ?></li>
								<li><?php echo anchor('email_templates', lang('email_templates')); ?></li>
                                <li><?php echo anchor('import', lang('import_data')); ?></li>
								<li><?php echo anchor('invoice_groups', lang('invoice_groups')); ?></li>
                                <li><?php echo anchor('item_lookups', lang('item_lookups')); ?></li>
								<li><?php echo anchor('payment_methods', lang('payment_methods')); ?></li>
								<li><?php echo anchor('tax_rates', lang('tax_rates')); ?></li>
								<li><?php echo anchor('users', lang('user_accounts')); ?></li>
                                <li class="divider"></li>
                                <li><?php echo anchor('settings', lang('system_settings')); ?></li>
							</ul>
						</li>
						<li class="divider-vertical"></li>
						<li><a href="<?php echo site_url('sessions/logout'); ?>" class="tip icon logout" data-original-title="<?php echo lang('logout'); ?>" data-placement="bottom"><i class="icon-off"></i></a></li>
					</ul>

				</div>

			</div>

		</nav>

		<div class="sidebar">

			<ul>
				<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fas fa-lg fa-fw fa-home"></i></a></li>
				<li><a href="<?php echo site_url('appointments'); ?>"><i class="fas fa-lg fa-fw fa-calendar-alt"></i></a></li>
				<li><a href="<?php echo site_url('patients'); ?>"><i class="fas fa-lg fa-fw fa-user-friends"></i></a></li>
				<li><a href="<?php echo site_url('quotes'); ?>"><i class="fas fa-lg fa-fw fa-folder"></i></a></li>
				<li><a href="<?php echo site_url('invoices'); ?>"><i class="fas fa-lg fa-fw fa-file-invoice"></i></a></li>
				<li><a href="<?php echo site_url('payments'); ?>"><i class="fas fa-lg fa-fw fa-money-bill-alt"></i></a></li>
			</ul>

		</div>

		<div class="main-area">

			<div id="modal-placeholder"></div>
			
			<?php echo $content; ?>

		</div><!--end.content-->

		<script defer src="<?php echo base_url(); ?>assets/default/js/plugins.js"></script>
		<script defer src="<?php echo base_url(); ?>assets/default/js/script.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/bootstrap-datepicker.js"></script>

		<!--[if lt IE 7 ]>
			<script src="<?php echo base_url(); ?>assets/default/js/dd_belatedpng.js"></script>
			<script type="text/javascript"> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
		<![endif]-->

		<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
			 chromium.org/developers/how-tos/chrome-frame-getting-started -->
		<!--[if lt IE 7 ]>
		  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		  <script type="text/javascript">window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->

	</body>
</html>