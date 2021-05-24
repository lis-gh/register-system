<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?> ">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<body>
    <div class="container">
<form method="GET"  >
        <input type="text" name="code" class="form-control mt-3">
        <button type="submit" name="verify" class="btn btn-warning mt-3">verify</button>
</form>

<?php

if(isset($_GET['verify']) ){
    session_start();
    $randomcode=$_SESSION['randomcode'];
    if($_GET['code']== $randomcode){
        
        $username="root";
        $password="";
        $database= new PDO("mysql:host=localhost;dbname=lis;charset=utf8;",$username,$password);

        $mail=$_SESSION['mail'];
        $fname=$_SESSION['fname'];
        $lname= $_SESSION['lname'];
        $pass=$_SESSION['pass'];
          $insertdata=$database->prepare("INSERT INTO users(fname,lname,mail,pass,role) VALUES('$fname', '$lname', '$mail', '$pass', 'user')");
          $insertdata->execute();
          echo '<div class="alert alert-success mt-3">
         you have registered successfully
        </div>';
      }else{
          echo 'it is wrong code';
      }

   
  }

?>
</div>
</body>
</html>

