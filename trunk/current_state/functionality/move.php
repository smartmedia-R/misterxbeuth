<?php
session_start();
$id =$_SESSION ['id'] ;
include '../db_login_data.php';
$id_player = $_SESSION['id_player'];

$ticket= $_POST ['ticket'];
$value= $_POST ['value'];
$coord= $_POST ['coord'];

$con = mysql_connect ( $host_db, $user_db, $passwort_db );
mysql_select_db ( $db, $con );
if (! $con) {
	echo ('Could not connect: ' . mysql_error ());
}


$sql="UPDATE ticket SET Value=".$value." WHERE SpielerID=".$id_player." AND Color='".$ticket."'";
mysql_query($sql);
$sql2="UPDATE Coord SET statusmrx=NULL WHERE statusmrx=1";
mysql_query($sql2);
$sql3="UPDATE Coord SET statusmrx=1 WHERE CoordID=$coord";
mysql_query($sql3);



?>