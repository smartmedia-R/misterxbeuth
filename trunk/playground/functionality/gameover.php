<?php
/**
 * Created by JetBrains PhpStorm.
 * User: asavuskin
 * Date: 17.03.13
 * Time: 19:28
 * To change this template use File | Settings | File Templates.
 */include 'db_login_data.php';
$con = mysql_connect ( $host_db, $user_db, $passwort_db );
mysql_select_db ( $db, $con );
if (! $con) {
    echo ('Could not connect: ' . mysql_error ());
}else{
    mysql_query("UPDATE Coord SET statusmrx=NULL WHERE statusmrx IS NOT NULL");
    mysql_query("UPDATE Coord SET statusdet=NULL WHERE statusdet IS NOT NULL");
    mysql_query("UPDATE tableSpieler SET coordID=NULL WHERE coordID IS NOT NULL");
    mysql_query("UPDATE tableSpieler SET MisterX=NULL WHERE MisterX IS NOT NULL");
    mysql_query("UPDATE tableSpieler SET Detectiv=NULL WHERE Detectiv IS NOT NULL");
    echo "alle daten in DB wurden zurückgesetzt";
}

