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

defined('XOOPS_ROOT_PATH') or die('Restricted access');

// phpMyAdmin release
if (!defined('PMA_VERSION')) {
    define('PMA_VERSION', '3.3.7');
}

// php version
if (!defined('PMA_PHP_INT_VERSION')) {
	if (!defined('PHP_VERSION_ID')) {
		$version = explode('.',PHP_VERSION);
		define('PMA_PHP_INT_VERSION', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
	} else {
		define('PMA_PHP_INT_VERSION', PHP_VERSION_ID);
	}
}
// Whether the os php is running on is windows or not
if (!defined('PMA_IS_WINDOWS')) {
    if (defined('PHP_OS') && stripos(PHP_OS,'win') !== false) {
        define('PMA_IS_WINDOWS', 1);
    } else {
        define('PMA_IS_WINDOWS', 0);
    }
}
// MySQL Version
if (!defined('PMA_MYSQL_INT_VERSION')) {
    if (!empty($server)) {
        $result = mysql_query('SELECT VERSION() AS version');
        if ($result != FALSE && @mysql_num_rows($result) > 0) {
            $row   = mysql_fetch_array($result);
            $match = explode('.', $row['version']);
        } else {
            $result = @mysql_query('SHOW VARIABLES LIKE \'version\'');
            if ($result != FALSE && @mysql_num_rows($result) > 0){
                $row   = mysql_fetch_row($result);
                $match = explode('.', $row[1]);
            }
        }
    } // end server id is defined case

    if (!isset($match) || !isset($match[0])) {
        $match[0] = 3;
    }
    if (!isset($match[1])) {
        $match[1] = 21;
    }
    if (!isset($match[2])) {
        $match[2] = 0;
    }

    define('PMA_MYSQL_INT_VERSION', (int)sprintf('%d%02d%02d', $match[0], $match[1], intval($match[2])));
    unset($match);
}

if (!defined('PMA_USR_OS')) {
    if (!isset($_SERVER['HTTP_USER_AGENT']) OR empty($_SERVER['HTTP_USER_AGENT'])) {
        die ('PHP version is too old');
    } 

    // 1. Platform
	if(preg_match_all("#Windows NT (.*)[;|\)]#isU", $_SERVER["HTTP_USER_AGENT"], $version)){  
    	$os = 'Win';  
	} elseif(preg_match_all("#Mac (.*);#isU", $_SERVER["HTTP_USER_AGENT"], $version)){  
    	$os = 'Mac';  
	} elseif(preg_match("#Mac#", $_SERVER["HTTP_USER_AGENT"])){  
	    $os = 'Mac';  
	} elseif(preg_match("#SunOS#", $_SERVER["HTTP_USER_AGENT"])){  
	    $os = 'SunOS';  
	} elseif(preg_match("#Fedora#", $_SERVER["HTTP_USER_AGENT"])){  
	    $os = 'Fedora';  
	} elseif(preg_match("#Haiku#", $_SERVER["HTTP_USER_AGENT"])){  
	    $os = 'Haiku';  
	} elseif(preg_match("#Ubuntu#", $_SERVER["HTTP_USER_AGENT"])){  
	    $os = 'Linux Ubuntu';  
	} elseif(preg_match("#FreeBSD#", $_SERVER["HTTP_USER_AGENT"])){  
	    $os = 'FreeBSD';  
	} elseif(preg_match("#Linux#", $_SERVER["HTTP_USER_AGENT"])){  
	    $os = 'Linux';  
	} else {  
	    $os = 'Inconnu';  
	} 
	define('PMA_USR_OS', $os);
	unset($os); 

    // 2. browser and version
	if(preg_match_all("#Opera (.*)(\[[a-z]{2}\];)?$#isU", $_SERVER["HTTP_USER_AGENT"], $version)){  
    	$navigateur = 'Opéra';
		$ver = $version[1][0];  
	} elseif(preg_match_all("#MSIE (.*);#isU", $_SERVER["HTTP_USER_AGENT"], $version)){  
    	$navigateur = 'Internet Explorer';
		$ver = $version[1][0];  
	} elseif(preg_match_all("#Firefox(.*)$#isU", $_SERVER["HTTP_USER_AGENT"], $version)){  
    	$ver = str_replace('/', '', $version[1][0]);  
	    $navigateur = 'Firefox';  
	} elseif(preg_match_all("#Chrome(.*) Safari#isU", $_SERVER["HTTP_USER_AGENT"], $version)){  
    	$ver = str_replace('/', '', $version[1][0]);  
	    $navigateur = 'Chrome';  
	} elseif(preg_match_all("#Opera(.*) \(#isU", $_SERVER["HTTP_USER_AGENT"], $version)){  
    	$ver = str_replace('/', '', $version[1][0]);  
    	$navigateur = 'Opéra';  
	} elseif(preg_match("#Nokia#", $_SERVER["HTTP_USER_AGENT"])){  
		$ver = '';
	    $navigateur = 'Nokia';  
	} elseif(preg_match("#Safari#", $_SERVER["HTTP_USER_AGENT"])){  
	    $navigateur = 'Safari';
		$ver = '';  
	} elseif(preg_match("#SeaMonkey#", $_SERVER["HTTP_USER_AGENT"])){  
	    $navigateur = 'SeaMonkey';
		$ver = '';  
	} elseif(preg_match("#PSP#", $_SERVER["HTTP_USER_AGENT"])){  
	    $navigateur = 'PSP';
		$ver = '';  
	} elseif(preg_match("#Netscape#", $_SERVER["HTTP_USER_AGENT"])){  
	    $navigateur = 'Netscape';  
		$ver = '';
	} else {  
    	$navigateur = 'Inconnu';  
		$ver = '';
	}  
	define ('PMA_USR_BROWSER_VER', $ver);
	define ('PMA_USR_BROWSER_AGENT', $navigateur);
	unset ($navigateur, $ver);
}