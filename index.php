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
if (!include('../../mainfile.php')) {
    die('XOOPS root path not defined');
}
if (!empty(\Xmf\Request::getString('HTTP_REFERER', '', 'SERVER'))) {
    if (preg_match('`backpack/admin`i', \Xmf\Request::getString('HTTP_REFERER', '', 'SERVER'))) {
        header('HTTP/1.0 303 See Other ');
        header('Location: ./admin/about.php');
        exit;
    }
}
header('HTTP/1.0 401 Unauthorized');
header('Location: '.XOOPS_URL);
