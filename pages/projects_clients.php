<?php 
$page_title='My Works';
include_once('includes/load.php');  
page_require_level(3);
$cuserclient = $user['name'];
$client_projects = find_all_clientprojects($cuserclient);
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
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">Your Works</h4>
              </div>
              <div class="card-body tablesorter table-responsive" >
                  <table class="table table-striped " id="datatables">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Project</th>
                        <th>Lead</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th class="text-center">Payment</th>
                        <th class="text-center">View Work</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($client_projects as $a_projects): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id();?></td>
                       <td><?php echo remove_junk(ucwords($a_projects['name']))?>
                           <br><span class="text-info"><?php echo remove_junk(ucwords($a_projects['category']))?></span>
                           <br><?php echo remove_junk(ucwords($a_projects['progress']))?></td>
                       <td><?php echo remove_junk(ucwords($a_projects['lead_emp']))?></td>
                       <td><?php echo remove_junk($a_projects['client'])?></td>
                       <td><?php echo remove_junk(ucwords($a_projects['status']))?></td>
                       <td class="text-center">
                        <a data-toggle="tooltip" title="Payment" href="<?php echo $a_projects['payment_url'] ?>" target="_top">
                            <button class="btn btn-icon btn-primary btn-round"><i class="fa fa-paypal" aria-hidden="true"></i></button>
                        </a>
                       </td>
                       <td class="text-center">
                        <a data-toggle="tooltip" title="View details" href="projects_details.php?id=<?php echo (int)$a_projects['id'];?>">
                            <button class="btn btn-icon btn-primary btn-round"><i class="fa fa-eye"></i></button>
                        </a>
                       </td>
                      </tr>
                     <?php endforeach;?>
                    </tbody>
                  </table>                
                </div>
              <div class="card-footer">
                  <a href="projects_add_client.php"><button type="submit" class="btn btn-fill btn-primary">Request New Projects</button></a>
              </div>
            </div>
          </div>
         <?php include_once('profile.php');?>                 
        </div>
      </div>
<?php include_once('common/footer.php'); ?>