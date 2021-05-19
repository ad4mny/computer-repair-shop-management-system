<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'loginController';
$route['login'] = 'loginController/index';
$route['login_auth'] = 'loginController/login_auth';
$route['logout'] = 'loginController/logout';
$route['dashboard'] = 'dashboardController/index';
$route['request'] = 'requestController';
$route['manage'] = 'manageController/index';
$route['status'] = 'statusController/index';
$route['profile'] = 'profileController';
$route['profile/update'] = 'profileController/index/update';
$route['profile/set_profile_update'] = 'profileController/set_profile_update';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
