<?php
	echo "p0";
	$Loc_Roll = rand(0, 100);
	$AP_Listen = 100;		
	echo "r". $Loc_Roll;
	
	 $Loc_Place = $_GET['plc']; 
	 	echo "plc". $Loc_Place;
//Party makes a listen roll to see if they hear any interesting rumors, a rumor can be 'Followed Up'
if (	$Loc_Roll<$AP_Listen)
	{//Success 
							
							//echo " Loc_Roll AP_Listen ";
						
							// Open SQL connection
							
							echo " p1";
									$db = new mysqli("localhost", "cjsgames_ADVENTUREPARTY", "Dice_Bot1!@", "cjsgames_mercsmonsters");	
									if($db->connect_errno > 0)	{
																	die('Unable to connect to database [' . $db->connect_error . ']');
																}

					echo "p2";


/* 							// Randomly pic as location and Merc to act as the MOM
					$sql = "		Select
						que.ID Loc_Que_Id,
						que2.ID NPC_Que_Id,
						que.Status Loc_Status,
						que2.Status NPC_Status,
						(
							select
								Realm_Name
							from
								Ap_Players
							where
								WP_User_ID = que.user_ID
						) Realm_Name,
						inst.ID Location_ID,
						inst2.ID NPC_ID,
						(
							select
								oiasp.Value_Name
							from
								Ap_Obj_Aspects oiasp,
								Ap_Obj_Ins_Asp_Vals ivals,
								Ap_Obj_Aspects iasp
							where
								oiasp.ID = ivals.asp_id
								and ivals.inst_id = inst2.ID
								and ivals.asp_id = iasp.ID
								and iasp.Aspect_name = 'Class'
						) class,
						(
							select
								oiasp.Value_Name
							from
								Ap_Obj_Aspects oiasp,
								Ap_Obj_Ins_Asp_Vals ivals,
								Ap_Obj_Aspects iasp
							where
								oiasp.ID = ivals.asp_id
								and ivals.inst_id = inst2.ID
								and ivals.asp_id = iasp.ID
								and iasp.Aspect_name = 'Race'
						) Race,
						que2.Param_1 Npc_Name,
						CONCAT( UCASE( LEFT( inst.Name, 2 )), SUBSTRING( inst.Name, 3 )) Location_Name,
						que.user_ID user_Id,
						vals.Txt_Val Where_At
					from
						Ap_World_Queue que,
						Ap_Obj_Instances inst,
						Ap_Obj_Ins_Asp_Vals vals,
						Ap_Obj_Aspects asp,
						Ap_World_Queue que2,
						Ap_Obj_Instances inst2,
						Ap_Obj_Ins_Asp_Vals vals2,
						Ap_Obj_Aspects asp2
					where
						que.Event = 'Gen_Location'
						and que.status in(
							'Loaded',
							'Paged'
						)
						and que.Param_1 = inst.Name
						and inst.ID = vals.Inst_ID
						and vals.Asp_Id = asp.ID
						and asp.Value_Name = 'Instance Current Location' -- s
						and que2.Event = 'Gen_NPC'
						and que2.status in(
							'Loaded',
							'Paged'
						)
						and que2.Param_1 = inst2.Name
						and inst2.ID = vals2.Inst_ID
						and vals2.Asp_Id = asp2.ID
						and asp2.Value_Name = 'Instance Current Location'
						and que2.Param_1 = '". $Loc_Place . "'
					order by
						rand() limit 1";
 */
				

							// Randomly pic as location and Merc to act as the MOM
					$sql = "		Select
						que.ID Loc_Que_Id,
						que2.ID NPC_Que_Id,
						que.Status Loc_Status,
						que2.Status NPC_Status,
						(
							select
								Realm_Name
							from
								Ap_Players
							where
								WP_User_ID = que.user_ID
						) Realm_Name,
						inst.ID Location_ID,
						inst2.ID NPC_ID,
						(
							select
								oiasp.Value_Name
							from
								Ap_Obj_Aspects oiasp,
								Ap_Obj_Ins_Asp_Vals ivals,
								Ap_Obj_Aspects iasp
							where
								oiasp.ID = ivals.asp_id
								and ivals.inst_id = inst2.ID
								and ivals.asp_id = iasp.ID
								and iasp.Aspect_name = 'Class'
						) class,
						(
							select
								oiasp.Value_Name
							from
								Ap_Obj_Aspects oiasp,
								Ap_Obj_Ins_Asp_Vals ivals,
								Ap_Obj_Aspects iasp
							where
								oiasp.ID = ivals.asp_id
								and ivals.inst_id = inst2.ID
								and ivals.asp_id = iasp.ID
								and iasp.Aspect_name = 'Race'
						) Race,
						que2.Param_1 Npc_Name,
						CONCAT( UCASE( LEFT( inst.Name, 2 )), SUBSTRING( inst.Name, 3 )) Location_Name,
						que.user_ID user_Id,
						vals.Txt_Val Where_At
					from
						Ap_World_Queue que,
						Ap_Obj_Instances inst,
						Ap_Obj_Ins_Asp_Vals vals,
						Ap_Obj_Aspects asp,
						Ap_World_Queue que2,
						Ap_Obj_Instances inst2,
						Ap_Obj_Ins_Asp_Vals vals2,
						Ap_Obj_Aspects asp2
					where
						que.Event = 'Gen_Location'
						and que.Param_1 = inst.Name
						and inst.ID = vals.Inst_ID
						and vals.Asp_Id = asp.ID
						and asp.Value_Name = 'Instance Current Location' -- s
						and que2.Event = 'Gen_NPC'
						and que2.Param_1 = inst2.Name
						and inst2.ID = vals2.Inst_ID
						and vals2.Asp_Id = asp2.ID
 						and asp2.Value_Name = 'Instance Home Location'
 					 and vals2.Txt_Val = '". $Loc_Place . "'
					order by
						rand() limit 1;";				
									
									echo $sql;
								if(!$result1 = $db->query($sql))
									{
										die('There was an error running the query [' . $db->error . ']');
									}
								echo "p3";
									while($row = $result1->fetch_assoc())
										{
										echo "4";
							
													$author_id = $row['user_ID'];
													$slug = $row['Param_1'];
													
													$Location_ID = $row['Location_ID'];
													$Location_Name = $row['Location_Name'];						
													$Loc_Status = $row['Loc_Status'];
													$Loc_Que_Id = $row['Loc_Que_Id'];						
													

													$NPC_Que_Id = $row['NPC_Que_Id'];							
													$NPC_Status = $row['NPC_Status'];						
													$Realm_Name = $row['Realm_Name'];

													$NPC_ID = $row['NPC_ID'];
													$Class = $row['class'];
													$Race = $row['Race'];
													$Npc_Name = $row['Npc_Name'];

													$User_Id = $row['user_Id'];
													$Where_At = $row['Where_At'];

													
													$npc = $Race.' '.$Class;
													//echo $Realm_Name;
													$Loc_slug = trim($Location_Name).'-'. trim($Where_At). '-'. trim($Realm_Name);
													$Loc_Title = trim($Location_Name);
													

							
																
										
												echo "<div style=' text-align: center; border: 3px solid green; background:#d7fdc7; color:#000; font-size:75%; font-family: Comic Sans MS, cursive, sans-serif'>";
												echo "<H5>";                            
											//	echo "You hear a ".$npc." talking about ".$Loc_Title. " <a href=". get_permalink($NPC_Id)."> do you ask about it? </a>";
													echo "You hear a ".$npc." talking about ".$Loc_Title. ". Do you  <input id='animateButton' type='button' onclick=".chr(34)."talk('".$npc."','".$Npc_Name."','".$Loc_Title. "')".chr(34)." value = 'ask'> about it?";


												echo "</H5>";
												echo "</div>";								
									}

		}


else //"Loc_Roll<AP_Listen";
	{ //Listen Failed
		echo " <button onclick=".chr(34)." ()".chr(34).">Seek other Adventure! ".$AP_Listen."%</button> ";		
		$npc_sql = "SELECT
						concat( asp.Value_Name,' ', asp2.Value_Name ) npc_name
					from
						Ap_Obj_Aspects asp,
						Ap_Obj_Aspects asp2
					where asp.Aspect_Name = 'Race'
						and asp2.Aspect_Name = 'Class'
					order by
						RAND() limit 1";
		if(!$result1 = $db->query($npc_sql))
			{
				die('There was an error running the query [' . $db->error . ']');
			}
		echo "7";
						while($row = $result1->fetch_assoc())
							{
							echo "8";														
											$npc = $row['npc_name'];
								
							}
												
		echo "<div style='  text-align: center; border: 3px solid black; background:#f2efbe; color:#000; font-size:75%;'>";						
		echo "<H5>";                            
		echo "The room is busy, you don't hear any rumors but you see a lone <a>".$npc."</a> that looks like they might be looking for an <a>Adventure Party.</a>";
		echo "</H5>";
		echo "</div>";												
							
	}
echo "<hr>";					


?>