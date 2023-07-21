<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
    <?php include('header.php');?>
    <div align="right">
        <pre>
        <a method="post" style='font-size: 27px' href='logout.php'><font color=red>Logout</a> 
        </pre>
    </div>
    <div align=center>
        <pre>
<a href="deleteproduct.php" style="border:blue; border-width:3px; border-style:inset; font-size: 40px;">. Products .</a>    <a href="deleteuser.php" style="border:blue; border-width:3px; border-style:inset; font-size: 40px;">.  Users  .</a>
</pre>
</div>
</body>
</html>