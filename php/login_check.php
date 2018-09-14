<?php

$email=$_POST['email'];
$pass=$_POST['password'];

include 'db_conn.php';

$pass_encode = md5($pass);
//아이디 비번 확인
$table_name = "sipping";
$sql = "SELECT * FROM $table_name WHERE email='$email'";


if($result = mysqli_query($db,$sql))
{
	if(mysqli_num_rows($result)==0)
	{
		echo "<script>alert('로그인 정보가 올바르지 않습니다.');</script>";
		echo "<script>window.location.replace('../index.html')</script>;";
	}
	else
    {
        $row = mysqli_fetch_assoc($result);
        if(!strcmp($row["password"],$pass_encode)) // 로그인 성공
        {
            //session_start();

            //세션 변수 만들기
            $_SESSION['useremail']=$email;
            $_SESSION['username']=$row["name"];
            $_SESSION['useridx']=$row["idx"];
            $_SESSION['userimage']=$row["image"];
            // 리디렉션
            echo "<script>location.href='./mainpage.php';</script>";
            
        }
        else
        {
            echo "<script>alert('로그인 정보가 올바르지 않습니다.');</script>";
            echo "<script>window.location.replace('../index.html');</script>";
        }
    }
}

mysqli_free_result($result);
mysqli_close($db);

?>