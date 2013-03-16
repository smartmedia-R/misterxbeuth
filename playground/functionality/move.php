<?php
session_start();
$id =$_SESSION ['id'] ;
include 'db_login_data.php';
$id_player = $_SESSION['id_player'];
$actor = $_SESSION["actor"];
$ticket= $_POST ['ticket'];
$value= $_POST ['value'];
$coord= $_POST ['coord'];

$con = mysql_connect ( $host_db, $user_db, $passwort_db );
mysql_select_db ( $db, $con );
if (! $con) {
	echo ('Could not connect: ' . mysql_error ());
}
mysql_query("UPDATE ticket SET Value=".$value." WHERE SpielerID=".$id_player." AND Color='".$ticket."'");
switch($actor) {
    case 'MisterX' :
        mysql_query("UPDATE Coord SET statusmrx=NULL WHERE statusmrx=1");
        mysql_query("UPDATE Coord SET statusmrx=1 WHERE CoordID=$coord");
    break;
    case 'Detektiv' :
        mysql_query("UPDATE Coord SET statusdet=NULL WHERE statusdet=1");
        mysql_query("UPDATE Coord SET statusdet=1 WHERE CoordID=$coord");
    break;
}