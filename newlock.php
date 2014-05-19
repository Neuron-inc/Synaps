<?php
	require('connect.php');



	$sql="INSERT INTO locks (lock_content,lock_date) VALUES ('$_POST[lock]', now())";


	if (!mysql_query($sql,$con))
	{
		die('Error : ' . mysql_error());
	}

	sleep(0.01);
	header('Location: ./');

	mysql_close($con)
?>