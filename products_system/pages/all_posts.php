<?php 
require_once('../config/database.php');
require_once('../classes/post.php');

$newpost= new Post($pdo);
$posts=$post->readallposts();
if($posts){
    
}
?> 