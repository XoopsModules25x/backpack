<?php
/*
** for clockedworks module
*/
function backpack_cron($parameter=NULL){
	global $xoopsDB;
	$dirname = basename( __DIR__ ) ;
	require(XOOPS_ROOT_PATH . '/modules/' . $dirname . '/include/zip.lib.php');
	require(XOOPS_ROOT_PATH . '/modules/' . $dirname . '/include/defines.lib.php');
	require(XOOPS_ROOT_PATH . '/modules/' . $dirname . '/include/read_dump.lib.php');
	include(XOOPS_ROOT_PATH . '/modules/' . $dirname . '/admin/backup.ini.php');
	include(XOOPS_ROOT_PATH . '/modules/' . $dirname . '/class/class.backpack.php');

	$alltables = $backup_structure = $backup_data = 1;
	$result = $xoopsDB->queryF('SHOW TABLES FROM '.$db_selected);
	$num_tables = $xoopsDB->getRowsNum($result);
	for ($i = 0; $i < $num_tables; $i++) {
		$tablename_array[$i] = mysqli_tablename($result, $i);
	}
	$filename = 'xdb'.date('YmdHis',time());
	$cfgZipType =  'gzip';
	$bp = new backpack($dirname,$parameter);
	if ($bp->err_msg) echo "<font color='red'>" . $bp->err_msg ."</font>";
	$bp->backup_data($tablename_array, $backup_structure, $backup_data, $filename, $cfgZipType);
}
