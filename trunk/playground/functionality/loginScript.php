<?php

// Session starten
session_start ();

// Variablen deklarieren
$_SESSION ['angemeldet'] = false;
$benutzername = '';
$passwort = '';
$fehlermeldung = '';

// Funktion zum verbinden zur Datenbank
function db_connect() {
	
	require_once '../db_login_data.php';
	// Verbindung herstellen und Verbindungskennung zurückgeben
	$conid = mysql_connect ( $host_db, $user_db, $passwort_db ) or die ( 'Verbindungsfehler!' );
	if (is_resource ( $conid )) {
		mysql_select_db ( $db, $conid ) or die ( 'Datenbankfehler!' );
	}
	return $conid;
}

// Wenn das Formular abgeschickt wurde

	// Benutzereingabe umladen, von Leerzeichen befreien und
	$email = $_POST ['email'];
	$passwort = md5 ( $_POST ['passwort'] );
	
	// Benutzereingabe mit User in der Datenbank vergleichen
	$conid = db_connect ();
	$sql = "SELECT `UserID`, `Name` FROM `alleuser` WHERE email = '$email' AND passwort = '$passwort'";
	
	$ergebnis = mysql_query ( $sql );
	
	// Stimmen die Benutzereingaben überein, wurde 1 Datensatz gefunden
	 if (mysql_num_rows($ergebnis) == 1)
    {
       echo 'war erfolgreich';
       while ( $row = mysql_fetch_array ( $ergebnis ) ) {
			$_SESSION['id'] = $row ['UserID'];
			$_SESSION ['name'] = $row ['Name'];
			
			$result=mysql_query("SELECT * FROM tableSpieler WHERE UserID=".$row ['UserID']);
			while($row2=mysql_fetch_array($result)){
				$_SESSION['id_player']=$row2['SpielerID'];
			}
		}
		
		$_SESSION ['angemeldet'] = true;
		$_SESSION ['email123'] = $email;
		exit ();
    }
    else
    {
        echo 'Die Anmeldung war fehlerhaft';
    }
