<?php
  $page_title = 'Upload';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php $media_files = find_all('media');?>

                        <?php foreach ($media_files as $media_file): ?>

                        <option value="<?php echo remove_junk(ucwords($media_file['id']))?>" data-img-src="../uploads/images/<?php echo $media_file['file_name'];?>">
                           <p class="text-info"><?php echo remove_junk(ucwords($media_file['file_name']))?></p>
                            <p>File Id : <?php echo remove_junk(ucwords($media_file['id']))?></p>
                        </option>

                      <?php endforeach;?>