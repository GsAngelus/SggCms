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

// Class SggCms | Config du site - Config site
class SggCms {
  /**
   * variable de connection.
   *
   * @var string
   */
  public $sggconnect;
  /**
   * variable du cms.
   *
   * @var string
   */
  public $sggcms;
  /**
   * Version du CMS
   * @var string
   */
  public $vserion = "1.0.0";

  /*function __construct($value='') {
    //$this->Version = $version;
  }*/

  // Function connect | Créer un pont de connection à la DB - Create a bridge connection to the DB
  function connect() {
    global $sggconnect;
    try {
      if (!empty($sggconnect['port'])) {
        $port = "port={$sggconnect['port']};";
      }
      $DB = new PDO("mysql:host={$sggconnect['host']};{$port}dbname={$sggconnect['database']}", "{$sggconnect['user']}", "{$sggconnect['password']}");
      $DB->exec("SET CHARACTER SET {$sggconnect['encoding']}");
      $DB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      return $DB;
    }
    catch (PDOException $e) {
      echo "The database is not available, please try again later. <br/> Error code: " . $e->getMessage() . "<br>"
      . "La base de donnéer n'est pas disponible, Merci de rééssayer plus tard.<br/>Code erreur: " . $e->getMessage() . "<br>"
      . "La base de datos no está disponible, por favor inténtelo de nuevo más tarde. <br/> Código de error: " . $e->getMessage();
    }
  }
  
  function SggCms() {
    global $sggconnect;
    
    $DB = $this->connect();

    $this->SggCms['prefix'] = $sggconnect['prefix'];
    try {
      $DBSelect = $DB->query("SELECT name, value FROM {$this->SggCms['prefix']}_config");
      while ($dataConf = $DBSelect->fetch(PDO::FETCH_OBJ)) $this->SggCms[$dataConf->name] = htmlentities($dataConf->value, ENT_NOQUOTES);
      unset($DBSelect, $dataConf);

      $this->SggCms['file'] = $_GET['Module'];

      if (!isset($this->SggCms['file'])) {
        $this->SggCms['file'] = $this->SggCms['index'];
      } 
    }
    catch (PDOException $e) {
      echo "La request a planter<br>Code erreur: " . $e->getMessage();
    }
    
    $this->SggCms['footer_message'] = html_entity_decode($this->SggCms['footer_message']);
  }

  // Function UserId | Générer une id d'utilisateur - Generate a user id
  function UserId($User, $Mail) {
    $srcIdUser = sha1(md5("{$User}|{$Mail}"));
    return $srcIdUser;
  }
  
  // Function RewriteMode
  function RewriteMode($shortenedUrl, $longUrl) {
    global $sggconfig;
    if ($sggconfig['SGGCMS_REWRITE'] == true) {
      $srcUrl = $shortenedUrl;
    }
    else {
      $srcUrl = $longUrl;
    }
    return $srcUrl;
  }

