<?php 
$page_title='Edit Projects';
require_once('includes/load.php');
page_require_level(3);
$all_projects = find_all('projects');

$a_projects = find_by_id('projects',(int)$_GET['id']);
if(!$a_projects){
  $session->msg("d","Missing product id.");
  redirect('projects.php');
}
$all_categories = find_all('categories');
$all_clients = find_all_clients();
$all_emps = find_all_emps();
require_once('common/header.php');
?>
  <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline"><?php echo remove_junk(ucwords($a_projects['name']))?></h4>
                 <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="messages_send.php">Send a Message</a>
                    <a class="dropdown-item" href="<?php echo $a_projects['payment_url'] ?>" target="_top">Renew Payment</a>
                    <a class="dropdown-item" onclick="history.back(-1)" style="cursor:pointer;">Go Back</a>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive" >
                    <p><strong class="text-info">Project Lead</strong> : <?php echo remove_junk(ucwords($a_projects['lead_emp']))?></p>
                    <p><strong class="text-info">Project category</strong> : <?php echo remove_junk(ucwords($a_projects['category']))?></p>
                    <p><strong class="text-info">Project Client</strong> : <?php echo remove_junk(ucwords($a_projects['client']))?></p>
                    <p><strong class="text-info">Project Description</strong> : <?php echo remove_junk(ucwords($a_projects['description']))?></p>
                    <p><strong class="text-info">Project Status</strong> : <?php echo remove_junk(ucwords($a_projects['status']))?></p>
                    <p><strong class="text-info">Project Progress</strong> : <?php echo remove_junk(ucwords($a_projects['progress']))?></p>
                </div>
                <div class="card-footer">
                    <a class="btn btn-primary" href="<?php echo remove_junk($a_projects['project_url'])?>" target="_blank">View Live</a>
                    <a class="btn btn-primary" href="<?php echo $a_projects['payment_url'] ?>" target="_top" title="Payments processed by PayPal">Renew Payment</a>
                </div>
              </div>

              <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline"><strong>Additional Details :</strong> <?php echo remove_junk(ucwords($a_projects['name']))?></h4>
                 <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="messages_send.php">Send a Message</a>
                    <a class="dropdown-item" href="<?php echo $a_projects['payment_url'] ?>" target="_top">Renew Payment</a>
                    <a class="dropdown-item" onclick="history.back(-1)" style="cursor:pointer;">Go Back</a>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive" >
                    <p><?php echo $a_projects['details'] ?></p>
                </div>
              </div>
            </div>
            
         <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline"><?php echo remove_junk(ucwords($a_projects['name']))?></h4>
                 <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="<?php echo remove_junk($a_projects['project_url'])?>" target="_blank">Open New Window</a>
                  </div>
                </div>
              </div>
              <iframe style="padding-top:10px;width:100%;height:70vh;border:none;" src="<?php echo remove_junk($a_projects['project_url'])?>"></iframe> 
            </div>
          </div>
            
         </div>        
    </div>
<?php include_once('common/footer.php'); ?>