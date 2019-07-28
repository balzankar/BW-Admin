<?php
  $page_title = 'Upload';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php $media_files = find_all_desc('media');?>
<?php include_once('common/header.php'); ?>
      <!-- End Navbar -->
      <div class="content">
       <?php echo display_msg($msg); ?>
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">All Image Medias</h4>
                 <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="media_upload.php">Upload New Media</a>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive" >
                  <table class="table table-striped tablesorter" id="datatable">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th class="text-center">Photo</th>
                          <th>File Name</th>
                          <th class="text-center">Actions</th>
                        </tr>
                      </thead>
                        <tbody>
                        <?php foreach ($media_files as $media_file): ?>
                        <tr>
                         <td class="text-center"><?php echo count_id();?></td>
                          <td class="text-center">
                              <img style="height:100px;width:100px;" class="img" src="../uploads/images/<?php echo $media_file['file_name'];?>" class="img-thumbnail" />
                          </td>
                        <td>
                          <?php echo $media_file['file_name'];?><p class="text-info"><?php echo remove_junk(ucwords($media_file['file_type']))?></p>
                            <p>File Id : <?php echo remove_junk(ucwords($media_file['id']))?></p>
                        </td>
                        <td class="text-center">
                        <a href="delete_media.php?id=<?php echo (int)$media_file['id'];?>">
                            <button class="btn btn-icon btn-danger btn-round"><i class="fa fa-trash"></i></button>
                        </a>
                        </td>
                       </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>                
                </div>
            </div>             
          </div>  
         <?php include_once('profile.php');?>                 
        </div>
      </div>


<?php include_once('common/footer.php'); ?>
