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
define("_AM_BACKUPTITLE","Sauvegarde des tables MySQL");
define("_AM_MODULEBACKUP","Sauvegarde d&#39;un module");
define("_AM_SELECTTABLES","S&#233;lection des tables et sauvegarde");
define("_AM_RESTORE","Restauration");
define("_AM_OPTIMIZE","Optimisation de table");
define("_AM_RESTORETITLE","Restauration des tables MySQL");
define("_AM_DETAILSTOBACKUP","S&#233;lectionnez les d&#233;tails de la sauvegarde");
define("_AM_SELECTMODULE","S&#233;lectionnez un module");
define("_AM_COMPRESSION","Compression");
define("_AM_OTHER","Autre");
define("_AM_SELECTAFILE","S&#233;lection de fichiers");
define("_AM_DETAILSTORESTORE","S&#233;lection des &#233;l&#233;ments &#224; restaurer");
define("_AM_TABLESTRUCTURE","Structure de Table");
define("_AM_TABLEDATA","Donn&#233;es de Table");
define("_AM_BACKUP","Sauvegarde");
define("_AM_RESET","Nettoyer");
define("_AM_BACKUPNOTICE","Une fois que vous aurez cliqu&#233; sur le bouton &#39;Sauvegarde&#39; les tables s&#233;lectionn&#233;es seront sauvegard&#233;es et un fichier &#224; t&#233;l&#233;charger sera d&#233;marr&#233; afin que vous puissiez le sauvegarder sur votre ordinateur.");
define("_AM_SELECTTABLE","S&#233;lection des tables MySQL. Tables &#224; sauvegarder");
define("_AM_CHECKALL","Toutes coch&#233;es");
define("_AM_RETURNTOSTART","Retour au d&#233;part");
define("_AM_OPT_WARNING","ATTENTION : VOTRE BASE DE DONNEES SERA INDISPONIBLE PENDANT L&#39;OPTIMISATION .");
define("_AM_OPT_STARTING","DEBUT DE L&#39;OPTIMISATION SUR LA BASE DE DONNEES %s dans %s SECONDES.");
define("_AM_BACKPACK_SITE","Site de Support");
// After V0.86
define("_AM_RESTORETITLE1","Envoi et restaure");
define("_AM_RESTORETITLE2","Restaure depuis %s dossier des fichiers");
define("_AM_SELECTAFILE_DESC",'Maximum : %s%s (Rappel : 1MB = 1024 Ko)');
define("_AM_UPLOADEDFILENAME","Saisir les noms des fichiers &#224; charger");
define("_AM_UPLOADEDFILENAME_DESC",' Envoi avant restauration. Le fichier sera supprim&#233; apr&#232;s restauration.');
// After V0.88
define("_AM_DOWNLOAD_LIST","T&#233;l&#233;charger la liste");
define("_AM_PURGE_FILES","Purge tous les fichiers de t&#233;l&#233;chargement.");
define("_AM_PURGED_ALLFILES","T&#233;l&#233;charger tous les fichiers qui sont purg&#233;s.");
define("_AM_READY_TO_DOWNLOAD","Pr&ecirc;t &#224; t&#233;l&#233;charger.");
// After V0.90
define("_AM_IFNOTRELOAD","Si le t&#233;l&#233;chargement ne d&#233;marre pas automatiquement, veuillez cliquer <a href='%s'>ici</a>");
// After V0.97
define('_AM_REPLACEURL','Remplacer le lien (sans http://)');
define('_AM_REPLACEURL_DESC',"Renseigner le lien. Remplacer par '.XOOPS_URL.'");
// After V1.01
define('_AM_VERIF_SUR', '&Ecirc;tes-vous s&ucirc;r de vouloir continuer ?');
define('_AM_PRECISION', 'Suivant la taille de votre base de donn&eacute;es, <br />un d&eacute;lai plus ou moins long sera n&eacute;cessaire');
define('_AM_PASOK_PASTABLE', 'Aucune table pr&eacute;sente dans la BDD');
define('_AM_PROCESS_EFFECTUE', 'Processus effectu&eacute; :');
define('_AM_LOCK_BDD', 'Verrouillage des tables de la BDD');
define('_AM_TEMPS_ECOULE', 'Temps &eacute;coul&eacute;');
define('_AM_UNLOCK_BDD', 'D&eacute;verrouillage de la BDD');
define('_AM_TEMPS_TOT', 'Dur&eacute;e totale de l\'op&eacute;ration ');
// Add version 2
define('_AM_RESTORE_OK','Restauration complète');
define('_AM_RESTORE_MESS1','La restauration est terminée. Les erreurs ou messages rencontrés sont indiqués ci-dessous.');
define('_AM_NO_FILE','Fichier manquant: ');
define('_AM_TITLE_BCK','Backup des données MySQL');
define('_AM_TITLE_RESTORE', 'Restaurer les données MySQL');
define('_AM_SELECT_DATABASE','Sélectionnez la base de données à partir de laquelle effectuer la sauvegarde ');
define('_AM_MESS_ERROR_1','Augmenter upload_max_filesize dans le php.ini');
define('_AM_MESS_ERROR_2','Augmenter la valeur de  MAX_FILE_SIZE dans le formulaire');
define('_AM_MESS_ERROR_3','Une erreur s\'est produite lors de la tentative de réception du fichier. Veuillez réessayer.');
define('_AM_MESS_ERROR_4','Aucun fichier à télécharger.');
define('_AM_MESS_ERROR_5','Erreur inconnue - %s');
define('_AM_MESS_ERROR_6','Impossible de télécharger le fichier.');
define('_AM_MESS_ERROR_7','Vérifier les paramètres upload_max_filesize, post_max_size, memory_limit dans le php.ini');
define('_AM_NO_TABLE','Aucune table trouvée');