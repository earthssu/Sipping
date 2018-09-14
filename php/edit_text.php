<?php

$useremail=$_SESSION['useremail'];
$username=$_SESSION['username'];
$useridx=$_SESSION['useridx'];
$userimage=$_SESSION['userimage'];

if(!isset($_GET["idx"])){
    echo "Invalid value input";
    exit();
}

$idx = $_GET["idx"];

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

    <title>SIPPING/Edit</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
    
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

        function LoadPage() 
        {
            CKEDITOR.replace('contents');
        }
	</script>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('content', {
            filebrowserUploadUrl : '../upload.php'
        });
    </script>
</head>
<body onload="LoadPage();">
	<div>
		<form method="post" enctype="multipart/form-data" style="margin-top: 10px; margin-right: 0%;" action="./php/logout.php">
			<button id="button" name="logout" class="btn waves-effect waves-light z-depth-0" type="submit">LOGOUT</button>
            <button id="button" name="revision" class="btn waves-effect waves-light z-depth-0" type="submit" onclick="mysubmit(2)">REVISION</button>
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

    $table_name='write';

    $sql = "SELECT * FROM `write` WHERE idx='$idx'";

    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);

    ?>
    <div>
    <form method="get" id="EditorForm" name="EditorForm" action="./edit_save.php";">
        <input type="hidden" name="idx" value="<?=$idx?>">
        <div class="input-field col s12">
            <input name="title" id="title" type="text" class="validate" value="<?=$row["title"]?>">
        </div>
        <div>
            <textarea id="contents" name="contents"><?=$row["comment"]?></textarea>
        </div>
        <div class="input-field col s12">
            <input type="text" id="address" name="address" size="40" value="<?=$row["address"]?>" class="validate">
        </div>
        <div>
            <button id="button" name="insert" class="btn waves-effect waves-light z-depth-0" style="align-self: right;" type="submit">UPLOAD</button>
        </div>
    </form>
    </div>
    <?php
    mysqli_close($db);
    ?>
</body>
</html>