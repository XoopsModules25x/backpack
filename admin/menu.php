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
defined('XOOPS_ROOT_PATH') or die('XOOPS root path not defined');

$path = dirname(dirname(dirname(__DIR__)));
include_once $path . '/mainfile.php';

$dirname         = basename(dirname(__DIR__));
$module_handler  = xoops_gethandler('module');
$module          = $module_handler->getByDirname($dirname);
$pathIcon32      = $module->getInfo('icons32');
$pathModuleAdmin = $module->getInfo('dirmoduleadmin');
$pathLanguage    = $path . $pathModuleAdmin;


if (!file_exists($fileinc = $pathLanguage . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . 'main.php')) {
    $fileinc = $pathLanguage . '/language/english/main.php';
}

include_once $fileinc;

$adminmenu = array();
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