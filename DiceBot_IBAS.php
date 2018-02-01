

		<style> 
		   body {
				background: #ffffff;
			}

			#canvas {
            position: relative;
            left: 0x;
            top: 0px;
            background: #ffffff;
            cursor: crosshair;
            margin-left: 10px;
            margin-top: 10px;
            -webkit-box-shadow: 4px 4px 8px rgba(0,0,0,0.5);
            -moz-box-shadow: 4px 4px 8px rgba(0,0,0,0.5);
            box-shadow: 4px 4px 8px rgba(0,0,0,0.5);
			}

            margin-left: 15px;
			}

		</style>

  

    <canvas id='canvas' width='0' height='0'>
      Canvas not supported
    </canvas>
  <input id='animateButton' type='hidden' value='Animate' onclick="requestNextAnimationFrame(animate)"/>
<?php
	 
	
	
		$Loc_Roll = rand(0, 100);
	$AP_Listen = 100;		
		
	echo "<div id ='Listen_Div' style=' text-align: center; border: 3px solid green;  color:#000; font-size:75%;'>";   
	  echo "		<script type='text/javascript'>	";
	echo "	function render_svg(){";																					
	echo "		return 0;";
	echo "	};";
	echo "</script>"; 
        echo "</Div>";		
  
		
				echo "0";
?>
 	<script type="text/javascript">		
	
function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min)) + min; //The maximum is exclusive and the minimum is inclusive
}

	
	
	/*
 * Copyright (C) 2012 David Geary. This code is from the book
 * Core HTML5 Canvas, published by Prentice-Hall in 2012.
 *
 * License:
 *
 * Permission is hereby granted, free of charge, to any person 
 * obtaining a copy of this software and associated documentation files
 * (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge,
 * publish, distribute, sublicense, and/or sell copies of the Software,
 * and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * The Software may not be used to create training material of any sort,
 * including courses, books, instructional videos, presentations, etc.
 * without the express written consent of David Geary.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
*/

window.requestNextAnimationFrame =
   (function () {
      var originalWebkitRequestAnimationFrame = undefined,
          wrapper = undefined,
          callback = undefined,
          geckoVersion = 0,
          userAgent = navigator.userAgent,
          index = 0,
          self = this;

      // Workaround for Chrome 10 bug where Chrome
      // does not pass the time to the animation function
      
      if (window.webkitRequestAnimationFrame) {
         // Define the wrapper

         wrapper = function (time) {
           if (time === undefined) {
              time = +new Date();
           }
           self.callback(time);
         };

         // Make the switch
          
         originalWebkitRequestAnimationFrame = window.webkitRequestAnimationFrame;    

         window.webkitRequestAnimationFrame = function (callback, element) {
            self.callback = callback;

            // Browser calls the wrapper and wrapper calls the callback
            
            originalWebkitRequestAnimationFrame(wrapper, element);
         }
      }

      // Workaround for Gecko 2.0, which has a bug in
      // mozRequestAnimationFrame() that restricts animations
      // to 30-40 fps.

      if (window.mozRequestAnimationFrame) {
         // Check the Gecko version. Gecko is used by browsers
         // other than Firefox. Gecko 2.0 corresponds to
         // Firefox 4.0.
         
         index = userAgent.indexOf('rv:');

         if (userAgent.indexOf('Gecko') != -1) {
            geckoVersion = userAgent.substr(index + 3, 3);

            if (geckoVersion === '2.0') {
               // Forces the return statement to fall through
               // to the setTimeout() function.

               window.mozRequestAnimationFrame = undefined;
            }
         }
      }
      
      return window.requestAnimationFrame   ||
         window.webkitRequestAnimationFrame ||
         window.mozRequestAnimationFrame    ||
         window.oRequestAnimationFrame      ||
         window.msRequestAnimationFrame     ||

         function (callback, element) {
            var start,
                finish;

            window.setTimeout( function () {
               start = +new Date();
               callback(start);
               finish = +new Date();

               self.timeout = 100 / 60 - (finish - start);

            }, self.timeout);
         };
      }
   )
