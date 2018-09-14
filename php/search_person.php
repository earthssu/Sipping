<?php
$person=$_GET['person'];

include 'db_conn.php';

$sql = "SELECT * FROM `sipping` WHERE name='$person'";

$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

$_SESSION['personname']=$row["name"];
$_SESSION['personidx']=$row["idx"];
$_SESSION['personimage']=$row['image'];

$username=$_SESSION['username'];
$useridx=$_SESSION['useridx'];

$person_num = $row['idx'];
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
    <link rel="stylesheet" href="../css/sipping_style.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>SIPPING/Main</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
    table {
    	margin-right: auto;
    	margin-left: auto;  
    }
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
                document.myform.action='./mainpage.php';
            }
            if(num == 3)
            {
                document.myform.action='./follow.php';
            }
        }
	</script>
</head>
<body>
	<form method="post" name="myform" enctype="multipart/form-data" style="margin-top: 10px; margin-right: 0%;">
		<button id="button" name="logout" class="btn waves-effect waves-light z-depth-0" type="submit" onclick="mysubmit(1)">LOGOUT</button>
		<button id="button" name="logout" class="btn waves-effect waves-light z-depth-0" type="submit" onclick="mysubmit(2)">MYPAGE</button>
		<button id="button" name="logout" class="btn waves-effect waves-light z-depth-0" type="submit" onclick="mysubmit(3)">FOLLOW</button>
	</form>
	<form  method="get" action="./search_person.php">
		<span class="input-field col s6" style="float: right; margin-top: -55px; margin-right: 50px; height: 30px;">
            <input id="person" name="person" type="text" data-length="10">
          </span>
          <button class="btn-floating orange lighten-3 z-depth-0" type="submit" style="float: right; margin-top: -50px;"><i class="material-icons">navigate_before</i></button>
	</form>
	<hr style="border:solid 1px #6a1b9a;">
	<?php
		echo '<div style="width: 160px; float: left;"><img src="../picture/'.$row['image'].'" alt="" class="circle responsive-img"></div>';
	?>
	<div id="main_name"><?=$row['name']?>의 공간</div>
	<hr style="border:solid 1px #6a1b9a;">
	<div>
		<form method="get" enctype="multipart/form-data">
			<table style="text-align: center;">
				<tr>
					<th style="color: #b39ddb; text-align: center;">TITLE</th>
					<th style="color: #b39ddb; text-align: center;">DATE</th>
					<th style="color: #b39ddb; text-align: center;">VIEW</th>
					<th style="color: #b39ddb; text-align: center;">RECOMMEND</th>
				</tr>
					<?php
					$sql_txt = "SELECT * FROM `write` WHERE writer=$person_num";

					if($result_txt = mysqli_query($db, $sql_txt))
					{
						while($row_txt = mysqli_fetch_assoc($result_txt))
						{
							echo "<tr>";
							echo '<td><a style="color: #9575cd;" href="search_read.php?idx='.$row_txt["idx"].'"><strong>'.$row_txt["title"]."</strong></a></td>";
							echo '<td style="color: #b39ddb; text-align: center;">'.$row_txt["date"]."</td>";
							echo '<td style="color: #b39ddb; text-align: center;">'.$row_txt["see"]."</td>";
							echo '<td style="color: #b39ddb; text-align: center;">'.$row_txt["recommend"]."</td>";
							echo "</tr>";
						}
					echo '</table>';
					echo '</form>';
					}
					
					mysqli_free_result($result);
					mysqli_close($db);
		
					?>
</body>
</html>