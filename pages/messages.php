<?php 
$page_title='Messages';
require_once('includes/load.php');

page_require_level(2);
$all_replied = find_all_replied();
$all_reply = find_all_needreply();
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
                <h4 class="card-title d-inline">Messages Awaiting Replies</h4>
                <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="messages_send.php">Compose New Message</a>
                  </div>
                </div>
              </div>
              <div class="card-body" >
                  <table class="table table-striped tablesorter" id="datatables">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>From</th>
                        <th>Messages &amp; Replies</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_reply as $a_msg): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id();?></td>
                       <td><?php echo remove_junk(ucwords($a_msg['user']))?></td>
                       <td><?php echo remove_junk(ucwords($a_msg['message']))?><p class="text-info"><?php echo remove_junk(ucwords($a_msg['reply']))?></p></td>
                       <td class="text-center">                    
                        <a href="messages_reply.php?id=<?php echo (int)$a_msg['id'];?>">
                            <button class="btn btn-icon btn-primary btn-round"><i class="fa fa-reply"></i></button>
                        </a>  
                       </td>
                      </tr>
                     <?php endforeach;?>
                    </tbody>
                  </table>                
                </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">Replied Messages</h4>
              </div>
              <div class="card-body" >
                  <table class="table table-striped tablesorter" id="datatables">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>From</th>
                        <th>Messages &amp; Replies</th>
                      </tr>
                    </thead>
                    <tbody>                    
                     <?php foreach($all_replied as $b_msg): ?>
                      <tr>
                       <td class="text-center"><?php echo count_id2();?></td>                       
                       <td><?php echo remove_junk(ucwords($b_msg['user']))?></td>
                       <td><?php echo remove_junk(ucwords($b_msg['message']))?><p class="text-info"><?php echo remove_junk(ucwords($b_msg['reply']))?></p></td>

                      </tr>
                     <?php endforeach;?>
                       <tr>
                       <td class="text-center"><?php echo count_id2();?></td>
                       <td>Bal World Technologies</td>
                       <td>Welcome to Bal World Admin. We are delighted you being a Part of Us. Manage your Projects and Other work with us.</td>
                      </tr>
                    </tbody>
                  </table>                
                </div>
            </div>       
         </div>
         <?php include_once('profile.php');?>                 
      </div>
</div>
<?php include_once('common/footer.php'); ?>