();
/*
 * Copyright (C) 2012 David Geary. This code is from the book
 * Core HTML5 Canvas, published by Prentice-Hall in 2012.
 *
 * License:
 *
 * Permission is hereby granted, free of charge, to any person 
 * obtaining a copy of this software and associated documentation files
 * (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge,
 * publish, distribute, sublicense, and/or sell copies of the Software,
 * and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * The Software may not be used to create training material of any sort,
 * including courses, books, instructional videos, presentations, etc.
 * without the express written consent of David Geary.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
*/
var launch_date = new Date();
var this_date = new Date();
var travel_time = 0;
var ap_arrived = 0;
var canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    controls = document.getElementById('controls'),
    animateButton = document.getElementById('animateButton'),

    tree = new Image(),
    nearTree = new Image(),
    grass = new Image(),
    grass2 = new Image(),
    sky = new Image(),
	mnt_1 = new Image(),
		jet_sled = new Image(),
   
	show_sled = false,
    paused = true,
    lastTime = 0,
    lastFpsUpdate = { time: 0, value: 0 },
    fps=60,

    skyOffset = 0,
    grassOffset = 0,
    treeOffset = 0,
    nearTreeOffset = 0,
    mntOffset = 0,	
	dst_mntOffset	 = 0,
	jet_sled_Offset = 0,	
	jet_float = 0,
	jet_float_dir = 0,
	

    TREE_VELOCITY = 20,
    FAST_TREE_VELOCITY = 40,
    SKY_VELOCITY = 10,
    MNT_VELOCITY = 8,	
	DST_MNT_VELOCITY = 4,
    GRASS_VELOCITY = 75;
    jet_sled_VELOCITY = 0;	

// Functions.....................................................

function erase() {
   context.clearRect(0,0,canvas.width,canvas.height);
}

function draw() {
   context.save();

   skyOffset = skyOffset < canvas.width ?
               skyOffset + SKY_VELOCITY/fps : 0;

   grassOffset = grassOffset < canvas.width ?
                 grassOffset +  GRASS_VELOCITY/fps : 0;

   treeOffset = treeOffset < canvas.width ?
                treeOffset + TREE_VELOCITY/fps : 0;

   nearTreeOffset = nearTreeOffset < canvas.width ?
                    nearTreeOffset + FAST_TREE_VELOCITY/fps : 0;
					
   mntOffset = mntOffset < canvas.width ?
                mntOffset + MNT_VELOCITY/fps : 0;		
				
   dst_mntOffset = dst_mntOffset < canvas.width ?
                dst_mntOffset + DST_MNT_VELOCITY/fps : 0;					

   jet_sled_Offset = jet_sled_Offset < canvas.width ?
                jet_sled_Offset + jet_sled_VELOCITY/fps : 0;						
				
				
				
				
				
				
				
				
				
   context.save();
   context.translate(-skyOffset, 0);
   context.drawImage(sky, 0, 0);
   context.drawImage(sky, sky.width-2, 0);
   context.restore();
   
   

   

      context.save();
   context.translate(-dst_mntOffset, 0);
   context.drawImage(mnt_1, 100, 50);
   context.drawImage(mnt_1, 1100, 50);
   context.drawImage(mnt_1, 400, 50);
   context.drawImage(mnt_1, 1400, 50);
   context.drawImage(mnt_1, 700, 50);
   context.drawImage(mnt_1, 1700, 50);
   context.restore();
   
         context.save();
   context.translate(-mntOffset, 0);
   context.drawImage(mnt_1, 240, 100);
   context.drawImage(mnt_1, 2400, 100);
   context.drawImage(mnt_1, 640, 100);
   context.drawImage(mnt_1, 2800, 100);
   context.drawImage(mnt_1, 140, 100);
   context.drawImage(mnt_1, 2200, 100);
   context.restore();
   
   
   
   context.save();
   context.translate(-treeOffset, 0);
   context.drawImage(tree, 100, 150);
   context.drawImage(tree, 1100, 150);
   context.drawImage(tree, 400, 150);
   context.drawImage(tree, 1400, 150);
   context.drawImage(tree, 700, 150);
   context.drawImage(tree, 1700, 150);
   context.restore();


   
	 if (jet_float_dir == 0)
		{

			jet_float = jet_float -.1;
			if (jet_float < 1)
				{	jet_float_dir = 1;};
							  
		}
	else	
		{		
			
		jet_float = jet_float +.1;
			if (jet_float > 50)
				{	jet_float_dir = 0;};


		};

   
   
      if (show_sled)
	  {
   


   context.save();
   context.translate(-jet_sled_Offset, 0);
   context.drawImage(jet_sled, 100, 100-jet_float);

   context.restore();
	  };
   context.save();
   context.translate(-nearTreeOffset, 0);
   context.drawImage(nearTree, 250, 150);
   context.drawImage(nearTree, 1250, 150);
   context.drawImage(nearTree, 800, 150);
   context.drawImage(nearTree, 1800, 150);
   context.restore();


   
   
   
   //
  // context.save();
  // context.translate(-grassOffset, 0);

   //context.drawImage(grass, 0, canvas.height-grass.height);

   //context.drawImage(grass, grass.width-5,
     //                canvas.height-grass.height);

   //context.drawImage(grass2, 0, canvas.height-grass2.height);

   //context.drawImage(grass2, grass2.width,/
     //                canvas.height-grass2.height);
   //context.restore();

}

