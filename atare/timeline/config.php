<?php
// configuration tool for timeline plugin
// copyright 26.8.2012 by ChilliPear, s.r.o.
// ----------------------------------------------------------------------------
// some little settings
$filename = "circles.json";

// simpledb functions
// Author: Michal from ChilliPear, s.r.o.
// ----------------------------------------------------> Lets the music play...
ini_set ("display_errors", "0");
error_reporting(E_ALL);
// function to convert object (json) to array
function objectToArray($d) {
    	if (is_object($d)) {
			$d = get_object_vars($d); }
		if (is_array($d)) {
			return array_map(__FUNCTION__, $d);	}
		else {
			return $d;	}
}
// function read from DB file
function readfromDB($filename) {
	$file = $filename;
	$fh = fopen($file, 'r');
	$data = fread($fh, filesize($file));
	fclose($fh);	
	
	return objectToArray(json_decode($data));
}
// function write to DB file
function writetoDB($inputarray, $filename) {
	// creating new output
	$output = (json_encode($inputarray)); 
	// write new array
	$file = $filename;
	$fh = fopen($file, 'w') or die("can't open file");
	fwrite($fh, $output);
	fclose($fh);
}
function clearj($input) {
	$input = str_replace('\"', '"', $input);
	$input = str_replace("\'", "'", $input);
	return ($input);
}

// savings variables from forms
if ($_POST["save"] == "yes") {
    unset ($_POST["save"]); 
    $save = true;
    //print_r($_POST);
    $circarray[numyears] = $_POST[numyears];
    $circarray[direction] = $_POST[direction];
    $circarray[width] = $_POST[width];
    $circarray[height] = $_POST[height];
    for ($n = 1; $n <= $_POST["numyears"]; $n++) {
        $circarray["year".$n][name] = $_POST["year".$n];
        $circarray["year".$n][numcirc] = $_POST["numcirc".$n];
        for ($m = 1; $m <= (int)$_POST["numcirc".$n]; $m++) {
        	$circarray["year".$n]["circ".$m][name] = $_POST["name_circ_y".$n."_".$m];
        	$circarray["year".$n]["circ".$m][circsize] = $_POST["csize_circ_y".$n."_".$m];
        	$circarray["year".$n]["circ".$m][textsize] = $_POST["tsize_circ_y".$n."_".$m];
        	$circarray["year".$n]["circ".$m][circcolor] = $_POST["ccolor_circ_y".$n."_".$m];
        	$circarray["year".$n]["circ".$m][textcolor] = $_POST["tcolor_circ_y".$n."_".$m];
        	$circarray["year".$n]["circ".$m][ftext] = $_POST["ftext_circ_y".$n."_".$m];
        }
    }
    writetoDB($circarray, $filename);
}
$data = readfromDB($filename);

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Timeline configurator</title>
<?php if ($save) { ?>
<meta http-equiv="REFRESH" content="0;url="></HEAD>
<?php } ?>
<script src="http://code.jquery.com/jquery-1.8.0.min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<script type="text/javascript" charset="utf-8">
	$(function () {
		var tabContainers = $('div.tabs > div');
		tabContainers.hide().filter(':first').show();
		$('div.tabs ul.tnavigation a').click(function () {
			tabContainers.hide();
			tabContainers.filter(this.hash).show();
			$('div.tabs ul.tnavigation a').removeClass('active');
			$(this).addClass('active');
			return false;
		}).filter(':first').click();
	});
    function howmany() {
        for (a = 1; a <= 20; a = a + 1) {
        document.getElementById("year"+a).style.display = "none"; }
        var e = document.getElementById("howmanyyears");
        var strUser = e.options[e.selectedIndex].value;
        for (a = 1; a <= strUser; a = a + 1) {
        document.getElementById("year"+a).style.display = "";        
        }
    }
    function howmanycirc($y) {
        for (a = 1; a <= 20; a = a + 1) {
        document.getElementById("circ_"+$y+"_"+a).style.display = "none"; }
        var e = document.getElementById("howmanycirc_"+$y);
        var strUser = e.options[e.selectedIndex].value;
        for (a = 1; a <= strUser; a = a + 1) {
        document.getElementById("circ_"+$y+"_"+a).style.display = "";        
        }
    }
