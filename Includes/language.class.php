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

// Class SggLanguage - Lang du site - Lang Site
class SggLanguage { 
  /**
   * Le chemin d'accès au dossier langues.
   *
   * @var string
   */
  public $path;
  /**
   * La langue que nous utilisons.
   *
   * @var string
   */
  public $Language;
  /**
   * Informations sur le langage courant.
   *
   * @var array
   */
  public $settings;

  /**
   * Définissez le chemin pour le dossier de la langue.
   *
   * @param string Le chemin d'accès au dossier de la langue.
   */
  function setPath($path) {
    $this->path = $path;
  }

  /**
   * Vérifier si une langue spécifique existe.
   *
   * @param string La langue à rechercher.
   * @return boolean True quand il existe, false quand n'existe pas.
   */
  function languageExists($Language) {
    $Language = preg_replace("#[^a-z0-9\-_]#i", "", $Language);
    if(file_exists("{$this->path}/{$Language}.php")) {
      return true;
    }
    else {
      return false;
    }
  }

  /**
   * Définir la langue pour une zone.
   *
   * @param string La langue à utiliser.
   */
  function setLanguage($Language) {
    $SggCms = new SggCms;

    $Language = preg_replace("#[^a-z0-9\-_]#i", "", $Language);

    // Vérifiez si la langue existe.
    if(!$this->languageExists($Language)) {
      die("Language {$Language} ($this->path/$Language) is not installed");
    }

    $this->language = $Language;
    require "{$this->path}/{$Language}.php";
    $this->settings = $LangInfo;
  }


  /**
   * Load the language variables for a section.
   *
   * @param string The section name.
   * @param boolean Is this a datahandler?
   * @param boolean supress the error if the file doesn't exist?
   */
  function load($section, $supressError=false) {
    // Assign language variables.
    // Datahandlers are never in admin lang directory.
    $LanguagesFile = "{$this->path}/{$this->language}/{$section}.lang.php";
    
    if(file_exists($LanguagesFile)) {
      require_once $LanguagesFile;
    }
    elseif(file_exists("{$this->path}/english/{$section}.lang.php")) {
      require_once "{$this->path}/english/{$section}.lang.php";
    }
    else {
      if($supressError != true) {
        die("{$LanguagesFile} does not exist");
      }
    }
    
    // We must unite and protect our language variables!
    $LangKeysIgnore = array('language', 'path', 'settings');
    
    if(is_array($Languages)) {
      foreach($Languages as $key => $val) {
        if((empty($this->$key) || $this->$key != $val) && !in_array($key, $LangKeysIgnore)) {
          $this->$key = $val;
        }
      }
    }
  }
}
?>
