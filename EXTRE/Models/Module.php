<?php
/*********************************************************************************************
** SGGCMS - PHP CMS(Portal) Extern Module                                                   **
** Your Site url                                                                            **
** Author: Your Name/Website Name                                                           **
** License : License                                                                        **
** Copyright SiteName © date                                                                **
*********************************************************************************************/

if (!defined("INDEX_CHECK")) {
 header('Location: Module/Error/CheckIndex');
}

if (!$user) {
  $visitor = 0;
} 
else {
  $visitor = $user->level;
} 

$moduleName       = basename(dirname(__FILE__));
$strModuleName    = strtolower("{$moduleName}");

// loading lang for the page
// chargement de la lang pour la page 
$Lang->load("{$strModuleName}");

if($visitor >= $SggCms->accessMod($moduleName) && $SggCms->accessMod($moduleName, 'Active') > 0) {
 switch ($_GET['Action']) {
   case 'value':
     # code...
     break;
   case 'value':
     # code...
     break;
     
   default:
     # code...
     break;
 }
}
else if ($SggCms->accessMod($moduleName, 'Active') == 0) {
  echo $Lang->erreurModule;
}
else if ($SggCms->accessMod($moduleName) == 1 && $visitor == 0) {
  echo $Lang->erreurModuleUser;
} 
else {
  echo $Lang->erreurModuleUserLevel;
}
?>
