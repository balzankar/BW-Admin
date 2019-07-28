<?php 
$page_title='Teams';
require_once('includes/load.php');
page_require_level(2);
$all_teams = find_all('teams');
$all_emps = find_all_emps();
?>
<?php
 if(isset($_POST['teams-add'])){
   $req_field = array('teams-name','teams-head');
   validate_fields($req_field);
   $t_name = remove_junk($db->escape($_POST['teams-name']));
   $t_created = remove_junk($db->escape($_POST['teams-created']));
   $t_head = remove_junk($db->escape($_POST['teams-head']));
   if(empty($errors)){
      $sql  = "INSERT INTO teams (name,created_by,head)";
      $sql .= " VALUES ('{$t_name}','{$t_created}','{$t_head}' )";
      if($db->query($sql)){
        $session->msg("s", "New team Added");
        redirect('teams.php',false);
      } else {
        $session->msg("d", "Sorry Failed to Add.");
        redirect('teams.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('teams.php',false);
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
                <h4 class="card-title d-inline">Add New Team</h4>
              </div>
              <div class="card-body" >
                  
                <form autocomplete="off" method="post" action="teams.php">
                  <div class="row">
                    <div class="col-md-6 pr-md-1">
                      <div class="form-group">
                        <label>Team Name</label>
                        <input type="text" class="form-control" name="teams-name" placeholder="Team Name" >
                      </div>
                    </div>
                        <input type="hidden" class="form-control" name="teams-created" value="<?php echo $user['name'];?>" >
                    <div class="col-md-5 pr-md-1">
                      <div class="form-group">
                        <label>Team Head</label>
                            <select class="form-control" name="teams-head">
                              <option value="Lead Not Specifed">Select Employee</option>
                            <?php  foreach ($all_emps as $emp): ?>
                              <option value="<?php echo $emp['name'] ?>">
                                <?php echo $emp['name'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                  </div>
                 <button type="submit" name="teams-add" class="btn btn-fill btn-primary">Add Team</button>
                </form> 
                  
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <h5 class="title">All Teams</h5>
              </div>
              <div class="card-body table-responsive" >
                  <table class="table table-striped tablesorter" id="datatables">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Title</th>
                        <th>Head</th>
                        <th class="text-center">Time Stamp</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_teams as $a_team): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id();?></td>
                       <td><?php echo remove_junk(ucwords($a_team['name']))?></td>
                       <td><?php echo remove_junk(ucwords($a_team['head']))?></td>
                       <td class="text-center"><?php echo remove_junk($a_team['date'])?></td>
                       <td class="text-center">                    
                        <a href="delete_team.php?id=<?php echo (int)$a_team['id'];?>">
                            <button class="btn btn-icon btn-danger btn-round"><i class="fa fa-trash"></i></button>
                        </a>  
                       </td>
                      </tr>
                     <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">All Employees</h4>
              </div>
              <div class="card-body table-responsive" >
                  <table class="table table-striped tablesorter" id="datatables">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Name &amp; Team</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th class="text-center">Last Login</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_emps as $a_emp): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id2();?></td>
                       <td><?php echo remove_junk(ucwords($a_emp['name']))?><p class="text-info"><?php echo remove_junk(ucwords($a_emp['teamname']))?></p></td>
                       <td><?php echo remove_junk(ucwords($a_emp['designation']))?></td>
                       <td><?php echo remove_junk($a_emp['email'])?></td>
                       <td class="text-center"><?php echo remove_junk($a_emp['last_login'])?></td>
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