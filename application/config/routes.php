<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'LoginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'LoginController/index';
$route['create'] = 'LoginController/index/create';
$route['login/auth'] = 'LoginController/login_auth';
$route['login/create_account'] = 'LoginController/create_user_account';
$route['login/check_username'] = 'LoginController/check_username';
$route['logout'] = 'LoginController/logout';

$route['dashboard'] = 'DashboardController/index';
$route['dashboard/delete/(:any)'] = 'DashboardController/delete_request/$1';

$route['request'] = 'RequestController/index';
$route['request/update/(:any)'] = 'RequestController/update_request_by_id/$1';
$route['request/add'] = 'RequestController/add_new_request';

$route['track'] = 'TrackingController/index';
$route['track/(:any)'] = 'TrackingController/index/$1';

$route['status'] = 'StatusController';
$route['status/(:any)'] = 'StatusController/index/$1';
$route['status/(:any)/update'] = 'StatusController/index/$1/update';

$route['profile'] = 'ProfileController/index';
$route['profile/update'] = 'ProfileController/index/update';
$route['profile/set_profile_update'] = 'ProfileController/set_profile_update';
$route['profile/set_password_change'] = 'ProfileController/set_password_change';
$route['profile/deactivate_account'] = 'ProfileController/deactivate_account';

$route['payment'] = 'PaymentController/index';
$route['payment/pay/(:any)'] = 'PaymentController/pay/$1';

// Staff routes
$route['register'] = 'LoginController/index/create_staff';
$route['login/create_staff'] = 'LoginController/create_staff_account';
$route['login/check_username'] = 'LoginController/check_username';

$route['staff/dashboard'] = 'staff/DashboardController/index';
$route['staff/dashboard/view/(:any)'] = 'staff/DashboardController/index/view/$1';
$route['staff/dashboard/take_repair_request/(:any)'] = 'staff/DashboardController/take_repair_request/$1';
$route['staff/dashboard/delete/(:any)'] = 'staff/DashboardController/delete_request/$1';

$route['staff/profile'] = 'staff/ProfileController/index';
$route['staff/profile/update'] = 'staff/ProfileController/index/update';
$route['staff/profile/set_profile_update'] = 'staff/ProfileController/set_profile_update';

$route['staff/status'] = 'staff/StatusController/index';
$route['staff/status/view/(:any)'] = 'staff/StatusController/index/view/$1';
$route['staff/status/update/(:any)'] = 'staff/StatusController/update_repair_request/$1';

$route['staff/manage'] = 'staff/ManageController/index';
$route['staff/manage/view/(:any)'] = 'staff/ManageController/index/view/$1';
$route['staff/manage/search'] = 'staff/ManageController/search_user';

// Runner routes
$route['runner/dashboard'] = 'runner/DashboardController/index';
$route['runner/dashboard/take_delivery_request/(:any)'] = 'runner/DashboardController/take_delivery_request/$1';

$route['runner/delivery'] = 'runner/DeliveryController/index';
$route['runner/delivery/cancel_delivery_request/(:any)'] = 'runner/DeliveryController/cancel_delivery_request/$1';
$route['runner/delivery/complete_delivery_request/(:any)'] = 'runner/DeliveryController/complete_delivery_request/$1';

$route['runner/profile'] = 'runner/ProfileController/index';
$route['runner/profile/update'] = 'runner/ProfileController/index/update';
$route['runner/profile/set_profile_update'] = 'runner/ProfileController/set_profile_update';