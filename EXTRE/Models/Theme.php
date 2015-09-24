<?php
/*********************************************************************************************
** SGGCMS - PHP CMS(Portal) Extern Theme                                                    **
** Your Site url                                                                            **
** Author: Your Name/Website Name                                                           **
** License : License                                                                        **
** Copyright SiteName © date                                                                **
*********************************************************************************************/

if (!defined("INDEX_CHECK")) {
 header('Location: Module/Error/CheckIndex');
}

require_once 'copyright.php';

class Themes {
  /**
   * [$Name Name of the theme | Nom du thème]
   * @var string
   */
  public $Name            = "";
  /**
   * [$Prefix Prefix of the theme | Prefix du thème]
   * @var string
   */
  public $Prefix          = "";
  /**
   * [$Suffix Suffix of the theme | Suffix du thème]
   * @var string
   */
  public $Suffix          = "";
  /**
   * [$Description description limit 200 char]
   * @var string
   */
  public $Description     = "";
  /**
   * [$Type Type : 0. Only Site. | 1. Only Administration. | 2. Site/Administration]
   * @var integer
   */
  public $Type            = 2;
  /**
   * [$Version Version of the theme | Version du thème]
   * @var string
   */
  public $Version         = "1.0.0";
  /**
   * [$Url http://www.name.ext/path_of_theme]
   * @var string
   */
  public $Url             = "http://www.name.ext/path_of_theme";
  /**
   * [$Author Name of creator | Nom des créateur]
   * @var [array]
   */
  public $Author          =  Array(1 => "name of creator 1", 2 => "name of creator 2");
  /**
   * [$AuthorUrl Url of creator | Url des créateur]
   * @var [array]
   */
  public $AuthorUrl       = 'AuthorUrl' => Array(1 => "url of creator 1", 2 => "url of creator 2");
  /**
   * [$Folder Name of the theme folder (not space) | Nom du dossier du thème (pas d'espace)]
   * @var string
   */
  private $Folder          = "Name_of_the_theme_folder"; //basename(dirname(__FILE__));


  function top() {
    global $SggCms, $Lang, $copyright;

    if (!empty($this->Prefix) {
      $Prefix = $this->Prefix . " - ";
    }
    if (!empty($this->Suffix) {
      $Suffix = " - " . $this->Suffix;
    }
    if (!empty($SggCms->SggCms['description'])) {
      $description = " - " . $SggCms->SggCms['description'];
    }

    echo "<!DOCTYPE html>\n"
    . "<html lang=\"{$Lang->settings['htmllang']}\">\n"
    . "  <head>\n"
    . "    <meta charset=\"utf-8\">\n"
    . "    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n"
    . "    <title>{$SggCms->SggCms['title']}{$description}</title>\n"
    . "    <meta name=\"keywords\" content=\"{$SggCms->SggCms['keyword']}\" />\n"
    . "    <meta name=\"Description\" content=\"{$SggCms->SggCms['description']}\" />\n"
    . "    <meta name=\"Robots\" content=\"all\" />\n"
    . "    <meta name=\"Revisit-After\" content=\"7 days\" />\n"
    . "    <meta name=\"Rating\" content=\"general\">\n"
    . "    <meta name=\"Distribution\" content=\"global\">\n"
    . "    <meta name=\"Category\" content=\"environment\">\n"
    . "    <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"images/favicon.ico\" />\n"
    . "    <link rel=\"icon\" type=\"image/x-icon\" href=\"images/favicon.ico\" />\n"
    . "    <link rel=\"stylesheet\" media=\"all\" type=\"text/css\" title=\"{$Prefix}{$this->Name}{$Suffix}\" href=\"{$SggCms->SggCms['url']}/Themes/{$this->Folder}/Css/Style.css\" />\n";
    $SggCms->ThemesStyleSheet(""); 
    $SggCms->ThemesJQ("StarOpole-GoToTop.js");
    echo "  </head>\n";
    
  }

  function footer() {
    global $SggCms, $Lang, $Timer;
    $Timer->stop();
    echo "    <footer>\n"
    . "      <div class=\"copyright\">{$SggCms->SggCms['tilte']} copyright &copy; " . date("Y") . " {$SggCms->SggCms['footer_message']}</div>\n"
    // Calcul le temp de generation de la page - Calculating the time for page generation
    . "      <center>{$Lang->GetTimer}{$Timer->getTime()} Sec</center>\n"
    . "    </footer>\n"
    . "  </body>\n"
    . "</html>";
  }

  function news($data) {
    # code...
  }

  // Block Center - Block du Centre
  function blockCenter($block) {
    # code...
  }

  // Block Low - Block du Bas
  function blockLow($block) {
    # code...
  }

  // Block Right - Block de Droite
  function blockRight($block) {
    # code...
  }

  // Block Left - Block de Gauche
  function blockLeft($block) {
    # code...
  }
}

class AdminThemes {
  
}
?>
