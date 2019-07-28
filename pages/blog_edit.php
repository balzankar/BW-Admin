<?php 
$page_title='Edit Blog';
require_once('includes/load.php');
$all_blog = find_all('blog');
$all_photo = find_all('media');
page_require_level(2);

$blog = find_by_id('blog',(int)$_GET['id']);
if(!$blog){
  $session->msg("d","Missing Blog id.");
  redirect('blog.php');
}

?>
<?php
 if(isset($_POST['blog-edit'])){
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
       
     $query   = "UPDATE blog SET";     
     $query .=" title='{$b_title}', post='{$b_post}', author='{$b_author}', image_id='{$b_image}', category='{$b_cat}', post_details='{$b_details}' ";
     $query  .=" WHERE id ='{$blog['id']}' ";
     $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Blog updated ");
                 redirect('blog.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('blog_edit.php?id='.$blog['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('blog_edit.php?id='.$blog['id'], false);
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
                <h4 class="card-title d-inline">Edit Blog : <?php echo $blog['title'];?></h4>
                 <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="blog.php">Cancel</a>
                    <a class="dropdown-item" href="delete_blog.php?id=<?php echo (int)$blog['id'] ?>">Delete</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form autocomplete="off" method="post" action="blog_edit.php?id=<?php echo (int)$blog['id'] ?>">
                  <div class="row">
                    <div class="col-md-5 pr-md-1">
                      <div class="form-group">
                        <label>Author</label>
                        <input type="text" class="form-control" name="blog-author" placeholder="Author Name" value="<?php echo $blog['author'];?>">
                      </div>
                    </div>
                    <div class="col-md-2 pl-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="blog-category">
                          <option value="<?php echo $blog['category'];?>" class="text-info">Current Category : <?php echo $blog['category'];?></option>
                          <option value="Page">Page</option>
                          <option value="Blog">Blog</option>
                          <option value="News">News</option>
                          <option value="Projects">Projects</option>
                        </select>
                     </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Current Image ID : <?php echo $blog['image_id'] ?></label>
                        <select class="form-control" name="blog-photo">
                          <option value="<?php echo $blog['image_id'] ?>">Current Image</option>
                        <?php  foreach ($all_photo as $photo): ?>
                          <option value="<?php echo (int)$photo['id'] ?>">ID : <?php echo $photo['id'] ?> | <?php echo $photo['file_name'] ?></option>
                        <?php endforeach; ?>
                        </select>
                     </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10 pr-md-1">
                      <div class="form-group">
                        <label>Blog Title</label>
                        <input type="text" name="blog-title" class="form-control" value="<?php echo $blog['title'];?>" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Description</label>
                          <textarea name="blog-post" class="form-control" placeholder="Your Basic post details goes here"><?php echo $blog['post'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Post Details</label>
                         <textarea name="blog-details" id="richeditor" class="form-control" placeholder="You can leave this blank if you Want"><?php echo $blog['post_details'];?></textarea>                       
                      </div>
                    </div>
                  </div>
                 <button type="submit" name="blog-edit" class="btn btn-fill btn-primary">Publish</button>
                 <a class="btn" href="../../post.php?id=<?php echo (int)$blog['id'] ?>" target="_blank" class="btn btn-fill btn-primary">View</a>
                </form>
              </div>
            </div>
          </div>
         <?php include_once('profile.php');?>                 
        </div>
      </div>
<?php include_once('common/footer.php'); ?>