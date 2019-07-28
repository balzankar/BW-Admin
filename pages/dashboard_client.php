<?php 
$page_title='Dashboard';
include_once('includes/load.php'); 
page_require_level(3);

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
          <h1>Hello, <?php echo $user['name'];?> ! <span class="text-info"> <?php echo $user['company'];?></span></h1>
        <div class="row">            
         <?php include_once('profile.php');?>                 

          <div class="col-md-6">
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
                          <p class="title">Hello, <?php echo $user['name'];?>. Welcome to Bal World Admin</p>
                          <p class="text-muted">We are delighted to Work with you. Here You'll see your <a class="text-info" href="projects_clients.php">Works</a> and its Progress made by us.</p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
         <?php include_once('dashboard_client_buttons.php');?>                 
        </div>
      </div>

<?php include_once('common/footer.php'); ?>