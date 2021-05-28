<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'loginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'loginController/index';
$route['create'] = 'loginController/index/create';
$route['login/auth'] = 'loginController/login_auth';
$route['login/create_account'] = 'loginController/create_user_account';
$route['login/check_username'] = 'loginController/check_username';
$route['logout'] = 'loginController/logout';

$route['dashboard'] = 'dashboardController/index';
$route['dashboard/delete/(:any)'] = 'dashboardController/delete_request/$1';

$route['request'] = 'requestController/index';

$route['track'] = 'trackController/index';
$route['track/(:any)'] = 'trackController/index/$1';

$route['status'] = 'statusController';
$route['status/(:any)'] = 'statusController/index/$1';

$route['profile'] = 'profileController/index';
$route['profile/update'] = 'profileController/index/update';
$route['profile/set_profile_update'] = 'profileController/set_profile_update';
$route['profile/set_password_change'] = 'profileController/set_password_change';

$route['payment'] = 'paymentController/index';
$route['payment/pay/(:any)'] = 'paymentController/pay/$1';

// Staff routes
$route['create_staff'] = 'loginController/index/create_staff';
$route['login/create_staff'] = 'loginController/create_staff_account';
$route['login/check_username'] = 'loginController/check_username';

$route['staff/dashboard'] = 'staff/dashboardController/index';
$route['staff/dashboard/view/(:any)'] = 'staff/dashboardController/index/view/$1';
$route['staff/dashboard/take_repair_request/(:any)'] = 'staff/DashboardController/take_repair_request/$1';
$route['staff/dashboard/delete/(:any)'] = 'staff/dashboardController/delete_request/$1';

$route['staff/profile'] = 'staff/profileController/index';
$route['staff/profile/update'] = 'staff/profileController/index/update';
$route['staff/profile/set_profile_update'] = 'staff/profileController/set_profile_update';

$route['staff/status'] = 'staff/statusController/index';
$route['staff/status/view/(:any)'] = 'staff/statusController/index/view/$1';
$route['staff/status/update/(:any)'] = 'staff/statusController/update_repair_request/$1';
