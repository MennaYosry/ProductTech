<?php 
require_once('../config/database.php');
if(isset($_POST["login"])){
    header('Location:login.php');
}
$message="";
if(isset($_POST["register"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $email=$_POST["email"];
    $duplicate=mysqli_query($connection , "SELECT * FROM users WHERE email='$email'");
    if(empty($username)|| empty($email)|| empty($password)){
        $message="Please enter all data in the form"; 
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
           $message="Please enter a valid email";
    }
    elseif(mysqli_num_rows($duplicate)>0){
        $message="Email has token";
    }else {
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $query="INSERT INTO users (username,email,password) VALUES ('$username','$email','$hash')";
        mysqli_query($connection,$query);
        header('Location:login.php');
    }
}
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration form </title>
        
    </head>
    <body>
    <?php include('header.php');?> 
        <div class="container">

            <form method="post">
                <br><h2 style="color:#069">Registration</h2>
                <?php 
                if($message!=""):
                ?>
                <ul style="background-color:antiquewhite">
                    <li ><font color =red>
                        <?=$message?>
                    </li>
                </ul>
                <?php endif ?>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="username"><br>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="email"><br>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="password"><br>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="register">register</button>
                    <button type="submit" class="btn btn-primary" style="background-color:darkred"  name="login">Login</button>
                </div>
                <br>
            </form>
        </div>
        </body>
    </html>
    
