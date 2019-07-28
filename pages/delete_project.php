<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1); 
?>
<?php
 $project = find_by_id('projects',(int)$_GET['id']);
  if(!$project){
    $session->msg("d","Missing Project id.");
    redirect('projects.php');
  }
?>
<?php
  $delete_id = delete_by_id('projects',(int)$project['id']);
  if($delete_id){
      $session->msg("s","Project deleted.");
      redirect('projects.php');
  } else {
      $session->msg("d","Project deletion failed.");
      redirect('projects.php');
  }
?>
