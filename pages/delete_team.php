<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
 $teams = find_by_id('teams',(int)$_GET['id']);
  if(!$teams){
    $session->msg("d","Missing Team id.");
    redirect('teams.php');
  }
?>
<?php
  $delete_id = delete_by_id('teams',(int)$teams['id']);
  if($delete_id){
      $session->msg("s","Team deleted.");
      redirect('teams.php');
  } else {
      $session->msg("d","Team deletion failed.");
      redirect('teams.php');
  }
?>
