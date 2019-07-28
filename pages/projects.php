<?php 
$page_title='Projects';
include_once('includes/load.php');  
page_require_level(2);
$cuserclient = $user['name'];
$all_projects = find_all_clientprojects($cuserclient);
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
                <h4 class="card-title d-inline">My Approved Projects</h4>
                 <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="projects_nonapproved.php">Waiting Approval</a>
                  </div>
                </div>
              </div>
              <div class="card-body tablesorter table-responsive" >
                  <table class="table table-striped " id="datatables">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Project</th>
                        <th>Created by &amp; Lead</th>
                        <th>Category</th>
                        <th>Client</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_projects as $a_projects): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id();?></td>
                       <td><?php echo remove_junk(ucwords($a_projects['name']))?>
                           <p style="font-size:12px !important;" class="text-info"><?php echo remove_junk(ucwords($a_projects['progress']))?></p>
                        </td>
                       <td><?php echo remove_junk(ucwords($a_projects['created_by']))?><p style="font-size:12px !important;"><?php echo remove_junk(ucwords($a_projects['lead_emp']))?></p></td>
                       <td><?php echo remove_junk(ucwords($a_projects['category']))?></td>
                       <td><?php echo remove_junk($a_projects['client'])?></td>
                       <td class="text-center">                    
                        <a href="projects_edit.php?id=<?php echo (int)$a_projects['id'];?>">
                            <button class="btn btn-icon btn-primary btn-round"><i class="fa fa-edit"></i></button>
                        </a>                    
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
                  <a href="projects_add.php"><button type="submit" class="btn btn-fill btn-primary">Add Projects</button></a>
              </div>
            </div>
              
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">All Other Projects</h4>
              </div>
              <div class="card-body tablesorter table-responsive" >
                  <table class="table table-striped " id="datatables">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Project</th>
                        <th>Lead</th>
                        <th>Category</th>
                        <th>Client</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_otherapproved as $a_projects): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id3();?></td>
                       <td><?php echo remove_junk(ucwords($a_projects['name']))?><p style="font-size:12px !important;" class="text-info"><?php echo remove_junk(ucwords($a_projects['progress']))?></p></td>
                       <td><?php echo remove_junk(ucwords($a_projects['lead_emp']))?></td>
                       <td><?php echo remove_junk(ucwords($a_projects['category']))?></td>
                       <td><?php echo remove_junk($a_projects['client'])?></td>
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
            </div>
              
              
          </div>
         <?php include_once('profile.php');?>                 
        </div>
      </div>
<?php include_once('common/footer.php'); ?>