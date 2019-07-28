<?php 
$page_title='Edit Projects';
require_once('includes/load.php');
page_require_level(1);
$all_projects = find_all('projects');

$project = find_by_id('projects',(int)$_GET['id']);
if(!$project){
  $session->msg("d","Missing product id.");
  redirect('projects_admin.php');
}
$all_categories = find_all('categories');
$all_clients = find_all_clients();
$all_emps = find_all_emps();

?>
<?php
 if(isset($_POST['projects-edit'])){
   $req_fields = array('projects-name','projects-lead','projects-category','projects-client','projects-description','projects-status','projects-progress','projects-payment','projects-details' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['projects-name']));
     $p_lead  = remove_junk($db->escape($_POST['projects-lead']));
     $p_cat   = remove_junk($db->escape($_POST['projects-category']));
     $p_client = remove_junk($db->escape($_POST['projects-client']));
     $p_desc   = remove_junk($db->escape($_POST['projects-description'])); 
     $p_status   = remove_junk($db->escape($_POST['projects-status'])); 
     $p_progress   = remove_junk($db->escape($_POST['projects-progress'])); 
     $p_url   = remove_junk($db->escape($_POST['projects-url']));
     $p_details   = $db->escape($_POST['projects-details']);
     $p_pay   = remove_junk($db->escape($_POST['projects-payment']));
       
     $query   = "UPDATE projects SET";     
     $query .=" name='{$p_name}',lead_emp='{$p_lead}', category='{$p_cat}', client='{$p_client}', description='{$p_desc}', status='{$p_status}', progress='{$p_progress}', project_url='{$p_url}', payment_url='{$p_pay}', details='{$p_details}' ";
     $query  .=" WHERE id ='{$project['id']}' ";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Project updated ");
                 redirect('projects_admin.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('projects_edit_admin.php?id='.$project['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('projects_edit_admin.php?id='.$project['id'], false);
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
                  <h4 class="card-title d-inline">Edit Project : <span class="text-info"><?php echo remove_junk($project['name'])?></span><br>
                  created by: <span class="text-info"><?php echo remove_junk($project['created_by'])?></span></h4>                 
                  <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="projects_admin.php">Cancel</a>
                    <a class="dropdown-item" href="delete_project.php?id=<?php echo (int)$project['id'] ?>">Delete</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form autocomplete="off" method="post" action="projects_edit_admin.php?id=<?php echo (int)$project['id'] ?>">
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
                            <select type="text" class="form-control" name="projects-category" value="<?php echo remove_junk($project['category'])?>">
                            <option value="<?php echo remove_junk($project['category'])?>">Current Category: <?php echo remove_junk($project['category'])?></option>
                            <?php  foreach ($all_categories as $cat): ?>                              
                              <option value="<?php echo remove_junk($cat['name']) ?>">
                                <?php echo $cat['name'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Client</label>
                            <select class="form-control" name="projects-client">
                              <option value="<?php echo remove_junk($project['client']) ?>">Current Cient : <?php echo remove_junk($project['client']) ?></option>
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
                  <div class="col-md-8 pr-md-1">
                      <div class="form-group">
                        <label>Project Name</label>
                        <input type="text" name="projects-name" class="form-control" placeholder="Enter Project Name" value="<?php echo remove_junk($project['name'])?>">
                       </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Lead Employee</label>
                            <select class="form-control" name="projects-lead">
                              <option value="<?php echo remove_junk($project['lead_emp']) ?>">Current Lead : <?php echo remove_junk($project['lead_emp']) ?></option>
                            <?php  foreach ($all_emps as $emp): ?>
                              <option value="<?php echo $emp['name'] ?>">
                                <?php echo $emp['name'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="projects-description" class="form-control" placeholder="Enter Breif Description" value="<?php echo remove_junk($project['description'])?>">
                      </div>
                    </div>
                  </div>
                 <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Project Url</label>
                        <input type="text" list="project_url" name="projects-url" class="form-control" placeholder="Enter Project Url" value="<?php echo remove_junk($project['project_url'])?>">
                        <datalist id="project_url">
                          <option value="https://balworld.in/sorry.php">Default</option>
                        </datalist>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Payment Url</label>
                        <input type="text" list="payment" name="projects-payment" class="form-control" placeholder="javascript:paymentcomplete();" value="<?php echo remove_junk($project['payment_url'])?>">
                          <datalist id="payment">
                              <option value="javascript:paymentcomplete();">Payment Complete</option>
                          </datalist>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Status : <span class="text-info"><?php echo remove_junk($project['status']) ?></span></label>
                         <select type="text" name="projects-status" class="form-control" placeholder="" value="<?php echo remove_junk($project['status'])?>">
                          <option value="<?php echo remove_junk($project['status'])?>">Current Value</option>
                          <option value="requested">requested</option>
                          <option value="accepted">accepted</option>
                          <option value="declined">declined</option>
                          <option value="will contact">will contact</option>
                        </select> 
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Progress : <span class="text-info"><?php echo remove_junk($project['progress']) ?></span></label>
                         <select type="text" name="projects-progress" class="form-control" placeholder="" value="<?php echo remove_junk($project['progress'])?>">
                          <option value="<?php echo remove_junk($project['progress'])?>">Current Value</option>
                          <option value="Brainstorming">Brainstorming</option>
                          <option value="In-Development">In-Development</option>
                          <option value="Completed">Completed</option>
                          <option value="Live/Released">Live/Released</option>
                        </select> 
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Additional Details</label>
                          <textarea name="projects-details" id="richeditor" class="form-control" placeholder="Your Basic post details goes here"><?php echo $project['details'];?></textarea>
                      </div>
                    </div>
                  </div>
                 <button type="submit" name="projects-edit" class="btn btn-fill btn-primary">Update</button>
                </form>
              </div>
            </div>
          </div>
         <?php include_once('profile.php');?>                 
        </div>
      </div>
<?php include_once('common/footer.php'); ?>