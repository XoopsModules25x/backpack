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
// Defines
define ('TIME_LIMIT',300);
define ('DB_SELECT_FORM', 1);
define ('POST_DB_SELECT_FORM', 2);
define ('POST_SELECT_TABLES_FORM', 3);
define ('RESTORE_DATA', 4);
define ('POST_CONFIG_FORM', 5);
define ('DELETE_CONFIG_FILE', 6);
define ('POST_SELECT_MODULE_FORM',7);
define ('MAX_DUMPLINE',131071);
define ('MAX_DUMPSIZE',1024);

// For the export features...
$cfg['ZipDump']               = true;   // Allow the use of zip/gzip/bzip
$cfg['GZipDump']              = true;   // compression for
$cfg['BZipDump']              = true;   // dump files
//Check for php.ini
//memory_limit = 8M      ; Maximum amount of memory a script may consume (8MB)
//; Maximum size of POST data that PHP will accept.
//post_max_size = 8M
//; Maximum allowed size for uploaded files.
//upload_max_filesize = 2M
$maxbyte = '8000000';	// Upload Max FileSize ( Dipend on php.ini def = 2M )
//
// Start a session and get variables
//
$db_selected = XOOPS_DB_NAME;
$db_host = XOOPS_DB_HOST;
$db_user = XOOPS_DB_USER;
$db_pass = XOOPS_DB_PASS;

$sys_tables = array(
	'groups',
	'users',
	'groups_users_link',
	'group_permission',
	'modules',
	'newblocks',
	'block_module_link',
	'tplfile',
	'tplsource',
	'tplset',
	'config',
	'configcategory',
	'configoption',
	'avatar',
	'avatar_user_link',
	'xoopsnotifications',
	'image',
	'imagebody',
	'imagecategory',
	'imgset',
	'online',
	'priv_msgs',
	'smiles',
	'session',
	'xoopscomments',
	'bannerclient',
	'banner',
	'bannerfinish'
);
$footer = '<div class="adminfooter">'."\n".'<div style="text-align: center;">'."\n"
    . '    <a href="http://www.xoops.org" rel="external"><img src="'.$pathIcon32.'/xoopsmicrobutton.gif" alt="xoops" title="xoops"></a>'."\n"
    . '  </div>'."\n" . '  <div class="center smallsmall italic pad5"> ce module est maintenu par <a href="https://store.chg-web.com" rel="external">Cedric MONTUY CHG-WEB</a>' . "\n" . '</div>';

// Whether the os php is running on is windows or not
if (!defined('PMA_IS_WINDOWS')) {
    if (defined('PHP_OS') && stristr(PHP_OS, 'win')) {
        define('PMA_IS_WINDOWS', 1);
    } else {
        define('PMA_IS_WINDOWS', 0);
    }
}

