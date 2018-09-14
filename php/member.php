<?php

$useremail=$_SESSION['useremail'];
$username=$_SESSION['username'];
$useridx=$_SESSION['useridx'];
$userimage=$_SESSION['userimage'];

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

    <title>SIPPING/Member</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

    table {
    	margin-left: auto;
    	margin-right: auto;
    	align: center;

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
                document.myform.action='./revision.php';
            }
        }
	</script>
</head>
<body>
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
	<div>
		<form method="get" enctype="multipart/form-data">
			<table style="text-align: center;">
				<tr>
					<th style="color: #b39ddb; text-align: center;">IMAGE</th>
					<th style="color: #b39ddb; text-align: center;">NAME</th>
					<th style="color: #b39ddb; text-align: center;">PAGE</th>
					<th style="color: #b39ddb; text-align: center;">DEL</th>
				</tr>
					<?php
					
					include 'db_conn.php';

					$sql = "SELECT * FROM follow WHERE follower=$useridx";

					$result = mysqli_query($db,$sql);
					if($result)
					{
						while($row=mysqli_fetch_assoc($result))
						{	
							$member = $row['following'];

							$sql_person = "SELECT * FROM `sipping` WHERE idx=$member";
							$result_person = mysqli_query($db, $sql_person);
							$row_person = mysqli_fetch_assoc($result_person);
							echo "<tr>";
							echo '<td><div style="width: 70px; margin-left: auto; margin-right: auto; display: block;"><img src="../picture/'.$row_person["image"].'" class="circle responsive-img"></div></td>';
							echo '<td style="color: #b39ddb; text-align: center;">'.$row_person["name"]."</td>";
							echo '<td><a class="waves-effect waves-light btn deep-orange lighten-3 z-depth-0" href="search_person.php?person='.$row_person['name'].'">'.'GO'."</a></td>";
							echo '<td><a class="waves-effect waves-light btn deep-orange lighten-4 z-depth-0" href="remove_follow.php?idx='.$member.'">'.'DEL'."</a></td>";
							echo "</tr>";
						}
					echo '</table>';
					echo '</form>';
					}
					
					mysqli_free_result($result);
					mysqli_free_result($result_person);
					mysqli_close($db);
		
					?>
</body>
</html>