<?php
$useremail=$_SESSION['useremail'];
$username=$_SESSION['username'];
$useridx=$_SESSION['useridx'];

include 'db_conn.php';

$sql = "DELETE FROM `sipping` WHERE idx=$useridx";

mysqli_query($db, $sql);

$sql_ = "DELETE FROM `write` WHERE writer=$useridx";

mysqli_query($db, $sql_);

mysqli_close($db);

session_destroy();

echo "<script>alert('정상적으로 탈퇴되었습니다'); location.href='../index.html';</script>";
?>