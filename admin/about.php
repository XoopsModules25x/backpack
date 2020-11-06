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

require_once __DIR__ . '/admin_header.php';
xoops_cp_header();

$aboutAdmin = Admin::getInstance();

$aboutAdmin->displayNavigation('about.php');
$aboutAdmin->renderAbout('2MHAG2L3NZG8G', false);

require __DIR__ . '/admin_footer.php';
