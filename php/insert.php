<?php

$useridx=$_SESSION['useridx'];

include 'db_conn.php';

$title=$_GET['title'];
$comment=$_GET['contents'];
$address=$_GET['address'];



$sql = "INSERT INTO `write`(`writer`, `title`, `comment`, `address`, `date`,`see`) VALUES ('$useridx','$title','$comment','$address',now(),0)";

mysqli_query($db, $sql);
mysqli_close($db);

echo "<script>alert('글이 성공적으로 작성되었습니다'); location.href='./mainpage.php';</script>";

?>