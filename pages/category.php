<?php 
$page_title='Categories';
require_once('includes/load.php');
page_require_level(2);
$all_category = find_all('categories');
?>
<?php
 if(isset($_POST['category-add'])){
   $req_field = array('category-name');
   validate_fields($req_field);
   $c_name = remove_junk($db->escape($_POST['category-name']));
   $c_created = remove_junk($db->escape($_POST['category-created']));
   if(empty($errors)){
      $sql  = "INSERT INTO categories (name,created_by)";
      $sql .= " VALUES ('{$c_name}','{$c_created}' )";
      if($db->query($sql)){
        $session->msg("s", "New Category Added");
        redirect('category.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('category.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('category.php',false);
   }
 }
?>
<?php include_once('common/header.php'); ?>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content">
       <?php echo display_msg($msg); ?>
        <div class="row">
        <div class="col">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">Add New Category</h4>
              </div>
              <div class="card-body" >
                  
                <form autocomplete="off" method="post" action="category.php">
                  <div class="row">
                    <div class="col-md-8 pr-md-1">
                      <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="category-name" placeholder="Category Name">
                      </div>
                    </div>
                      <div class="col-md-4">
                      <div class="form-group">
                        <input type="hidden" class="form-control" name="category-created" value="<?php echo remove_junk($user['name'])?>">
                      </div>
                    </div>
                  </div>
                 <button type="submit" name="category-add" class="btn btn-fill btn-primary">Add Category</button>
                </form> 
                  
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">Categories</h4>
              </div>
              <div class="card-body" >
                  <table class="table table-striped tablesorter" id="datatable" >
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Title</th>
                        <th>Created by</th>
                        <th class="text-center">Time Stamp</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_category as $a_category): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id();?></td>
                       <td><?php echo remove_junk(ucwords($a_category['name']))?></td>
                       <td><?php echo remove_junk(ucwords($a_category['created_by']))?></td>
                       <td class="text-center"><?php echo remove_junk($a_category['date'])?></td>
                       <td class="text-center">                    
                        <a href="delete_category.php?id=<?php echo (int)$a_category['id'];?>">
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
<script>
$(document).ready(function(){ $('#myTable').DataTable(); });
</script>
<?php include_once('common/footer.php'); ?>