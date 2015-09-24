<?php
/*********************************************************************************************
** SGGCMS - PHP CMS(Portal)                                                                 **
** http://www.SggCMS.Stargate-Galactique.com                                                **
** Author: Stargate-Galactique-Dev-Corporation                                              **
** License : http://creativecommons.org/licenses/by-nc-sa/4.0/                              **
** Copyright SGGDC © 2000 - Open Source Solutions - Any reproduction without permission     **
*********************************************************************************************/
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if (!defined("INDEX_CHECK")) {
 header('Location: Module/Error/CheckIndex');
}

/* Config de connection */
$sggconnect = array(
  'host' => "localhost",            //SQL server IP
  'port' => "3306",                 //SQL server port
  'user' => "root",                 //SQL server login
  'password' => "",                 //SQL server password
  'database' => "Project_SggCms",   //DB name
  'prefix'   => "SggCMS",           //Table prefix exemple: _news_cat and SggCMS_news_cat
  'encoding' => "utf8"              //SQL connection encoding
  );

/* Config du site <true = on | false = off> */
$sggconfig = array(
  'SGGCMS_INSTALLED' => false,     // autoload install.php
  'SGGCMS_REWRITE'   => false,      // Url Rewrite exemple: http://www.Site_Url.com/index.php?Modules=News and http://www.Site_Url.com/News (.html)
  'SGGCMS_OPEN'      => true,
  );
?>
