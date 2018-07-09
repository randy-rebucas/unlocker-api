<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
if(!in_array($_SERVER['REMOTE_ADDR'], $this->config->item('maintenance_ips')) && $this->config->item('maintenance_mode')) {
	
    $route['default_controller'] = 'maintenance';
    $route['(:any)'] = 'maintenance';
	
}else{
    $route['default_controller'] = 'dashboard';

    $route['auth'] = 'sessions/login';
    
    $route['404_override'] = '';
    $route['translate_uri_dashes'] = FALSE;

	$route['contact'] 							= 'welcome/contact';
	$route['submit-ticket'] 					= 'welcome/submit_ticket';
	$route['testimonial'] 						= 'welcome/testimonial';
	$route['knowledgebase'] 					= 'welcome/knowledgebase';

	$route['services/(:any)'] 					= 'welcome/services/$1';
	$route['place-order/(:any)'] 				= 'orders/index/$1';
	$route['order-history'] 					= 'orders/history';

	$route['item-details/(:any)/(:any)'] 		= 'welcome/item_details/$1/$2';
	//-----------------
	$route['login'] 							= 'auth/login';
	$route['signup'] 							= 'auth/register';

	$route['my-dashboard'] 						= 'home';
	$route['my-profile'] 						= 'profile';
	$route['change-password'] 					= 'profile/change_password';
	$route['my-invoice'] 						= 'profile/invoice';
	$route['my-mail'] 							= 'profile/mail';
	$route['my-statement'] 						= 'profile/statement';
	$route['recharge-voucher'] 					= 'profile/recharge_voucher';
	$route['email-preferences'] 				= 'profile/email_preferences';
	$route['my-tickets'] 						= 'profile/tickets';
	$route['submit-ticket'] 					= 'profile/submit_tickets';
	$route['service-status'] 					= 'profile/service_status';
}
