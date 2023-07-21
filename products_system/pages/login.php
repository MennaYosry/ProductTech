<?php 
session_start();
require_once('../classes/User.php');
require_once('../config/database.php');


// Check if the user is already logged in

if(isset($_SESSION['user_id']))
{
        header('Location:home.php');
        exit;
}

// Check if the login form is submitted

if($_POST && isset($_POST['login']) &&  isset($_POST['email']) &&  isset($_POST['password']))
{
       // Get the email and password from the form

    $email = ($_POST['email']);
    $password = ($_POST['password']);

        // Create a new User object
    $user = new User($pdo);

    // Try to log the user in
    $result = $user->login($email ,$password );

    if($result===true)
    {
        echo"<script type='text/javascript'> Logged in successfully </script>";
        header('Location: home.php');
        exit;
    }
    else
    {
                // If login fails, display an error message
        $error = $result;
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
        <div class="container">
            <form method="post">
                <br><h2 style="color:#069">Login</h2>
                <?php 
                if(isset($error)):
                ?>
                <ul style="background-color:antiquewhite">
                    <li >
                        <?=$error?>
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
                </div>
            </form>
        </div>
        </body>
    </html>
    