function calculateFps(now) {
   var fps = 1000 / (now - lastTime);
   lastTime = now;
   return fps; 
}

function animate(now) {
   if (now === undefined) {
      now = +new Date;
   }

   fps = calculateFps(now);

   	   this_date = +new Date;
	   var difference = (this_date - launch_date) / 1000;
	   if (difference >= travel_time )// Party Arrives at location
			{	
			if (ap_arrived == 0)
			{
					ap_arrived = 1;
						paused = true;
						 if (window.XMLHttpRequest) {
										 xmlhttp = new XMLHttpRequest();

							 } else {
										 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
										
							 }
							 xmlhttp.onreadystatechange = function() {
								 
																		if (this.readyState == 4 && this.status == 200) 
																			{
																				document.getElementById("Listen_Div").innerHTML = this.responseText;
																			
																				show_sled = false;																
																				document.getElementById('canvas').width = 0;															
																				document.getElementById('canvas').height = 0;
																				var AC = document.getElementById("Arive_Code");
																				eval(AC.innerHTML);
																				//eval(AC.innerHTML);
																		
																			/* 	var svg1_o = document.getElementById("svg1");
																				alert("You have arived!");
																				var svgDoc = svg1_o.contentDocument;

																				var delta = svgDoc.getElementById("path4177");																		
																				var delta2 = svgDoc.getElementById("svg1");
																				delta.addEventListener("mousedown", function(){ alert('hello world!')}, false); */
																			}

														};

		 xmlhttp.open("GET","http://cjsgames.com/DiceBag/IBAS_arive.php",true);
			 
				 xmlhttp.send();									
										
			}
			}
			
		else

			{
				
				document.getElementById("Listen_Div").innerHTML =  "<div style=' text-align: center; border: 3px solid green; background:#d7fdc7; color:#000; font-size:75%;'><H5> You have traveled for  " +Math.round( difference) + " of your " + Math.round(travel_time) + " days journey.</H5></Div>";	
							
			}
		

   if (!paused) {
      erase();
	   draw();
   }

   requestNextAnimationFrame(animate);
}

// Event handlers................................................

animateButton.onclick = function (e) {
   paused = paused ? false : true;
   if (paused) {
      animateButton.value = 'Animate';
   }
   else {
      animateButton.value = 'Pause';
   }
};

// Initialization................................................

context.font = '48px Helvetica';

tree.src = 'http://cjsgames.com/DiceBag/trs_1.png';
nearTree.src = 'http://cjsgames.com/DiceBag/trs_1.png';
grass.src = 'http://cjsgames.com/DiceBag/grc_1.png';
grass2.src = 'http://cjsgames.com/DiceBag/grc_1.png';
sky.src = 'http://cjsgames.com/DiceBag/sky.png';
mnt_1.src = 'http://cjsgames.com/DiceBag/mnts_1.png';

jet_sled.src = 'http://cjsgames.com/DiceBag/jet_sleds.png';


