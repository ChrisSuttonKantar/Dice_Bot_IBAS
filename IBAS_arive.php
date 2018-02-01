	<div >
	<object id="svg1" data="http://adventureparty.org/imgs/structures/STRCT1.svg" type="image/svg+xml"></object>
	</Div
	

	
<?php
$AP_Listen = 100;	
$AP_Explore = 100;		
	echo "<div style=' text-align: center; border: 3px solid green; background:#d7fdc7; color:#000; font-size:75%; font-family: Comic Sans MS, cursive, sans-serif'><H5>
	Your party arives at the location,do you <input type='button' onclick=".chr(34)."explore()".chr(34)."  value ='Explore'> the area,<input type='button' onclick=".chr(34)."return()"
	.chr(34)." value ='Return'> to base or go <input type='button' onclick=".chr(34)."wander()".chr(34)." value ='Wandering'>?</H5></div>";
	?>

	
	 	<script id="Arive_Code" type="text/javascript">	
																			
			var svg1_o = document.getElementById("svg1");
			
			alert("You have arived!");
			var svgDoc = svg1_o.contentDocument;

			var delta = svgDoc.getElementById("path4177");																		
			var delta2 = svgDoc.getElementById("svg1");
			delta.addEventListener("mousedown", function(){ alert('hello world!')}, false);


		</script>																				