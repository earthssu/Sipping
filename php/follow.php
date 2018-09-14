<?php
$useridx=$_SESSION['useridx'];
$personidx=$_SESSION['personidx'];

include 'db_conn.php';

$sql = "SELECT * FROM `follow` WHERE follower=$useridx";

$sql_insert = "INSERT INTO `follow`(`following`, `follower`) VALUES ('$personidx','$useridx')";

if($result = mysqli_query($db,$sql))
{
	if(mysqli_num_rows($result)==0) //팔로우한 사람 아무도 없음
	{
		mysqli_query($db, $sql_insert);

		echo "<script>alert('팔로우 되었습니다');</script>";
		echo "<script>window.location.replace('./mainpage.php')</script>;";
	}
	else
    {
    	while($row = mysqli_fetch_assoc($result))
		{
			if(!strcmp($row["following"],$personidx))
			{
				echo "<script>alert('이미 팔로우한 회원입니다');</script>";
				echo "<script>window.location.replace('./mainpage.php')</script>;";
			}
		}
		mysqli_query($db, $sql_insert);

		echo "<script>alert('팔로우 되었습니다');</script>";
		echo "<script>window.location.replace('./mainpage.php')</script>;";
    }
}


mysqli_free_result($result);
mysqli_close($db);
?>