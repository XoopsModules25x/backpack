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

use Xmf\Module\Admin;

/** @var Admin $adminObject */

$path = dirname(__DIR__, 3);
require_once $path . '/include/cp_header.php';

//global $xoopsModule, $xoopsUser;

$thisModuleDir  = $GLOBALS['xoopsModule']->getVar('dirname');
$thisModulePath = dirname(__DIR__);

require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
require_once $thisModulePath . '/include/zip.lib.php';
require_once $thisModulePath . '/include/defines.lib.php';
require_once $thisModulePath . '/include/read_dump.lib.php';

$adminObject = Admin::getInstance();

$pathIcon16      = '../' . $GLOBALS['xoopsModule']->getInfo('icons16');
$pathIcon32      = '../' . $GLOBALS['xoopsModule']->getInfo('icons32');
$pathModuleAdmin = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
// Include backup functions
require_once $thisModulePath . '/admin/backup.ini.php';
require_once $thisModulePath . '/class/class.backpack.php';

// Load language files
xoops_loadLanguage('admin', $thisModuleDir);
xoops_loadLanguage('modinfo', $thisModuleDir);

$myts = MyTextSanitizer::getInstance();

if ($GLOBALS['xoopsUser']) {
    $modulepermHandler = xoops_getHandler('groupperm');
    if (!$modulepermHandler->checkRight('module_admin', $GLOBALS['xoopsModule']->getVar('mid'), $GLOBALS['xoopsUser']->getGroups())) {
        redirect_header(XOOPS_URL, 1, _NOPERM);
    }
} else {
    redirect_header(XOOPS_URL . '/user.php', 1, _NOPERM);
}

if (!isset($xoopsTpl) || !is_object($xoopsTpl)) {
    require_once XOOPS_ROOT_PATH . '/class/template.php';
    $xoopsTpl = new XoopsTpl();
}

$xoopsTpl->assign('pathIcon16', $pathIcon16);
