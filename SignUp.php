<?php
include 'init2.php';
if(isset($_POST['signup'])){
  $screenName = $_POST['screenName'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $error = '';

  if(empty($screenName) or empty($password) or empty($email)){
    $error = 'All fields are required';
  }else {
    $email = $getFromU->checkInput($email);
    $screenName = $getFromU->checkInput($screenName);
    $password = $getFromU->checkInput($password);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email format";
    }
    else if(strlen($screenName) > 20){
      $error = 'Name must be between in 6-20 characters';
    }else if(strlen($password) < 5){
      $error = 'Password is too short';
    }else {
      if($getFromU->checkEmail($email) === true){
        $error = 'Email is already in use';
      }else {
        $password = md5($password);
        $otp=rand(100000,999999);

      /*  $mail_status = $getFromU->sendOTP($_POST["email"],$otp);
        if($mail_status == 1){
          $result = mysqli_query("INSERT INTO otp_expiry(otp,is_expired,create_at) VALUES('" .$otp.  "', 0, '" .date("Y-m-d H:i:s"). "') ");
        }*/

        $user_id = $getFromU->create('users', array('email' => $email, 'password' => $password , 'screenName' => $screenName, 'otp' => $otp));
        $_SESSION['user_id'] = $user_id;

        header('Location:signUp2.php?step=1');
      }
    }
  }
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    
     <link rel="stylesheet" type="text/css" href="css/second.css">
  </head>
  <body>
<div class="login-box">
  <form method="post">
  <h1>Sign Up</h1>

  <div class="textbox">
    
     <input type="text" name="screenName" placeholder="Full Name"/>
  </div> 
  <div class="textbox">
   
    <input type="text" name="email" placeholder="Email">
  </div>

  <div class="textbox">
    
    <input type="password" name="password" placeholder="Password">
  </div>

  <input type="submit" class="btn"   name="signup" Value="Signup">


   <?php
      if(isset($error)){
        echo '
        <div class="span-fp-error">'.$error.'</div>
        ';
      }
    ?>
  </form>
</div>

  </body>
</html>