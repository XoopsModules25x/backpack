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

require_once __DIR__ . '/admin_header.php';
xoops_cp_header();
$adminObject = Admin::getInstance();
$adminObject->displayNavigation(basename(__FILE__));
$adminObject->displayIndex();
require __DIR__ . '/admin_footer.php';
