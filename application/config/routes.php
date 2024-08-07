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


$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['product'] = 'product/index';
$route['product/create'] = 'product/create';
$route['product/store'] = 'product/store';
$route['product/edit/(:num)'] = 'product/edit/$1';
$route['product/update/(:num)'] = 'product/update/$1';
$route['product/delete/(:num)'] = 'product/delete/$1';

$route['inventory/request-form'] = 'admin/requestForm';
$route['inventory/receive'] = 'inventory/receive';
$route['inventory/stock_report'] = 'inventory/stockReport';
$route['admin/detail/(:num)'] = 'admin/detail/$1';
$route['admin/continue/(:num)'] = 'admin/continue/$1';

$route['inventory_out'] = 'inventory_out/index';
$route['inventory_out/create'] = 'inventory_out/create';
$route['inventory_out/store'] = 'inventory_out/store';
$route['inventory_out/edit/(:num)'] = 'inventory_out/edit/$1';
$route['inventory_out/update/(:num)'] = 'inventory_out/update/$1';
$route['inventory_out/delete/(:num)'] = 'inventory_out/delete/$1';

$route['user/request-form'] = 'user/requestForm';
$route['admin/continueRequest/(:any)'] = 'admin/continueRequest/$1';





