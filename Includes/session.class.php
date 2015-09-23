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

class SggSession {


  function __construct() {
    echo $this->start();
  }

  function start()
  {
    session_start();
  }
  // remove all session variables
  /*function Unset()
  {
    session_unset(); 
  }*/
  // destroy the session 
  function destroy()
  {
    session_destroy();
  }
  
}
?>
