<?php
$username=$_SESSION['username'];
$useridx=$_SESSION['useridx'];

include 'db_conn.php';

if(!isset($_GET["idx"])){
	echo "Invalid value input";
	exit();
}

$idx = $_GET["idx"];

$sql = "DELETE FROM `write` WHERE idx='$idx'";


mysqli_query($db, $sql);
mysqli_close($db);


echo "<script>alert('정상적으로 삭제되었습니다'); location.href='./mainpage.php';</script>";
?>