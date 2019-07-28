<?php 
$page_title='Edit Profile';
require_once('includes/load.php');
page_require_level(1); 
$all_users = find_all_user();
$all_teams = find_all('teams');

$a_users = find_by_id('users',(int)$_GET['id']);
if(!$a_users){
  $session->msg("d","Missing user id.");
  redirect('users.php');
}
?>
<?php
//update user image
  if(isset($_POST['profile-pic'])) {
  $photo = new Media();
  $user_id = (int)$_POST['user_id'];
  $photo->upload($_FILES['file_upload']);
  if($photo->process_user($user_id)){
    $session->msg('s','photo has been uploaded.');
    redirect('users.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('users.php');
    }
  }
?>
<?php
 //update user other info
  if(isset($_POST['update-user'])){
    $req_fields = array('team','designation');
    validate_fields($req_fields);
    if(empty($errors)){
           $id = (int)$a_users['id'];
           $name = remove_junk($db->escape($_POST['name']));
       $username = remove_junk($db->escape($_POST['username']));
       $email = remove_junk($db->escape($_POST['email']));
       $skills = remove_junk($db->escape($_POST['skills']));
       $about_user = remove_junk($db->escape($_POST['about-user']));
       $company = remove_junk($db->escape($_POST['company']));
       $designation = remove_junk($db->escape($_POST['designation']));
       $team = remove_junk($db->escape($_POST['team']));
            $sql = "UPDATE users SET name ='{$name}', username ='{$username}', company ='{$company}', email ='{$email}', about_user='{$about_user}', team_id='{$team}', designation='{$designation}', skills='{$skills}' WHERE id='{$db->escape($id)}'";
    $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Acount updated ");
            redirect('users.php', false);
          } else {
            $session->msg('d',' Sorry failed to updated!');
            redirect('users.php', false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('users.php',false);
    }
  }
?>

<?php
  if(isset($_POST['update-password'])){

    $req_fields = array('new-password','id' );
    validate_fields($req_fields);

    if(empty($errors)){
           $id = (int)$a_users['id'];
            $new = remove_junk($db->escape(sha1($_POST['new-password'])));
            $sql = "UPDATE users SET password ='{$new}' WHERE id='{$db->escape($id)}'";
            $result = $db->query($sql);
                if($result && $db->affected_rows() === 1):
                  $session->msg('s',"Success.");
                  redirect('users.php', false);
                else:
                  $session->msg('d',' Sorry failed to updated!');
                  redirect('users.php', false);
                endif;
    } else {
      $session->msg("d", $errors);
      redirect('users.php',false);
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
          <div class="col-sm-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">Edit Profile</h4>
              </div>
              <div class="card-body">
                <form method="post" action="users_edit.php?id=<?php echo (int)$a_users['id'];?>" class="clearfix">
                  <div class="row">
                    <div class="col-md-5 pr-md-1">
                      <div class="form-group">
                        <label>Company</label>
                        <input type="text" readonly class="form-control" name="company" placeholder="Company Name" value="<?php echo remove_junk($a_users['company']); ?>">
                      </div>
                    </div>
                    <div class="col-md-3 pr-md-1">
                      <div class="form-group">
                        <label>Designation</label>
                        <input type="text" class="form-control" name="designation" placeholder="Client" value="<?php echo remove_junk($a_users['designation']); ?>">
                      </div>
                    </div>
                    <div class="col-md-3 pr-md-1">
                      <div class="form-group">
                        <label>Team</label>
                            <select class="form-control" name="team" value="<?php echo remove_junk($a_users['team'])?>">
                            <option value="<?php echo remove_junk($a_users['team'])?>" class="text-info">Current team</option>
                            <?php  foreach ($all_teams as $team): ?>                              
                              <option value="<?php echo remove_junk($team['id']) ?>">
                                <?php echo $team['name'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pr-md-1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="full name" value="<?php echo remove_junk($a_users['name']); ?>">
                      </div>
                    </div>
                    <div class="col-md-3 px-md-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="username" value="<?php echo remove_junk($a_users['username']); ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="email Id" value="<?php echo remove_junk($a_users['email']); ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About You</label>
                        <input type="text" name="about-user" class="form-control" placeholder="Lets our users know a few things about u. Dont get poetic Max 5000." value="<?php echo remove_junk($a_users['about_user']); ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>My Skills</label>
                        <input type="text" name="skills" class="form-control" placeholder="eg: PhP, HTML5, Web Development" value="<?php echo remove_junk($a_users['skills']); ?>">
                      </div>
                    </div>
                  </div>
                 <button type="submit" name="update-user" class="btn btn-fill btn-primary">Save</button>
                </form>
              </div>
            </div>

        <div class="row"> 
         <div class="col-md-6"> 
          <div class="card">
            <div class="card-header">
                <h5 class="title">Change Profile Photo</h5>
            </div>
            <div class="card-body">
'                  <form class="form" action="users_edit.php?id=<?php echo (int)$a_users['id'];?>" method="POST" enctype="multipart/form-data" class="clearfix">
                  <img class="avatar profile-pic" style="height:100px;width:100px;" src="../uploads/users/<?php echo $a_users['image'];?>" alt="img">   
                  <input type="file" name="file_upload">             
                  <div class="form-group">
                     <input type="hidden" name="user_id" value="<?php echo $a_users['id'];?>">
                     <button type="submit" name="profile-pic" class="btn btn-warning">Change</button>
                  </div>
                 </form>
              </div>
            </div>
            </div>
            <div class="col-md-6"> 
            <div class="card">
            <div class="card-header">
                <h5 class="title">Change Password</h5>
            </div>
            <div class="card-body">
                  <form method="post" action="users_edit.php?id=<?php echo (int)$a_users['id'];?>" class="clearfix">
                    <div class="form-group">
                          <label for="newPassword">New password</label>
                          <input type="password" class="form-control" name="new-password" placeholder="New password">
                    </div>
                    <div class="form-group clearfix">
                           <input type="hidden" name="id" value="<?php echo (int)$a_users['id'];?>">
                            <button type="submit" name="update-password" class="btn btn-info">Change</button>
                    </div>
                </form>
              </div>
            </div>
           </div>
           </div>
         </div>     
            
          <div class="col-md-4">
            <div class="card card-user" style="height:500px;">
              <div class="card-header">
                <div class="dropdown">
                  <button class="btn dropdown-toggle btn-link btn-gear btn-icon" data-toggle="dropdown" style="">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="user_edit.php">Edit Profile</a>
                  </div>
                </div>
              </div>
              <div class="card-body" style="overflow-y:auto;">
                <div class="card-text">
                  <div class="author">
                    <div class="block block-one"></div>
                    <div class="block block-two"></div>
                    <div class="block block-three"></div>
                    <div class="block block-four"></div>
                    <a href="javascript:void(0)">
                      <img class="avatar profile-pic" src="../uploads/users/<?php echo $a_users['image'];?>" alt="img">
                      <h5 class="title"><?php echo $a_users['name'];?><br><?php echo $user['designation'];?></h5>
                    </a>
                    <p class="description"><?php echo $a_users['company'];?></p>
                  </div>
                </div>
                  <div>
                <div class="card-description">                      
                    <h5 class="title" style="margin-bottom:0px;">About Me</h5>
                  <?php echo remove_junk($a_users['about_user']); ?>                    
                    <h5 class="title" style="margin-bottom:0px;margin-top:10px;">My Skills</h5><?php echo remove_junk($a_users['skills']); ?>    
                    <h5 class="title" style="margin-bottom:0px;margin-top:10px;">Email</h5><?php echo remove_junk($a_users['email']); ?>
                    <h5 class="title" style="margin-bottom:0px;margin-top:10px;"></h5>
                </div></div>
              </div> 
            </div>
           </div>
                  
    </div>
 </div>
<?php include_once('common/footer.php'); ?>