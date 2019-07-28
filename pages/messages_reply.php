<?php 
$page_title='Reply Messages';
require_once('includes/load.php');
$all_blog = find_all('messages');
page_require_level(2);

$messages = find_by_id('messages',(int)$_GET['id']);
if(!$messages){
  $session->msg("d","Missing Message id.");
  redirect('messages.php');
}

?>
<?php
 if(isset($_POST['msg'])){
   $req_fields = array('msg-reply' );
   validate_fields($req_fields);
   if(empty($errors)){
     $m_reply = remove_junk($db->escape($_POST['msg-reply']));
       
     $query   = "UPDATE messages SET";     
     $query .=" reply='{$m_reply}' ";
     $query  .=" WHERE id ='{$messages['id']}' ";
     $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Replied ");
                 redirect('messages.php', false);
               } else {
                 $session->msg('d',' Sorry failed to Reply!');
                 redirect('messages_reply.php?id='.$messages['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('messages_reply.php?id='.$messages['id'], false);
   }

 }

?>
<?php include_once('common/header.php'); ?>
      <!-- End Navbar -->
      <div class="content">
       <?php echo display_msg($msg); ?>
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title d-inline">Reply : <?php echo $messages['user'];?></h4>
                 <div class="dropdown d-inline pull-right">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="messages.php">Cancel</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form autocomplete="off" method="post" action="messages_reply.php?id=<?php echo (int)$messages['id'] ?>">
                  <div class="row">
                    <div class="col-md-10 pr-md-1">
                      <div class="form-group">
                        <label>Message</label>
                        <p class="text-info"><?php echo $messages['message'];?></p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Reply ( please use below format )</label>
                          <textarea name="msg-reply" class="form-control" placeholder="Your Name : Reply"><?php echo $messages['reply']; ?><?php echo $user['name'];?> : </textarea>
                      </div>
                    </div>
                  </div>
                 <button type="submit" name="msg" class="btn btn-fill btn-primary">Publish</button>
                </form>
              </div>
            </div>
          </div>
         <?php include_once('profile.php');?>                 
        </div>
      </div>
<?php include_once('common/footer.php'); ?>