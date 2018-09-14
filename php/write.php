<?php

$useremail=$_SESSION['useremail'];
$username=$_SESSION['username'];
$useridx=$_SESSION['useridx'];
$userimage=$_SESSION['userimage'];

?>

<html>
	<head>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="demo.css" />
        <link rel="stylesheet" type="text/css" href="backgroundTransition.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/hanna.css">
        <link rel="stylesheet" href="../css/sipping_style.css">

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title>SIPPING/Write</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<style>

    </style>

    	<script type="text/javascript">
		function mysubmit(num)
        {
            if(num == 1)
            {
                document.myform.action='./logout.php';
            }
            if(num == 2)
            {
                document.myform.action='./revision.php';
            }
            if(num == 3)
            {
                document.myform.action='./map.php';
            }
            if(num == 4)
            {
                document.myform.action='./insert.php';
            }
        }

	</script>
	<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=VVmyGRyYk6iAaaKci9Iz&submodules=geocoder"></script>
	</head>
	<body onload="LoadPage();">
		<div>
			<form method="post" name="myform" enctype="multipart/form-data" style="margin-top: 10px; margin-right: 0%;">
				<button id="button" name="logout" class="btn waves-effect waves-light z-depth-0" type="submit" onclick="mysubmit(1)">LOGOUT</button>
				<button id="button" name="logout" class="btn waves-effect waves-light z-depth-0" type="submit" onclick="mysubmit(2)">REVISION</button>
			</form>
      <form  method="get" action="./search_person.php">
        <span class="input-field col s6" style="float: right; margin-top: -55px; margin-right: 50px; height: 30px;">
          <input id="person" name="person" type="text" data-length="10">
        </span>
        <button class="btn-floating orange lighten-3 z-depth-0" type="submit" style="float: right; margin-top: -50px;"><i class="material-icons">navigate_before</i></button>
      </form>
			<hr style="border:solid 1px #6a1b9a;">
			<?php
			echo '<div style="width: 160px; float: left;"><img src="../picture/'.$userimage.'" alt="" class="circle responsive-img"></div>';
			?>
      <div id="main_name"><a href="./mainpage.php" style="color:#7e57c2;"><?=$username?>의 공간</a></div>
			<hr style="border:solid 1px #6a1b9a;">
			<form method="get" action="./insert.php">
          <div class="input-field col s12">
            <input name="title" id="title" type="text" class="validate">
          </div>
				  <textarea id="contents" name="contents"></textarea>
          <script>
          var editor = CKEDITOR.replace( 'contents' );

          CKFinder.setupCKEditor( editor );

          </script>
				  <br>
				  <div id="map" style="width:100%;height:400px;"></div>
    			<script>
      				var map = new naver.maps.Map('map');
      				var myaddress = document.getElementById("address").value;// 도로명 주소나 지번 주소만 가능 (건물명 불가!!!!)
      				naver.maps.Service.geocode({address: myaddress}, function (status, response) 
      				{
          				if (status !== naver.maps.Service.Status.OK) 
          				{
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
          				naver.maps.Event.addListener(marker, "click", function(e) {
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
        <div class="input-field col s12">
				  <input id="address" name="address" type="text" value="도로명 주소 또는 지번 주소를 입력해주세요 (건물명 불가)">
        </div>
				<button id="button" name="insert" class="btn waves-effect waves-light z-depth-0" style="float: right;" type="submit">UPLOAD</button>
			</form>	
		</div>	
	</body>
</html>