<?php 
$page_title='Dashboard';
require_once('includes/load.php');
page_require_level(2);

$all_users = find_all_emps();
$all_projects = find_5_approved();
$cusermsg = $user['name'];
$all_msgs = find_all_usermsg($cusermsg);
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
          <h1>Hello, <?php echo $user['name'];?> !</h1>
        <div class="row">
         <div class="col-md-10">
         <div class="row">
          <div class="col-md-5">
              <?php include_once('profile_content.php');?></div>          
          <div class="col-md-7">
            <div class="card card-tasks">
              <div class="card-header ">
                <h4 class="card-title d-inline">Your Messages</h4>
                <div class="dropdown">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="messages.php">Send Us a Message</a>
                    <a class="dropdown-item" href="mailto://info@balworld.in?subject=mail from <?php echo $user['name'];?> via Bal World Admin ">Email Us</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-full-width table-striped table-responsive">
                  <table class="table">
                    <tbody>                         
                    <?php foreach($all_msgs as $a_msgs): ?>      
                      <tr>
                        <td><i class="fa fa-envelope"></td>
                        <td>
                          <p class="title"><?php echo remove_junk(ucwords($a_msgs['user']))?></p>
                          <p class="text-muted"><?php echo remove_junk(ucwords($a_msgs['message']))?></p>
                          <p class="text-info"><?php echo remove_junk(ucwords($a_msgs['reply']))?></p>
                        </td>
                        <?php endforeach;?>                       
                      </tr>
                      <tr>
                        <td><i class="fa fa-envelope"></td>
                        <td>
                          <p class="title">Bal World Technologies</p>
                          <p class="text-muted"><?php echo $user['name'];?>, Here are Few things to Know before Getting started.
                          <br><a href="projects.php" class="text-info">Projects</a> is for Creating New Projects Undertaken, Our Client Project request will also be seen here.
                        </td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-envelope"></td>
                        <td>
                          <p class="title">Bal World Technologies</p>
                          <p class="text-muted"><a href="blog.php" class="text-info">Blogs</a> and <a href="works.php" class="text-info">Works</a> tabs are managed for Bal World Frontend Websites. Create Posts in Works to See in Bal World Website/Works. Only Completed Works must be posted in Works tab. 
                              <br><br>Blog Tab is for Writting Articles related to Bal World to be Shown in Bal World Website in Appropriate Category.
                        </td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-envelope"></td>
                        <td>
                          <p class="title">Bal World Technologies</p>
                          <p class="text-muted">You Can Upload Images in <a href="media.php" class="text-info">Media</a> Tab and can select Images while Adding or Editing a Blog or Work.</p>
                        </td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-envelope"></td>
                        <td>
                          <p class="title">Hello, <?php echo $user['name'];?>. Welcome to Bal World Admin</p>
                          <p class="text-muted">We are delighted you being a Part of Us. Manage your Projects and Other work with us.</p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
 
           <div class="col-lg-5 col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Employee Database</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter table-striped table-full-width " id="">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>User </th>
                        <th class="text-center" style="width: 15%;">User Role</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_users as $a_user): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id();?></td>
                       <td><?php echo remove_junk(ucwords($a_user['name']))?><br><span class="text-info"><?php echo remove_junk(ucwords($a_user['email']))?></span></td>
                       <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name']))?></td>
                      </tr>
                     <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

           <div class="col-lg-7 col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">All Projects Undertaken</h4>
                 <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="projects_add.php">Add Projects</a>
                    <a class="dropdown-item" href="projects.php">Edit Projects</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
              <div class="tablesorter table-responsive">
                  <table class="table table-striped " id="datatables">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Lead </th>
                        <th>Category</th>
                        <th>Client</th>
                        <th class="text-center">Status</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_projects as $a_projects): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id2();?></td>
                       <td><?php echo remove_junk(ucwords($a_projects['name']))?></td>
                       <td><?php echo remove_junk(ucwords($a_projects['category']))?></td>
                       <td><?php echo remove_junk($a_projects['client'])?></td>
                       <td class="text-center"><?php echo remove_junk(ucwords($a_projects['status']))?></td>
                      </tr>
                     <?php endforeach;?>
                    </tbody>
                  </table>                
                </div>
              </div>
            </div>
          </div>
         </div>
        </div>
      <?php include_once('dashboard_buttons.php'); ?>
      </div>
   </div>
<?php include_once('common/footer.php'); ?>