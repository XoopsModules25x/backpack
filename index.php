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
if ( !include('../../mainfile.php') ) {
    die('XOOPS root path not defined');
}
if (!empty($_SERVER['HTTP_REFERER'])) {
	if (preg_match('`backpack/admin`i',$_SERVER['HTTP_REFERER'])) {
		header('HTTP/1.0 303 See Other ');
		header('Location: ./admin/about.php');
		exit;
	}
}
header('HTTP/1.0 401 Unauthorized');
header('Location: '.XOOPS_URL);
