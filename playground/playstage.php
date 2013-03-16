<?php
include 'functionality/db_login_data.php';
session_start();
if ($_SESSION['angemeldet'] == false) {
	header('location: login.php');
	exit ;
}
$actor = $_SESSION["actor"];

$con = mysql_connect($host_db, $user_db, $passwort_db);
mysql_select_db($db, $con);
if (!$con) {
	echo('Could not connect: ' . mysql_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <script type="text/javascript" src="js/required/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="js/playstage/main.js"></script>
        <link rel="stylesheet" href="style/style.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>playstage</title>
	</head>
	<body>
		<div id="wrapper" >
			<input type="hidden" name="id" id="id" value="" />
			<input type="hidden" name="value" id="value" value="" />
			<div id="buttons">
				<?php
				$result = mysql_query("SELECT * FROM ticket WHERE SpielerID=" . $_SESSION['id_player']);
				while ($row = mysql_fetch_array($result))
                {
			        if (!($row['Value'] == 0))
                    {
                    ?>
						<input onclick='clickButton(this.id)' 
							id= "<?php echo$row['Color']?>"
							type='button' 
							name="<?php echo $row['Color']?>"
							value="<?php echo $row['Value']?>"
						/>
			        <?php
                    }else{
                    ?>
						<input 
							disabled='disabled' 
							onclick='clickButton(this.id)' 
							id="<?php echo $row['Color']?>"
							type='button' 
							name="<?php echo $row['Color']?>"
							value="<?php echo $row['Value']?>"
						>
                    <?php
					}
				}
				?>
			</div>
			<div id="playarea" >
				<?php

				switch($actor) {
					case 'MisterX' :
                        $actualStateMrX="";
						$result2 = mysql_query("SELECT * FROM Coord WHERE statusmrx=1");
						while ($row2 = mysql_fetch_array($result2))
                        {
                            $actualStateMrX = $row2['coordID'];
				        ?>
							<div class='stand' align='center' id="<?php echo $row2['coordID']?>"
								style="left:<?php echo $row2['xAchse']?>px; top:<?php echo $row2['yAchse'] ?>px;">
								<?php echo $row2['coordID']?>
							</div>

				        <?php
							$result3 = mysql_query("SELECT * FROM neighbors WHERE coordID='". $row2['coordID'] ."'");

							while ($row3 = mysql_fetch_array($result3))
                            {
								$result3_1 = mysql_query("SELECT * FROM Coord WHERE CoordID=".$row3['CoordID_Neighbor']);
								while ($row3_1 = mysql_fetch_array($result3_1))
                                {
								?>

									<div class='standClickable' align='center' id="<?php echo $row3_1['coordID']?>"
										style='left:<?php echo $row3_1['xAchse']?>px; top:<?php echo $row3_1['yAchse']?>px;'>
										<?php echo $row3_1['coordID']?>
									</div>
				                <?php
								}

							}
                            $resultx= mysql_query("SELECT * FROM Coord WHERE coordID NOT IN
                            (SELECT coordID_Neighbor FROM neighbors WHERE
                            coordID=(SELECT coordID FROM Coord WHERE statusmrx=1))
                            AND coordID NOT LIKE ". $actualStateMrX);
                            while($rowx=mysql_fetch_array($resultx))
                            {
                                ?>
                                <div class='standNotUseful' align='center' id="<?php echo $rowx['coordID']?>"
                                     style="left:<?php echo $rowx['xAchse']?>px; top:<?php echo $rowx['yAchse'] ?>px;">
                                    <?php echo $rowx['coordID']?>
                                </div>
                            <?php
                            }

						}
					break;
                    case 'Detektiv' :
                        $result1= mysql_query("SELECT * FROM Coord WHERE statusdet=1");
                        while ($row1 = mysql_fetch_array($result1))
                        {
                            ?>
                            <div class='stand' align='center' id="<?php echo $row1['coordID']?>"
                                 style='left: <?php echo $row1['xAchse']?>px; top: <?php echo $row1['yAchse']?>px;'>
                                <?php echo $row1['coordID'] ?>
                            </div>
                        <?php
                        }
                        $result2= mysql_query("SELECT * FROM Coord WHERE statusdet IS NULL");
                        while ($row2 = mysql_fetch_array($result2))
                        {
                            ?>

                            <div class='standClickable' align='center'  id="<?php echo $row2['coordID']?>"
                                 style='left: <?php echo $row2['xAchse']?>px; top: <?php echo $row2['yAchse']?>px;'>
                                <?php echo $row2['coordID']?>
                            </div>
                        <?php
                        }
                        break;
				}
		        ?>
			</div>
		</div>
        <script type="text/javascript">
            move.init();
        </script>
	</body>
</html>