sky.onload = function (e) {
   draw();
};




						
	 function evesdrop(Npc_Name) {	
	 alert ('evesdrop');
	 v_place_name = document.getElementById("place_name").value;
	 alert (v_place_name);
	document.getElementById("Listen_Div").innerHTML = "Finding Adventure!";
		 if (window.XMLHttpRequest) {
					 xmlhttp = new XMLHttpRequest();

		 } else {
					 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					
		 }
		 
		 
		 xmlhttp.onreadystatechange = function() {
													if (this.readyState == 4 && this.status == 200)
														{
															document.getElementById("Listen_Div").innerHTML = this.responseText;
														}
												};

		 xmlhttp.open("GET","http://cjsgames.com/DiceBag/IBAS_Listen.php?plc="+v_place_name,true);
	 
		 xmlhttp.send();									
											}
											
						
	 function prime_town() {	
	//alert('boo');
		 if (window.XMLHttpRequest) {
					 xmlhttp = new XMLHttpRequest();

		 } else {
					 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					
		 }
		 xmlhttp.onreadystatechange = function() {
													if (this.readyState == 4 && this.status == 200) {
													document.getElementById("Listen_Div").innerHTML = this.responseText;
												
																	}

												};

		 xmlhttp.open("GET","http://cjsgames.com/DiceBag/IBAS_prime_town.php",true);
	 
		 xmlhttp.send();									
											}											
function travel(travel_time)
 {	
						ap_arrived = 0;
						 launch_date = new Date();

						document.getElementById("Listen_Div").innerHTML =  
													"<div style=' text-align: center; border: 3px solid green; background:#d7fdc7; color:#000; font-size:75%;'> Your party bords thier ship and leave for the location, the trip should take you "+ travel_time/10 + " days.</div>";																			
																
								show_sled = true;
								paused =  false ;
								document.getElementById('canvas').width = 1000;
								document.getElementById('canvas').height = 300;
								requestNextAnimationFrame(animate);	 		

}
		
 function talk(npc_rp,name,loc) 
 {	
				  travel_time = getRandomInt(90, 3);
				  var cln_loc_name = loc.substring(2);
					cln_loc_name = cln_loc_name.replace("a place called");
				document.getElementById("Listen_Div").innerHTML =  
											"<div style=' text-align: center; border: 3px solid green; background:#d7fdc7; color:#000; font-size:75%;'><H5> Hello there! I'm " + name + " I've been to the " + cln_loc_name 
											+ " its about " + travel_time + " days from here. I can <input onclick='travel()' type='button' value ='mark it on your map '> or even  <input onclick='travel()' type='button' value ='guide you there if you want.'></H5></Div>";	
}
		 								
		 
	//alert('boo');
prime_town();
</script>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="http://connect.facebook.net/de_DE/all.js1">
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>The Dice Bot</title>




		</style>

<?php
//session_start();
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__.'/src/Facebook/');
require_once(__DIR__.'/src/Facebook/autoload.php');

$fb = new Facebook\Facebook([
'app_id' => '154931045266042',
'app_secret' => '624b605599f06a3669afcbd38a4517ae',
'default_graph_version' => 'v2.9',
]);

	$PstId = $_POST["pstid"];
	$Times = $_POST["times"];
	$Keeph = $_POST["keephighest"];
	$Sides = $_POST["sides"];
	$RRLower = $_POST["rrlower"];	
	$PlayerKey = $_POST["keyid"];		
	$LogRoll =  $_POST["logrolls"];
	$UserName =  $_POST["User_Name"];
	$ShelfCnt =  $_POST["shelf_cnt"];	
	$ApChat =  $_POST["APchat"];	
	$ApChat =str_replace( array( "'","'" ),'',$ApChat );
	 	if ($ShelfCnt =='')
	{$ShelfCnt ='2';};


 	if ($UserName =='')
	{$UserName ='Wandering Gamer';};


	if ($PlayerKey =='')
	{$PlayerKey ='123';}; 

	$Rolled = 0;
	$RollSer = '';
	$Rolls = [];
	
			if($PstId=='')
					{$PstId= '372131636544330';};

		if(isset($_REQUEST['times']))
				{


				if ($Keeph > $Times)
					{$Keeph  = $Times; }
				
				if($Sides<1)
					{ $Sides = 1;}
				
				if($Sides<$RRLower)
					{$RRLower = $Sides -1;}
				
				
				for ($num = 0 ; $num < $Times; $num++)
					{				
					$Rolls[$num ] = rand(1,$Sides);
						while($Rolls[$num ] <= $RRLower)
								{	
									$Rolls[$num ] = rand(1,$Sides);
								};
					};		
			
					sort($Rolls);
					array_reverse($Rolls);
					for ($num = 0 ; $num < $Keeph; $num++)
					{	if ($num  == 0)
							{$RollSer = $Rolls[$num];}
						  else
						{
							$RollSer =  $RollSer . ' + ' .  $Rolls[$num];
						}			
						$Rolled = $Rolled + $Rolls[$num];
					};	
			};
