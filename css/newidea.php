<html>
<!--
	A document for submitting idea to database 20140114
-->
<body>

<?php
$con = mysql_connect("localhost","root","a9715996");
if (!$con)
	{
	die('Could not connect: ' . mysql_error() );
	}

mysql_select_db("synaps_alpha", $con);

$sql="INSERT INTO nametable (idea)
VALUES
('$_POST[idea]')";

if (!mysql_query($sql,$con))
	{
	die('Error : ' . mysql_error());
	}
echo "idea added";

mysql_close($con)
?>
</body>
</html>