</script>
<style>
    h1, h2, h3, h4 {
    font-weight:normal;
    }
	body {
        background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAADCAYAAABWKLW/AAAAG0lEQVQIW2NkgIKGhgYfRhAbxADiLYwwBkgQAJpZCdAh/mO3AAAAAElFTkSuQmCC") repeat, rgb(238,238,238);
        background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAADCAYAAABWKLW/AAAAG0lEQVQIW2NkgIKGhgYfRhAbxADiLYwwBkgQAJpZCdAh/mO3AAAAAElFTkSuQmCC") repeat, -moz-linear-gradient(top, rgba(238,238,238,1) 0%, rgba(204,204,204,1) 100%);
        background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAADCAYAAABWKLW/AAAAG0lEQVQIW2NkgIKGhgYfRhAbxADiLYwwBkgQAJpZCdAh/mO3AAAAAElFTkSuQmCC") repeat, -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(238,238,238,1)), color-stop(100%,rgba(204,204,204,1)));
        background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAADCAYAAABWKLW/AAAAG0lEQVQIW2NkgIKGhgYfRhAbxADiLYwwBkgQAJpZCdAh/mO3AAAAAElFTkSuQmCC") repeat, -webkit-linear-gradient(top, rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%);
        background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAADCAYAAABWKLW/AAAAG0lEQVQIW2NkgIKGhgYfRhAbxADiLYwwBkgQAJpZCdAh/mO3AAAAAElFTkSuQmCC") repeat, -o-linear-gradient(top, rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%);
        background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAADCAYAAABWKLW/AAAAG0lEQVQIW2NkgIKGhgYfRhAbxADiLYwwBkgQAJpZCdAh/mO3AAAAAElFTkSuQmCC") repeat, -ms-linear-gradient(top, rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%);
        background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAADCAYAAABWKLW/AAAAG0lEQVQIW2NkgIKGhgYfRhAbxADiLYwwBkgQAJpZCdAh/mO3AAAAAElFTkSuQmCC") repeat, linear-gradient(to bottom, rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%);
	    font-family: 'Quicksand', sans-serif;   
        color:#333;
    }
    .centerdiv {
        width:800px;
        margin: 0 auto;
    }
    h1 {
        text-align:center;
    }
    .config {
        background:rgba(150, 150, 150, 0.4);
        -webkit-border-radius: 0px 10px 10px 10px;
        border-radius: 0px 10px 10px 10px;
        padding:15px;
        margin-top: 4px;
    }
    ul {
        list-style: none;
        margin: 0;
        padding: 0;
        -webkit-padding-start: 0px;
    }
    .tnavigation li {
        display:inline-block;
        }
    .tnavigation li a {
        padding:5px 15px;
        background:rgba(255, 255, 255, 0.4);
        -webkit-border-radius: 10px 10px 0px 0px;
        border-radius: 10px 10px 0px 0px;
        color:#555;
        text-decoration:none;
    }
    .active {
        background:rgba(150, 150, 150, 0.4) !important;
        color:#222 !important;
    }
    .save {
        background:rgba(0, 0, 0, 1);
        color:#FFF;
        display:block;
        width:160px;
        height:31px;
        padding-top: 10px;
        text-align:center;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        margin: 20px auto 100px auto;
        cursor: hand; cursor: pointer; 
    }
    .yearnames div input, #howmanyyears, .direction {
        width:200px;
        height:25px;
        margin-left: 20px;
        border-radius: 10px;
        border:none;
        background:rgba(255, 255, 255, 0.8);
        padding-left:20px;
        position:inherit;
    }
    .yearnames div {
        margin:10px 0;
    }
    .desc {
    	font-size: 11px;
    	text-align: left;
    }
    .cell {
    	width: 132px;
		display: inline-block;
		position: relative;
		text-align: center;
    }
    .inp {
        width:110px;
        height:25px;
    	border-radius: 10px;
        border:none;
        background:rgba(255, 255, 255, 0.8);
        padding:0px 10px;
    }
    .setting {
    	position:relative;
    	left: 85px;
		top: -34px;
    }
    .ftextta {
    	width: 660px;
		height: 60px;
		border-radius: 10px;
        border:none;
        background:rgba(255, 255, 255, 0.8);
        padding:10px;
        
    }
    .ftext {
    	display: block;
		width: 680px;
		margin-top: 5px;
		text-align:center;
    }
    .atension {
    	display:block;
    	text-align:center;
    }
    
</style>
</head>


<body>
<?php if (!$save) { 
    include ("timeline.php"); } ?>

