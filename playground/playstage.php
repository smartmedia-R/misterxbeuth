<?php
include 'db_login_data.php';
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
        <script type="text/javascript" src="jquery-1.8.3.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script>
            $(document).ready(function(e) {

                $('.standClickable').click(function() {
                    if (document.getElementById('id').value == "" && document.getElementById('value').value == "") {
                        alert('bitte erst ticket auswählen');
                    } else {
                        $.ajax({
                            url : 'functionality/move.php',
                            type : 'POST',
                            data : {
                                coord : $(this).attr('id'),
                                ticket : document.getElementById('id').value,
                                value : document.getElementById('value').value

                            },
                            async : false,
                            success : function(data) {
                                //  alert(data);
                                document.location.href = 'playstage.php'
                            }
                        });
                    }
                });

            });
        </script>
        <link rel="stylesheet" href="style/style.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>playstage</title>
	</head>

	<body>
		<div id="wrapper" >
			<input type="hidden" name="id" id="id" value="" />
			<input type="hidden" name="value" id="value" value="" />

			<div id="buttons">
				<!--<input onclick='clickButton(this.id)' id='gruen' type='button' name='gruen' value='4'>-->
				<?php
				$sql = "SELECT * FROM ticket WHERE SpielerID=" . $_SESSION['id_player'];
				$result = mysql_query($sql);

				while ($row = mysql_fetch_array($result))
                {
			        if (!($row['Value'] == 0))
                    {
                    ?>
						<input onclick='clickButton(this.id)' 
							id= "<?php echo$row['Color']?> " 
							type='button' 
							name="<?php echo $row['Color'] ?>" 
							value=" <?php echo $row['Value'] ?> "
						/>
					
			        <?php
                    }
                    else
                    {
                    ?>
						<input 
							disabled='disabled' 
							onclick='clickButton(this.id)' 
							id=" <?php echo $row['Color'] ?> " 
							type='button' 
							name=" <?php echo $row['Color'] ?> "
							value=" <?php echo $row['Value'] ?> "
						>
                    <?php
					}
				}
				
				?>
			</div>
			<div id="playarea" >
				<?php

				switch($actor) {
					case'MisterX' :
						$sql2 = "SELECT * FROM Coord WHERE statusmrx=1";
						$result2 = mysql_query($sql2);
						while ($row2 = mysql_fetch_array($result2))
                        {
				        ?>
							<div class='stand' align='center' id=" <?php echo $row2['coordID']?>"
								style=" left:<?php echo $row2['xAchse']?>px; top:<?php echo $row2['yAchse'] ?>px;">
								<?php echo $row2['coordID']?>
							</div>

				        <?php
							$sql3 = "SELECT * FROM neighbors WHERE coordID='" . $row2['coordID'] . "'";
							$result3 = mysql_query($sql3);
							while ($row3 = mysql_fetch_array($result3))
                            {
								$sql3_1 = "SELECT * FROM Coord WHERE CoordID=" . $row3['CoordID_Neighbor'];
								$result3_1 = mysql_query($sql3_1);
								while ($row3_1 = mysql_fetch_array($result3_1))
                                {
								?>
									<div class='standClickable' align='center' id="<?php echo $row3_1['coordID'] ?>"
										style='left:<?php $row3_1['xAchse']?>px; top:<?php echo $row3_1['yAchse']?>px;'>
										<?php echo $row3_1['coordID']?>
									</div>
				                <?php
								}
							}
						}
					break;
					case'Detectiv' :
						$sql="SELECT * FROM Coord WHERE statusdet=1";
						$result= mysql_query($sql);
						while ($row = mysql_fetch_array($result))
                        {
				        ?>
							<div class='stand' align='center' id="<?php echo $row['coordID']?>  "  
								style='left: <?php echo $row['xAchse'] ?>px; top: <?php echo $row['yAchse'] ?>px;'>
								<?php echo $row['coordID'] ?> 
							</div>							
				        <?php
						}
					    $sql2="SELECT * FROM Coord WHERE statusdet!=1";
						$result2= mysql_query($sql2);
						while ($row2 = mysql_fetch_array($result2))
                        {
				        ?>
							<div class='standClickable' align='center'  id="<?php echo $row2['coordID']?>  "
								style='left: <?php echo $row2['xAchse'] ?>px; top: <?php echo $row2['yAchse'] ?>px;'>
								<?php echo $row2['coordID'] ?>
							</div>
			            <?php
						}					
					break;
				}
		        ?>
			</div>
		</div>
	</body>
</html>