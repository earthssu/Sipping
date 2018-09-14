<?php
$personname=$_SESSION['personname'];
$personidx=$_SESSION['personidx'];
$personimage=$_SESSION['personimage'];

$username=$_SESSION['username'];
$useridx=$_SESSION['useridx'];

include 'db_conn.php';

if(!isset($_GET["idx"])){
  echo "Invalid value input";
  exit();
}

$idx = $_GET["idx"];
          
$sql = "SELECT * FROM `write` WHERE idx='$idx'";


// 데이터 가져오기
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);

$see = $row["see"]+1;

$sql_see = "UPDATE `write` SET see=$see WHERE idx=$idx";

$result_see = mysqli_query($db, $sql_see);
?>

<html>
<head>
	<!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="demo.css" />
    <link rel="stylesheet" type="text/css" href="backgroundTransition.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/hanna.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/jejugothic.css">
    <link rel="stylesheet" href="../css/sipping_style.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>SIPPING/Read</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
		.title {
			margin-top: 20px;
			text-align: center;
			font-size: 30px;
			font-family: 'Jeju Gothic';
			color: #ba68c8;
			border: solid 2px #6a1b9a;
		}
	</style>

	<script type="text/javascript">
		function mysubmit(num)
        {
            if(num == 1)
            {
                document.myform.action='./logout.php';
            }
            if (num == 2)
            {
                document.myform.action='./mainpage.php';
            }
            if (num == 3)
            {
                document.myform.action='./recommend.php';
            }
        }
	</script>
	<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=VVmyGRyYk6iAaaKci9Iz&submodules=geocoder"></script>
</head>
<body>
  <div>
		<form method="get" name="myform" enctype="multipart/form-data" style="margin-top: 10px; margin-right: 0%;">
			<input type="hidden" name="idx" value="<?=$idx?>">
			<button id="button" name="logout" class="btn waves-effect waves-light z-depth-0" type="submit" onclick="mysubmit(1)">LOGOUT</button>
			<button id="button" name="revision" class="btn waves-effect waves-light z-depth-0" type="submit" onclick="mysubmit(2)">MYPAGE</button>
    <form  method="get" action="./search_person.php">
      <span class="input-field col s6" style="float: right; margin-top: -55px; margin-right: 50px; height: 30px;">
        <input id="person" name="person" type="text" data-length="10">
      </span>
      <button class="btn-floating orange lighten-3 z-depth-0" type="submit" style="float: right; margin-top: -50px;"><i class="material-icons">navigate_before</i></button>
    </form>
		<hr style="border:solid 1px #6a1b9a;">
		<?php
		echo '<div style="width: 160px; float: left;"><img src="../picture/'.$personimage.'" alt="" class="circle responsive-img"></div>';
		?>
    <div id="main_name"><span style="color:#7e57c2;"><?=$personname?>의 공간</span></div>
		<hr style="border:solid 1px #6a1b9a;">
			
		<div class="title"><?=$row["title"]?></div>
		<div style="margin-top: 50px;"><?=$row["comment"]?></div>
		<br>
		<div id="map" style="width:100%;height:400px;"></div>
    <script>
      var map = new naver.maps.Map('map');
      var myaddress = "<?=$row["address"]?>";// 도로명 주소나 지번 주소만 가능 (건물명 불가!!!!)
      naver.maps.Service.geocode({address: myaddress}, function(status, response) 
      {
        if (status !== naver.maps.Service.Status.OK) {
          return alert(myaddress + '의 검색 결과가 없거나 기타 네트워크 에러');
        }
        var result = response.result;
        // 검색 결과 갯수: result.total
        // 첫번째 결과 결과 주소: result.items[0].address
        // 첫번째 검색 결과 좌표: result.items[0].point.y, result.items[0].point.x
        var myaddr = new naver.maps.Point(result.items[0].point.x, result.items[0].point.y);
        map.setCenter(myaddr); // 검색된 좌표로 지도 이동
        // 마커 표시
        var marker = new naver.maps.Marker({
            position: myaddr,
            map: map
        });
        // 마커 클릭 이벤트 처리
        naver.maps.Event.addListener(marker, "click", function(e) 
        {
          if (infowindow.getMap()) 
          {
            infowindow.close();
          } else 
          {
            infowindow.open(map, marker);
          }
        });
        // 마크 클릭시 인포윈도우 오픈
        var infowindow = new naver.maps.InfoWindow({
        content: '<h4> [네이버 개발자센터]</h4><a href="https://developers.naver.com" target="_blank"><img src="https://developers.naver.com/inc/devcenter/images/nd_img.png"></a>'
        });
      });
    </script>
    <br>
    <form action="./recommend.php" method="get" enctype="multipart/form-data">
      <input type="hidden" name="txt_idx" id="txt_idx" value="<?=$idx?>">
      <input type="hidden" name="name_idx" id="name_idx" value="<?=$useridx?>">
      <button id="button" name="recommend" class="btn waves-effect waves-light z-depth-0" style="align-self: right;" type="submit">RECOMMEND</button>
		</form>
	</div>
	<?php
	$sql = "SELECT * FROM `reply` WHERE writing_number=$idx";

	$result_reply = mysqli_query($db, $sql);

	if($result_reply)
	{
		while($row_reply = mysqli_fetch_array($result_reply))
		{
			echo '<div style="width: 20%; float: left; color: #9575cd; font-weight: bold;">'.$row_reply["name"].'</div>';
			echo '<div style="width: 40%; float: left; color: #9575cd;">'.$row_reply["text"].'</div>';
			echo '<div style="width: 20%; float: left; color: #9575cd;">'.$row_reply["date"].'</div>';
			echo '<div style="width: 5%; float: right; color: #9575cd;">'.'<a href="remove_reply.php?idx='.$row_reply["idx"].'">'."삭제".'</a></div>';
		}
		echo "<br>";
	}
					
	mysqli_free_result($result_reply);

	?>

	<form method="get" action="./reply_save.php">
		<br>
		<input type="hidden" name="idx" value="<?=$idx?>">

		<textarea id="reply" name="reply">댓글을 달아보세요</textarea>
		<div style="float: right; margin-bottom: 10px; margin-top: 10px;">
			<button class="btn waves-effect waves-light z-depth-0" type="submit" id="button">UPLOAD</button>
		</div>
	</form>
	<?php
	mysqli_close($db);
	?>
</body>
</html>