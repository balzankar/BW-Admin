<?php 
$page_title='About';
include_once('common/header.php');                    
?>
    <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">About Bal World Admin</h4>
              </div>
              <div class="card-body table-responsive" >
                <img class="image pull-left" style="height:100px!important;" src="../assets/img/bw.png" alt="logo"/>
                <span class="text-info">Bal World Admin</span>
                <span class="">v2.02 Beta <br/>
                    <br>powerd by BW-DBM Engine<br>
                    Developed by Bal World Technologies<br/>with <i class="text-danger fa fa-heart"></i> in Thrissur<br/><br>
                </span>                  
                  <div class="col-md-12"><a href="https://www.balworld.in" target="_blank" class="btn btn-primary">Visit Bal World</a></div>
                  <hr>
                  <h4 class="card-title">Bal World Resources</h4>
                  <span>The Following Products developed by Bal World for this Admin</span><br>
                  <p style="padding-left:20px;padding-bottom:10px;">
                  <a href="https://www.balworld.in/post.php?id=12" target="_blank" class="text-info">BW-DBM Engine</a> - MicroBlogging Framework developed by Bal Sankar E, for Bal World Technologies.<br>
                  </p>
                  <span>other Resources used:</span><br>
                  <p style="padding-left:20px;">
                  <a href="https://jquery.com/" target="_blank" class="text-info">jQuery</a> - Javascript Library<br>
                  <a href="https://getbootstrap.com/docs/4.0/getting-started/introduction/" target="_blank" class="text-info">Bootstrap 4</a> - CSS Framework<br>
                  <a href="https://daneden.github.io/animate.css/" target="_blank" class="text-info">Animate</a> - CSS Animations<br>
                  </p>
                </div>
              </div>
            </div>
           <?php include_once('profile.php');?>                 
         </div>        
    </div>
<?php include_once('common/footer.php'); ?>