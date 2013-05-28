<?php

$cnx=mysql_connect('localhost','root','');
mysql_select_db('atare');
$year=$_GET['year'];
$table=$_GET['table'];
$sql1= mysql_query("SELECT $table from federal where year='$year' ");
$sql2= mysql_query("SELECT $table from state where year='$year' ");
$sql3= mysql_query("SELECT $table from lga where year='$year' ");
$sql4= mysql_query("SELECT $table from ward where year='$year' ");
$rowss=array();
$rowss['federal']=mysql_result($sql1,0);
$rowss['state']=mysql_result($sql2,0);
$rowss['lga']=mysql_result($sql3,0);
$rowss['ward']=mysql_result($sql4,0);
$jsondecode=json_encode($rowss);
mysql_close();
echo $jsondecode;


?>