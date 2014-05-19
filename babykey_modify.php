<?php
  require('connect.php');
  //DB : chogoon.tistory.com/31 참고

  $sql="UPDATE  keys_table SET key_content ='{$_POST['content']}' WHERE  key_id ={$_GET['id']}";
  //var_dump($parentkeystatus);
  $sql1="UPDATE  keys_table SET key_type ='{$_POST['type']}' WHERE  key_id ={$_GET['id']}";
  
  if (!mysql_query($sql,$con))
  {
    die('Error0 : ' . mysql_error());
  }
  if (!mysql_query($sql1,$con))
  {
    die('Error0 : ' . mysql_error());
  }

  sleep(0.01);
  //var_dump($sql);
  header('Location: ./lockpage.php?id='.$_POST['lock_id']);
  mysql_close($con)
?>