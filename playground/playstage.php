<?php
include 'functionality/db_login_data.php';
include 'functionality/renderPlaystage.php';
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
                        renderPlaystage("statusmrx");
					break;
                    case 'Detektiv' :
                        renderPlaystage("statusdet");
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