  function accessMod($accessName, $type=null) {
    global $DB;
    $DBSelect = $DB->query("SELECT level, admin, active FROM {$this->SggCms['prefix']}_modules WHERE name = '{$accessName}'");
    $data = $DBSelect->fetch(PDO::FETCH_OBJ);
    if ($type == "Active") {
      $vars = $data->active;
    }
    else if ($type == "Admin") {
      $vars = $data->admin;
    }   
    else {
      $vars = $data->level;
    }
    return $vars;
  }
  // Function BBCode
  function BBCode($textarea) {
    global $DB;
    /* Smileys */
    $DBSelect = $DB->query("SELECT code, url, name FROM {$this->SggCms['prefix']}_smilies ORDER BY id");
    while ($data = $DBSelect->fetch(PDO::FETCH_OBJ)) {
      $textarea = str_replace($code, "<img src=\"{$this->SggCms['url']}/Images/smileys/{$data->url}\" alt=\"{$data->code}\" title=\"{$data->name} [{$data->code}]\" />", $textarea);
    } 
    /* Mise en forme du texte */
    $textarea = preg_replace('`\[g\](.+)\[/g\]`isU', "<strong>$1</strong>", $textarea);
    $textarea = preg_replace('`\[b\](.+)\[/b\]`isU', "<strong>$1</strong>", $textarea);
    $textarea = preg_replace('`\[i\](.+)\[/i\]`isU', "<em>$1</em>", $textarea);
    $textarea = preg_replace('`\[s\](.+)\[/s\]`isU', "<u>$1</u>", $textarea);
    $textarea = preg_replace('`\[u\](.+)\[/u\]`isU', "<u>$1</u>", $textarea);
    $textarea = preg_replace('`\[li\](.+)\[/li\]`isU', "<li>$1</li>", $textarea);
    $textarea = preg_replace('`\[ul\](.+)\[/ul\]`isU', "<ul>$1</ul>", $textarea);
    $textarea = preg_replace('`\[ol\](.+)\[/ol\]`isU', "<ol>$1</ol>", $textarea);
    $textarea = preg_replace('`\[left\](.+)\[/left\]`isU', "<div style=\"text-align: left\">$1</div>", $textarea);
    $textarea = preg_replace('`\[center\](.+)\[/center\]`isU', "<div style=\"text-align: center\">$1</div>", $textarea);
    $textarea = preg_replace('`\[right\](.+)\[/right\]`isU', "<div style=\"text-align: right\">$1</div>", $textarea);
    $textarea = preg_replace('`\[url\](.+)\[/url\]`isU', "<a href=\"$1\">$1</a>", $textarea);
    $textarea = preg_replace('`\[url\=(.*?)\](.*?)\[/url\]`', "<a href=\"$1\">$2</a>", $textarea);
    $textarea = preg_replace('`\[email\](.+)\[/email\]`isU', "<a href=\"mailto:$1\">$1</a>", $textarea);
    $textarea = preg_replace('`\[email=(.*?)\](.+)\[/email\]`isU', "<a href=\"mailto:$1\">$2</a>", $textarea);
    $textarea = preg_replace('`\[img\](.+)\[/img\]`isU', "<img src=\"$1\" border=\"0\" />", $textarea);
    $textarea = preg_replace('`\[img=(.*?)x(.*?)\](.+)\[/img\]`isU', "<img height=\"$1\" width=\"$2\" src=\"$3\" border=\"0\" />", $textarea);
    $textarea = preg_replace('`\[aimg\](.+)\[/aimg\]`isU', "<a href=\"$1\" title=\"Zoom\" onclick=\"return hs.expand(this)\"><img style=\"border: 0; overflow: auto; width: 100px; height: 100px;\" src=\"$1\" alt=\"\" /></a>", $textarea);
    $textarea = preg_replace('`\[size=(.*?)\](.+)\[/size\]`', "<span style=\"font-size: $1;\">$2</span>", $textarea);
    $textarea = preg_replace('`\[color=(.*?)\](.+)\[/color\]`', "<span style=\"color: $1;\">$2</span>", $textarea);
    $textarea = preg_replace('`\[font=(.*?)\](.+)\[/font\]`', "<span style=\"font-family: $1;\">$2</span>", $textarea);
    $textarea = preg_replace('`\[quote=(.*?)\](.+)\[/quote\]`', "<div class=\"quote\"><quote><b>" . _ . " $1: </b><br />$2</quote></div>", $textarea);/* citation de */
    $textarea = preg_replace('`\[flash\](.+)\[\/flash\]`',"<object type=\"application/x-shockwave-flash\" data=\"$1\">\n<param name=\"movie\" value=\"$1\">\n<param name=\"pluginurl\" value=\"http://www.macromedia.com/go/getflashplayer\">\n</object>\n", $textarea);
    $textarea = preg_replace('`\[flash=(.*?)x(.*?)\](.+)\[\/flash\]`','<object type="application/x-shockwave-flash" data="$3" height="$1" width="$2">\n<param name="movie" value="$3">\n<param name="pluginurl" value="http://www.macromedia.com/go/getflashplayer">\n</object>\n', $textarea);
    $textarea = preg_replace('`\[youtube\](.+)\[\/youtube\]`','<object width="640" height="360"><param name="movie" value="https://www.youtube.com/v/$1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="https://www.youtube.com/v/$1" type="application/x-shockwave-flash" width="640" height="360" allowscriptaccess="always" allowfullscreen="true"></embed></object>\n', $textarea);
    $textarea = preg_replace('`\[youtube=(.*?)x(.*?)\](.+)\[\/youtube\]`','<object width="$1" height="$2"><param name="movie" value="https://www.youtube.com/v/$3"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="https://www.youtube.com/v/$3" type="application/x-shockwave-flash" width="$1" height="$2" allowscriptaccess="always" allowfullscreen="true"></embed></object>\n', $textarea);
    $textarea = preg_replace('`\[dailymotion\](.+)\[\/dailymotion\]`', '<object width="480" height="270"><param name="movie" value="http://www.dailymotion.com/swf/video/$1"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><param name="wmode" value="transparent"></param><embed type="application/x-shockwave-flash" src="http://www.dailymotion.com/swf/video/$1" width="480" height="270" wmode="transparent" allowfullscreen="true" allowscriptaccess="always"></embed></object>\n', $textarea);
    $textarea = preg_replace('`\[dailymotion=(.*?)x(.*?)\](.+)\[\/dailymotion\]`', '<object width="$1" height="$2"><param name="movie" value="http://www.dailymotion.com/swf/video/$3"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><param name="wmode" value="transparent"></param><embed type="application/x-shockwave-flash" src="http://www.dailymotion.com/swf/video/$3" width="$1" height="$2" wmode="transparent" allowfullscreen="true" allowscriptaccess="always"></embed></object>\n', $textarea);


    $textarea = str_replace("[code]", "<div class=\"quote\"><code><b>Code :</b><br>", $textarea);
    $textarea = str_replace("[/code]", "</code></div>", $textarea);
    $textarea = str_replace("[/quote]", "</quote></div>", $textarea);
    $textarea = str_replace("[quote]", "<div class=\"quote\"><quote><b>" . _ . ": </b><br />", $textarea);/* citation */
    $textarea = str_replace("[strike]", "<span style=\"text-decoration: line-through;\">", $textarea);
    $textarea = str_replace("[/strike]", "</span>", $textarea);
    $textarea = str_replace("[blink]", "<span style=\"text-decoration: blink;\">", $textarea);
    $textarea = str_replace("[/blink]", "</span>", $textarea);
    /* Mise en couleur du texte */
    $textarea = str_replace("<font color=\"red\">", "<font color=\"#FF0000\">", $textarea);
    $textarea = str_replace("<font color=\"darkred\">", "<font color=\"#8B0000\">", $textarea);
    $textarea = str_replace("<font color=\"blue\">", "<font color=\"#0000FF\">", $textarea);
    $textarea = str_replace("<font color=\"darkblue\">", "<font color=\"#00008B\">", $textarea);
    $textarea = str_replace("<font color=\"orange\">", "<font color=\"#FFA500\">", $textarea);
    $textarea = str_replace("<font color=\"or\">", "<font color=\"#BE9C19\">", $textarea);
    $textarea = str_replace("<font color=\"brown\">", "<font color=\"#A52A2A\">", $textarea);
    $textarea = str_replace("<font color=\"yellow\">", "<font color=\"#FFFF00\">", $textarea);
    $textarea = str_replace("<font color=\"green\">", "<font color=\"#008000\">", $textarea);
    $textarea = str_replace("<font color=\"violet\">", "<font color=\"#EE82EE\">", $textarea);
    $textarea = str_replace("<font color=\"olive\">", "<font color=\"#808000\">", $textarea);
    $textarea = str_replace("<font color=\"cyan\">", "<font color=\"#00FFFF\">", $textarea);
    $textarea = str_replace("<font color=\"indigo\">", "<font color=\"#4B0082\">", $textarea);
    $textarea = str_replace("<font color=\"white\">", "<font color=\"#FFFFFF\">", $textarea);
    $textarea = str_replace("<font color=\"black\">", "<font color=\"#000000\">", $textarea);
    $textarea = str_replace("[hr]", "<hr width=\"100%\" size=\"1\" />", $textarea);
    $textarea = str_replace("[br]", "<br>", $textarea);
    /* On retourne la variable texte */
    return $textarea;
  }

