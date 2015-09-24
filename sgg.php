<?php
/*********************************************************************************************
** SGGCMS - PHP CMS(Portal)                                                                 **
** http://www.SggCMS.Stargate-Galactique.com                                                **
** Author: Stargate-Galactique-Dev-Corporation                                              **
** License : http://creativecommons.org/licenses/by-nc-sa/4.0/                              **
** Copyright SGGDC © 2000 - Open Source Solutions - Any reproduction without permission     **
*********************************************************************************************/

if (!defined("INDEX_CHECK")) {
 header('Location: Module/Error/CheckIndex');
}

$dir = "./includes/";

// Ouvre un dossier bien connu, et liste tous les fichiers
if (is_dir($dir)) {
  if ($dh = opendir($dir)) {
    while (($file = readdir($dh)) !== false) {
      $ext = explode('.', $file);
      $ext = $ext[count($ext) - 2];
      if (strtolower($ext) == "class") { 
        include "./Includes/$file";
      }
    }
    closedir($dh);
  }
}

// Calcul le temp de generation de la page - Calculating the time for page generation
$Timer = new Timer;

// Config du site et connection a la database - Site Setup and connection to the database
$SggCms = new SggCms;
$DB = $SggCms->connect();

// Langue du site plus vérifier si une langue spécifique existe - Language of the site over whether there is a specific language
$Lang = new SggLanguage;
$Lang->setPath("Lang");
$Lang->setLanguage($SggCms->SggCms['language']);
// chargement de la lang - loading lang
$Lang->load("index");
$Lang->load("error");
//$Lang->languageExists($SggCms->SggCms['language']);

//
$Session = new SggSession;

//
if (condition) {
  # code...
} else {
  # code...
}
include_once 'Themes/' . $SggCms->SggCms['theme'] . '/theme.php';
$Themes = new Themes;
$AdminThemes = new AdminThemes;

?>
