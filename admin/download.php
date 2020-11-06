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
ini_set('memory_limit','20M');
if (!ini_get('safe_mode')) {
	set_time_limit(0);
}
include_once 'admin_header.php';
xoops_cp_header();
$indexAdmin = new ModuleAdmin();
echo $indexAdmin->addNavigation('download.php.php');

include '../include/ext2mime.php';		// Load the decode array of extension to MIME

$fpathname = htmlspecialchars ( rawurldecode($_GET['url']) , ENT_QUOTES );
$dl_filename = $fpathname;
if ( defined('XOOPS_VAR_PATH')) {
	$backup_dir = XOOPS_VAR_PATH . '/caches/';
}else{
	$backup_dir = XOOPS_ROOT_PATH . '/cache/';
}
$fpathname = $backup_dir.$fpathname;
ob_clean();
if(!file_exists($fpathname)){
	if(file_exists($fpathname.'.log')){
		echo '<strong>Already downloaded by </strong>';
		$fp = fopen($fpathname.'.log','r');
		while(!feof($fp)) {
			$line = fgets($fp);
			echo $line.'<br />';
		}
		fclose($fp);
		exit();
	}
	print('Error - '.$fpathname.' does not exist.');
	return ;
}
$browser = $version =0;
UsrBrowserAgent($browser,$version);
ignore_user_abort();

$fnamedotpos = strrpos($dl_filename,'.');
$fext = substr($dl_filename,$fnamedotpos+1);
$ctype = isset($ext2mime[$fext]) ? $ext2mime[$fext] : "application/octet-stream-dummy" ;
if ($fext=="gz") $content_encoding = 'x-gzip';
//echo $fext.$ctype; exit();
if ($browser == 'IE' && (ini_get('zlib.output_compression')) ) {
    ini_set('zlib.output_compression', 'Off');
}
//if (!empty($content_encoding)) {
//    header('Content-Encoding: ' . $content_encoding);
//}
if (!empty($content_encoding)) {
    header('Content-Encoding: ' . $content_encoding);
}
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($fpathname) );
header("Content-type: " . $ctype);
header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Last-Modified: ' . date("D M j G:i:s T Y"));
header('Content-Disposition: attachment; filename="' . $dl_filename . '"');
//header("Content-Disposition: inline; filename=" . $dl_filename);
header("x-extension: " . $ctype );

if ($browser == 'IE') {
    header('Pragma: public');
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
} else {
    header('Pragma: no-cache');
}

$fp = fopen($fpathname,'r');
while(!feof($fp)) {
	$buffer = fread($fp, 1024*6); //speed-limit 64kb/s
	print $buffer;
	flush();
	ob_flush();
	usleep(10000); 
}
fclose($fp);
//
// Save download log
//
if ($xoopsUser) $uname = $xoopsUser->getVar('uname'); else $uname = "Anonymous";
$str = $uname.",".date("Y-m-d H:i:s", time());
$postlog = $fpathname.'.log';
$fp = fopen($postlog, 'a');
fwrite($fp, $str."\n");
fclose($fp);
unlink($fpathname);
//xoops_cp_footer();
//
// Check User Browser
//
function UsrBrowserAgent(&$browser,&$version) {
    if (preg_match('@Opera(/| )([0-9].[0-9]{1,2})@', $_SERVER['HTTP_USER_AGENT'], $log_version)) {
        $version= $log_version[2];
        $browser='OPERA';
    } elseif (preg_match('@MSIE ([0-9].[0-9]{1,2})@', $_SERVER['HTTP_USER_AGENT'], $log_version)) {
        $version= $log_version[1];
        $browser='IE';
    } elseif (preg_match('@OmniWeb/([0-9].[0-9]{1,2})@', $_SERVER['HTTP_USER_AGENT'], $log_version)) {
        $version= $log_version[1];
        $browser='OMNIWEB';
    } elseif (preg_match('@(Konqueror/)(.*)(;)@', $_SERVER['HTTP_USER_AGENT'], $log_version)) {
        $version= $log_version[2];
        $browser='KONQUEROR';
    } elseif (preg_match('@Mozilla/([0-9].[0-9]{1,2})@', $_SERVER['HTTP_USER_AGENT'], $log_version)
               && preg_match('@Safari/([0-9]*)@', $_SERVER['HTTP_USER_AGENT'], $log_version2)) {
        $version= $log_version[1] . '.' . $log_version2[1];
        $browser='SAFARI';
    } elseif (preg_match('@Mozilla/([0-9].[0-9]{1,2})@', $_SERVER['HTTP_USER_AGENT'], $log_version)) {
        $version= $log_version[1];
        $browser='MOZILLA';
    } else {
        $version= 0;
        $browser='OTHER';
    }
    return $browser;
}
