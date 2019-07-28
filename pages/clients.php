<?php 
$page_title='Clients';
include_once('includes/load.php');  
page_require_level(2);
$all_clients = find_all_clients();
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
                <h4 class="card-title d-inline">All Clients</h4>
              </div>
              <div class="card-body tablesorter table-responsive" >
                  <table class="table table-striped " id="datatables">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Client Name</th>
                        <th>Email</th>
                        <th>Last Login</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_clients as $a_clients): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id();?></td>
                       <td><?php echo remove_junk(ucwords($a_clients['name']))?></td>
                       <td><?php echo remove_junk($a_clients['email'])?></td>
                       <td><?php echo remove_junk(ucwords($a_clients['last_login']))?></td> 
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