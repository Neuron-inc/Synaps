<?php
$con = mysql_connect("localhost","root","a9715996"); //%con 에 mysql_connect 값을 불러옴
mysql_select_db("synaps_alpha", $con); // connection 값으로 synaps DB를 선택
mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");
mysql_query("TRUNCATE  locks"); //테이블에 존제하는 모든 키 삭제
mysql_query("TRUNCATE keys_table");
header('Location: ./');
?>