<?php
session_start();
include 'db_login_data.php';
require_once ('../recaptcha-php-1.11/recaptchalib.php');
$privatekey = "6LcAJtoSAAAAAIJ9MHr5zX1EXfNi7jHlr4l_hObg ";
$resp = recaptcha_check_answer ( $privatekey, $_SERVER ["REMOTE_ADDR"], 
								 $_POST ["recaptcha_challenge_field"], 
								 $_POST ["recaptcha_response_field"] );

$value1 = mysql_real_escape_string ( $_POST ['name'] );
$value2 = mysql_real_escape_string ( $_POST ['vorname'] );
$value3 = mysql_real_escape_string ( $_POST ['email'] );
$value4 = mysql_real_escape_string ( $_POST ['passwort'] );
$value5 = mysql_real_escape_string ( $_POST ['passwort2'] );
$value6 = md5($value5);

$con = mysql_connect ( $host_db, $user_db, $passwort_db );
mysql_select_db ( $db, $con );
if (! $con) {
	echo ('Could not connect: ' . mysql_error ());
} else {
	$einlesen = mysql_query ( "SELECT COUNT(*) FROM alleuser WHERE Email='$value3'" );
	$einzeln = mysql_fetch_row ( $einlesen );
	if ($resp->is_valid) {
		if ($value1 != NULL && $value2 != NULL && $value3 != NULL && $value4 != NULL && $value5 != NULL) {
			if ($value4 == $value5) {
				if ($einzeln [0] == 0) {
					if (preg_match ( '|^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$|i', $value3 )) {
							mysql_query ( "INSERT INTO alleuser ( Name, Vorname, Email, Passwort)
								VALUES ( '$value1','$value2','$value3','$value6')" );
							$id = mysql_insert_id();
							$_SESSION ['id'] = $id;
							mysql_query ("INSERT INTO tablespieler( Beschreibung, UserID) VALUES ('$value1', '$id')");
                            mysql_query("INSERT INTO ticket(Color, SpielerID) VALUES ('gruen', '$id')");
                            mysql_query("INSERT INTO ticket(Color, SpielerID) VALUES ('blau', '$id')");
                            mysql_query("INSERT INTO ticket(Color, SpielerID) VALUES ('rot', '$id')");
                            mysql_query("INSERT INTO ticket(Color, SpielerID) VALUES ('schwarz', '$id')");
							$_SESSION['id_player']=mysql_insert_id();
							$_SESSION ['angemeldet'] = true;
							$_SESSION ['name'] = $value1;
							echo "der Eintrag wurde eingefügt";							
					} else {echo "die Emailadresse ist nicht korrekt";}
				} else {echo "Der Eintrag existiert schon";}
			} else {echo "die Passwörter sind nicht identisch";}
		} else {echo "Sie haben nicht alle Felder ausgefühlt";}
	} else {
		echo ("The reCAPTCHA wasn't entered correctly. Go back and try it again.");
	}
	mysql_close ( $con );
	
}
?> 
