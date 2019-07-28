<?php 
$page_title='Users';
include_once('includes/load.php');  
page_require_level(1);
$all_users = find_all('users');
?>
<?php include_once('common/header.php'); ?>
      <!-- End Navbar -->
      <div class="content">
       <?php echo display_msg($msg); ?>
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">All Users</h4>
              </div>
              <div class="card-body table-responsive" >
                  <table class="table table-striped tablesorter" id="datatables">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>User Details</th>
                        <th>About user</th>
                        <th>Skills</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_users as $a_user): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id();?></td>
                       <td><?php echo remove_junk(ucwords($a_user['name']))?>
                           <br><span class="text-info"><?php echo remove_junk(ucwords($a_user['email']))?></span>
                           <br><span>Login: <?php echo remove_junk(ucwords($a_user['last_login']))?></span>
                          
                       </td>
                       <td><?php echo remove_junk(ucwords($a_user['about_user']))?><br><span class="text-info"><?php echo remove_junk(ucwords($a_user['designation']))?></span></td>
                       <td><?php echo $a_user['skills'];?></td>
                       <td class="text-center">                                        
                        <a href="users_edit.php?id=<?php echo (int)$a_user['id'];?>">
                            <button class="btn btn-icon btn-primary btn-round"><i class="fa fa-edit"></i></button>
                        </a>                                         
                        <a href="delete_user.php?id=<?php echo (int)$a_user['id'];?>">
                            <button class="btn btn-icon btn-danger btn-round"><i class="fa fa-trash"></i></button>
                        </a>  
                       </td>
                      </tr>
                     <?php endforeach;?>
                    </tbody>
                  </table>                
                </div>
              <div class="card-footer">
                  <a href="https://www.balworld.in/register.php" target="_blank"><button type="submit" class="btn btn-fill btn-primary">Add Users</button></a>
              </div>
            </div>
          </div>
         <?php include_once('profile.php');?>                 
        </div>
      </div>
<?php include_once('common/footer.php'); ?>