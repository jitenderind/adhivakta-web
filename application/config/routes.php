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
|	https://codeigniter.com/user_guide/general/routing.html
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


//user
$route['login'] = 'user/login';
$route['logout'] = 'user/logout';
$route['register'] = 'user/register';
$route['verify-account'] = 'user/verify_account';
$route['recover-password'] = 'user/forgot_password';
$route['reset-password'] = 'user/reset_password';
$route['account'] = 'user/page/account';
$route['settings'] = 'user/page/settings';
$route['user/account-details/(:any)'] = 'user/account_details/$1';
$route['user/account-settings/(:any)'] = 'user/account_settings/$1';
$route['user/payment-details/(:any)'] = 'payments/user_payments/$1';
$route['user/update-settings'] = 'user/update_settings/';
$route['update-profile'] = 'user/updateProfile';
$route['user/change-password'] = 'user/update_password';
$route['plans'] = 'user/page/plans';
$route['subscription-plans'] = 'user/plans';
$route['payment/add'] = 'payments/add_payment';




$route['workspace'] = 'user/index';
$route['causelist'] = 'user/page/causelist';
$route['display-board'] = 'user/page/display-board';
$route['appeal-alert'] = 'user/page/appeal-alert';
$route['tasks'] = 'user/page/tasks';
$route['invoice'] = 'user/page/invoice';
$route['invoice/(:any)'] = 'payments/show_invoice/$1';
$route['archived'] = 'user/page/archived';
$route['clients'] = 'user/page/clients';


$route['all-user-staff/(:any)'] = 'user/all_user_staff/$1';


$route['workspace/case/(:any)'] = 'user/page/case-details?id=$1';


$route['load/(:any)'] = 'page/load_page/$1';
$route['load/workspace/case/(:any)'] = 'page/load_case/$1';
$route['data/(:any)'] = 'page/load_data/$1';
$route['nav'] = 'page/nav';
$route['sidebar'] = 'page/sidebar';
$route['upload/document'] = 'upload/upload_file/case_document';

//for emails
$route['queue_email/send_queue'] = 'queue_email/send_queue';
$route['queue_email/retry_queue'] = 'queue_email/retry_queue'; 


//for cron
$route['invoice/add/(:any)'] = 'payments/add_invoice/$1';

$route['default_controller'] = 'user';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
