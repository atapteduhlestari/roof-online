<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['404_override'] = 'Error';
$route['translate_uri_dashes'] = FALSE;

//to update slug with keyword name of the table
$route['slug/(:any)'] = 'Home/slug/$1';

$route['tentang'] = 'Home/about';
$route['kontak'] = 'Home/contact';
$route['karir'] = 'Home/career';
$route['save'] = 'Home/save';

//pagination product index
$route['product/(:num)'] = 'Product/index';
//detail product
$route['product/(:any)/(:any)/detail'] = 'Product/detail/$2';

//kategori product
$route['product/(:any)'] = 'Product/kategori/$1';
//pagination product kategori
$route['product/(:any)/(:num)'] = 'Product/kategori/$1';

//subkategori product
$route['product/(:any)/(:any)'] = 'Product/subkategori/$1/$2';
//pagination product subkategori
$route['product/(:any)/(:any)/(:num)'] = 'Product/subkategori/$1/$2';

$route['artikel'] = 'Post';
$route['artikel/(:any)'] = 'Post/detail/$1';
$route['artikel/date/(:any)/(:any)'] = 'Post/date/$1/$2';
