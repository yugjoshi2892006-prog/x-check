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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'home';

$route['materials/categories'] = 'materials/categories';
$route['materials/add-category'] = 'materials/add_category';

$route['employee/profile'] = 'employee/profile';
$route['project-monitoring'] = 'admin/project_monitoring';
$route['register'] = 'auth/register';
$route['save-register'] = 'auth/save_register';

$route['team'] = 'team/index';
$route['team/add'] = 'team/add';
$route['team/insert'] = 'team/insert';
$route['team/edit/(:num)'] = 'team/edit/$1';
$route['team/update/(:num)'] = 'team/update/$1';
$route['team/delete/(:num)'] = 'team/delete/$1';
$route['profile'] = 'profile';

$route['payment-history'] = 'plan/payment_history';


$route['profile/save'] = 'profile/save';

$route['materials/subcategories'] = 'materials/subcategories';
$route['materials/add-subcategory'] = 'materials/add_subcategory';



$route['layout_member'] = 'Layout_member/index';
$route['layout_member/add'] = 'Layout_member/add';
$route['layout_member/store'] = 'Layout_member/store';
$route['layout_member/edit/(:num)'] = 'Layout_member/edit/$1';
$route['layout_member/update/(:num)'] = 'Layout_member/update/$1';
$route['layout_member/delete/(:num)'] = 'Layout_member/delete/$1';



$route['project/get_priority_subcategories']
    = 'project/get_priority_subcategories';




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
