<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
 $works = find_by_id('works',(int)$_GET['id']);
  if(!$works){
    $session->msg("d","Missing Work id.");
    redirect('works.php');
  }
?>
<?php
  $delete_id = delete_by_id('works',(int)$works['id']);
  if($delete_id){
      $session->msg("s","Work deleted.");
      redirect('works.php');
  } else {
      $session->msg("d","Work deletion failed.");
      redirect('works.php');
  }
?>
