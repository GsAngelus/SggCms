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

// Class Timer | Temp de génération de la page - Temp Page generation
class Timer {
  public $startTime;
  public $stopTime;

  function start() {
    $this->startTime = microtime();
  }

  function stop() {
    $this->stopTime = microtime();
  }

  function getTime() {
    $numberTimer = new SggCms;
    list($uSecondeA, $SecondeA) = explode(' ',$this->startTime);
    list($uSecondeB, $SecondeB) = explode(' ',$this->stopTime);
    $total = ($SecondeA - $SecondeB) + ($uSecondeA - $uSecondeB);
    return number_format(abs($total), $numberTimer->SggCms['timer_number']);
  }
}
?>
