<?php
include 'init2.php';
if(isset($_POST['signup'])){
  $password = $_POST['password'];
  $error = '';

  if(empty($password)){
    $error = 'OTP missing';
  }else {
    $password = $getFromU->checkInput($password);
    
    if($getFromU->otpD($password) === false){
          $errorMsg = " The otp is incorrect!";
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
  <h1>OTP</h1>


  <div class="textbox">
    <i class="fas fa-lock"></i>
    <input type="password" name="password" placeholder="Enter OTP">
  </div>

  <input type="submit" class="btn"   name="signup" Value="Signup">


   <?php
      if(isset($error)){
        echo '
        <div class="span-fp-error">'.$error.'</div>
        ';
      }
    ?>

    <?php
      if(isset($errorMsg)){
        echo '
        <div class="span-fp-error">'.$errorMsg.'</div>
        ';
      }
    ?>

  </form>
</div>

  </body>
</html>