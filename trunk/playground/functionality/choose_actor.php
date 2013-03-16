<?php
session_start();
include 'db_login_data.php';
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
            $result= mysql_query("SELECT COUNT(*) FROM tablespieler WHERE MisterX='1'");
            $einzeln = mysql_fetch_row ($result);
            if($einzeln[0]==0){
                mysql_query("UPDATE tableSpieler SET MisterX ='1',CoordID='1' WHERE UserID=".$id );
                mysql_query("UPDATE Coord SET statusmrx=1 WHERE CoordID=1");
                mysql_query("UPDATE ticket SET Value=2 WHERE SpielerID=".$id_player." AND Color='gruen'");
                mysql_query("UPDATE ticket SET Value=3 WHERE SpielerID=".$id_player." AND Color='blau'");
                mysql_query("UPDATE ticket SET Value=2 WHERE SpielerID=".$id_player." AND Color='rot'");
                mysql_query("UPDATE ticket SET Value=1 WHERE SpielerID=".$id_player." AND Color='schwarz'");
                $_SESSION['actor']='MisterX';
                echo 'MisterX';
            }else{
                echo "MisterX_Actor ist schon belegt, bitte wählen Sie Detectiv als Actor";
            }
		break;
		case 'Detektiv' :
            $result= mysql_query("SELECT COUNT(*) FROM tablespieler WHERE Detectiv='1'");
            $einzeln = mysql_fetch_row ($result);
            if($einzeln[0]==0){
                mysql_query("UPDATE tableSpieler SET Detectiv ='1',CoordID='1' WHERE UserID=".$id );
                mysql_query("UPDATE Coord SET statusdet=1 WHERE CoordID=9");
                mysql_query("UPDATE ticket SET Value=2 WHERE SpielerID=".$id_player." AND Color='gruen'");
                mysql_query("UPDATE ticket SET Value=3 WHERE SpielerID=".$id_player." AND Color='blau'");
                mysql_query("UPDATE ticket SET Value=2 WHERE SpielerID=".$id_player." AND Color='rot'");
                mysql_query("UPDATE ticket SET Value=1 WHERE SpielerID=".$id_player." AND Color='schwarz'");
                $_SESSION['actor']='Detektiv';
                echo 'Detektiv';
            }else{
                echo "Detektiv_Actor ist schon belegt, bitte wählen Sie MisterX als Actor";
            }
		break;
	}
}