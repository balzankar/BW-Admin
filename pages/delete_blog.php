<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
 $blog = find_by_id('blog',(int)$_GET['id']);
  if(!$blog){
    $session->msg("d","Missing Project id.");
    redirect('blog.php');
  }
?>
<?php
  $delete_id = delete_by_id('blog',(int)$blog['id']);
  if($delete_id){
      $session->msg("s","Blog deleted.");
      redirect('blog.php');
  } else {
      $session->msg("d","Blog deletion failed.");
      redirect('blog.php');
  }
?>