  // Function button | Créer un bouton styler et unique - Create your button style unique
  function Button($varHref, $varText, $varClass="") {
    if (!empty($varClass)) {
      $class = " class=\"{$varClass}\"";
    }
    $ButtonA = "<a href=\"{$varHref}\"{$class}>{$varText}</a>";
    return $ButtonA;
  }
  
  // Function Qr Code generate
  function QrCodeGenerate($Url, $Dims='150', $QrLevel='H', $Margin='0') {
    global $Lang;
    $Url = urlencode($Url);
    $QrGenerate = "<img src=\"http://chart.apis.google.com/chart?cht=qr&chs={$Dims}x{$Dims}&choe=UTF-8&chld={$QrLevel}|{$Margin}&chl={$Url}\" title=\"{$Lang->QrApis}\" />";
    return $QrGenerate;
  }

  // Function Themes Link
  function ThemesStyleSheet($AddLink="") {
    print("    <!--******************************************************************************************-->\n"
    . "    <!--** SGGCMS - PHP CMS(Portal)                                                                 **-->\n"
    . "    <!--** http://www.SggCMS.Stargate-Galactique.com                                                **-->\n"
    . "    <!--** Author: Stargate-Galactique-Dev-Corporation                                              **-->\n"
    . "    <!--** License : LICENSE_FR.md | LICENSE_EN.md                                                  **-->\n"
    . "    <!--** Copyright SGGDC © 2000 - Open Source Solutions - Any reproduction without permission     **-->\n"
    . "    <!--**********************************************************************************************-->\n");
    echo "    <link href=\"{$this->SggCms['url']}/Css/General.css\" rel=\"stylesheet\" title=\"General\" type=\"text/css\" media=\"screen\" />\n" # Style du site en General
    . "    <link href=\"{$this->SggCms['url']}/Css/Button.css\" rel=\"stylesheet\" title=\"Button\" type=\"text/css\" media=\"screen\" />\n" # Style des Button du site
    . "    <link href=\"{$this->SggCms['url']}/Css/jQuery.QapTcha.css\" rel=\"stylesheet\" title=\"QapTcha\" type=\"text/css\" media=\"screen\" />\n"; # Style du QapTcha
    if (!empty($AddLink)) {
      $AddLink1 = explode('|', $AddLink);
      foreach($AddLink1 as $mapping) {
        echo "    <link href=\"{$this->SggCms['url']}/Css/{$mapping}\" rel=\"stylesheet\" type=\"text/css\"/>\n";
        $i++;
      }
    }
  }

