<?php

$cnx=mysql_connect('localhost','root','');
mysql_select_db('hackathon');
$year=$_GET['year'];
$sql="select * from hackdata where year='$year'";
$query=mysql_query($sql);
$rowss=array();
$rows=mysql_fetch_assoc($query);
$jsondecode=json_encode($rows);
echo $jsondecode;

?>