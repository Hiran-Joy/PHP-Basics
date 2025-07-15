<?php
$Server = "localhost";
$User = "root";
$Password = "";
$DB = "db_shopping";
$con = mysqli_connect($Server,$User,$Password,$DB);
if(!$con){
echo "connection failed";
}
?>