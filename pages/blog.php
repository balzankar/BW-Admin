<?php 
$page_title='Blogs';
include_once('includes/load.php');  
page_require_level(2);
$all_blog = find_all_desc('blog');
?>
<?php include_once('common/header.php'); ?>
      <!-- End Navbar -->
      <div class="content">
       <?php echo display_msg($msg); ?>
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">Blog</h4>
              </div>
              <div class="card-body table-responsive">
                  <table class="table table-striped tablesorter" id="datatable">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th class="text-center">Time Stamp</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_blog as $a_blog): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id();?></td>
                       <td><?php echo remove_junk(ucwords($a_blog['title']))?></td>
                       <td><?php echo remove_junk(ucwords($a_blog['author']))?></td>
                       <td><?php echo $a_blog['category'];?></td>
                       <td class="text-center"><?php echo remove_junk($a_blog['date'])?></td>
                       <td class="text-center">                    
                        <a href="blog_edit.php?id=<?php echo (int)$a_blog['id'];?>">
                            <button class="btn btn-icon btn-primary btn-round"><i class="fa fa-edit"></i></button>
                        </a>                     
                        <a href="../../post.php?id=<?php echo (int)$a_blog['id'];?>" target="_blank">
                            <button class="btn btn-icon btn-primary btn-round"><i class="fa fa-eye"></i></button>
                        </a>  
                       </td>
                      </tr>
                     <?php endforeach;?>
                    </tbody>
                  </table>                
                </div>
              <div class="card-footer">
                  <a href="blog_add.php"><button type="submit" class="btn btn-fill btn-primary">Add Blog</button></a>
              </div>
            </div>
          </div>
         <?php include_once('profile.php');?>                 
        </div>
      </div>
<?php include_once('common/footer.php'); ?>