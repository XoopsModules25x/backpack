<?php
/*
*******************************************************
***													***
*** backpack										***
*** Cedric MONTUY pour CHG-WEB                      ***	
*** Original author : Yoshi Sakai					***
***													***
*******************************************************
*/
$module_dirname = basename( __DIR__ ) ;

$modversion['name'] = _MI_MOD_NAME;
$modversion['version'] = 2.01;
$modversion['description'] = _MI_MOD_DESC;
$modversion['author'] = 'Cedric MONTUY / Original author : Yoshi Sakai';
$modversion['credits'] = 'CHG-WEB';
$modversion['help'] = '';
$modversion['dirname'] = $module_dirname;
$modversion['image'] = 'images/'.$module_dirname.'_slogo.png';
$modversion['license'] = 'GNU General Public License';
$modversion['license_url'] = 'http://www.gnu.org/licenses/gpl.html';
$modversion['official'] = 0;
$modversion['author_website_url'] = 'store.chg-web.com';
$modversion['author_website_name'] = 'CHG-WEB';
$modversion['dirmoduleadmin'] = '/Frameworks/moduleclasses/moduleadmin';
$modversion['icons16']        = '../../Frameworks/moduleclasses/icons/16';
$modversion['icons32']        = '../../Frameworks/moduleclasses/icons/32';

//about
$modversion['demo_site_url'] = '';
$modversion['demo_site_name'] = '';
$modversion['module_website_url'] = 'store.chg-web.com';
$modversion['module_website_name'] = 'Cédric MONTUY';
$modversion['release_date'] = '2020/11/03';
$modversion["module_status"] = 'RC1';
$modversion['min_php'] = '7.1';
$modversion['min_xoops'] = '2.5.9';
$modversion['min_admin']= '1.1';
$modversion['min_db']= array('mysql'=>'5.5', 'mysqli'=>'5.5');

//Admin things
$modversion['system_menu'] = 1 ;
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

// Menu
$modversion['hasMain'] = 0;

// Blocks


// Search
$modversion['hasSearch'] = 0;

// Smarty
$modversion['use_smarty'] = 1;

/**
* Option
*/
$modversion['config'][1]['name'] = 'max_dumpsize';
$modversion['config'][1]['title'] = '_MI_MAX_DUMPSIZE';
$modversion['config'][1]['description'] = '_MI_MAX_DUMPSIZEDSC';
$modversion['config'][1]['formtype'] = 'textbox';
$modversion['config'][1]['valuetype'] = 'int';
$modversion['config'][1]['default'] = 15000000;

$modversion['config'][2]['name'] = 'xoopsurlto';
$modversion['config'][2]['title'] = '_MI_XOOPSURL_TO';
$modversion['config'][2]['description'] = '_MI_XOOPSURL_DSC';
$modversion['config'][2]['formtype'] = 'textbox';
$modversion['config'][2]['valuetype'] = 'text';
$modversion['config'][2]['default'] = XOOPS_URL;