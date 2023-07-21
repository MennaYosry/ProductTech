<?php 
require_once('../config/database.php');
$_SESSION=[];
session_unset();
session_destroy();
header('Location:dash.php');
?>