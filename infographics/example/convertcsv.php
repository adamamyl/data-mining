<?php
$arr_convert=array();
$arr_convert['numyears']=13;
$arr_convert["direction"]="right";
$arr_convert["width"]="800";
$arr_convert["height"]="400";

/*"year1":{"name":"2001","numcirc":"5","circ1":{"name":"<img src=\\\"chplogo.png\\\" \/>","circsize":"90","textsize":"30","circcolor":"#20CCAC","textcolor":"#FFF","ftext":"<span style=\\'color:#A3BF2A\\'>2009<\/span><h1><a href=\\\"http:\/\/chillipear.com\\\" target=\\\"_blank\\\"><img src=\\\"chplogoblack.png\\\" \/><\/a><\/h1><p>Working in ChilliPear<\/p>"},*/

$file=file('Hackathon.csv');
$file2=file('Hackathon1.csv');
$arrs=array_merge($file,$file2);
$field=array();
$fields=array();
foreach ($arrs as $key=>$value) {
	$arr=explode(',', $value);
	foreach($arr as $val){
		if(!empty($val))
			$field[$key][]=$val;
	}
	
}

$fields['year']=$field[0];
$fields['rev']=$field[1];
$fields['pri']=$field[2];
$fields['clas']=$field[3];
$fields['pol']=$field[4];
$fields['fer']=$field[5];
$fields['voc']=$field[6];
$fields['sol']=$field[7];



?>