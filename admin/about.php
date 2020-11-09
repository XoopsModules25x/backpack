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

require __DIR__ . '/admin_header.php';
xoops_cp_header();

$adminObject->displayNavigation(basename(__FILE__));
$adminObject::setPaypal('2MHAG2L3NZG8G');
$adminObject->displayAbout(false);

require __DIR__ . '/admin_footer.php';
