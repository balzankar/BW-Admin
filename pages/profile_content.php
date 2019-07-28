            <div class="card card-user" style="height:500px;">
              <div class="card-header">
                <div class="dropdown">
                  <button class="btn dropdown-toggle btn-link btn-gear btn-icon" data-toggle="dropdown" style="">
                    <i class="fa fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="user_edit.php">Edit Profile</a>
                  </div>
                </div>
              </div>
              <div class="card-body" style="overflow-y:auto;">
                <div class="card-text">
                  <div class="author">
                    <div class="block block-one"></div>
                    <div class="block block-two"></div>
                    <div class="block block-three"></div>
                    <div class="block block-four"></div>
                    <a href="javascript:void(0)">
                      <img class="avatar profile-pic" src="../uploads/users/<?php echo $user['image'];?>" alt="img">
                      <h5 class="title"><?php echo $user['name'];?><br><?php echo $user['designation'];?></h5>
                    </a>
                    <p class="description"><?php echo $user['company'];?></p>
                  </div>
                </div>
                  <div>
                <div class="card-description">                      
                    <h5 class="title" style="margin-bottom:0px;">About Me <a title="Edit About You" class="fa fa-pencil ml-1 text-info" href="user_edit.php"></a></h5>
                  <?php echo remove_junk($user['about_user']); ?>                    
                    <h5 class="title" style="margin-bottom:0px;margin-top:10px;">My Skills <a title="Edit Your Skills" class="fa fa-pencil ml-1 text-info" href="user_edit.php"></a></h5><?php echo remove_junk($user['skills']); ?>    
                    <h5 class="title" style="margin-bottom:0px;margin-top:10px;">Email</h5><?php echo remove_junk($user['email']); ?>
                    <h5 class="title" style="margin-bottom:0px;margin-top:10px;"></h5>
                </div></div>
              </div>

              <!-- <div class="card-footer">
                <div class="button-container">
                  <a href="http://www.facebook.com/<?php echo $user['username'];?>" target="_blank"><button class="btn btn-icon btn-round btn-facebook">
                    <i class="fab fa-facebook"></i>
                   </button></a>                  
                    <a href="http://www.facebook.com/<?php echo $user['username'];?>" target="_blank"><button class="btn btn-icon btn-round btn-facebook">
                    <i class="fab fa-linkedin"></i>
                   </button></a>                  
                    <a href="http://www.facebook.com/<?php echo $user['username'];?>" target="_blank"><button class="btn btn-icon btn-round btn-facebook">
                    <i class="fa fa-envelope"></i>
                   </button></a>                  
                    <a href="http://www.facebook.com/<?php echo $user['username'];?>" target="_blank"><button class="btn btn-icon btn-round btn-facebook">
                    <i class="fab fa-github"></i>
                   </button></a>                  
                    <a href="http://www.facebook.com/<?php echo $user['username'];?>" target="_blank"><button class="btn btn-icon btn-round btn-facebook">
                    <i class="fab fa-twitter"></i>
                   </button></a>
                </div>
              </div> -->
                
            </div>