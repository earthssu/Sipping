<?php

$useridx=$_SESSION['useridx'];

include 'db_conn.php';

$title=$_GET['title'];
$comment=$_GET['contents'];
$address=$_GET['address'];

$idx = $_GET["idx"];

$sql = "UPDATE `write` SET title='$title', comment='$comment', address='$address' WHERE idx=$idx";

echo $sql;

mysqli_query($db, $sql);

mysqli_close($db);

echo "<script>alert('글이 성공적으로 수정되었습니다'); window.history.go(-2);</script>";

?>