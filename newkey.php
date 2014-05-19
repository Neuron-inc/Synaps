<?php
	require('connect.php');

	//생성될 key의 keyid(auto increment값)을 가져옴 (key group에 쓰여야 함!)
	$keyquery=mysql_query("SHOW TABLE STATUS LIKE 'keys_table'");
	$tablestatus=mysql_fetch_array($keyquery);
	$nextkeyid=$tablestatus['Auto_increment'];

	$sql="INSERT INTO keys_table (key_content,key_date,key_type,key_lockid,key_group,key_seq,key_level) VALUES ('$_POST[content]', now(), '$_POST[type]','$_POST[lock_id]','$nextkeyid', '1','0')";

	if (!mysql_query($sql,$con))
	{
		die('Error : ' . mysql_error());
	}

	sleep(0.01);
	header('Location: ./lockpage.php?id='.$_POST['lock_id']);

	mysql_close($con)
?>