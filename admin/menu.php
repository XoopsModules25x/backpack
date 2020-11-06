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

defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

$path = dirname(__DIR__, 3);
require_once $path . '/mainfile.php';

$dirname         = basename(dirname(__DIR__));
$moduleHandler  = xoops_getHandler('module');
$module          = $moduleHandler->getByDirname($dirname);
$pathIcon32      = $module->getInfo('icons32');
$pathModuleAdmin = $module->getInfo('dirmoduleadmin');
$pathLanguage    = $path . $pathModuleAdmin;
$thisModuleDir  = $GLOBALS['xoopsModule']->getVar('dirname');

xoops_loadLanguage('main', $thisModuleDir);

$adminmenu = [];
$i = 1;
$adminmenu[$i]['title'] = _MI_ACCUEIL;
$adminmenu[$i]['link'] = 'admin/index.php';
$adminmenu[$i]['icon'] = $pathIcon32.'/index.png';
$i++;
$adminmenu[$i]['title'] = _MI_BACKUPTITLE;
$adminmenu[$i]['link'] = 'admin/index2.php';
$adminmenu[$i]['icon'] = $pathIcon32.'/list.png';
$i++;
$adminmenu[$i]['title'] = _MI_MODULEBACKUP;
$adminmenu[$i]['link'] = 'admin/index2.php?mode=7';
$adminmenu[$i]['icon'] = $pathIcon32.'/export.png';
$i++;
$adminmenu[$i]['title'] = _MI_SELECTTABLES;
$adminmenu[$i]['link'] = 'admin/index2.php?mode=2&action=backup';
$adminmenu[$i]['icon'] = $pathIcon32.'/list.png';
$i++;
$adminmenu[$i]['title'] = _MI_RESTORE;
$adminmenu[$i]['link'] = 'admin/restore.php';
$adminmenu[$i]['icon'] = $pathIcon32.'/download.png';
$i++;
$adminmenu[$i]['title'] = _MI_OPTIMIZE;
$adminmenu[$i]['link'] = 'admin/optimizer.php';
$adminmenu[$i]['icon'] = $pathIcon32.'/synchronized.png';
$i++;
$adminmenu[$i]['title'] = _MI_ABOUT;
$adminmenu[$i]['link'] = 'admin/about.php';
$adminmenu[$i]['icon'] = $pathIcon32.'/about.png';
unset($i);
