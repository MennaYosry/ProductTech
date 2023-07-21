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
            width: 100px;
            height: 100px;
            
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
        $user_id=$_GET['id'];
        $query=mysqli_query($connection,"DELETE FROM users WHERE id='$user_id'");
        $message="Deleted Successfully";
    }
    
     $sql="SELECT * FROM users order by created_at";
     $all_users=$connection->query($sql);
     if($message ==="Deleted Successfully"):
        ?>
        <ul style="background-color:antiquewhite">
            <li ><font color =red>
                <?=$message?>
            </li>
        </ul>
        <?php endif ?>
        <?php 
        
        while($row =mysqli_fetch_assoc($all_users)){
            $result_id=$row["id"];
        ?>
        <div align= center style="border:blue; border-width:3px; border-style:inset;font-size: 25px;">
      
                <label><font color =blue><?php echo $row["username"];?></label>
            <div class="caption">
                <p><font color =black><?php echo $row["email"]?></p><br> 
                <a href="deleteuser.php?id=<?php echo $result_id;?>"> <font color = red> Delete</a> 
            </div>
        </div><br><br>
        <?php }?>  
</body>
</html>