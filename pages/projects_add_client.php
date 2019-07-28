<?php 
$page_title='Project Request';
require_once('includes/load.php');
page_require_level(3);

$all_users = find_all_user();
$all_categories = find_all('categories');
$all_clients = find_all_clients();
$all_emps = find_all_emps();
?>
<?php
 if(isset($_POST['projects-add'])){
   $req_fields = array('projects-name','projects-category','projects-client','projects-created_by','projects-description' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['projects-name']));  
     $p_cat   = remove_junk($db->escape($_POST['projects-category']));
     $p_created   = remove_junk($db->escape($_POST['projects-created_by']));
     $p_client = remove_junk($db->escape($_POST['projects-client']));
     $p_desc   = remove_junk($db->escape($_POST['projects-description']));
       
     $query  =" INSERT INTO projects (";
     $query .=" name, category ,created_by, client ,description ,status ";
     $query .=") VALUES (";
     $query .=" '{$p_name}','{$p_cat}','{$p_created}','{$p_client}','{$p_desc}','requested' ";
     $query .=")";
       
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
       
     if($db->query($query)){
       $session->msg('s',"Project request added ");
       redirect('projects_clients.php', false);
     } else {
       $session->msg('d',' Sorry failed to add!');
       redirect('projects_clients.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('projects_add_client.php',false);
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
                <h4 class="card-title d-inline">Add Projects</h4>
              </div>
              <div class="card-body">
                <form autocomplete="off" method="post" action="projects_add_client.php">
                  <div class="row">
                    <div class="col-md-4 pr-md-1">
                      <div class="form-group">
                        <label>Company (disabled)</label>
                        <input type="text" class="form-control" disabled="" placeholder="Bal World" value="Bal World Technologies.">
                      </div>
                    </div>
                    <div class="col-md-3 pl-md-1">
                      <div class="form-group">
                        <label>Client</label>
                        <input type="text" class="form-control" readonly name="projects-client" value="<?php echo $user['name'];?>">
                        </div>
                    </div>
                    <div class="col-md-3 px-md-1">
                      <div class="form-group">
                        <label>Category</label>
                            <select type="text" class="form-control" name="projects-category">
                              <option value="Category Not Specifed">Select Category</option>
                            <?php  foreach ($all_categories as $cat): ?>
                              <option value="<?php echo $cat['name'] ?>">
                                <?php echo $cat['name'] ?></option>
                            <?php endforeach; ?>
                            </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8 pr-md-1">
                      <div class="form-group">
                        <label>Project Name</label>
                        <input type="text" name="projects-name" class="form-control" placeholder="Enter Project Name">
                       </div>
                    </div>
                     <div class="col-md-3">
                      <div class="form-group">
                        <label>Project Created by</label>
                        <input type="text" readonly name="projects-created_by" class="form-control" value="<?php echo $user['username'] ?>">
                       </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-11">
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="projects-description" class="form-control" placeholder="Enter Breif Description">
                      </div>
                    </div>
                  </div>
                 <button type="submit" name="projects-add" class="btn btn-fill btn-primary">Request</button>
                </form>
              </div>
            </div>
          </div>
         <?php include_once('profile.php');?>                 
        </div>
      </div>
<?php include_once('common/footer.php'); ?>