<?php
require_once('../config/database.php');
include('header.php');
$message="";
if(isset($_GET['id'])){
    $post_id=$_GET['id'];
    $query=mysqli_query($connection,"SELECT * FROM posts WHERE id='$post_id'");
    $post=mysqli_fetch_assoc($query);

if(isset($_POST['comment'])){
    $content=$_POST["content"];
    $user_id=$_SESSION["user_id"];
    if(empty($content)){
        $message="please, Enter comment before click on add";
    }
    else {
        $query="INSERT INTO comments (user_id,post_id,content) VALUES ('$user_id','$post_id','$content')";
        mysqli_query($connection,$query);
        $message="Added successfully";

    }
}
}
$sql="SELECT * FROM comments order by created_at";
$all_comments=$connection->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            padding: 0;
            margin : 0 ; 
            box-sizing: border-box;
        }
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
         
         
         main{
            max-width: 1500px;
            width:97%;
            margin:30px auto;
            display:flex;
            flex-wrap: wrap;
            gap:20px
         }
         main .card-container{
            height: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border :1px solid lightgray;
            gap:5px;
            text-align: center;
            padding-bottom: 20px;
            
         }
       
         main .card-container .image img{
            width: 300px;
            height: 300px;
            
         }
         main .card-container .caption p{
            color:black;
            margin-bottom: unset;
            max-width: 300px;
            word-wrap: break-word;
         }
         main .card-container .caption a{
            color:red;
         }
    </style>
</head>
<body>
<form method="post">
    <main>
        <div class="card-container" align=center>
            <div class="image">
                <img src="images/<?php echo $post["image"];?>" alt="">
            </div>
            <div class="caption">
                <p><?php echo $post["content"]?></p><br>  
            </div>
        </div>
        <div>
        </div>
    </main><br>
    <div align = "left" class="container">
    <div class="col-xs-4">
    <h5><font color=red> You can add a comment , <?php echo ($_SESSION['username']);?></h5>
    <form action="" method="post">
    <input type="text" name="content" size ="40" class="form-control" placeholder="Add Comment"><br>
    <?php if ($message!=""):?>
        <ul style="background-color:antiquewhite">
            <li ><font color =red>
                <?=$message?>
            </li>
        </ul>
    <?php endif ?>
    <button type="submit" name="comment" class="btn btn-primary">ADD</button>
        </form>
        <?php 
        while($row =mysqli_fetch_assoc($all_comments)){?>
         </div>
    </div><br><br>
        <div class="caption">
                <a><font color=red>
                    <?php
                    $user_id=$row["user_id"];
                    $sql="SELECT username FROM users WHERE id='$user_id'";
                    $sql=$connection->query($sql);
                    $user=mysqli_fetch_assoc($sql);
                    echo($user['username']);
                    ?>
                </a>
                <p style="border:blue; border-width:2px; border-style:inset;"><font color = black>
                    <?php echo $row["content"]?>
                </p>
        </div>
        <?php } ?>
    </form>
</body>
</html>