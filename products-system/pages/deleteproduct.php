<?php 
require_once('../config/database.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
            height: 600px;;
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
    <?php
     include('header.php');
     require_once('../config/database.php');
     if(isset($_GET['id'])){
        $post_id=$_GET['id'];
        $query=mysqli_query($connection,"DELETE FROM posts WHERE id='$post_id'");
        $message="Deleted Successfully";
    }
    
     $sql="SELECT * FROM posts order by created_at";
     $all_product=$connection->query($sql);
     if($message ==="Deleted Successfully"):
        ?>
        <ul style="background-color:antiquewhite">
            <li ><font color =red>
                <?=$message?>
            </li>
        </ul>
        <?php endif ?>
    <main>
        <?php 
        
        while($row =mysqli_fetch_assoc($all_product)){
            $result_id=$row["id"];
            $user_id=$row["user_id"];
            $sql="SELECT username FROM users where id='$user_id'";
            $username=$connection->query($sql);
            $username =mysqli_fetch_assoc($username);
        ?>
        <div class="card-container">
            <h1><font color = red><?php echo ($username['username']);?></h1>
            <div class="image">
                <img src="images/<?php echo $row["image"];?>" alt="">
            </div>
            <div class="caption">
                <p><?php echo $row["content"]?></p><br> 
                <a href="deleteproduct.php?id=<?php echo $result_id;?>">Delete</a> 
            </div>
        </div>
        <?php }?>  
    </main>
    
</body>
</html>