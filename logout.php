<?php
  require_once('pages/includes/load.php');
  if(!$session->logout()) {redirect("../index.php");}
?>
