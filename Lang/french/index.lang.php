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

$Languages = array(
  'WelcomeGuest' => "Bienvenue, Visiteur !",
  'Welcome' => "Bienvenue, ",
  'Admin' => "Administration",
  'Logout' => "Déconnexion",
  'Login' => "Connection",
  'Register' => "S'enregistrer",
  'Return' => "Retour",
  'ReturnIndex' => "Retour à l'index",
  'GetTimer' => "Page générée en ",
  'QrApis' => "Qr code Propulse par Google",
  /* Lang erreur */
  'error_404' => "La page demandée n'existe pas ou n'existe plus...<br />Si le problème persiste, veuillez contacter l'administrateur du site via <a href=\"index.php?Module=Contact\">le formulaire de contact</a>",
  /* Lang plugins jQuery */
  'jQueryQaptchaLock' => "Verrouiller : Le formulaire ne peut pas être soumis",
  'jQueryQaptchaUnlocked' => "Déverrouiller : Le formulaire peut être soumis"
);
?>
