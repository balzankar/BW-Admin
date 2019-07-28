<?php 
$page_title='Edit Profile';
require_once('includes/load.php');
page_require_level(3); 
$all_users = find_all_user();
?>
<?php
//update user image
  if(isset($_POST['profile-pic'])) {
  $photo = new Media();
  $user_id = (int)$_POST['user_id'];
  $photo->upload($_FILES['file_upload']);
  if($photo->process_user($user_id)){
    $session->msg('s','photo has been uploaded.');
    redirect('user.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('user_edit.php');
    }
  }
?>
<?php
 //update user other info
  if(isset($_POST['update-user'])){
    $req_fields = array('name','username','email' );
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$_SESSION['user_id'];
           $name = remove_junk($db->escape($_POST['name']));
       $username = remove_junk($db->escape($_POST['username']));
       $email = remove_junk($db->escape($_POST['email']));
       $skills = remove_junk($db->escape($_POST['skills']));
       $about_user = remove_junk($db->escape($_POST['about-user']));
       $company = remove_junk($db->escape($_POST['company']));
            $sql = "UPDATE users SET name ='{$name}', username ='{$username}', company ='{$company}', email ='{$email}', about_user='{$about_user}', skills='{$skills}' WHERE id='{$id}'";
    $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Acount updated ");
            redirect('user.php', false);
          } else {
            $session->msg('d',' Sorry failed to updated!');
            redirect('user_edit.php', false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('user_edit.php',false);
    }
  }
?>
<?php $user = current_user(); ?>

<?php
  if(isset($_POST['update-password'])){

    $req_fields = array('new-password','old-password','id' );
    validate_fields($req_fields);

    if(empty($errors)){

             if(sha1($_POST['old-password']) !== current_user()['password'] ){
               $session->msg('d', "Your old password Dont match");
               redirect('user_edit.php',false);
             }

            $id = (int)$_POST['id'];
            $new = remove_junk($db->escape(sha1($_POST['new-password'])));
            $sql = "UPDATE users SET password ='{$new}' WHERE id='{$db->escape($id)}'";
            $result = $db->query($sql);
                if($result && $db->affected_rows() === 1):
                  $session->logout();
                  $session->msg('s',"Success, Login with your new password.");
                  redirect('../../index.php', false);
                else:
                  $session->msg('d',' Sorry failed to updated!');
                  redirect('user_edit.php', false);
                endif;
    } else {
      $session->msg("d", $errors);
      redirect('user_edit.php',false);
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
                <form method="post" action="user_edit.php?id=<?php echo (int)$user['id'];?>" class="clearfix">
                  <div class="row">
                    <div class="col-md-5 pr-md-1">
                      <div class="form-group">
                        <label>Company</label>
                        <input type="text" readonly class="form-control" name="company" placeholder="Company Name" value="<?php echo remove_junk($user['company']); ?>">
                      </div>
                    </div>
                    <div class="col-md-3 pr-md-1">
                      <div class="form-group">
                        <label>Designation</label>
                        <input type="text" readonly class="form-control mb-0" name="designation" placeholder="Client" value="<?php echo remove_junk($user['designation']); ?>">
                      </div>
                    </div>
                    <div class="col-md-3 px-md-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" readonly class="form-control" name="username" placeholder="username"  title="Disabled" value="<?php echo remove_junk($user['username']); ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-md-1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" readonly class="form-control mb-0" title="Disabled by Bal World" name="name" placeholder="full name" value="<?php echo remove_junk($user['name']); ?>">
                        <em class="small pt-0">Name is Linked with Projects, Changing it will causes Multiple Errors.</em>
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="email Id" value="<?php echo remove_junk($user['email']); ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About You</label>
                        <input type="text" name="about-user" class="form-control" placeholder="Lets our users know a few things about u. Dont get poetic Max 5000." value="<?php echo remove_junk($user['about_user']); ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>My Skills</label>
                        <input type="text" name="skills" class="form-control" placeholder="eg: PhP, HTML5, Web Development" value="<?php echo remove_junk($user['skills']); ?>">
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
'                  <form class="form" action="user_edit.php" method="POST" enctype="multipart/form-data" class="clearfix">
                  <img class="avatar profile-pic" style="height:100px;width:100px;" src="../uploads/users/<?php echo $user['image'];?>" alt="img">   
                  <input type="file" name="file_upload">             
                  <div class="form-group">
                     <input type="hidden" name="user_id" value="<?php echo $user['id'];?>">
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
                  <form method="post" action="user_edit.php" class="clearfix">
                    <div class="form-group">
                          <label for="newPassword">New password</label>
                          <input type="password" class="form-control" name="new-password" placeholder="New password">
                    </div>
                    <div class="form-group">
                          <label for="oldPassword">Old password</label>
                          <input type="password" class="form-control" name="old-password" placeholder="Old password">
                    </div>
                    <div class="form-group clearfix">
                           <input type="hidden" name="id" value="<?php echo (int)$user['id'];?>">
                            <button type="submit" name="update-password" class="btn btn-info">Change</button>
                    </div>
                </form>
              </div>
            </div>
           </div>
           </div>
         </div>        
          
        <?php include_once('profile.php');?>          
    </div>
 </div>
<?php include_once('common/footer.php'); ?>