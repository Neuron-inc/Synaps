<?php
	require('connect.php');
	//DB : chogoon.tistory.com/31 참고

	$parentkeyquery = "SELECT key_id,key_lockid, key_seq, key_group, key_level FROM keys_table WHERE key_id = {$_GET['id']}";
	$parentkeystatus = mysql_query($parentkeyquery);
	$parentkeyresult = mysql_fetch_array($parentkeystatus);
	//var_dump($parentkeystatus);

	//먼저 원글의 sort와 depth를 건드리고, 키 값을 insert.\

	$sql0="UPDATE keys_table SET key_seq=key_seq+1 WHERE key_group = {$parentkeyresult[key_group]} AND key_seq > {$parentkeyresult[key_seq]} ";
	$sql1="INSERT INTO keys_table (key_content,key_date,key_type,key_lockid,key_group,key_seq,key_level) VALUES ('$_POST[content]', now(), '$_POST[type]','$_POST[lock_id]','$parentkeyresult[key_group]', '$parentkeyresult[key_seq]'+1 ,'$parentkeyresult[key_level]'+1 )";
	
	
	if (!mysql_query($sql0,$con))
	{
		die('Error0 : ' . mysql_error());
	}

	if (!mysql_query($sql1,$con))
	{
		die('Error1 : ' . mysql_error());
	}
	

	var_dump($sql);
	sleep(0.01);
	//var_dump($sql);
	header('Location: ./lockpage.php?id='.$_POST['lock_id']);
	mysql_close($con)
?>