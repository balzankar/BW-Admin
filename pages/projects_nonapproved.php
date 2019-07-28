<?php 
$page_title='Projects';
include_once('includes/load.php');  
page_require_level(2);

$all_otherprojects = find_all_notapproved();
$all_otherapproved = find_all_approved()
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
                <h4 class="card-title d-inline">Non Approved Projects</h4>
                 <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="projects.php">Projects</a>
                  </div>
                </div>
              </div>
              <div class="card-body tablesorter table-responsive" >
                  <table class="table table-striped " id="datatables">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Project</th>
                        <th>Requested by</th>
                        <th>Category</th>
                        <th>Client</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_otherprojects as $a_projects): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id2();?></td>
                       <td><?php echo remove_junk(ucwords($a_projects['name']))?><p style="font-size:12px !important;" class="text-info"><?php echo remove_junk(ucwords($a_projects['progress']))?></p></td>
                       <td><?php echo remove_junk(ucwords($a_projects['created_by']))?></td>
                       <td><?php echo remove_junk(ucwords($a_projects['category']))?></td>
                       <td><?php echo remove_junk($a_projects['client'])?></td>
                       <td style="color: red !important;"><?php echo remove_junk(ucwords($a_projects['status']))?></td>
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