<?php
  ob_start();
  $page_title = 'Bal World Admin';
  require_once('pages/includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('logout.php', false);}
?>
<center><h1>Access Denied</h1></center>