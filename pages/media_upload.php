<?php
  $page_title = 'Upload';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php $media_files = find_all('media');?>
<?php
  if(isset($_POST['submit'])) {
  $photo = new Media();
  $photo->upload($_FILES['file_upload']);
    if($photo->process_media()){
        $session->msg('s','photo uploaded.');
        redirect('media.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('media.php');
    }

  }

?>
<?php include_once('common/header.php'); ?>
      <!-- End Navbar -->
      <div class="content">
       <?php echo display_msg($msg); ?>
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">Image Upload</h4>
                 <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="media.php">Cancel</a>
                  </div>
                </div>
                <h5 class="card-title">Please Upload Image of Resolution 500x500</h5>
              </div>
              <div class="card-body table-responsive" >
                  <table class="table table-striped tablesorter" id="datatables">
                        <tbody>
                        <form class="form pull-right" action="media_upload.php" method="POST" enctype="multipart/form-data">                 
                                <tr><td style="padding:50px;width:60%;"><input class="imageupload" type="file" name="file_upload" multiple="multiple"></td></tr>
                                <tr><td><button type="submit" name="submit" class="btn btn-default">Upload</button></td></tr>
                         </form>
                    </tbody>
                  </table>                
                </div>
            </div>             
          </div>  
         <?php include_once('profile.php');?>                 
        </div>
      </div>


<?php include_once('common/footer.php'); ?>
