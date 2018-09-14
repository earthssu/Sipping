<?php

$useremail=$_SESSION['useremail'];
$username=$_SESSION['username'];
$userimage=$_SESSION['userimage'];
$useridx=$_SESSION['useridx'];

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

    <title>SIPPING/Revision</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        #revision_box {
            width: 550px; 
            height: 550px;
            margin-left: auto; 
            margin-right: auto;
            margin-top: 50px;
            display: block; 
            border-radius: 10%; 
            background-color: rgba(255,255,255,0.3);
            padding-top: 20px;
            padding-left: 40px;
            padding-right: 60px;
            padding-bottom: 20px;
        }
	</style>

	<script type="text/javascript">
		function mysubmit(num)
        {
            if(num == 1)
            {
                document.myform.action='./out.php';
            }
            if(num == 2)
            {
                document.myform.action='./revision_save.php';
            }
        }
	</script>
</head>
<body>
	<div>
		<form method="post" enctype="multipart/form-data" style="margin-top: 10px; margin-right: 0%;" action="./php/logout.php">
			<button id="button" name="logout" class="btn waves-effect waves-light z-depth-0" type="submit">LOGOUT</button>
		</form>
        <form  method="get" action="./search_person.php">
            <span class="input-field col s6" style="float: right; margin-top: -55px; margin-right: 50px; height: 30px;">
                <input id="person" name="person" type="text" data-length="10">
            </span>
        <button class="btn-floating orange lighten-3 z-depth-0" type="submit" style="float: right; margin-top: -50px;"><i class="material-icons">navigate_before</i></button>
        </form>
	</div>
    <hr style="border:solid 1px #6a1b9a;">
    <?php
    echo '<div style="width: 160px; float: left;"><img src="../picture/'.$userimage.'" alt="" class="circle responsive-img"></div>';
    ?>
    <div id="main_name"><a href="./mainpage.php" style="color:#7e57c2;"><?=$username?>의 공간</a></div>
    <hr style="border:solid 1px #6a1b9a;">
    <?php
    
    include 'db_conn.php';

    $table_name='sipping';

    $sql = "SELECT * FROM $table_name WHERE idx=$useridx";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);

    //$pw_encode = md5($row["password"]);

    ?>
    <div id="revision_box">
    <form method="post" name="myform" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                <input name="name" id="icon_prefix" type="text" class="validate" value="<?=$row['name']?>">
            </div>
            <br>
            <div class="input-field">
                <i class="material-icons prefix">email</i>
                <input name="email" id="icon_prefix" type="email" class="validate" value="<?=$row['email']?>" readonly>
            </div>
            <br>
            <div class="input-field">
                <i class="material-icons prefix">lock_outline</i>
                <input name="password" id="icon_prefix" type="password" class="validate" required>
            </div>
            <br>
            <div class="input-field">
                <i class="material-icons prefix">phone_iphone</i>
                <input name="phone" id="icon_prefix" type="tel" class="validate" pattern = "\d{3}-\d{3,4}-\d{4}" title="'-'를 포함하여 입력해주세요" value="<?=$row['phone']?>">
            </div>
            <div class="file-field input-field">
                <div class="btn orange lighten-4 z-depth-0">
                    <span>File</span>
                    <input type="file" name="upload" value="<?=$userimage?>">
                </div>
            </div>
            <div style="height: 40px; margin-top: 30px; margin-left: 100px; padding-left: 20px;">프로필을 수정하려면 왼쪽의 버튼을 눌러주세요
                </div>
        </div>
        <br>
        <button id="button" name="logout" class="btn waves-effect waves-light z-depth-0" type="submit" onclick="mysubmit(1)" style="float: left;">탈 퇴</button>
        <button id="button" name="logout" class="btn waves-effect waves-light z-depth-0" type="submit" onclick="mysubmit(2)" style="float: right;">완 료</button>
    </form>
    </div>
    <?php
    mysqli_close($db);
    ?>
</body>
</html>