<?php
//echo "e1";		
//require('/home2/adventv2/public_html/wp-blog-header.php');
//require_once ('http://adventureparty.org/wp-load.php');
//require_once('http://adventureparty.org/wp-includes/option.php');
//global $wp, $wp_query;
//echo "e2";		


echo " PT 1";
				$db = new mysqli("localhost", "cjsgames_ADVENTUREPARTY", "Dice_Bot1!@", "cjsgames_mercsmonsters");	
				if($db->connect_errno > 0)	{
												die('Unable to connect to database [' . $db->connect_error . ']');
											}

echo "2";

		// Randomly pic as location and Merc to act as the MOM
		$r_sql = "select
					Instance_Meta_Instance_Home_Location loc
				from
					cjsgames_mercsmonsters.`Ap_Obj_Base_Traits_Inst_Asp_vw`
				where
					Instance_Meta_Instance_Home_Location != '0'
					and Typ_Id = (select Id from Ap_Obj_Types where name = 'Structure')
				order by
					rand() limit 1	";
			

				if(!$result1 = $db->query($r_sql))
					{
						die('There was an error running the query [' . $db->error . ']');
					}
echo "3";
				while($place_result = $result1->fetch_assoc())
					{
echo "4";
						$place_name = $place_result['loc'];
					echo "<div><h2>You have arived in ". $place_name . "</h2><Div>";
							echo "<form ><input type='hidden' name='place_name' id ='place_name' value='$place_name'></form>";


							$structure_sql = "select name, Id inst_Id, Typ_Id
													
												from
													cjsgames_mercsmonsters.`Ap_Obj_Base_Traits_Inst_Asp_vw`
												where
													Instance_Meta_Instance_Home_Location = ".chr(34). $place_name .chr(34)." and Typ_Id = (select Id from Ap_Obj_Types where name = 'Structure')	";
					

									if(!$result2 = $db->query($structure_sql))
										{
											die('There was an error running the query [' . $db->error . ']');
										}

								while($structure_result = $result2->fetch_assoc())
									{
										$structure_name = $structure_result['name'];
											$structure_inst_Id = $structure_result['inst_Id'];
											$structure_typ_id = $structure_result['Typ_Id'];
											echo "<div  onclick=".chr(34)."evesdrop()".chr(34)." style='cursor: pointer;'><h3>Go to ". str_replace("in ".$place_name,'',$structure_name). "</h3>";
											echo "<object id='svg1' data='http://adventureparty.org/imgs/structures/STRCT1.svg' type='image/svg+xml' ></object><div>";
											
											

									}
					}

			
					
			/* 
								mysql_free_result($place_result);
								mysql_free_result($structure_result);					
								mysql_close(); */
					
					
			
					
						?>