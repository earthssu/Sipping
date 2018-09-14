<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['useremail'])) 
{
    session_destroy();
    //echo "<meta http-equiv='refresh' content='0;url=../index.html'>";
    
}

$useremail=$_SESSION['useremail'];
$username=$_SESSION['username'];
$useridx=$_SESSION['useridx'];

echo "<script>window.location.replace('./mainpage.php')</script>;";
?>