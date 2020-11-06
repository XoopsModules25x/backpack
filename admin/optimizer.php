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
if (!ini_get('safe_mode')) {
	set_time_limit(0);
}
$ok = 0;
$op = '';
$message = '';
$table = array();
$op = (isset($_POST['op'])) ? filter_input(INPUT_POST, 'op', FILTER_SANITIZE_STRING, array('flags' => FILTER_NULL_ON_FAILURE)) : false;
$ok = (isset($_POST['ok'])) ? filter_input(INPUT_POST, 'ok', FILTER_SANITIZE_STRING, array('flags' => FILTER_NULL_ON_FAILURE)) : false;

include_once 'admin_header.php';
xoops_cp_header();
$indexAdmin = new ModuleAdmin();
echo $indexAdmin->addNavigation('optimizer.php');

function format_time($seconds){
	$hour = $seconds / 3600;
    $total_time = $seconds - ($hour*3600);
    $min = $seconds / 60;
    $sec = $seconds % 60;
    $format = sprintf("%02d",$hour).":".sprintf("%02d",$min).":".sprintf("%02d",$sec);
    return $format;
}
if ($ok != 1) {
	$op = '';
}
switch ($op) {
	case 'conf_opt':
		echo _AM_PROCESS_EFFECTUE.'<br />';
		$r = $xoopsDB->queryF('SHOW TABLES');
		while($row = $xoopsDB->fetchRow($r)) {
			$table[] = $row[0];
		}
		if (count($table) == 0) {
			$ok = 0;
			$message = _AM_PASOK_PASTABLE;
			break;
		} elseif (count($table) == 1) {
			$xoopsDB->queryF('LOCK TABLES `'.$table[0].'` WRITE');
		} elseif (count($table) > 1) {
			$xoopsDB->queryF('LOCK TABLES `'.implode('` WRITE, `',$table).'` WRITE');
		} else {
			$ok = 0;
			$message = _AM_ERROR_UNKNOWN;
			break;
		}
		echo _AM_LOCK_BDD.'<br />';
		$t1 = time();	
		foreach ($table	as $val) {
			$b1 = time();
			if ($xoopsDB->query('OPTIMIZE TABLE `'.$val.'`')) {
				$b2 = time();
				$table_time = $b2 - $b1;
				echo _AM_OPTIMIZE . ' ' . $val . ' OK (' . _AM_TEMPS_ECOULE .' : ' . format_time($table_time) . ')<br />';
			}
		}
		$xoopsDB->queryF('UNLOCK TABLES');
		echo _AM_UNLOCK_BDD.'<br />';
		$t2 = time();
	    $total_time = $t2 - $t1;
		echo _AM_TEMPS_TOT.' : '.format_time($total_time) .'<br />';
		echo '<p style="text-align: center;"><a href="index.php">'._AM_RETURNTOSTART.'</a></p>';
		break;
	default:
		$ok = 1;
		xoops_confirm(array( 'op' => 'conf_opt', 'ok' => 1),XOOPS_URL.'/modules/' . $xoopsModule->getVar('dirname') .'/admin/optimizer.php',_AM_OPT_WARNING. '<br />'._AM_PRECISION.'<br />'._AM_VERIF_SUR.'<br /><a href="index.php">'._AM_RETURNTOSTART.'</a>');
}
if ($ok != 1) {
	echo $message;
	echo '<p style="text-align: center;"><a href="index.php">'._AM_RETURNTOSTART.'</a></p>';
}
include 'admin_footer.php';
