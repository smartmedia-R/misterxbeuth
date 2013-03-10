<?php
include 'db_login_data.php';
session_start();
if ($_SESSION['angemeldet'] == false) {
	header('location: login.php');
	exit ;
}/**/
$actor = $_SESSION["actor"];
$con = mysql_connect($host_db, $user_db, $passwort_db);
mysql_select_db($db, $con);
if (!$con) {
	echo('Could not connect: ' . mysql_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<style>
		.standClickable:hover {
			background-color: #7AA100;
		}

		#rot:hover {
			background: #FF0000;
			color: #FFF;
			background-image: url(images/grd2.png);
			background-repeat: repeat-x;
		}

		#rot {
			-moz-border-radius: 18px;
			-webkit-border-radius: 18px;
			border-bottom-left-radius: 10px 18px;
			border-bottom-right-radius: 10px 18px;
			border-top-left-radius: 10px 18px;
			border-top-right-radius: 10px 18px;
			padding: 2px 15px;
			font-family: Arial, Helvetica, sans-serif;
			color: #FFF;
			background-color: #CC0000;
			width: 80px;
			text-align: center;
			background-image: url(images/grd2.png);
			background-repeat: repeat-x;
		}
		#gruen:hover {
			background: #00FF00;
			color: #FFF;
			background-image: url(images/grd2.png);
			background-repeat: repeat-x;
		}

		#gruen {
			-moz-border-radius: 18px;
			-webkit-border-radius: 18px;
			border-bottom-left-radius: 10px 18px;
			border-bottom-right-radius: 10px 18px;
			border-top-left-radius: 10px 18px;
			border-top-right-radius: 10px 18px;
			padding: 2px 15px;
			font-family: Arial, Helvetica, sans-serif;
			color: #FFF;
			background-color: #00CC00;
			width: 80px;
			text-align: center;
			background-image: url(images/grd2.png);
			background-repeat: repeat-x;
		}
		#blau:hover {
			background: #0000FF;
			color: #FFF;
			background-image: url(images/grd2.png);
			background-repeat: repeat-x;
		}

		#blau {
			-moz-border-radius: 18px;
			-webkit-border-radius: 18px;
			border-bottom-left-radius: 10px 18px;
			border-bottom-right-radius: 10px 18px;
			border-top-left-radius: 10px 18px;
			border-top-right-radius: 10px 18px;
			padding: 2px 15px;
			font-family: Arial, Helvetica, sans-serif;
			color: #FFF;
			background-color: #0000CC;
			width: 80px;
			text-align: center;
			background-image: url(images/grd2.png);
			background-repeat: repeat-x;
		}
		#schwarz:hover {
			color: #FFF;
			background-color: #999999;
			background-image: url(images/grd2.png);
			background-repeat: repeat-x;
		}

		#schwarz {
			-moz-border-radius: 18px;
			-webkit-border-radius: 18px;
			border-bottom-left-radius: 10px 18px;
			border-bottom-right-radius: 10px 18px;
			border-top-left-radius: 10px 18px;
			border-top-right-radius: 10px 18px;
			padding: 2px 15px;
			font-family: Arial, Helvetica, sans-serif;
			color: #FFF;
			background-color: #000000;
			width: 80px;
			text-align: center;
			background-image: url(images/grd2.png);
			background-repeat: repeat-x;
		}

	</style>
	<script type="text/javascript" src="jquery-1.8.3.js"></script>
	<script>
		function clickButton(id) {
			//entscheide dich endlich, sonst hast du keine ticket mehr!!!!
			if ((document.getElementById('id').value == "" && document.getElementById('value').value == "") || id != document.getElementById('id').value) {

				var val = document.getElementById(id).value - 1;
				document.getElementById(id).value = val;
				document.getElementById('id').value = id;
				document.getElementById('value').value = val;
			} else {
				alert('das ticket ist schon ausgewählt')
			}

		}


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
						},
					});
				}
			});

		});

	</script>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Unbenanntes Dokument</title>

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

				while ($row = mysql_fetch_array($result)) {
					if (!($row['Value'] == 0)) {
						echo "<input onclick='clickButton(this.id)' id='" . $row['Color'] . "' type='button' name='" . $row['Color'] . "' value='" . $row['Value'] . "'>";
					} else {
						echo "<input disabled='disabled' onclick='clickButton(this.id)' id='" . $row['Color'] . "' type='button' name='" . $row['Color'] . "' value='" . $row['Value'] . "'>";
					}
				}
				/**/
				?>
			</div>
			<div id="playarea" >
				<?php

				switch($actor) {
					case'MisterX' :
						$sql4 = "SELECT * FROM Coord  WHERE statusmrx=NULL";
						$result4 = mysql_query($sql4);
						while ($row4 = mysql_fetch_array($result4)) {
							echo "<div class='stand' align='center' id=" . $row4['coordID'] . " style='width:50px;height: 50px; background-color:#F00;position:absolute;border: solid medium #000; left:" . $row4['xAchse'] . "px; top:" . $row4['yAchse'] . "px;'>" . $row4['coordID'] . "</div>";
						}
						$sql2 = "SELECT * FROM Coord WHERE statusmrx=1";
						$result2 = mysql_query($sql2);
						while ($row2 = mysql_fetch_array($result2)) {
							echo "<div class='stand'  align='center' id=" . $row2['coordID'] . "  style='width:50px;height: 50px; background-color:#0F0;position:absolute;border: solid medium #000; left:" . $row2['xAchse'] . "px; top:" . $row2['yAchse'] . "px;'>" . $row2['coordID'] . "</div>";
							$sql3 = "SELECT * FROM neighbors WHERE coordID='" . $row2['coordID'] . "'";
							$result3 = mysql_query($sql3);
							while ($row3 = mysql_fetch_array($result3)) {
								$sql3_1 = "SELECT * FROM Coord WHERE CoordID=" . $row3['CoordID_Neighbor'];
								$result3_1 = mysql_query($sql3_1);
								while ($row3_1 = mysql_fetch_array($result3_1)) {
									echo "<div class='standClickable' align='center' id=" . $row3_1['coordID'] . " style='width:50px;height: 50px; background-color:#00F;position:absolute;border: solid medium #000; left:" . $row3_1['xAchse'] . "px; top:" . $row3_1['yAchse'] . "px;'>" . $row3_1['coordID'] . "</div>";

								}
							}

						}
						break;
				}
				?>
			</div>
		</div>
	</body>
</html>