<?php
$useremail=$_SESSION['useremail'];
$username=$_SESSION['username'];
$useridx=$_SESSION['useridx'];
$userimage=$_SESSION['userimage'];

$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$phone=$_POST['phone'];

if(!isset($_FILES['upload']))
{
	$change_file_name = $userimage;
}
else
{
	$uploadfile = $_FILES['upload'] ['name'];
	$uploadfile_type = $_FILES['upload']['type'];
	$uploadfile_size = $_FILES['upload']['size'];
	$tmp_name = $_FILES['upload']['tmp_name'];
	$error = $_FILES['upload']['error'];

	// 파일명 변경 (업로드되는 파일명을 별도로 생성하고 원래 파일명을 별도의 변수에 지정하여 DB에 기록할 수 있습니다.)

	$real_name = $uploadfile;     // 원래 파일명(업로드 하기 전 실제 파일명) 

	$arr = explode(".", $real_name);	 // 원래 파일의 확장자명을 가져와서 그대로 적용 $file_exe	
	$arr1 = $arr[0];	
	$arr2 = $arr[1];	

	$file_exe = $arr2;

	$file_time = time(); 

	$file_Name = "file_".$file_time.".".$file_exe;	 
	// 실제 업로드 될 파일명 생성	(본인이 원하는 파일명 지정 가능)	 
	$change_file_name = $file_Name;			 
	// 변경된 파일명을 변수에 지정 
	$real_name = addslashes($real_name);		
	// 업로드 되는 원래 파일명(업로드 하기 전 실제 파일명) 
	$real_size = $uploadfile_size;                         
	// 업로드 되는 파일 크기 (byte)

	//파일을 저장할 디렉토리 및 파일명 전체 경로

	$target = '../picture/'.$change_file_name;

	move_uploaded_file($tmp_name, $target);
}

$pw_encode = md5($password);

include 'db_conn.php';

$sql = "UPDATE sipping SET name='$name', email='$email', password='$pw_encode', phone='$phone', image='$change_file_name' WHERE idx=$useridx";

mysqli_query($db, $sql);

$sql_revision = "SELECT * FROM `sipping` WHERE idx=$useridx";

$result = mysqli_query($db, $sql_revision);

$row = mysqli_fetch_assoc($result);

$_SESSION['username']=$row["name"];
$_SESSION['userimage']=$row["image"];

$username=$_SESSION['username'];
$userimage=$_SESSION['userimage'];

mysqli_free_result($result);
mysqli_close($db);

echo "<script>alert('회원님의 정보가 정상적으로 수정되었습니다'); location.href='./mainpage.php';</script>";
?>