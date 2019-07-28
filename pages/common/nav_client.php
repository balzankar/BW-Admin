
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            <img src="../assets/img/bw_white.png">
          </a>
          <a href="javascript:void(0)" style="margin-top:2px;" class="simple-text logo-normal">
            <?php echo $user['name'];?>
          </a>
        </div>        

        <ul class="nav">
          <li>
            <a href="./dashboard_client.php">
              <i class="fa fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="./projects_clients.php">
              <i class="fa fa-cube"></i>
              <p>My Works</p>
            </a>
          </li>
          <li>
            <a href="./messages_send.php">
              <i class="fa fa-envelope"></i>
              <p>Messages</p>
            </a>
          </li>
          <li>
            <a href="mailto://info@balworld.in?subject=mail from <?php echo $user['name'];?> via Bal World Admin ">
              <i class="fa fa-share"></i>
              <p>Direct Email</p>
            </a>
          </li>
          <li>
            <a href="./user.php">
              <i class="fa fa-user"></i>
              <p>User Profile</p>
            </a>
          </li>         
          <li>
            <a href="./about.php">
              <i class="fa fa-info"></i>
              <p>About</p>
            </a>
          </li>
        </ul>