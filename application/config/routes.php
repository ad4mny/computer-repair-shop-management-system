<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'loginController';

$route['login'] = 'loginController';
$route['login/auth'] = 'loginController/login_auth';
$route['create'] = 'loginController/index/create';
$route['login/create_account'] = 'loginController/create_user_account';
$route['login/check_username'] = 'loginController/check_username';
$route['logout'] = 'loginController/logout';

$route['dashboard'] = 'dashboardController';
$route['dashboard/delete/(:any)'] = 'dashboardController/delete_request/$1';

$route['request'] = 'requestController';

$route['track'] = 'trackController';

$route['status'] = 'statusController';

$route['profile'] = 'profileController';
$route['profile/update'] = 'profileController/index/update';
$route['profile/set_profile_update'] = 'profileController/set_profile_update';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