if ($PlayerKey!='')
	{
	//	$arr = array('message' => "Your score is ".$Rolled." the roll was " .$Times."d".$Sides. " keep > ". $Keeph." rolls, re - rolling < ".$RRLower." :". $RollSer  );
					
		//		$res = $fb->post('/157282881362541_' .$PstId. '/comments', $arr,	'EAACM6LHq8noBAKr7E6CGZBBNW3CRD0uZCXhGsFq8tekYeS83MIpUQPZCOCBpSi7qvDQ09aT4w92PSJ5x1ooZBHuAqZBjJgSN4w6x0VciHrqAlZAdiuKbmWIKlZC6vSd3aFUBKeJXroIoYPI9p1FzWyUGZA7XZAfrej0atlLDaAwSwjQZDZD');
		//		$res = $fb->post('/157282881362541_' .$PstId. '/comments', $arr,	'EAACM6LHq8noBAKr7E6CGZBBNW3CRD0uZCXhGsFq8tekYeS83MIpUQPZCOCBpSi7qvDQ09aT4w92PSJ5x1ooZBHuAqZBjJgSN4w6x0VciHrqAlZAdiuKbmWIKlZC6vSd3aFUBKeJXroIoYPI9p1FzWyUGZA7XZAfrej0atlLDaAwSwjQZDZD');
			//	$res = $fb->post('/1944779038896511_' .$PstId. '/comments', $arr,	'EAACM6LHq8noBAKr7E6CGZBBNW3CRD0uZCXhGsFq8tekYeS83MIpUQPZCOCBpSi7qvDQ09aT4w92PSJ5x1ooZBHuAqZBjJgSN4w6x0VciHrqAlZAdiuKbmWIKlZC6vSd3aFUBKeJXroIoYPI9p1FzWyUGZA7XZAfrej0atlLDaAwSwjQZDZD');

					
				//	$res = $fb->post('/157282881362541/feed/', $arr,	'EAACM6LHq8noBAKr7E6CGZBBNW3CRD0uZCXhGsFq8tekYeS83MIpUQPZCOCBpSi7qvDQ09aT4w92PSJ5x1ooZBHuAqZBjJgSN4w6x0VciHrqAlZAdiuKbmWIKlZC6vSd3aFUBKeJXroIoYPI9p1FzWyUGZA7XZAfrej0atlLDaAwSwjQZDZD');};			
					$db = new mysqli("localhost", "cjsgames_DiceBot", "Dice_Bot1!@", "cjsgames_cjsmain");	
				if($db->connect_errno > 0)	{
												die('Unable to connect to database [' . $db->connect_error . ']');
											}
		if ($_POST['logrolls'] == 'logit')
		{
						

/* 				 $badWords = array('normat','anal','anus','arse','ass','ballsack','bkbitch','biatch','bloody','blowjob','blow job','bollock','bollok','boner','boob','bugger','bum','butt','buttplug','clitoris','cock','coon','crap','cunt','dick','dildo','dyke','fag','feck','fellate','fellatio','felching','fuck','f u c k','fudgepacker','fudge packer','flange','Goddamn','God damn','hell','homo','jerk','jizz','knobend','knob end','labia','lmao','lmfao','muff','nigger','nigga','penis','piss','poop','prick','pube','pussy','queer','scrotum','sex','shit','shit','sh1t','slut','smegma','spunk','tit','tosser','turd','twat','vagina','wank','whore');

					 if(in_array(strtolower($UserName), $badWords) ) {
						$UserName = 'Wandering Troll';
					 }
 */
	 
			 
			 $badwords = [ "/(normat)/","/(anal)/","/(anus)/","/(arse)/","/(ass)/","/(ballsack)/","/(bkbitch)/","/(biatch)/","/(bloody)/","/(blowjob)/","/(blow job)/","/(bollock)/","/(bollok)/","/(boner)/","/(boob)/","/(bugger)/","/(bum)/","/(butt)/","/(buttplug)/","/(clitoris)/","/(cock)/","/(coon)/","/(crap)/","/(cunt)/","/(dick)/","/(dildo)/","/(dyke)/","/(fag)/","/(feck)/","/(fellate)/","/(fellatio)/","/(felching)/","/(fuck)/","/(f u c k)/","/(fudgepacker)/","/(fudge packer)/","/(flange)/","/(Goddamn)/","/(God damn)/","/(homo)/","/(jerk)/","/(jizz)/","/(knobend)/","/(knob end)/","/(labia)/","/(muff)/","/(nigger)/","/(nigga)/","/(penis)/","/(piss)/","/(poop)/","/(prick)/","/(pube)/","/(pussy)/","/(queer)/","/(scrotum)/","/(sex)/","/(shit)/","/(shit)/","/(sh1t)/","/(slut)/","/(smegma)/","/(spunk)/","/(tit)/","/(tosser)/","/(turd)/","/(twat)/","/(vagina)/","/(wank)/","/(whore)/"];
		//"#\((\d+)\)#"
		$phrase = $UserName;

		$UserName = preg_replace_callback(
				$badwords,
				function ($matches) {
					return str_repeat('*', strlen($matches[0]));
				},
				$phrase
			);

if($UserName !=	$phrase)
	{	$UserName = 'TROLL!!';}
else
	{	

	if ($Times >0)
					{

						$r_sql = "Insert into cjsgames_cjsmain.DB_Keys 
											   (AP_key, AP_User, Roll )
											   values  ('". $PlayerKey."','" .$UserName. "',' CHAT MESSAGE: ".$ApChat." / ROLL STATS : Your score is ".$Rolled." the roll was " .$Times."d".$Sides. 
											   " keeping the highest ". $Keeph." rolls and re - rolling anything lower than a ".$RRLower.". Your rolls were ".$RollSer."' )";
							
					}
					else
						
					{
	
						$r_sql = "Insert into cjsgames_cjsmain.DB_Keys 
											   (AP_key, AP_User, Roll )
											   values  ('". $PlayerKey."','" .$UserName. "',' CHAT MESSAGE: ".$ApChat." ')";
	
					}	
					if(!$result = $db->query($r_sql))
						{
							die('There was an error running the query [' . $db->error . ']');
						}

	
			
			}; 
	};
/* 
					$r_sql = " SELECT ID, AP_key, Roll, AP_User, Roll_date
									FROM cjsgames_cjsmain.DB_Keys 
									where AP_key = ". $PlayerKey;


				if(!$result = $db->query($r_sql))
					{
						die('There was an error running the query [' . $db->error . ']');
					}

				while($rolls_result = $result->fetch_assoc())
					{
						$rolls_user = $rolls_result['AP_User'];
						$rolls_roll = $rolls_result['Roll'];
						$rolls_date = $rolls_result['Roll_date'];
						
						echo "<div><h6>". $rolls_date . "/".$rolls_user. " - ".  $rolls_roll." </h6><Div>";		
					} */

					
		
			
};

?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110314295-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110314295-2');
</script>

</head>
<body style="background-color:white; id="main_body"  >
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=154931045266042';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function select_products( nm_prd) {
	
	////alert('OK! Let me get some things together for you to look at!');
	//alert("Bzzzbang! Woops!");
	//alert(nm_prd);
document.getElementById('shelf_cnt').value=nm_prd;	
	//alert(nm_prd);
document.getElementById("Dice_Form").submit();
	//alert("Whomfkapow! Ohhh not good!");
//	//alert('Oh No! Why are we here?');
}


