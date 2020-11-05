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
include_once 'admin_header.php';
xoops_cp_header();
$indexAdmin = new ModuleAdmin();
echo $indexAdmin->addNavigation('restore.php');

$mode = '' ;
$action = '' ;
$filename = '' ;
$restore_structure = '' ;
$restore_data = '' ;
$replace_url =  '';
// Make sure we pick up variables passed via URL
if( isset( $_GET[ 'mode' ] ) ) $mode = filter_input(INPUT_GET,'mode',FILTER_SANITIZE_SPECIAL_CHARS);
if( isset( $_GET[ 'action' ] ) ) $action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_SPECIAL_CHARS);
if( isset( $_GET[ 'filename' ] ) ) $filename = filter_input(INPUT_GET,'filename',FILTER_SANITIZE_SPECIAL_CHARS);
if( isset( $_GET[ 'restore_structure' ] ) ) $restore_structure = filter_input(INPUT_GET,'restore_structure',FILTER_SANITIZE_SPECIAL_CHARS);
if( isset( $_GET[ 'restore_data' ] ) ) $restore_data = filter_input(INPUT_GET,'restore_data',FILTER_SANITIZE_SPECIAL_CHARS);
if( isset( $_POST['replace_url'] ) ) $replace_url =  filter_input(INPUT_POST,'replace_url',FILTER_SANITIZE_SPECIAL_CHARS);


$bp = new backpack();
if ($bp->err_msg) echo '<font color="red">' . $bp->err_msg .'</font>';

