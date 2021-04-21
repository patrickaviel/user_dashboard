<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Users';

$route['sign-in'] = 'Users/showSignInForm';
$route['sign-up'] = 'Users/showRegistrationForm';
$route['register'] = 'Users/register';
$route['dashboard'] = 'Users/showDashboard';
$route['users/new'] = 'Users/addNewUser';
$route['users/edit'] = 'Users/editProfile';
$route['wall'] = 'wall/index';
$route['users/edit_admin'] = 'Users/adminEditUser';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
