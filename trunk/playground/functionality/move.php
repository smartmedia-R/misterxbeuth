<?php
session_start();
$id =$_SESSION ['id'] ;
include 'db_login_data.php';
$actor = $_SESSION["actor"];
$ticket= $_POST ['ticket'];
$value= $_POST ['value'];
function updateDBafterMove($status){

    mysql_query("UPDATE Coord SET ".$status."=NULL WHERE ".$status."=1");
    mysql_query("UPDATE Coord SET ".$status."=1 WHERE CoordID=".$_POST ['coord']);
    mysql_query("UPDATE tableSpieler SET coordID=".$_POST ['coord']." WHERE UserID=".$_SESSION['id']);
}
$con = mysql_connect ( $host_db, $user_db, $passwort_db );
mysql_select_db ( $db, $con );
if (! $con) {
	echo ('Could not connect: ' . mysql_error ());
}
mysql_query("UPDATE ticket SET Value=".$value." WHERE SpielerID=".$_SESSION['id_player']." AND Color='".$ticket."'");
switch($actor) {
    case 'MisterX' :
       updateDBafterMove("statusmrx");
    break;
    case 'Detektiv' :
        updateDBafterMove("statusdet");
    break;
}