</script>




<div align="center">


<script type="text/javascript">
  window.fbAsyncInit = function() {
    FB.init({
      appId : '154931045266042',
      cookie : true
    });
  }

  window.onload = function() {
    FB.Canvas.setAutoGrow(5);
  }
</script>
	<form style="background-color:white;" id="Dice_Form" name="Dice_Form"   method="post" action="http://cjsgames.com/DiceBag/DiceBot_IBAS.php">
		<input type="hidden" id="shelf_cnt" name="shelf_cnt" value="2">


<?php 



		echo('
	


		 <table style="background-color:white;">
		<tbody>
		<tr>
				<td style="width: 100%;" colspan="6">	

		Roller Name?<input id="User_Name" name="User_Name" class="element text small" type="text"  value="'.$UserName.'" title="How do you want other people to see your rolls tagged as?"/>
		Log Code <input id="keyid" name="keyid" class="element text small" type="text" value="'.$PlayerKey.'" title="Enter your own code to save rolls to it and see them in the Roll Log."/>


		</td>
		</tr>
		<tr>
				<td style="width: 100%;" colspan="6">	
		Adventure Chat
		<textarea name="APchat" id="APchat"  rows="3" cols="85" style="font-family: Tahoma, sans-serif;" ></textarea>

		</td>
		</tr>
		
		<tr>
		<th style="background-color: #000000;"><span style="color: #ffffff;font-size:12px;text-align:left;font-family:arial, helvetica, sans-serif;" title="How many times to roll the dice?" class="element text small" >Times to Roll</span></th>
		<th style="background-color: #000000;"><span style="color: #ffffff;font-size:12px;text-align:left;font-family:arial, helvetica, sans-serif;" title="How many sides does the dice have?" class="element text small" >Sides on Dice</span></th>
		<th style="background-color: #000000;"><span style="color: #ffffff;font-size:12px;text-align:left;font-family:arial, helvetica, sans-serif;" title="Any roll with a score equal to or lower than this number will be re-rolled." class="element text small" >Re-Roll Lower Than</span></th>
		<th style="background-color: #000000;"><span style="color: #ffffff;font-size:12px;text-align:left;font-family:arial, helvetica, sans-serif;" title="Out of the number of rolls, only keep this many of the highest scores. Make this the same as Rolls if you want to keep them all." class="element text small" >Keep Highest # Rolls) </span></th>
		<th style="background-color: #000000;"><span style="color: #ffffff;font-size:12px;text-align:left;font-family:arial, helvetica, sans-serif;" title="Check this box to save the roll in the Roll Log for the Log Code." >Log Roll</span></th>
		<th style="background-color: #000000;"><span style="color: #ffffff;font-size:12px;text-align:left;font-family:arial, helvetica, sans-serif;" title="Roll!" class="element text small" >Roll </span></th>		
		</tr>
		<tr>
		<td><input  style="width: 100%;" id="times" name="times" class="element text small" type="text"  value="0" title="How many times to roll the dice?"/> </td>
		<td><input  style="width: 100%;" id="sides" name="sides" class="element text small" type="text"  value="" title="How many sides does the dice have?"/> </td>
		<td><input  style="width: 100%;" id="rrlower" name="rrlower" class="element text small" type="text"  value="0" title="Any roll with a score equal to or lower than this number will be re-rolled."/> </td>
		<td><input  style="width: 100%;" id="keephighest" name="keephighest" class="element text small" type="text" value="" title="Out of the number of rolls, only keep this many of the highest scores. Make this the same as Rolls if you want to keep them all."/> </td>
		<td>Log roll?<input id="logrolls" name="logrolls" type="checkbox"  value="logit" title="Check this box to save the roll in the Roll Log for the Log Code."></td>
		<td><input id="saveForm" class="button_text" type="submit" name="Roll" value="Roll" /> 
		</tr>

		<tr>
		<td style="width: 100%;" colspan="6">
		<textarea rows="10" cols="85" style="font-family: Tahoma, sans-serif;" >');


	if($Times>0)
				{
					if ($UserName == 'TROLL!!')
					{
						echo("Your a Troll, I don't roll for Trolls.");
					
					}
					else
					{ if ($ApChat !='')
						{
							echo($ApChat);
						}
						
						echo("Your score is ".$Rolled." the roll was " .$Times."d".$Sides. " keeping the highest ". $Keeph." rolls and re - rolling anything lower than a ".$RRLower.". Your rolls were ".$RollSer);					
					}
				}
		else		
			{if ($ApChat !='')
						{echo($ApChat);}
			 else{
				echo("Hello... I'm DiceBot! Hover over my fields and labels to have me tell you what they do!");
			 }
			}
							

if ($PlayerKey!='')
	{ 	echo (" \n\n -- Roll Log for (".$PlayerKey. ")-- \n\n");	

		$r_sql = " SELECT ID, AP_key, Roll, AP_User, Roll_date
									FROM cjsgames_cjsmain.DB_Keys 
									where AP_key = ". $PlayerKey. " order by Roll_date desc";


				if(!$result = $db->query($r_sql))
					{
						die('There was an error running the query [' . $db->error . ']');
					}

				while($rolls_result = $result->fetch_assoc())
					{
						$rolls_user = $rolls_result['AP_User'];
						$rolls_roll = $rolls_result['Roll'];
						$rolls_date = $rolls_result['Roll_date'];
						
						echo  $rolls_date . "/".$rolls_user. " - ".  $rolls_roll."\n\n";		
					}
	};

echo('</textarea>
</td>
</tr>

</tbody>
</table>');


 ?>

		</form>	
<?php
$facebook_page_id ='157282881362541';

$response = $fb->get( '/'.$facebook_page_id.'/posts?fields=message,full_picture,link,updated_time,picture&limit=5', $fb->getApp()->getAccessToken() );

$get_data = $response->getDecodedBody(); // for Array resonse

foreach ( $get_data['data'] as $single ) {

   // var_dump($single);
}

 //echo('<iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fadventurepartyorg%2Fposts%2F'.$PstId.'&width=0500" width="500" height="199" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>');
  
  if ($PstId== '372131636544330'){
  
  echo('<div class="fb-post" data-href="https://www.facebook.com/adventurepartyorg/posts/372082303215930"');
  }
  else{
  echo('<div class="fb-post" data-href="https://www.facebook.com/adventurepartyorg/posts/'.$PstId.'"');
  };
echo('  data-width="800" data-show-text="true"><blockquote cite="https://www.facebook.com/adventurepartyorg/posts/'.$PstId.'"   class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/adventurepartyorg/posts/'.$PstId.'">POST</a></div>');




?>
</form>
	<script src='https://www.thedicedealers.com/index.php?rt=r/embed/js' type='text/javascript'></script>	
<table>
	<TR>
	<TD align="center">
	<image src="http://cjsgames.com/DiceBag/SMB_CHK_lrgg.png">
	</a>
	</TD>
	
	<?php 

	
		$ab_db = new mysqli("localhost", "cjsgames_DiceBot", "Dice_Bot1!@", "cjsgames_aban961");	
				if($ab_db->connect_errno > 0)	{
												die('Unable to connect to database [' . $ab_db->connect_error . ']');
											}
		$p_sql = "SELECT product_id FROM cjsgames_aban961.abc2_products where quantity >0 order by RAND() LIMIT 0,". $ShelfCnt;

		//	$p_sql = "SELECT product_id FROM cjsgames_aban961.abc2_products where quantity >0 and product_id in (SELECT product_id FROM cjsgames_aban961.abc2_product_descriptions where name like '%mini set%')";	
		
		 
		
				if(!$p_result = $ab_db->query($p_sql))
					{	
						die('There was an error running the query [' . $ab_db->error . ']');
					}
				$p_id = 1;
				$r_cnt =1;
			
			while($product_result = $p_result->fetch_assoc())
					{
						
						if ($r_cnt == 3)
							{	$r_cnt=0;
								echo ("	</TR><TR>");
							};	
						
						echo ("	<TD>");
						echo ("		<div style='display:none;' class='abantecart-widget-container' data-url='https://www.thedicedealers.com/' data-css-url='https://www.thedicedealers.com/storefront/view/default/stylesheet/embed.css' data-language='en' data-currency='USD'>");
						echo ("			<div id='abc_".$p_id."' class='abantecart_product'  data-product-id='".$product_result['product_id']."'>");					
						echo ("				<div class='abantecart_image'></div>");	
						echo ("				<h3 class='abantecart_name'></h3>");	
						echo ("				<div class='abantecart_blurb'></div>");	
						echo ("				<div class='abantecart_price'></div>");	
						echo ("				<div class='abantecart_rating'></div>");	
						echo ("			</div>");	
						echo ("		</div>");	
						echo ("	</TD>");
						
	
						
						
						
						$r_cnt = $r_cnt +1;
						$p_id = $p_id + 1;						
					}
	
	
	
				
		?>
	

</TR></Table>


</html>

























