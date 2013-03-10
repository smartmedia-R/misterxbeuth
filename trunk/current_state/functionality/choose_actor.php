<?php
session_start();
include '../db_login_data.php';
$id =$_SESSION ['id'] ;
$actor=$_POST['choose_actor'];
$id_player=$_SESSION['id_player'];

$con = mysql_connect ( $host_db, $user_db, $passwort_db );
mysql_select_db ( $db, $con );
if (! $con) {
	echo ('Could not connect: ' . mysql_error ());
} else {
	switch ($actor) {
		case 'MisterX':	
		$sql="SELECT COUNT(*) FROM tablespieler WHERE MisterX='1'";
		$result= mysql_query($sql);
		$einzeln = mysql_fetch_row ($result);
		if($einzeln[0]==0){
			$sql1="UPDATE tableSpieler SET MisterX ='1',CoordID='1' WHERE UserID= $id ";
			mysql_query($sql1);
			//lege die Tickets für misterX an
			$sql2="INSERT INTO ticket(Color, Value, SpielerID) VALUES ('gruen', '2', '$id_player')";
			mysql_query($sql2);
			$sql3="INSERT INTO ticket(Color, Value, SpielerID) VALUES ('blau', '3', '$id_player')";
			mysql_query($sql3);
			$sql4="INSERT INTO ticket(Color, Value, SpielerID) VALUES ('rot', '2', '$id_player')";
			mysql_query($sql4);
			$sql5="INSERT INTO ticket(Color, Value, SpielerID) VALUES ('schwarz', '1', '$id_player')";
			mysql_query($sql5);
			
			$_SESSION['actor']='MisterX';
			echo 'MisterX';
		}else{echo "MisterX_Actor ist schon belegt, bitte wählen Sie Detectiv als Actor";}
		break;
		case 'Detektiv' :
		//lege die Tickets für detektiv an
			$sql6="INSERT INTO ticket(Color, Value, SpielerID) VALUES ('gruen', '2', '$id_player')";
			mysql_query($sql6);
			$sql7="INSERT INTO ticket(Color, Value, SpielerID) VALUES ('blau', '3', '$id_player')";
			mysql_query($sql7);
			$sql8="INSERT INTO ticket(Color, Value, SpielerID) VALUES ('rot', '2', '$id_player')";
			mysql_query($sql8);
			$sql9="INSERT INTO ticket(Color, Value, SpielerID) VALUES ('schwarz', '1', '$id_player')";
			mysql_query($sql9);	
		$_SESSION['actor']='Detektiv';
		echo 'Detektiv';
		break;
	}
	

}




?>