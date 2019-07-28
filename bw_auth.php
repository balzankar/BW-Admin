<?php include_once('pages/includes/load.php'); 
?>
<?php

$req_fields = array('email','password' );
validate_fields($req_fields);
$email = remove_junk($_POST['email']);
$password = remove_junk($_POST['password']);

  if(empty($errors)){

    $user = authenticate_v2($email, $password);

        if($user):
           //create session with id
           $session->login($user['id']);
           //Update Sign in time
           updateLastLogIn($user['id']);
           // redirect user to group home page by user level
           if($user['user_level'] === '1'):
             $session->msg("s", "Hello ".$user['name'].", Welcome to Bal World Admin.");
             redirect('pages/dashboard.php',false);
           elseif ($user['user_level'] === '2'):
              $session->msg("s", "Hello ".$user['name'].", Welcome to Bal World Admin.");
             redirect('pages/dashboard.php',false);
           else:
              $session->msg("s", "Hello ".$user['name'].", Welcome to Bal World Admin.");
             redirect('pages/dashboard_client.php',false);
           endif;

        else:
          $session->msg("d", "Sorry Username/Password incorrect.");
          redirect('../index.php',false);
        endif;

  } else {

     $session->msg("d", $errors);
     redirect('../index.php',false);
  }

?>