<div class="centerdiv">

    <h1><svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="127.599px" height="55.517px" viewBox="0 0 127.599 55.517" enable-background="new 0 0 127.599 55.517"
	 xml:space="preserve"><g>
	<circle fill="#222222" cx="64.092" cy="27.758" r="13.7"/>
	<path fill="#222222" d="M120.334,24.517H87.973c-1.377-12-11.542-21.27-23.881-21.27c-12.341,0-22.504,9.27-23.88,21.27H7.267
		c-1.607,0-2.91,1.467-2.91,3c0,1.534,1.303,3,2.91,3h32.945c1.377,12,11.54,21.27,23.88,21.27c12.34,0,22.504-9.27,23.881-21.27
		h32.361c1.606,0,2.909-1.466,2.909-3C123.243,25.984,121.94,24.517,120.334,24.517z M64.092,46.577
		c-10.394,0-18.818-8.426-18.818-18.819S53.698,8.939,64.092,8.939S82.91,17.364,82.91,27.758S74.485,46.577,64.092,46.577z"/></g></svg>
        <br/>Timeline configurator</h1>
    <form id="saveForm" action="#" method="POST">
    <div class="tabs">
         <ul class="tnavigation">
            <li><a href="#main">Main</a></li>
            
            
            <?php 
            	for ($n = 1; $n <= $data[numyears]; $n++) {
            		echo "<li style='margin-right:5px;'><a href='#t".$n."'>".$data["year".$n][name]."</a></li>";
            	}
           	?>
            
        </ul>
        <div class="config" id="main">
            <h2>Main configuration</h2>
            <p>Timeline width (in pixels) <input class="inp" type="text" name="width" value="<?php echo clearj($data["width"]);?>" /></p>
			<p>Timeline height (in pixels) <input class="inp" type="text" name="height" value="<?php echo clearj($data["height"]);?>" /></p>
			<p>Panel sliding align
			<select class="direction" name="direction">
				<option value='left' <?php if ($data[direction] == "left") echo "selected";?>>left</option>
				<option value='right' <?php if ($data[direction] == "right") echo "selected";?>>right</option>
			</select></p>
			<p>Number of changes (years)<select id="howmanyyears" name="numyears" onchange="howmany()">
                <?php for ($n=1;$n<=20;$n++) {
                    if ($n == $data[numyears]) $sel="selected";
                    echo "<option value='$n' $sel>$n</option>";
                    $sel = "";
                }?>
            </select></p>
            <div class="yearnames">
                <?php for ($n=1;$n<=20;$n++) {
                    if ($n <= $data[numyears]) {$disp="";} else {$disp="none";}
                    echo '<div id="year'.$n.'" style="display:'.$disp.'" class="">Name of change (year) #'.$n.'<input type="text" name="year'.$n.'" value="'.$data["year".$n][name].'"/></div>';
                }?>
            </div>
            <br/><br/>
            
        </div>
        <?php for ($n = 1; $n <= $data[numyears]; $n++) {?>
        
        <div class="config" id="t<?php echo $n; ?>">

            <h2><?php echo $data["year".$n][name]; ?></h2>
            <p>Number of circles<select id="howmanycirc_y<?php echo $n; ?>" name="numcirc<?php echo $n; ?>" onchange="howmanycirc('y<?php echo $n; ?>')">
                <?php for ($m=1;$m<=20;$m++) {
                    if ($m == $data["year".$n][numcirc]) $sel="selected";
                    echo "<option value='$m' $sel>$m</option>";
                    $sel = "";
                }?>
            </select></p>
            <br/>
            <?php for ($m=1;$m<=20;$m++) { 
            	if($m > $data["year".$n][numcirc]) $disp="none"; else $disp=""; ?>
	            <div style="display:<?php echo $disp;?>;" id="circ_y<?php echo $n;?>_<?php echo $m;?>">
	            Circle #<?php echo $m;?>
		            <div class="setting">
			            <span class="cell"><span class="desc">Name</span>
			            <input class="inp" type="text" name="name_circ_y<?php echo $n;?>_<?php echo $m;?>" value=<?php $uvo = "'"; if (strpos(clearj($data["year".$n]["circ".$m][name]),"'") != 0) $uvo = '"'; echo $uvo;?><?php echo clearj($data["year".$n]["circ".$m][name]); ?><?php echo $uvo;?> /></span>
			            <span class="cell"><span class="desc">Circle size</span>
			            <input class="inp" type="text" name="csize_circ_y<?php echo $n;?>_<?php echo $m;?>" value="<?php echo clearj($data["year".$n]["circ".$m][circsize]); ?>" /></span>
			            <span class="cell"><span class="desc">Text size</span>
			            <input class="inp" type="text" name="tsize_circ_y<?php echo $n;?>_<?php echo $m;?>" value="<?php echo clearj($data["year".$n]["circ".$m][textsize]); ?>" /></span>
			            <span class="cell"><span class="desc">Circle color (#HEX)</span>
			            <input class="inp" type="text" name="ccolor_circ_y<?php echo $n;?>_<?php echo $m;?>" value="<?php echo clearj($data["year".$n]["circ".$m][circcolor]); ?>" /></span>
			            <span class="cell"><span class="desc">Text color (#HEX)</span>
			            <input class="inp" type="text" name="tcolor_circ_y<?php echo $n;?>_<?php echo $m;?>" value="<?php echo clearj($data["year".$n]["circ".$m][textcolor]); ?>" /></span>
			            <span class="ftext">
			            <span class="desc">Full text</span>
			            <textarea class="ftextta" name="ftext_circ_y<?php echo $n;?>_<?php echo $m;?>"><?php echo clearj($data["year".$n]["circ".$m][ftext]); ?></textarea>
			            </span>
		            </div>
	            </div>	
            <?php } ?>
        </div>
        <?php } ?>


    <input type="hidden" name="save" value="yes"/>    
    </div>  <!-- end of div "tabs"-->
    <div class="atension">Please, save your changes after editing each tab.<br/>Please, delete or rename configurator when you're done with config.</div>
	<div class="save" onClick="document.forms['saveForm'].submit();">Save changes</div>
    </form>

</div>
</body>











