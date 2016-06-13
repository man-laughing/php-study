<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'zhanglei';
$db_name = 'mysql';

$conn = mysql_connect($db_host,$db_user,$db_pass,$db_name);

if ($conn) {
   echo "MySQL connected OK. \n";
} else  {
   echo "MySQL connected Error. \n";
}

mysql_close($conn)
?>
