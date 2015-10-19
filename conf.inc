<?php
/**
 * SGGCMS - PHP CMS(Portal)
 *
 * EN : CMS OS (A PHP Content Management System - Open Source) 
 * 
 * FR : CMS OS (Système de gestion de contenu PHP - Open Source)
 * 
 * @author      &lt;Stargate-Galactique-Dev-Corporation&gt; <contact@Stargate-Galactique.com>
 * @version     1.0.0
 * @copyright   Copyright &lt;Stargate-Galactique-Dev-Corporation&gt; © 2000-2015
 * @package     SGGCMS
 * @subpackage  Core
 * @license     http://creativecommons.org/licenses/by-nc-sa/4.0/ Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
 * @link        http://dev.Stargate-Galactique.com
 */

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
  /**
   *---------------------------------------------------------------
   * INSTALLED
   *---------------------------------------------------------------
   * 
   * autoload install.php
   */
  'SGGCMS_INSTALLED' => false,
  /**
   *---------------------------------------------------------------
   * REWRITE
   *---------------------------------------------------------------
   * 
   * Url Rewrite exemple: http://www.Site_Url.com/index.php?Modules=News and http://www.Site_Url.com/News (.html)
   */
  'SGGCMS_REWRITE'   => false,
  /*
   *---------------------------------------------------------------
   * ENVIRONMENT
   *---------------------------------------------------------------
   *
   * You can load different configurations depending on your
   * current environment. Setting the environment also influences
   * things like logging and error reporting.
   *
   * false = production    true = development
   *
   * NOTE: If you change these, also change the error_reporting() code below
   *
   */
  'SGGCMS_DEV_ENVIRONMENT' => false,
  'SGGCMS_OPEN'      => true,
  );
?>
