<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="<?php echo $meta_description; ?>" name="description" />
    <meta content="<?php echo $meta_keywords; ?>" name="keywords" />
    <meta content="<?php echo $meta_author; ?>" name="author" />

   <!-- BEGIN GLOBAL MANDATORY STYLES -->          
   <!--<link href="<?php echo base_url();?>themes/corporate/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>-->     
   <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
   <link href="<?php echo base_url();?>themes/corporate/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
	
   <meta property="og:site_name" content="unlockedzpd">
   <meta property="og:title" content="<?php echo $title; ?>">
   <meta property="og:description" content="<?php echo $meta_description; ?>">
   <meta property="og:type" content="website">
   <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
   <meta property="og:url" content="-CUSTOMER VALUE-">
  
    <?php echo $_styles;  ?>

    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <script type="text/javascript">
        var BASE_URL = '<?php echo base_url(); ?>';
        var _lat = '<?php echo $this->config->item("lat");?>';
        var _lng = '<?php echo $this->config->item("lng");?>';
        var business_name = '<?php echo $this->config->item("business_name");?>';
        var address1 = '<?php echo $this->config->item("address1");?>';
        var address2 = '<?php echo $this->config->item("address2");?>';
        var city = '<?php echo $this->config->item("city");?>';
        var state = '<?php echo $this->config->item("state");?>';
        var country = '<?php echo $this->config->item("country");?>';
        var postal_code = '<?php echo $this->config->item("postal_code");?>';
    </script>

   <!-- BEGIN THEME STYLES --> 
   <link href="<?php echo base_url();?>themes/corporate/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url();?>themes/corporate/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url();?>themes/corporate/css/themes/blue.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="<?php echo base_url();?>themes/corporate/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url();?>themes/corporate/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->

   <link rel="shortcut icon" href="<?php echo base_url();?>corporate/favicon.ico" />
   <style type="text/css">
   .front-topbar li.sep span {
        color: #888 !important;
        font-size: 11px;
    }
   </style>
   
   
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=175683579222305";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-default navbar-static-top">
        <!-- BEGIN TOP BAR -->
        <div class="front-topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <ul class="list-unstyled inline">
                            <li><i class="fa fa-phone topbar-info-icon top-2"></i>Call us: <span><?php echo $this->config->item('contact_number');?></span></li>
                            <li class="sep"><span>|</span></li>
                            <li><i class="fa fa-envelope-o topbar-info-icon top-2"></i>Email: <span><?php echo $this->config->item('email');?></span></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-4 login-reg-links">
                        <ul class="list-unstyled inline">
                            <?php if (!$this->tank_auth->is_logged_in()) {   ?>
                            <li><a href="<?php echo site_url('login');?>">Login</a></li>
                            <li class="sep"><span>|</span></li>
                            <li><a href="<?php echo site_url('signup');?>">Signup</a></li>
                            <?php }else{ ?>
                            
                            <?php if ($user_info->role_id == 1) { ?>
                                <li><a href="<?php echo site_url('admin/dashboard');?>" target="_blank">Admin</a></li>
                                <li class="sep"><span>|</span></li>
                            <?php } ?>
                            <li><a href="javascript:;">Balance : <strong>$
                                <?php 
                                $rem_funds = $this->User_list->bal_funds($user_info->user_id);
                                echo ($rem_funds > 0) ? $rem_funds : 0 ;?> USD </strong>
                            </a></li>
                            <li class="sep"><span>|</span></li>

                            <li  class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">My Profile
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu" id="tiny-nav">
                                    <li><a href="<?php echo site_url('my-profile');?>">Edit Profile</a></li>
                                    <li><a href="<?php echo site_url('change-password');?>">Change password</a></li>
                                    <li class="hidden"><a href="<?php echo site_url('');?>">Change Security Question</a></li>
                                    <li><a href="<?php echo site_url('my-invoice');?>">My Invoice</a></li>
                                    <li><a href="<?php echo site_url('my-mail');?>">My Mail</a></li>
                                    <li><a href="<?php echo site_url('my-statement');?>">My statement</a></li>
                                    <li class="hidden"><a href="<?php echo site_url('recharge-voucher');?>">Recharge Voucher</a></li>
                                    <li><a href="<?php echo site_url('email-preferences');?>">Email Preferences</a></li>
                                    <li><a href="<?php echo site_url('my-tickets');?>">My Tickets</a></li>
                                    <li><a href="<?php echo site_url('submit-ticket');?>">Submit Ticket</a></li>
                                    <li><a href="<?php echo site_url('service-status');?>">Service Status</a></li>
                                    <li><a href="<?php echo site_url('auth/logout');?>">Logout</a></li>

                                </ul>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>        
        </div>
        <!-- END TOP BAR -->
        <div class="container">
            <div class="navbar-header">
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <button class="navbar-toggle btn navbar-btn" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN LOGO (you can use logo image instead of text)-->
                <a class="navbar-brand logo-v1" href="<?php echo site_url();?>">
                    <img src="<?php echo base_url();?>themes/corporate/img/<?php echo $this->config->item('logo');?>" id="logoimg" alt="">
                </a>
                <!-- END LOGO -->
            </div>
        
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li <?php if($this->uri->segment(1) == '') echo 'class="active"';?>><a href="<?php echo site_url();?>" >Home</a></li> 
                    <?php if (!$this->tank_auth->is_logged_in()) {   ?>
                    <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
                            Product & Services
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('services/imei');?>">Imei Services</a></li>
                            <li class="hidden"><a href="<?php echo site_url('services/file');?>">File Services</a></li>
                            <li class="hidden"><a href="<?php echo site_url('services/server');?>">Server Services</a></li>
                        </ul>
                    </li>
                    <li class="hidden" <?php if($this->uri->segment(1) == 'knowledgebase') echo 'class="active"';?>><a href="<?php echo site_url('knowledgebase');?>" >Knowledgebase</a></li>                        
                    <li <?php if($this->uri->segment(1) == 'testimonial') echo 'class="active"';?>><a href="<?php echo site_url('testimonial');?>" >Testimonial</a></li>
                    <li <?php if($this->uri->segment(1) == 'submit-ticket') echo 'class="active"';?>><a href="<?php echo site_url('submit-ticket');?>" >Submit Ticket</a></li>
                    <li <?php if($this->uri->segment(1) == 'contact') echo 'class="active"';?>><a href="<?php echo site_url('contact');?>" >Contact Us</a></li>
                    <?php }else{ ?>
                    <!-- <li <?php if($this->uri->segment(1) == 'client-area') echo 'class="active"';?>><a href="<?php echo site_url('client-area');?>" >Client area</a></li>  -->
                    <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
                            Place Order
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('place-order/imei');?>">Imei Services</a></li>
                            <li><a href="<?php echo site_url('place-order/file');?>">File Services</a></li>
                            <li><a href="<?php echo site_url('place-order/server');?>">Server Services</a></li>
                        </ul>
                    </li>
                    <li <?php if($this->uri->segment(1) == 'order-history') echo 'class="active"';?>><a href="<?php echo site_url('order-history');?>" >Order History</a></li>                        
                    <?php } ?>
                    <li class="hidden menu-search">
                        <span class="sep"></span>
                        <i class="fa fa-search search-btn"></i>

                        <div class="search-box">
                            <form action="#">
                                <div class="input-group input-large">
                                    <input class="form-control" type="text" placeholder="Search">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn theme-btn">Go</button>
                                    </span>
                                </div>
                            </form>
                        </div> 
                    </li>
                </ul>                         
            </div>
            <!-- BEGIN TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- END HEADER -->

    <!-- BEGIN PAGE CONTAINER -->  
    <div class="page-container">
        <?php echo $content;?>
        
    </div>
    <!-- END PAGE CONTAINER -->

    <!-- BEGIN FOOTER -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 space-mobile">
                    <!-- BEGIN ABOUT -->                    
                    <h2>About</h2>
                    <p class="margin-bottom-30">
                        <?php echo $this->config->item('business_name');?> owned and managed by Eduardo, Dela pasion 
                    </p>
                    <div class="clearfix"></div>                    
                    <!-- END ABOUT -->          
                    <h2>Photos Stream</h2>
                    <!-- BEGIN BLOG PHOTOS STREAM -->
                    <div class="fb-page" data-href="https://www.facebook.com/unlockedzpd" 
  data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"
  data-show-posts="false"></div>
                    <!-- END BLOG PHOTOS STREAM -->           
                                               
                </div>
                <div class="col-md-4 col-sm-4 space-mobile">
                    <!-- BEGIN CONTACTS -->                                    
                    <h2>Contact Us</h2>
                    <address class="margin-bottom-40">
                        <?php echo $this->config->item('business_name');?> <br />
                        <?php echo $this->config->item('address1');?><br />
                        <?php echo $this->config->item('address2');?><br />
                        <?php echo $this->config->item('city');?>, <?php echo $this->config->item('state');?> <br />
                        <?php echo $this->config->item('country');?>, <?php echo $this->config->item('postal_code');?> <br />
                        P: <?php echo $this->config->item('contact_number');?> <br />
                        Email: <a href="mailto:<?php echo $this->config->item('email');?>"><?php echo $this->config->item('email');?></a>                        
                    </address>
                    <!-- END CONTACTS -->                                    

                    <!-- BEGIN SUBSCRIBE -->                                    
                    <h2>Monthly Newsletter</h2>  
                    <p>Subscribe to our newsletter and stay up to date with the latest news and deals!</p>
              
					<?php echo form_open('',' class="form-subscribe"');?>
                        <div class="input-group input-large">
                            <input class="form-control" type="text">
                            <span class="input-group-btn">
                                <button class="btn theme-btn" type="button">SUBSCRIBE</button>
                            </span>
                        </div>
                    </form> 

                    <!-- END SUBSCRIBE -->                                    
                </div>
                <div class="col-md-4 col-sm-4">
                    <h2>Facebook page</h2>  
					<div class="fb-page" data-href="https://www.facebook.com/unlockedzpd" data-height="300px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/unlockedzpd"><a href="https://www.facebook.com/unlockedzpd">Unlockedzpd</a></blockquote></div></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END FOOTER -->

    <!-- BEGIN COPYRIGHT -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <p>
                        <span class="margin-right-10"><?php echo date('Y');?> © <?php echo $this->config->item('business_name');?>. ALL Rights Reserved.</span> 
                        <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
                    </p>
                </div>
                <div class="col-md-4 col-sm-4">
                    <ul class="social-footer">
                        <?php if($this->config->item('facebook')){   ?>
                            <li><a href="<?php echo $this->config->item('facebook');?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <?php } ?>
                        <?php if($this->config->item('google_plus')){   ?>
                            <li><a href="<?php echo $this->config->item('google_plus');?>" target="_blank"><i class="fa google-plus"></i></a></li>
                        <?php } ?>
                        <?php if($this->config->item('twitter')){   ?>
                            <li><a href="<?php echo $this->config->item('twitter');?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <?php } ?>
                        <?php if($this->config->item('skype')){   ?>
                            <li><a href="<?php echo $this->config->item('skype');?>" target="_blank"><i class="fa fa-skype"></i></a></li>
                        <?php } ?>
                        <?php if($this->config->item('youtube')){   ?>
                            <li><a href="<?php echo $this->config->item('youtube');?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        <?php } ?>
                    </ul>                
                </div>
            </div>
        </div>
    </div>
    <!-- END COPYRIGHT -->
<div id="sitelock_shield_logo" class="fixed_btm" style="bottom:0;position:fixed;_position:absolute;right:0;"><a href="https://www.sitelock.com/verify.php?site=unlockedzpd.com" onclick="window.open('https://www.sitelock.com/verify.php?site=unlockedzpd.com','SiteLock','width=600,height=600,left=160,top=170');return false;" ><img alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/unlockedzpd.com"></a></div>
    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS(REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="/plugins/respond.min.js"></script>  
    <![endif]-->  
    <script src="<?php echo base_url();?>themes/corporate/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>themes/corporate/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>themes/corporate/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <script type="text/javascript" src="<?php echo base_url();?>themes/corporate/plugins/hover-dropdown.js"></script>  
    <script type="text/javascript" src="<?php echo base_url();?>themes/corporate/plugins/back-to-top.js"></script>    
    <!-- END CORE PLUGINS -->
    <?php if($this->uri->segment(1) == 'contact') { ?>
    <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
    <?php } ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo $_scripts; ?>
   

    <?php if ($this->tank_auth->is_logged_in()) { ?>
        <script type="text/javascript">
        jQuery(document).ready(function() {
            App.init();     
            App.initUniform();                 
        });
    </script>
    <?php }else{
        switch ($this->uri->segment(1)) {
        case 'my-profile':
            echo '<script type="text/javascript">
                jQuery(document).ready(function() {
                    App.init();     
                    App.initUniform();                 
                });
            </script>';
            break;
        case 'services':
            echo '';
            break;
        case 'knowledgebase':
            echo '';
            break;
        case 'testimonial':
            echo '';
            break;
        case 'submit-ticket':
            echo '';
            break;
        case 'contact':
            echo '<script type="text/javascript">
                jQuery(document).ready(function() {    
                   App.init();
                   ContactUs.init();
                });
            </script>';
            break;
		case 'login':
            echo '<script type="text/javascript">
        jQuery(document).ready(function() {    
           App.init();
		   App.initUniform();  
        });
    </script>';
            break;
			
        default:
           echo '<script type="text/javascript">
                jQuery(document).ready(function() {
                    App.init();    
                    App.initBxSlider();
                    Index.initRevolutionSlider();             
                });
            </script>';
            break;
        }
    } ?>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>