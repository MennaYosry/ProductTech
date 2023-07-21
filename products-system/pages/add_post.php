<?php 
$message = "";
require_once('../config/database.php');
if(isset($_POST['addpost'])){
  $description=$_POST['description'];
  if($_FILES['newpost']['error']===4){
    $message="Image doesn't exist";
  }
  else{
    $filename=$_FILES['newpost']['name'];
    $filesize=$_FILES['newpost']['size'];
    $tmpname=$_FILES['newpost']['tmp_name'];

    $validimageextension=['jpeg','jpg','png'];
    $imageextension=explode('.',$filename);
    $imageextension=strtolower(end($imageextension));
    if(!in_array($imageextension,$validimageextension)){
      $message="Invalid Image Extension";
    }else if($filesize>100000000){
      $message="Image size is too large";
    }else{
      $newimagename=uniqid();
      $newimagename .='.'. $imageextension;
      move_uploaded_file($tmpname ,'images/' . $newimagename);
      $query = "INSERT INTO posts (user_id , content , image) VALUES ('$_SESSION[user_id]','$description','$newimagename')";
      mysqli_query($connection , $query);
      $message="Added Successfully";
    }
  }
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

<form method="post" enctype="multipart/form-data">
  <div class="form-group" style="background-color:cornflowerblue" align=" center"><br>
   <h1 ><font color =white> Add Products For Clients</h1>       
   <a style='font-size: 27px' href='home.php'><font color=red>Home</a><br>
    <?php 
                if($message!=""):
                ?>
                <ul style="background-color:antiquewhite">
                    <li ><font color =red>
                        <?=$message?>
                    </li>
                </ul>
                <?php endif ?>
  </div>
  <div class="form-group" align="center"> 
    <br> 
    <label><font color =blue><font size = 5>Description</label>
    <br>
    <textarea class="form-group" name="description" placeholder="Description" cols="60" rows="7"></textarea>
    <br><br> 
    <label >
        <font color =blue>upload an image of a product 
    </label>
    <input type="file" name="newpost" accept=".jpg , .jpeg , .png"  class="btn btn-primary" id="fileToUpload"> 
    <br><br>
    <input type="submit" value="Upload Image"  class="btn btn-primary" name="addpost">
    <br>
  </div>
  <br>
</form>

</body>
</html>