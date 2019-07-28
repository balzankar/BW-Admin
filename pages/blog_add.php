<?php 
$page_title='Add Blogs';
require_once('includes/load.php');
$all_users = find_all_user();
$all_photo = find_all_desc('media');
page_require_level(2);
?>
<?php
 if(isset($_POST['blog-add'])){
   $req_fields = array('blog-title','blog-post' );
   validate_fields($req_fields);
   if(empty($errors)){
     $b_title  = remove_junk($db->escape($_POST['blog-title']));
     $b_post   = $db->escape($_POST['blog-post']);
     $b_details   = $db->escape($_POST['blog-details']);
     $b_author = remove_junk($db->escape($_POST['blog-author']));
     $b_cat = remove_junk($db->escape($_POST['blog-category']));
       
     if (is_null($_POST['blog-photo']) || $_POST['blog-photo'] === "") {
       $b_image = '0';
     } else {
       $b_image = remove_junk($db->escape($_POST['blog-photo']));
     }
       
     $query  = "INSERT INTO blog (";
     $query .=" title,post,author,image_id,category,post_details";
     $query .=") VALUES (";
     $query .=" '{$b_title}', '{$b_post}', '{$b_author}', '{$b_image}','{$b_cat}','{$b_details}' ";
     $query .=")";
       
     $query .=" ON DUPLICATE KEY UPDATE title='{$b_title}'";
       
     if($db->query($query)){
       $session->msg('s',"New Blog added ");
       redirect('blog.php', false);
     } else {
       $session->msg('d',' Sorry failed to add!');
       redirect('blog.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('blog_add.php',false);
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
                <h4 class="card-title d-inline">Add New Blog</h4>
                  <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="blog.php">Cancel</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form autocomplete="off" method="post" action="blog_add.php">
                  <div class="row">
                    <div class="col-md-5 pr-md-1">
                      <div class="form-group">
                        <label>Author</label>
                        <input type="text" class="form-control" name="blog-author" placeholder="Author Name" value="<?php echo $user['name'];?>">
                      </div>
                    </div>
                    <div class="col-md-2 pl-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Blog Category</label>
                        <select class="form-control" name="blog-category">
                          <option value="Not Specifed">Select Category</option>
                          <option value="Page">Page</option>
                          <option value="Blog">Blog</option>
                          <option value="News">News</option>
                          <option value="Projects">Projects</option>
                        </select>
                     </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Blog Image</label>
                        <select class="form-control" name="blog-photo">
                          <option value="">Select Image</option>
                        <?php  foreach ($all_photo as $photo): ?>
                          <option value="<?php echo (int)$photo['id'] ?>">
                            <?php echo $photo['file_name'] ?></option>
                        <?php endforeach; ?>
                        </select>
                     </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-11">
                      <div class="form-group">
                        <label>Blog Title</label>
                        <input type="text" name="blog-title" class="form-control" placeholder="Enter your blog title." >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Description</label>
                         <textarea name="blog-post" class="form-control"  placeholder="Your Basic post details goes here"></textarea>                       
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Post Details</label>
                         <textarea name="blog-details" id="richeditor" class="form-control" placeholder="You can leave this blank if you Want"></textarea>                       
                      </div>
                    </div>
                  </div>
                 <button type="submit" name="blog-add" class="btn btn-fill btn-primary">Publish</button>
                </form>
              </div>
            </div>
          </div>
         <?php include_once('profile.php');?>                 
        </div>
      </div>
<?php include_once('common/footer.php'); ?>