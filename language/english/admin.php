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
define("_AM_TITLE", "BackPack");
define("_AM_BACKUPTITLE","Database Backup");
define("_AM_MODULEBACKUP","Module Backup");
define("_AM_SELECTTABLES","Table Backup");
define("_AM_RESTORE","Restore");
define("_AM_OPTIMIZE","Optimize");
define("_AM_RESTORETITLE","Restore (Prefix will be replaced to '" . XOOPS_DB_PREFIX . "'.)");
define("_AM_DETAILSTOBACKUP","Select details to backup");
define("_AM_SELECTMODULE","Select Module");
define("_AM_COMPRESSION","Compression");
define("_AM_OTHER","Other");
define("_AM_SELECTAFILE","Select a file");
define("_AM_DETAILSTORESTORE","Select details to restore");
define("_AM_TABLESTRUCTURE","Table Structure");
define("_AM_TABLEDATA","Table Data");
define("_AM_BACKUP","Backup");
define("_AM_RESET","Reset");
define("_AM_BACKUPNOTICE","Once you click 'Backup' the selected tables will be backed up and a file download will start which will download the backup file to your computer.");
define("_AM_SELECTTABLE","Select Tables for backup");
define("_AM_CHECKALL","Check All");
define("_AM_RETURNTOSTART","Return to Start");
define("_AM_OPT_WARNING","WARNING: YOUR DATABASE WILL BE UNACCESSIBLE DURING THE OPTIMIZE.");
define("_AM_OPT_STARTING","STARTING OPTIMIZE ON DATABASE %s in %s SECONDS.");
define("_AM_BACKPACK_SITE","Support Site");
// After V0.86
define("_AM_RESTORETITLE1","Upload and restore");
define("_AM_RESTORETITLE2","Restore from %s folder files");
define("_AM_SELECTAFILE_DESC",'Max: %s%s');
define("_AM_UPLOADEDFILENAME","Input uploaded file name");
define("_AM_UPLOADEDFILENAME_DESC",'&nbsp;Upload before restoration. The file will be deleted after restoration.');
// After V0.88
define("_AM_DOWNLOAD_LIST","Download list");
define("_AM_PURGE_FILES","Purge all download files.");
define("_AM_PURGED_ALLFILES","All download files are purged.");
define("_AM_READY_TO_DOWNLOAD","Ready to download.");
// After V0.90
define("_AM_IFNOTRELOAD","If the download does not automatically start, please click <a href='%s'>here</a>");
// After V0.97
define('_AM_REPLACEURL','Replace URL(ommit http://)');
define('_AM_REPLACEURL_DESC','Describe the URL perplace to \''.XOOPS_URL.'\'');
// After V1.01
define('_AM_VERIF_SUR', 'Are you sure you want to continue ?');
define('_AM_PRECISION', 'Depending on the size of your database, <br />a shorter or longer period is necessary');
define('_AM_PASOK_PASTABLE', 'No tables found in the database');
define('_AM_PROCESS_EFFECTUE', 'Process :');
define('_AM_LOCK_BDD', 'Locking tables of the database');
define('_AM_TEMPS_ECOULE', 'Elapsed time');
define('_AM_UNLOCK_BDD', 'Unlocking tables of database');
define('_AM_TEMPS_TOT', 'Total time of the operation :');
// Add version 2
define('_AM_RESTORE_OK','Restore Complete');
define('_AM_RESTORE_MESS1','The Restore is complete. Any errors or messages encountered are shown below.');
define('_AM_NO_FILE','No exist file: ');
define('_AM_TITLE_BCK','Backup MySQL Data');
define('_AM_TITLE_RESTORE', 'Restore MySQL Data');
define('_AM_SELECT_DATABASE','Select database to backup from ');
define('_AM_MESS_ERROR_1','Over upload_max_filesize on php.ini');
define('_AM_MESS_ERROR_2','Over MAX_FILE_SIZE at form');
define('_AM_MESS_ERROR_3','An error occured while trying to recieve the file. Please try again.');
define('_AM_MESS_ERROR_4','No Upload File.');
define('_AM_MESS_ERROR_5','Unknown Error - %s');
define('_AM_MESS_ERROR_6','Could not upload file.');
define('_AM_MESS_ERROR_7','Check upload_max_filesize, post_max_size, memory_limit parameters in php.ini');
define('_AM_NO_TABLE','No table found');
