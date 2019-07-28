<?php 
$page_title='Profile';
include_once('includes/load.php');  
page_require_level(3);
$all_users = find_all_user();
?>
<?php include_once('common/header.php'); ?>
      <!-- End Navbar -->
      <div class="content">
       <?php echo display_msg($msg); ?>
        <div class="row">
            <?php include_once('profile.php');?>                 
        </div>
      </div>
<?php include_once('common/footer.php'); ?>