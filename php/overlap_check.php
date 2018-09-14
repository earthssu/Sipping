<?php
$name=$_POST['name'];
$email=$_POST['email'];

include 'db_conn.php';

$table_name = "sipping";

$sql = "SELECT email FROM $table_name";
$message = 'success';

if($result = mysqli_query($db,$sql))
{
	while($row = mysqli_fetch_assoc($result))
	{
		if(!strcmp($row["email"],$email))
		{
			$message = 'error';
		}
	}
}

mysqli_free_result($result);
mysqli_close($db);

echo $message;

?>