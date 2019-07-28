<?php 
$page_title='Send Messages';
require_once('includes/load.php');
page_require_level(3);
$all_users = find_all_user();
$all_msgs = find_all('messages');
?>
<?php
 if(isset($_POST['message-sent'])){
   $req_field = array('message');
   validate_fields($req_field);
   $m_msg = remove_junk($db->escape($_POST['message']));
   $m_from = remove_junk($db->escape($_POST['message-from']));
   if(empty($errors)){
      $sql  = "INSERT INTO messages (message,user)";
      $sql .= " VALUES ('{$m_msg}','$m_from')";
      if($db->query($sql)){
        $session->msg("s", "Message Sent Successfully");
        redirect('messages.php',false);
      } else {
        $session->msg("d", "Sorry Failed to sent.");
        redirect('messages.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('messages.php',false);
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
        <div class="col">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">Message to Bal World</h4>
              </div>
              <div class="card-body" >
                  
                <form autocomplete="off" method="post" action="messages_send.php">
                  <div class="row">
                    <div class="col-md-3 pr-md-1">
                      <div class="form-group">
                        <label>From</label>
                        <input type="text" readonly class="form-control" name="message-from" value="<?php echo $user['name'];?>">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>To</label>
                        <input type="text" disabled class="form-control" name="message-to" value="Bal World">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Message</label>
                          <textarea type="text" class="form-control" name="message" placeholder="Write to us"></textarea>
                      </div>
                    </div>
                  </div>
                 <button type="submit" name="message-sent" class="btn btn-fill btn-primary">send</button>
                </form> 
                  
              </div>
            </div>
            
        </div>
     <?php include_once('profile.php');?>                    

       </div>
      </div>
<?php include_once('common/footer.php'); ?>