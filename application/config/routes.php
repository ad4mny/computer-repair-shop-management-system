<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'loginController';

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

$route['status'] = 'statusController';
$route['status/(:any)'] = 'statusController/index/$1';

$route['profile'] = 'profileController/index';
$route['profile/update'] = 'profileController/index/update';
$route['profile/set_profile_update'] = 'profileController/set_profile_update';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