// Handle URL actions
switch ($mode) {
	case RESTORE_DATA: {
		if (!ini_get('safe_mode')) {
			set_time_limit(TIME_LIMIT);
		}
		echo '<p><strong>'._AM_RESTORE_OK.'</strong><br />'._AM_RESTORE_MESS1.'</p>';
		$fnamedotpos = strrpos($filename,'.');
		$fext = substr($filename,$fnamedotpos+1);
		$sql_str = '';
		switch($fext) {
			case 'gz':
				$mime_type = 'application/x-gzip';
				$sql_str = PMA_readFile($bp->backup_dir.$filename,$mime_type);
				break;
			case 'bz':
				$mime_type = 'application/x-bzip';
				$sql_str = PMA_readFile($bp->backup_dir.$filename,$mime_type);
				break;
			case 'sql':
				$mime_type = 'text/plain';
				break;
			default:
				$mime_type = '';
				break;
		}
		if (!file_exists($bp->backup_dir.$filename)){
			echo _AM_NO_FILE.$bp->backup_dir.$filename;
			break;
		}
		if ($sql_str){
			unlink($bp->backup_dir.$filename);
			//$filename = eregi_replace( ".gz|.bz" , "" , $filename);
			$filename = preg_replace('/.gz|.bz/i','',$filename);
			$fp = fopen($bp->backup_dir.$filename, 'wb');
			fwrite($fp, $sql_str);
			fclose($fp);
		}
		if ( strcmp(_CHARSET,'EUC-JP')==0 ){
		    //$result = mysql_query( "SET NAMES 'ujis'" );
			$result = $xoopsDB->queryF('SET NAMES \'ujis\'');
		}
		$bp->restore_data($bp->backup_dir.$filename, $restore_structure, $restore_data, $db_selected, $replace_url);
		unlink($bp->backup_dir.$filename);
		break;
	}
	case DB_SELECT_FORM: {
		echo '<table cellspacing="0" cellpadding="3">';
		if ($action == 'backup') {
			echo '<tr><td class="title">'._AM_TITLE_BCK.'</td></tr>';
			echo '<tr><td class="main_left"><p><b>'._AM_SELECT_DATABASE.'</b>';
		}
		if ($action == 'restore') {
			$upload       = $_FILES['filename'];
			$upload_tmp   = $_FILES['filename']['tmp_name'];	// Temp File name
			$upload_name  = $_FILES['filename']['name'];		// Local File Name
			$upload_size  = $_FILES['filename']['size'];		// Size
			$upload_type  = $_FILES['filename']['type'];		// Type
			$upfile_error = $_FILES['filename']['error'];		//upload file error no
		    if ( $upfile_error > 0 ){
		    	switch ($upfile_error){
		    		case UPLOAD_ERR_INI_SIZE: 
						echo _AM_MESS_ERROR_1; 
						break;
		    		case UPLOAD_ERR_FORM_SIZE: 
						echo _AM_MESS_ERROR_2; 
						break;
		    		case UPLOAD_ERR_PARTIAL: 
						echo _AM_MESS_ERROR_3; 
						break;
		    		case UPLOAD_ERR_NO_FILE: 
						echo _AM_MESS_ERROR_4; 
						break;
					default: 
						echo sprintf(_AM_MESS_ERROR_5,$upfile_error); 
						break;
				}
		    } 
			echo '<tr><td class="title">'._AM_TITLE_RESTORE.'</td></tr>';
			if ( !$upload_name && isset($_POST['uploadedfilename'])) {
				$upload_name = filter_input(INPUT_POST,'uploadedfilename',FILTER_SANITIZE_STRING); //$_POST['uploadedfilename'];
			} else {
				// Upload file
				$ret_val = move_uploaded_file($upload_tmp, $bp->backup_dir.$upload_name);
				if (!$ret_val) {
					echo '<br /><br />'._AM_MESS_ERROR_6.'<br />'._AM_MESS_ERROR_7.'</p></td></tr></table>';
					break;
				}
			}
			echo '<tr><td class="main_left"><p><b>restore from '.$upload_name.'</b>';
			echo '<tr><td class="main_left"><p><b>replace URL from http://'.$replace_url.'</b>';
			//$restore_structure = ($_POST['structure'] == "on") ? 1 : 0;
			$restore_structure = (filter_input(INPUT_POST,'structure',FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE) == 'on') ? 1 : 0;
			//$restore_data = ($_POST['data'] == "on") ? 1 : 0;
			$restore_data = (filter_input(INPUT_POST,'data',FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE) == "on") ? 1 : 0;
			echo '<form method="post" action="restore.php?mode='.RESTORE_DATA.'&filename=$upload_name&restore_structure=$restore_structure&restore_data=$restore_data\">\n';
			sprintf('<form method="post" action="restore.php?mode=%s&filename=%s&restore_structure=%s&restore_data=%s">',RESTORE_DATA,$upload_name,$restore_structure,$restore_data);
		}
		echo '<input type="submit" value="'._AM_RESTORE.'"></form>';
		echo '</p></td></tr></table>';
		break;
	}
	default: {
		if (!$filesize = ini_get('upload_max_filesize')) {
			$filesize = '5M';
		}
		$max_upload_size = $bp->get_real_size($filesize);
		if ($postsize = ini_get('post_max_size')) {
			$postsize = $bp->get_real_size($postsize);
			if ($postsize < $max_upload_size) {
				$max_upload_size = $postsize;
			}
		}
		unset($filesize);
		unset($postsize);
		echo '<h2>'._AM_RESTORETITLE.'</h2>';
		/*
		** for file upload
		*/
		//echo "<form method=\"post\" enctype=\"multipart/form-data\" action=\""
		//	.XOOPS_URL."/modules/backpack/admin/restore.php?mode=".DB_SELECT_FORM."&action=restore\">";
		sprintf('<form method="post" enctype="multipart/form-data" action="%s/modules/backpack/admin/restore.php?mode=%s&action=restore">',XOOPS_URL,DB_SELECT_FORM  );
		echo '<table class="outer" style="width: 100%"><tr><td class=head colspan="2">'._AM_RESTORETITLE1.'</td></tr>';
		echo '<tr><td class="odd"  style="width: 30%"><b>'._AM_SELECTAFILE.'</b> (gz, bz, sql)</td>';
		echo '<td><input type="hidden" name="MAX_FILE_SIZE" value="'.$maxbyte.'" />';
		echo '<input type="file" name="filename" />'.$bp->PMA_displayMaximumUploadSize($max_upload_size).'</td></tr>';
		echo '<tr><td class="odd"><b>'._AM_DETAILSTORESTORE.'</b></td>';
		echo '<td><input type="checkbox" name="structure" checked />&nbsp;'._AM_TABLESTRUCTURE.'&nbsp;&nbsp;&nbsp;<input type="checkbox" name="data" checked />&nbsp;'._AM_TABLEDATA.'</td></tr>';
		// preg_replace URL
		echo '<tr><td class="odd" style="width: 30%"><b>'._AM_REPLACEURL.'</b> </td>';
		echo '<td><input type="text" name="replace_url"> '._AM_REPLACEURL_DESC.'</td></tr>';
		// submit
		echo '<tr><td colspan="2" style="text-align: center;"><input type="submit" value="'._AM_RESTORE.'" /></td></tr></table></form>';
		echo '</p>';
		/*
		** for import only
		*/
		//echo "<form method=\"post\" action=\""
		//	.XOOPS_URL."/modules/backpack/admin/restore.php?mode=".DB_SELECT_FORM."&action=restore\">";
		sprintf('<form method="post" action="%s/modules/backpack/admin/restore.php?mode=%s&action=restore">',XOOPS_URL,DB_SELECT_FORM  );
		echo '<table class="outer" style="width: 100%"><tr><td class="head" colspan="2">'.sprintf(_AM_RESTORETITLE2,$bp->backup_dir).'</td></tr>';
		echo '<tr><td class="odd" style="width: 30%"><b>'._AM_UPLOADEDFILENAME.'</b> (gz, bz, sql)</td>';
		echo '<td><input type="text" name="uploadedfilename" />'._AM_UPLOADEDFILENAME_DESC.'</td></tr>';
		echo '<tr><td class="odd"><b>'._AM_DETAILSTORESTORE.'</b></td>';
		echo '<td><input type="checkbox" name="structure" checked />&nbsp;'._AM_TABLESTRUCTURE.'&nbsp;&nbsp;&nbsp;<input type="checkbox" name="data" checked />&nbsp;'._AM_TABLEDATA.'</td></tr>';
		// preg_replace URL
		echo '<tr><td class="odd" style="width: 30%"><b>'._AM_REPLACEURL.'</b></td>';
		echo '<td><input type="text" name="replace_url"> '._AM_REPLACEURL_DESC.'</td></tr>';
		// submit
		echo '<tr><td colspan="2" style="text-align: center;"><input type="submit" value="'._AM_RESTORE.'" /></td></tr></table></form>';
		echo '</p>';
	}
}
include 'admin_footer.php';
