<?php 
session_start();
require_once('../config/database.php');
require_once('../classes/post.php');
$newpost= new Post($pdo);
if(isset($_POST['submit'])&&isset($_FILES['newpost'])){
  echo "ADDED SUCCESSFULLY";
}else {
  header("Location:add_post.php");
}

?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap.min.css" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
      body{
        display:flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        min-height:100vh;
      }
    </style>
    
</head>
<body>

<form action="home.php" method="post" enctype="multipart/form-data">
  <div class="form-group" style="background-color:cornflowerblue" align=" center"><br>
    <h1 ><font color =white> Add Products For Sellers</h1><br>
  </div>
  <div class="form-group" align="center"> 
    <br> 
    <label><font color =blue><font size = 5>Description</label>
    <br>
    <textarea class="form-group" name="content" placeholder="Description" cols="60" rows="7"></textarea>
    <br><br> 
    <label >
        <font color =blue>upload an image of a product 
    </label>
    <input type="file" name="newpost" accept=".jpg , .jpeg , .png"  class="btn btn-primary" id="fileToUpload"> 
    <br><br>
    <input type="submit" value="Upload Image"  class="btn btn-primary" name="submit">
    <br>
  </div>
  <br>
</form>

</body>
</html>