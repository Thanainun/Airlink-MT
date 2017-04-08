<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['home/(:any)'] = "home/$1";

$route['admin/login'] = "admin/auth/login";
$route['admin/logout'] = "admin/auth/logout";
$route['register'] = "admin/auth/register";
$route['activate'] = "admin/auth/activate";
$route['admin/changepass'] = "admin/auth/change_password";
$route['forgotpass'] = "admin/auth/forgot_password";
$route['resetpass'] = "admin/auth/reset_password";
$route['changeemail'] = "admin/auth/change_email";
$route['resetemail'] = "admin/auth/reset_email";
$route['unregister'] = "admin/admin/auth/unregister";
$route['sendagain'] = "auth/send_again";

$route['gologin/(:any)'] = "gologin/$1";
$route['admin/user/:num'] = "admin/user";
$route['admin/design/:num'] = "admin/design"; 
$route['help/(:any)'] = "help/$1";
$route['admin/message/read/:num'] = "admin/message/read/$1";
$route['admin/message/delete/:num'] = "admin/message/delete/$1";

$route['admin/client/action/(:any)'] = 'admin/client/action/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */