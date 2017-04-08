<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Active template
|--------------------------------------------------------------------------
|
| The $template['active_template'] setting lets you choose which template 
| group to make active.  By default there is only one group (the 
| "default" group).
|
*/
$template['active_template'] = 'default';

/*
|--------------------------------------------------------------------------
| Explaination of template group variables
|--------------------------------------------------------------------------
|
| ['template'] The filename of your master template file in the Views folder.
|   Typically this file will contain a full XHTML skeleton that outputs your
|   full template or region per region. Include the file extension if other
|   than ".php"
| ['regions'] Places within the template where your content may land. 
|   You may also include default markup, wrappers and attributes here 
|   (though not recommended). Region keys must be translatable into variables 
|   (no spaces or dashes, etc)
| ['parser'] The parser class/library to use for the parse_view() method
|   NOTE: See http://codeigniter.com/forums/viewthread/60050/P0/ for a good
|   Smarty Parser that works perfectly with Template
| ['parse_template'] FALSE (default) to treat master template as a View. TRUE
|   to user parser (see above) on the master template
|
| Region information can be extended by setting the following variables:
| ['content'] Must be an array! Use to set default region content
| ['name'] A string to identify the region beyond what it is defined by its key.
| ['wrapper'] An HTML element to wrap the region contents in. (We 
|   recommend doing this in your template file.)
| ['attributes'] Multidimensional array defining HTML attributes of the 
|   wrapper. (We recommend doing this in your template file.)
|
| Example:
| $template['default']['regions'] = array(
|    'header' => array(
|       'content' => array('<h1>Welcome</h1>','<p>Hello World</p>'),
|       'name' => 'Page Header',
|       'wrapper' => '<div>',
|       'attributes' => array('id' => 'header', 'class' => 'clearfix')
|    )
| );
|
*/

/*
|--------------------------------------------------------------------------
| Default Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$template['default']['template'] = 'themes/nostx/index';
$template['default']['regions'] = array(
   'meta',
   'site-name',
   'util-nav',
   'main-nav',
   'message',
   'profile',
   'help',
   'logout',
   'admin',
   'action',
   'header',
   'content',
   'left-content',
   'right-content',
);

$template['default']['regions']['footer'] = array('content' => array('
    
DUYDUI Server Hotspot <strong>Solfware Version '.AL_VERSION.'</strong> &amp; Core Version '.CI_VERSION.'  | โปรแกรมนี้ใช้สัญญาอนุญาตครีเอทีฟคอมมอนส์ "สงวนลิขสิทธิ์บางประการ" 2017. Some rights reserved. ผู้พัฒนา :  '.DEVELOPER.' <a href="donate" id="iframe_fancybox">สนับสนุนโปรแกรม</a> 
       
	'));
$template['default']['parser'] = 'parser';
$template['default']['parser_method'] = 'parse';
$template['default']['parse_template'] = TRUE;

/*  End default template */



/*
|--------------------------------------------------------------------------
| Fancybox Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$template['fancybox']['template'] = 'themes/fancybox/index';
$template['fancybox']['regions'] = array(
   'content',
   
);

$template['fancybox']['parser'] = 'parser';
$template['fancybox']['parser_method'] = 'parse';
$template['fancybox']['parse_template'] = TRUE;

/*  End fancybox template */

/*
|--------------------------------------------------------------------------
| Administrator air Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$template['air']['template'] = 'themes/air/index';
$template['air']['regions'] = array(
	'template_path',
   'title',
   'header',
   'content',
   'inner',
   'footer'
   
   
);

$template['air']['parser'] = 'parser';
$template['air']['parser_method'] = 'parse';
$template['air']['parse_template'] = TRUE;

/*  End Administrator air template */



/*
|--------------------------------------------------------------------------
| Hotspotlogin Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$template['hotspotlogin']['template'] = 'themes/hotspotlogin/index';
$template['hotspotlogin']['regions'] = array(
   'template_path',
   'site-name',
   'header',
   'body',
   'signup_url',
   'login_content',
   'login_footer',
   'popup_message',
   'popup_content',
   'message',
   'changepwd_url',
   'contract_url'
);

$template['hotspotlogin']['parser'] = 'parser';
$template['hotspotlogin']['parser_method'] = 'parse';
$template['hotspotlogin']['parse_template'] = TRUE;

/*  End hotspotlogin template */

/*
|--------------------------------------------------------------------------
| Home page Template Admin Configuration (adjust this or create your own) 
|--------------------------------------------------------------------------
*/

$template['admin_pages']['template'] = 'themes/admin_pages/index'; 
$template['admin_pages']['regions'] = array(
'template_path',
   'site-name',
   'header_logo',
   'content',
);

$template['admin_pages']['parser'] = 'parser';
$template['admin_pages']['parser_method'] = 'parse';
$template['admin_pages']['parse_template'] = TRUE;

/*  End homepage template */
/*
|--------------------------------------------------------------------------
| Common page Template Common Configuration (adjust this or create your own) 
|--------------------------------------------------------------------------
*/

$template['common']['template'] = 'themes/common/main'; 
$template['common']['regions'] = array(
   'template_path',
   'header',
   'site-name',
   'header_logo',
   'content',
   'footer'
);

$template['common']['parser'] = 'parser';
$template['common']['parser_method'] = 'parse';
$template['common']['parse_template'] = TRUE;

/*  End Template Common template */

/*
|--------------------------------------------------------------------------
| Home page Template Admin Configuration (adjust this or create your own) 
|--------------------------------------------------------------------------
*/

$template['homepage']['template'] = 'themes/homepage/main'; 
$template['homepage']['regions'] = array(
   'template_path',
   'body',
   'site-name',
   'header_logo',
   'content',
);

$template['homepage']['parser'] = 'parser';
$template['homepage']['parser_method'] = 'parse';
$template['homepage']['parse_template'] = TRUE;

/*  End homepage template */

/*
|--------------------------------------------------------------------------
| Home page user miscellaneous Configuration (adjust this or create your own) 
|--------------------------------------------------------------------------
*/

$template['register']['template'] = 'user/index'; 
$template['register']['regions'] = array(
   'template_path',
   'header', 
   'site-name',
   'header_logo',
   'content',
   'footer',
);

$template['register']['parser'] = 'parser';
$template['register']['parser_method'] = 'parse';
$template['register']['parse_template'] = TRUE;

/*  End user miscellaneous template */

/*
|--------------------------------------------------------------------------
| Home page user dashboard (adjust this or create your own) 
|--------------------------------------------------------------------------
*/

$template['user']['template'] = 'dashboard/index'; 
$template['user']['regions'] = array(
   'template_path',
   'header', 
   'site-name',
   'header_logo',
   'content',
   'announ',
   'footer',
);

$template['user']['parser'] = 'parser';
$template['user']['parser_method'] = 'parse';
$template['user']['parse_template'] = TRUE;

/*  End homepage user dashboard template */

/*
|--------------------------------------------------------------------------
| Home page for user mobile phone & tablet (adjust this or create your own) 
|--------------------------------------------------------------------------
*/

$template['mobile']['template'] = 'mobileview/index'; 
$template['mobile']['regions'] = array(
   'template_path',
   'header', 
   'site-name',
   'header_logo',
   'content',
   'announ',
   'footer',
);

$template['mobile']['parser'] = 'parser';
$template['mobile']['parser_method'] = 'parse';
$template['mobile']['parse_template'] = TRUE;

/*  End homepage user mobile template */

/*
|--------------------------------------------------------------------------
| Home page for user mobile phone & tablet (adjust this or create your own) 
|--------------------------------------------------------------------------
*/

$template['mobilesign']['template'] = 'user/mobile/index'; 
$template['mobilesign']['regions'] = array(
   'template_path',
   'header', 
   'site-name',
   'header_logo',
   'content',
   'announ',
   'footer',
);

$template['mobilesign']['parser'] = 'parser';
$template['mobilesign']['parser_method'] = 'parse';
$template['mobilesign']['parse_template'] = TRUE;

/*  End homepage user mobile template */


/*
|--------------------------------------------------------------------------
| Mobilelogin Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$template['mobilelogin']['template'] = 'themes/mobilelogin/index';
$template['mobilelogin']['regions'] = array(
   'template_path',
   'site-name',
   'header',
   'logo',
   'body',
   'signup_url',
   'login_content',
   'login_footer',
   'login_copy',
   'hidden_form',
   'message',
   'auth_url',
   'meta_refresh'
);

$template['mobilelogin']['parser'] = 'parser';
$template['mobilelogin']['parser_method'] = 'parse';
$template['mobilelogin']['parse_template'] = TRUE;

/*  End mobilelogin template */



$template['css_path'] = ASSETS.'css/'; 
$template['js_path'] = ASSETS.'js/';



/* End of file template.php */
/* Location: ./system/application/config/template.php */