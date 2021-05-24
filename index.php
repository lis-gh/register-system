<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?> ">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Navbar</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    </ul>
  </div>
</nav>
<div class="container mt-3">
<form method="POST">
<div class="form-group">
    <label >Email address:</label>
    <input type="email" class="form-control" name="mail" placeholder="Enter email" required>
  </div>
  <div class="form-group">
    <label >First Name:</label>
    <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required>
  </div>
  <div class="form-group">
    <label >Last Name:</label>
    <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" required>
  </div>
  <div class="form-group">
    <label >Password:</label>
    <input type="password" class="form-control" name="pass" placeholder="Enter password" required>
  </div>
  <button class="btn btn-dark" type="submit" name="signin">register</button>


</form>

<form method="POST"  >
        <button type="submit" name="login" class="btn btn-success mt-3">login</button>
</form>

<?php

$username="root";
$password="";
$database= new PDO("mysql:host=localhost;dbname=lis;charset=utf8;",$username,$password);

if(isset($_POST['signin'])){
    $mail=$_POST['mail'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $pass=$_POST['pass'];
    
    
    $checkmail=$database->prepare("SELECT * FROM users where mail='$mail'");
    $checkmail->execute();
    if($checkmail->rowCount() >0){
        echo '<div class="alert alert-danger mt-3">
        you have already registered with this email!
      </div>';
    }else{
        $randomcode=rand(100000,999999); 

        session_start();
        $_SESSION['mail']=$mail;
        $_SESSION['fname']=$fname;
        $_SESSION['lname']=$lname;
        $_SESSION['pass']=$pass;
        $_SESSION['randomcode']=$randomcode;
     
       require_once "mail.php";
        $mail->addAddress($_POST['mail']);
        $mail->Subject = 'verify your account';
        $mail->Body    = 'This is your verification code <b>'.$randomcode.'</b>';
        $mail->send();
        header("Location:verify.php");
        
      
        
    }

}elseif(isset($_POST['login'])){
 header("Location:login.php");
}

?>

</div>
    
</body>
</html>