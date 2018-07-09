<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.1
Version: 2.0.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $title; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="<?php echo $meta_description; ?>" name="description" />
<meta content="<?php echo $meta_keywords; ?>" name="keywords" />
<meta content="<?php echo $meta_author; ?>" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>themes/admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>themes/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>themes/admin/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

<?php echo $_styles;  ?>

<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url();?>themes/admin/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>themes/admin/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>themes/admin/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>themes/admin/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>themes/admin/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>themes/admin/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url();?>themes/admin/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<link href="<?php echo base_url();?>themes/admin/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<a class="navbar-brand" href="index.html">
			<img src="<?php echo base_url();?>themes/admin/img/logo.png" alt="logo" class="img-responsive"/>
		</a>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<img src="<?php echo base_url();?>themes/admin/img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			<!-- BEGIN NOTIFICATION DROPDOWN -->
			<li class="dropdown hidden" id="header_notification_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-warning"></i>
					<span class="badge">
						 6
					</span>
				</a>
				<ul class="dropdown-menu extended notification">
					<li>
						<p>
							 You have 14 new notifications
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							<li>
								<a href="#">
									<span class="label label-sm label-icon label-success">
										<i class="fa fa-plus"></i>
									</span>
									 New user registered.
									<span class="time">
										 Just now
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
									</span>
									 Server #12 overloaded.
									<span class="time">
										 15 mins
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-sm label-icon label-warning">
										<i class="fa fa-bell-o"></i>
									</span>
									 Server #2 not responding.
									<span class="time">
										 22 mins
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-sm label-icon label-info">
										<i class="fa fa-bullhorn"></i>
									</span>
									 Application error.
									<span class="time">
										 40 mins
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
									</span>
									 Database overloaded 68%.
									<span class="time">
										 2 hrs
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
									</span>
									 2 user IP blocked.
									<span class="time">
										 5 hrs
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-sm label-icon label-warning">
										<i class="fa fa-bell-o"></i>
									</span>
									 Storage Server #4 not responding.
									<span class="time">
										 45 mins
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-sm label-icon label-info">
										<i class="fa fa-bullhorn"></i>
									</span>
									 System Error.
									<span class="time">
										 55 mins
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
									</span>
									 Database overloaded 68%.
									<span class="time">
										 2 hrs
									</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="external">
						<a href="#">
							 See all notifications <i class="m-icon-swapright"></i>
						</a>
					</li>
				</ul>
			</li>
			<!-- END NOTIFICATION DROPDOWN -->
			<!-- BEGIN INBOX DROPDOWN -->
			<li class="dropdown hidden" id="header_inbox_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-envelope"></i>
					<span class="badge">
						 5
					</span>
				</a>
				<ul class="dropdown-menu extended inbox">
					<li>
						<p>
							 You have 12 new messages
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							<li>
								<a href="inbox.html?a=view">
									<span class="photo">
										<img src="<?php echo base_url();?>themes/admin/img/avatar2.jpg" alt=""/>
									</span>
									<span class="subject">
										<span class="from">
											 Lisa Wong
										</span>
										<span class="time">
											 Just Now
										</span>
									</span>
									<span class="message">
										 Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh...
									</span>
								</a>
							</li>
							<li>
								<a href="inbox.html?a=view">
									<span class="photo">
										<img src="<?php echo base_url();?>themes/admin/assets/img/avatar3.jpg" alt=""/>
									</span>
									<span class="subject">
										<span class="from">
											 Richard Doe
										</span>
										<span class="time">
											 16 mins
										</span>
									</span>
									<span class="message">
										 Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh...
									</span>
								</a>
							</li>
							<li>
								<a href="inbox.html?a=view">
									<span class="photo">
										<img src="<?php echo base_url();?>themes/admin/assets/img/avatar1.jpg" alt=""/>
									</span>
									<span class="subject">
										<span class="from">
											 Bob Nilson
										</span>
										<span class="time">
											 2 hrs
										</span>
									</span>
									<span class="message">
										 Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh...
									</span>
								</a>
							</li>
							<li>
								<a href="inbox.html?a=view">
									<span class="photo">
										<img src="<?php echo base_url();?>themes/admin/assets/img/avatar2.jpg" alt=""/>
									</span>
									<span class="subject">
										<span class="from">
											 Lisa Wong
										</span>
										<span class="time">
											 40 mins
										</span>
									</span>
									<span class="message">
										 Vivamus sed auctor 40% nibh congue nibh...
									</span>
								</a>
							</li>
							<li>
								<a href="inbox.html?a=view">
									<span class="photo">
										<img src="<?php echo base_url();?>themes/admin/assets/img/avatar3.jpg" alt=""/>
									</span>
									<span class="subject">
										<span class="from">
											 Richard Doe
										</span>
										<span class="time">
											 46 mins
										</span>
									</span>
									<span class="message">
										 Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh...
									</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="external">
						<a href="inbox.html">
							 See all messages <i class="m-icon-swapright"></i>
						</a>
					</li>
				</ul>
			</li>
			<!-- END INBOX DROPDOWN -->
			<!-- BEGIN TODO DROPDOWN -->
			<li class="dropdown hidden" id="header_task_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-tasks"></i>
					<span class="badge">
						 5
					</span>
				</a>
				<ul class="dropdown-menu extended tasks">
					<li>
						<p>
							 You have 12 pending tasks
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">
											 New release v1.2
										</span>
										<span class="percent">
											 30%
										</span>
									</span>
									<span class="progress">
										<span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
											<span class="sr-only">
												 40% Complete
											</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">
											 Application deployment
										</span>
										<span class="percent">
											 65%
										</span>
									</span>
									<span class="progress progress-striped">
										<span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
											<span class="sr-only">
												 65% Complete
											</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">
											 Mobile app release
										</span>
										<span class="percent">
											 98%
										</span>
									</span>
									<span class="progress">
										<span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
											<span class="sr-only">
												 98% Complete
											</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">
											 Database migration
										</span>
										<span class="percent">
											 10%
										</span>
									</span>
									<span class="progress progress-striped">
										<span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
											<span class="sr-only">
												 10% Complete
											</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">
											 Web server upgrade
										</span>
										<span class="percent">
											 58%
										</span>
									</span>
									<span class="progress progress-striped">
										<span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
											<span class="sr-only">
												 58% Complete
											</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">
											 Mobile development
										</span>
										<span class="percent">
											 85%
										</span>
									</span>
									<span class="progress progress-striped">
										<span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
											<span class="sr-only">
												 85% Complete
											</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="task">
										<span class="desc">
											 New UI release
										</span>
										<span class="percent">
											 18%
										</span>
									</span>
									<span class="progress progress-striped">
										<span style="width: 18%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
											<span class="sr-only">
												 18% Complete
											</span>
										</span>
									</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="external">
						<a href="#">
							 See all tasks <i class="m-icon-swapright"></i>
						</a>
					</li>
				</ul>
			</li>
			<!-- END TODO DROPDOWN -->
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" src="<?php echo base_url();?>themes/admin/img/avatar1_small.jpg"/>
					<span class="username">
						 <?php echo $user_info->username;?>
					</span>
					<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li class="hidden">
						<a href="extra_profile.html">
							<i class="fa fa-user"></i> My Profile
						</a>
					</li>
					<li class="hidden">
						<a href="page_calendar.html">
							<i class="fa fa-calendar"></i> My Calendar
						</a>
					</li>
					<li class="hidden">
						<a href="inbox.html">
							<i class="fa fa-envelope"></i> My Inbox
							<span class="badge badge-danger">
								 3
							</span>
						</a>
					</li>
					<li class="hidden">
						<a href="#">
							<i class="fa fa-tasks"></i> My Tasks
							<span class="badge badge-success">
								 7
							</span>
						</a>
					</li>
					<li class="divider hidden">
					</li>
					<li>
						<a href="javascript:;" id="trigger_fullscreen">
							<i class="fa fa-arrows"></i> Full Screen
						</a>
					</li>
					<li>
						<a href="extra_lock.html">
							<i class="fa fa-lock"></i> Lock Screen
						</a>
					</li>
					<li>
						<a href="<?php echo site_url('auth/logout');?>">
							<i class="fa fa-key"></i> Log Out
						</a>
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- add "navbar-no-scroll" class to disable the scrolling of the sidebar menu -->
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form class="sidebar-search" action="extra_search.html" method="POST">
						<div class="form-container">
							<div class="input-box">
								<a href="javascript:;" class="remove">
								</a>
								<input type="text" placeholder="Search..."/>
								<input type="button" class="submit" value=" "/>
							</div>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start <?php if($this->uri->segment(2) == 'dashboard') echo 'active';?>">
					<a href="<?php echo site_url('admin/dashboard');?>">
						<i class="fa fa-home"></i>
						<span class="title">
							Dashboard
						</span>
						<span class="<?php if($this->uri->segment(2) == 'dashboard') echo 'selected';?>">
						</span>
					</a>
				</li>
				<li class="<?php if($this->uri->segment(2) == 'user') echo 'active';?>">
					<a href="<?php echo site_url('admin/user');?>">
						<i class="fa fa-users"></i>
						<span class="title">
							Users
						</span>
						<span class="<?php if($this->uri->segment(2) == 'user') echo 'selected';?>">
						</span>
					</a>
				</li>
				<li class="<?php if($this->uri->segment(2) == 'items') echo 'active';?>">
					<a href="<?php echo site_url('admin/items');?>">
						<i class="fa fa-puzzle-piece"></i>
						<span class="title">
							Items
						</span>
						<span class="<?php if($this->uri->segment(2) == 'items') echo 'selected';?>">
						</span>
					</a>
				</li>
				<li class="hidden <?php if($this->uri->segment(2) == 'services') echo 'active';?>">
					<a href="<?php echo site_url('admin/services');?>">
						<i class="fa fa-list"></i>
						<span class="title">
							Services
						</span>
						<span class="<?php if($this->uri->segment(2) == 'services') echo 'selected';?>">
						</span>
					</a>
				</li>
				<li class="hidden <?php if($this->uri->segment(2) == 'categories') echo 'active';?>">
					<a href="<?php echo site_url('admin/categories');?>">
						<i class="fa fa-tags"></i>
						<span class="title">
							Categories
						</span>
						<span class="<?php if($this->uri->segment(2) == 'categories') echo 'selected';?>">
						</span>
					</a>
				</li>

				<li class="<?php if($this->uri->segment(2) == 'orders') echo 'active';?>">
					<a href="<?php echo site_url('admin/orders');?>">
						<i class="fa fa-file-text"></i>
						<span class="title">
							Orders
						</span>
						<span class="<?php if($this->uri->segment(2) == 'orders') echo 'selected';?>">
						</span>
					</a>
				</li>
				<li class="<?php if($this->uri->segment(2) == 'tickets') echo 'active';?>">
					<a href="<?php echo site_url('admin/tickets');?>">
						<i class="fa fa-table"></i>
						<span class="title">
							Tickets
						</span>
						<span class="<?php if($this->uri->segment(2) == 'tickets') echo 'selected';?>">
						</span>
					</a>
				</li>
				<li class="<?php if($this->uri->segment(2) == 'testimonials') echo 'active';?>">
					<a href="<?php echo site_url('admin/testimonials');?>">
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Testimonials
						</span>
						<span class="<?php if($this->uri->segment(2) == 'testimonials') echo 'selected';?>">
						</span>
					</a>
				</li>
				<li class="<?php if($this->uri->segment(2) == 'notifications') echo 'active';?>">
					<a href="<?php echo site_url('admin/notifications');?>">
						<i class="fa fa-bullhorn"></i>
						<span class="title">
							Notifications
						</span>
						<span class="<?php if($this->uri->segment(2) == 'notifications') echo 'selected';?>">
						</span>
					</a>
				</li>
				<li class="<?php if($this->uri->segment(2) == 'sources') echo 'active';?>">
					<a href="<?php echo site_url('admin/sources');?>">
						<i class="fa fa-sitemap"></i>
						<span class="title">
							Sources API's
						</span>
						<span class="<?php if($this->uri->segment(2) == 'sources') echo 'selected';?>">
						</span>
					</a>
				</li>
				<li class="<?php if($this->uri->segment(2) == 'remote_services') echo 'active';?>">
					<a href="<?php echo site_url('admin/remote_services');?>">
						<i class="fa fa-sitemap"></i>
						<span class="title">
							Remote Services
						</span>
						<span class="<?php if($this->uri->segment(2) == 'remote_services') echo 'selected';?>">
						</span>
					</a>
				</li>
				<li class="<?php if($this->uri->segment(2) == 'settings') echo 'active';?>">
					<a href="<?php echo site_url('admin/settings');?>">
						<i class="fa fa-cogs"></i>
						<span class="title">
							Application settings
						</span>
						<span class="<?php if($this->uri->segment(2) == 'settings') echo 'selected';?>">
						</span>
					</a>
				</li>
				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<?php echo $content;?>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
	<div class="footer-inner">
		 <?php echo date('Y');?> &copy; <?php echo $this->config->item('business_name');?>.
	</div>
	<div class="footer-tools">
		<span class="go-top">
			<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>themes/admin/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>themes/admin/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url();?>themes/admin/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>themes/admin/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>themes/admin/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>themes/admin/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>themes/admin/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>themes/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>themes/admin/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>themes/admin/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>themes/admin/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $_scripts; ?>
<!-- END PAGE LEVEL PLUGINS -->

<?php
switch ($this->uri->segment(2)) {
	case 'settings': 
		echo '<script>
			jQuery(document).ready(function() {   
			   // initiate layout and plugins
			  	App.init();
	   			ComponentsEditors.init();
			});
			</script>';
		
		break;
	case 'dashboard':
		echo '<script>
			jQuery(document).ready(function() {    
			   App.init(); 
			   Index.init();
			   Index.initJQVMAP(); 
			   Index.initCalendar(); 
			   Index.initCharts(); 
			   Index.initChat();
			   Index.initMiniCharts();
			   Index.initDashboardDaterange();
			   Index.initIntro();
			   Tasks.initDashboardWidget();
			});
			</script>';
		break;
	default:
		echo '<script>
			jQuery(document).ready(function() {       
			   App.init();
			   TableManaged.init();
			});
			</script>';
		break;
}?>

<!-- END JAVASCRIPTS -->
<script type="text/javascript">
       

    $(function() {
		
    });

    function goBack() {
            window.history.back()
        }
</script>

</body>
<!-- END BODY -->
</html>