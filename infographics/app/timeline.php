<?php
ini_set ("display_errors", "0");
error_reporting(E_ALL);
// function JSON Object to array
function timeline_objectToArray($d) {
        if (is_object($d)) {
    		// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
}
// get json file of circles
$json = file_get_contents('circles.json');
$json = json_decode($json);

$data = timeline_objectToArray($json);
$width = $data[width];
$height = $data[height];
$direction = $data[direction];
?>


<?php

// style generator
echo '<style type="text/css">';
echo file_get_contents('timeline.css');


echo '
.timeline-container {
	width:'.$width.'px;
}
    
#timeline-line {
	width:'.$width.'px;
	background-color:#313140;
	background-color:rgba(49,49,64,0.6);
	height:3px;	

}

#timeline-outputtext {
		position:absolute;
     '.$direction.': 0px;
     top:0;
     left:0;
     width:100%;
     height100%;
		



}
	
.href1 .circleLine{
	opacity:1;
}';
// genetarting circles
$maxcircles = 0;
$numyears = $data[numyears];
for ($c0 = 1; $c0 <= $numyears; $c0++) {
	$sum = 0;
    // calculate MAX and SUM of circle size
    for ($cd0=1; $cd0 <= $data[year.$c0][numcirc]; $cd0++) {
    		$sum +=$data[year.$c0][circ.$cd0][circsize];
        if ($cd0 > $maxcircles) {
            $maxcircles = $cd0;
        }
	}
    $ratio = ($width-1)/$sum;

    for ($c1 = 1; $c1 <= $maxcircles; $c1++) {
        $size = round($ratio * $data[year.$c0][circ.$c1][circsize],0)-0.5;
    	$halfsize = $size/2;
		echo ".timeline-circle".$c1."change".$c0." {
			margin-top: ".(rand(0,($height/2)-($size/2)))."px;
			width: ".$size."px;
			height: ".$size."px;
			-moz-border-radius: ".$halfsize."px;
			-webkit-border-radius: ".$halfsize."px;
			border-radius: ".$halfsize."px;
			background-color: ".$data[year.$c0][circ.$c1][circcolor].";
		}
		.textincircle".$c1."and".$c0." {
			height:".$size."px;
			width:".$size."px;
			font-size:".($data[year.$c0][circ.$c1][textsize])."px;
			color:".($data[year.$c0][circ.$c1][textcolor]).";
		}";   
        if ($maxcircles <= $c1-1) {
			$maxcircles = $c1-1;
		}
    }
}
echo "</style>";

echo "<script>";
$c3=1;
for ($c0 = 1; $c0 <= $numyears; $c0++) {
    
	echo "function change".$c0."() {";
	for ($c1 = 1; $c1 <= $maxcircles; $c1++) {
        echo 'document.getElementById("timeline-circid'.$c1.'").className = "timeline-circles timeline-circle'.$c1.'change'.$c0.'";';
        echo 'document.getElementById("timeline-circid'.$c1.'").setAttribute("data-year", "'.$data[year.$c0][name].'");';
		echo 'document.getElementById("textcircid'.$c1.'").className = "timeline-textformat textincircle'.$c1.'and'.$c0.'";';
		echo 'document.getElementById("textcircid'.$c1.'").onclick = ptext'.$c3.';';
		echo 'document.getElementById("textcircid'.$c1.'").setAttribute("data-info", "'.$data[year.$c0][circ.$c1][name].'");';
		echo 'document.getElementById("textcircid'.$c1.'").innerHTML = "'.$data[year.$c0][circ.$c1][name].'";';
	$c3++;
	}
	echo "}";
}
$c3=1;
for ($c0 = 1; $c0 <= $numyears; $c0++) {
	for ($c1 = 1; $c1 <= $maxcircles; $c1++) {	
		echo "function ptext".$c3."() {";
		echo "setTimeout('timeout_trigger".$c3."()', 400);";
	 	echo "}";
	 	echo "function timeout_trigger".$c3."() {";
		echo 'document.getElementById("timeline-outputtext").innerHTML = "'.$data[year.$c0][circ.$c1][ftext].'";';
	 	echo "}";
	 	$c3++;
	}
}
echo "</script>";
// generating line of years
echo '<div class="timeline-container" style="width:'.$width.';margin-top:50px;">';
echo '<div class="time-line-time">';
echo '<div id="timeline-line" style="width:'.$width.';"></div>';
for ($c0 = 1; $c0 <= $numyears; $c0++) {
    echo '<div class="time-line-circle" style="width:'.(100/$numyears).'%"><a class="time-line-href href'.$c0.'" href="#" onclick="change'.$c0.'()" id="time_click"  data-amount='.$data[year.$c0][amount].'><div class="circleLine"></div><span >'.$data[year.$c0][name].'</span></a></div>';
}
echo '</div>';

// circle generator

echo "<div style='width:$width; height:$height;margin-top:50px;'>";
for ($n=1;$n <=$maxcircles;$n++) {
    echo "<div class='timeline-circles timeline-circle".$n."change1' id='timeline-circid$n'><span id='textcircid$n'   onclick='ptext();' ></span></div>";
}
echo "</div>";
echo "</div>";
echo "    	<div id='timeline-outputtext'>
	    		<span></span>
	    		<h1></h1>
	    		<p></p>
			</div>

	</div>";
echo "<script>
window.onload = change1;
$(document).ready(function(){
	$('body').css('overflow-x','hidden');
	var con = $('.timeline-container');
	$('#figures').hide();
	var position = con.position();
	$('#timeline-outputtext').css({'top':'0'}).hide();
	$('.circleLine').css('opacity','0');
	$('.time-line-href').on('click', function(e){
		e.preventDefault();
		$('.circleLine').css('opacity','0');
		$(this).find('div').css('opacity','1');
		var amount=$(this).data('amount');
		$('#figures').show(200);
		$('#amt').animateNumbers(amount, true, 1500);
	});
	$('.timeline-circles').bind('click',function(){
		var year=$(this).data('year');
		var that=$(this);
		var width=$('body').width();
		var height=$('wrapper').outerHeight();
		var minheight=$(document).height();
		//$('body').css('overflow','hidden');

		
		$('#infographic_cont').append('<div id=info_img ></div>');

		$('#infographic_cont').append('<div id=comments></div>');
		$('#info_comment').jOverlay({center:false,css:{position:'absolute',left:'10%',top:'20px'}});
		$('#comment_form_area').focus(function(){
				$(this).animate({height:'90px'},{width:'300px'});

		});
		$('#submit-button').click(function(e){
			e.preventDefault();
			$('#comment').html('<span>Thank you for your feedback. Your petitions will be forwarded to your Representative and Senetorial within 48 hours</span>');
		});
			var varss=that.find('span');
			var info= varss.data('info');
			if(info=='Primary Health Clinics'){
				$('#info_gra').html('<img src=hackathon6.png>');
			}

		$.get('request.php?year='+year,function(data,status,xhr){
			

			
			//alert(info);
			//alert(data);
		});
			
		
	});
});

</script>
";

?>	