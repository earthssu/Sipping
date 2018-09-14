<?php
$txt_idx = $_GET["txt_idx"];
$name_idx = $_GET["name_idx"];

include 'db_conn.php';

$sql = "SELECT * FROM recommend WHERE txt=$txt_idx";
$sql_recom = "INSERT INTO `recommend`(`txt`, `name`) VALUES ('$txt_idx','$name_idx')";
$sql_ = "SELECT * FROM `write` WHERE idx=$txt_idx";


if($result = mysqli_query($db,$sql))
{
	if(mysqli_num_rows($result)==0) //글 추천한 사람 아무도 없음
	{
		mysqli_query($db,$sql_recom);

		$result_ = mysqli_query($db,$sql_);
		$row_ = mysqli_fetch_assoc($result_);

		$rec = $row_["recommend"]+1;
		$sql_wt = "UPDATE `write` SET recommend=$rec WHERE idx=$txt_idx";
		mysqli_query($db,$sql_wt);

		echo "<script>alert('추천되었습니다'); window.history.go(-1);</script>";
	}
	else
    {
        $row = mysqli_fetch_assoc($result);
        if(!strcmp($row["name"],$name_idx)) //이미 추천함
        {
        	echo "<script>alert('이미 추천하셨습니다'); window.history.go(-1);</script>";
            
        }
        else //아직 추천 안 함
        {
        	mysqli_query($db,$sql_recom);

			$result_ = mysqli_query($db,$sql_);
			$row_ = mysqli_fetch_assoc($result_);

			$rec = $row_["recommend"]+1;
			$sql_wt = "UPDATE `write` SET recommend=$rec WHERE idx=$txt_idx";
			mysqli_query($db,$sql_wt);

			echo "<script>alert('추천되었습니다'); window.history.go(-1);</script>";
        }
    }
}


mysqli_free_result($result);
mysqli_close($db);
?>