  function ThemesjQ($AddLink="") {
    /* A voir JQuery */
    echo "    <script type=\"text/javascript\" src=\"{$this->SggCms['url']}/Js/jquery.js\"></script>\n"
    . "    <script type=\"text/javascript\" src=\"{$this->SggCms['url']}/Js/jquery.ui.js\"></script>\n"
    . "    <script type=\"text/javascript\" src=\"{$this->SggCms['url']}/Js/jquery.ui.touch.js\"></script>\n"
    . "    <script type=\"text/javascript\" src=\"{$this->SggCms['url']}/Js/jquery-1.5.1.min.js\"></script>\n"
    /* QapTcha */
    . "    <script type=\"text/javascript\" src=\"{$this->SggCms['url']}/Js/jquery.ui.touch.js\"></script>\n"
    . "    <script type=\"text/javascript\" src=\"{$this->SggCms['url']}/Js/jquery.QapTcha.js\"></script>\n"
    . "    <script type=\"text/javascript\" src=\"{$this->SggCms['url']}/Js/jquery.min.QapTcha.js\"></script>\n"
    /* JavaScript *//* Highslide */
    . "    <script type=\"text/javascript\" src=\"{$this->SggCms['url']}/Js/highslide/highslide-with-html.js\"></script>\n";
    if (!empty($AddLink)) {
      $AddLink1 = explode('|', $AddLink);
      foreach($AddLink1 as $mapping) {
        echo "    <script type=\"text/javascript\" src=\"{$this->SggCms['url']}/Js/" . $mapping . "\"></script>\n";
        $i++;
      }
    }
  }
  // Function Themes Link fin
}

?>
