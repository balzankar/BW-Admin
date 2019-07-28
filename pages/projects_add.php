<?php 
$page_title='Add Projects';
require_once('includes/load.php');
page_require_level(2);

$all_users = find_all_user();
$all_categories = find_all('categories');
$all_clients = find_all_clients();
$all_emps = find_all_emps();
?>
<?php
 if(isset($_POST['projects-add'])){
   $req_fields = array('projects-name','projects-lead','projects-created_by','projects-category','projects-client','projects-description','projects-progress' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['projects-name']));     
     $p_lead = remove_junk($db->escape($_POST['projects-lead']));
     $p_cat   = remove_junk($db->escape($_POST['projects-category']));
     $p_created   = remove_junk($db->escape($_POST['projects-created_by']));
     $p_client = remove_junk($db->escape($_POST['projects-client']));
     $p_desc   = remove_junk($db->escape($_POST['projects-description'])); 
     $p_pro   = remove_junk($db->escape($_POST['projects-progress']));
     $p_url   = remove_junk($db->escape($_POST['projects-url'])); 
       
     $query  =" INSERT INTO projects (";
     $query .=" name, lead_emp,created_by, category ,client ,description ,status ,progress ,project_url ";
     $query .=") VALUES (";
     $query .=" '{$p_name}','{$p_lead}','{$p_created}','{$p_cat}','{$p_client}','{$p_desc}','requested','{$p_pro}','{$p_url}'";
     $query .=")";
       
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
       
     if($db->query($query)){
       $session->msg('s',"Project request added ");
       redirect('projects.php', false);
     } else {
       $session->msg('d',' Sorry failed to add!');
       redirect('projects.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('projects_add.php',false);
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
                <form autocomplete="off" method="post" action="projects_add.php">
                  <div class="row">
                    <div class="col-md-5 pr-md-1">
                      <div class="form-group">
                        <label>Company (disabled)</label>
                        <input type="text" class="form-control" disabled="" placeholder="Bal World" value="Bal World Technologies.">
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
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label>Client</label>
                            <select type="text" class="form-control" name="projects-client">
                              <option value="Client Not Specifed">Select Client</option>
                            <?php  foreach ($all_clients as $client): ?>
                              <option value="<?php echo $client['name'] ?>">
                                <?php echo $client['name'] ?></option>                              
                            <?php endforeach; ?>
                                <option value="Self Project">Self Project</option>
                            </select>                      
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-md-1">
                      <div class="form-group">
                        <label>Project Created by</label>
                        <input type="text" readonly name="projects-created_by" class="form-control" value="<?php echo $user['name'] ?>">
                       </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Head Employee</label>
                            <select class="form-control" name="projects-lead">
                              <option value="Lead Not Specifed">Select Employee</option>
                            <?php  foreach ($all_emps as $emp): ?>
                              <option value="<?php echo $emp['name'] ?>">
                                <?php echo $emp['name'] ?></option>
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
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="projects-description" class="form-control" placeholder="Enter Breif Description">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Project Url</label>
                        <input type="text" list="project_url" name="projects-url" class="form-control" placeholder="Enter Project Url">
                        <datalist id="project_url">
                          <option value="https://balworld.in/sorry.php">Default</option>
                        </datalist>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="text" hidden name="projects-payment" class="form-control" placeholder="javascript:paymentcomplete();" value="javascript:paymentcomplete();">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Progress</label>
                         <select type="text" name="projects-progress" class="form-control">
                          <option value="Brainstorming">Brainstorming</option>
                          <option value="In-Development">In-Development</option>
                          <option value="Completed">Completed</option>
                          <option value="Live/Released">Live/Released</option>
                        </select>
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