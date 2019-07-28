<?php 
$page_title='Edit Work';
require_once('includes/load.php');
$all_works = find_all('works');
$all_photo = find_all('media');
$all_categories = find_all('categories');
page_require_level(2);

$works = find_by_id('works',(int)$_GET['id']);
if(!$works){
  $session->msg("d","Missing Work id.");
  redirect('works.php');
}

?>
<?php
 if(isset($_POST['work-edit'])){
   $req_fields = array('work-title','work-post','work-url','work-dev','work-status','work-button','work-display' );
   validate_fields($req_fields);
   if(empty($errors)){
     $b_title  = remove_junk($db->escape($_POST['work-title']));
     $b_post   = remove_junk($db->escape($_POST['work-post']));
     $b_dev   = remove_junk($db->escape($_POST['work-dev']));
     $b_status   = remove_junk($db->escape($_POST['work-status']));
     $b_author = remove_junk($db->escape($_POST['work-author']));
     $b_cat = remove_junk($db->escape($_POST['work-category']));
     $b_display = remove_junk($db->escape($_POST['work-display']));
     $b_url = remove_junk($db->escape($_POST['work-url']));
     $b_btn = remove_junk($db->escape($_POST['work-button']));
       
     if (is_null($_POST['work-photo']) || $_POST['work-photo'] === "") {
      $b_image = '0';
     } else {
      $b_image = remove_junk($db->escape($_POST['work-photo']));
     }
       
     $query   = "UPDATE works SET";     
     $query .=" title='{$b_title}', post='{$b_post}',developer='{$b_dev}',status='{$b_status}', author='{$b_author}', image_id='{$b_image}', category='{$b_cat}', url='{$b_url}', button='{$b_btn}' ";
     $query .=" , display_category ='{$b_display}' ";
     $query  .=" WHERE id ='{$works['id']}' ";
     $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Work updated ");
                 redirect('works.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('works_edit.php?id='.$works['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('works_edit.php?id='.$works['id'], false);
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
                <h4 class="card-title d-inline">Edit Work : <?php echo $works['title'];?></h4>
                 <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="works.php">Cancel</a>
                    <a class="dropdown-item" href="delete_work.php?id=<?php echo (int)$works['id'] ?>">Delete</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form autocomplete="off" method="post" action="works_edit.php?id=<?php echo (int)$works['id'] ?>">
                  <div class="row">
                    <div class="col-md-3 pr-md-1">
                      <div class="form-group">
                        <label>Author</label>
                        <input type="text" readonly class="form-control" name="work-author" placeholder="Author Name" value="<?php echo $works['author'];?>">
                      </div>
                    </div>
                      <div class="col-md-3 pr-md-1">
                      <div class="form-group">
                        <label>Developer</label>
                        <input type="text" class="form-control" name="work-dev" placeholder="Developer Name" value="<?php echo $works['developer'];?>">
                      </div>
                    </div>
                      <div class="col-md-4 pr-md-1">
                      <div class="form-group">
                        <label>Work Status</label>
                          <select class="form-control" name="work-status">
                          <option class="text-info" value="<?php echo $works['status'];?>"><?php echo $works['status'];?> (Active)</option>
                          <option value="Brainstorming">Brainstorming</option>
                          <option value="In-Development">In-Development</option>
                          <option value="Testing">Testing</option>
                          <option value="Completed">Completed</option>
                          <option value="Live/Released">Live/Released</option>
                          </select>
                       </div>
                    </div>
                  </div> 
                  <div class="row">
                    <div class="col-md-4 pr-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Display Category</label>
                            <select type="text" class="form-control" name="work-display">
                                <option value="<?php echo $works['display_category'];?>">Select Category</option>
                                <option value="Web">Web Services</option>
                                <option value="Motion">Motion Works</option>
                                <option value="Graphics">Graphics/Branding/Logo</option>
                            </select>
                       </div>
                    </div>
                    <div class="col-md-4 pr-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                            <select type="text" class="form-control" name="work-category">
                              <option class="text-info" value="<?php echo $works['category'];?>"><?php echo $works['category'];?> (Active)</option>
                            <?php  foreach ($all_categories as $cat): ?>
                              <option value="<?php echo $cat['name'] ?>">
                                <?php echo $cat['name'] ?></option>
                            <?php endforeach; ?>
                            </select>
                       </div>
                    </div>
                   <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <select class="form-control" name="work-photo">
                          <option class="text-info" value="<?php echo $works['image_id'] ?>">No Change</option>
                        <?php  foreach ($all_photo as $photo): ?>
                          <option value="<?php echo (int)$photo['id'] ?>">ID : <?php echo $photo['id'] ?> | <?php echo $photo['file_name'] ?></option>
                        <?php endforeach; ?>
                        </select>
                     </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Blog Title</label>
                        <input type="text" name="work-title" class="form-control" placeholder="Work Title" value="<?php echo $works['title'];?>" >
                      </div>
                    </div>
                  </div>
                 <div class="row">
                    <div class="col-md-8 pr-md-1">
                      <div class="form-group">
                        <label>Url</label>
                        <input type="text" name="work-url" class="form-control" placeholder="points to the hosted version of Work" value="<?php echo $works['url'];?>" >
                      </div>
                    </div>
                     <div class="col-md-4">
                      <div class="form-group">
                        <label>Button Name</label>
                      <select name="work-button" class="form-control">
                          <option class="text-info" value="<?php echo $works['button'];?>">Current Button</option>
                          <option value="More Details">More Details</option>
                          <option value="Download">Download</option>
                          <option value="View">View</option>
                          <option value="View on Youtube">View on Youtube</option>
                          <option value="View on Github">View on Github</option>
                          <option value="View on Behance">View on Behance</option>
                          <option value="Visit Website">Visit Website</option>
                          <option value="Visit Offical Website">Visit Offical Website</option>
                      </select>   
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Description</label>
                          <textarea name="work-post" class="form-control"><?php echo $works['post'];?></textarea>
                      </div>
                    </div>
                  </div>
                 <button type="submit" name="work-edit" class="btn btn-fill btn-primary">Publish</button>
                </form>
              </div>
            </div>
          </div>
         <?php include_once('profile.php');?>                 
        </div>
      </div>
<?php include_once('common/footer.php'); ?>