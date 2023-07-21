<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form </title>
    <style>
        a { 
            display: inline-block;

            transition: .3s;

            font-weight:bold;
 
            text-decoration:none;
        }
        a:hover {
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
         }
    </style>
</head>
<body>
    <?php require('header.php'); ?>
    
    <div align="right">
        <pre>
        <a method="post" style='font-size: 27px' href='logout.php'><font color=red>Logout</a>       <a style='font-size: 27px' href='add_post.php'><font color=red>Add Product</a>   
        </pre>
    </div>
    <?php include('allposts.php'); ?>
</body>
</html>