<?php
require_once('../config/database.php');
if(isset($_POST["register"])){
    header('Location:register.php');
}
$message="";
if(isset($_POST["login"])){
    $password=$_POST["password"];
    $email=$_POST["email"];
    if(empty($email)|| empty($password)){
        $message="Please enter all data in the form"; 
    }
    $result=mysqli_query($connection,"SELECT * FROM users WHERE email='$email'");
    $user=mysqli_fetch_assoc($result);
    if($email == "Admin@ProductTech.com" && password_verify($password , $user['password'])){
        header('Location:admin.php');
    }
    elseif ($user && password_verify($password, $user['password'])) {
    
        $_SESSION['user_id']=$user['id'];
        $_SESSION['username']=$user['username'];
        $_SESSION['email']=$user['email'];
        $_SESSION['login']=true;
        
        header('Location:home.php');
        exit;
    } else {
        // The username or password is incorrect
        $message="The email or password is incorrect";
    }
}

 ?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login form </title>
        
    </head>
    <body>
    <?php include('header.php');?>
        <div class="container">
            <form method="post">
                <br><h2 style="color:#069">Login</h2>
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
                    <input type="email" class="form-control" name="email" placeholder="email"><br>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="password"><br>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                    <button type="submit" class="btn btn-primary" name="register" style="background-color:darkred">register</button>
                </div>
            </form>
        </div>
        </body>
    </html>
    
