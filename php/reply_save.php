<?php
$useremail=$_SESSION['useremail'];
$username=$_SESSION['username'];
$useridx=$_SESSION['useridx'];

$text = $_GET["reply"];

$idx = $_GET["idx"];

include 'db_conn.php';

$sql = "INSERT INTO `reply`(`writing_number`,`name`, `text`, `date`) VALUES ($idx,'$username','$text',now())";

mysqli_query($db, $sql);
mysqli_close($db);

echo "<script>window.history.go(-1);</script>";
?>