<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/required/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/index/main.js"></script>
<title>registration</title>
</head>
<body>
	<div id="wrapper">
		<div id="response">
			<p>Registration</p>
		</div>
		<form id="form" method="post">
			<table id="table" border="0">
				<tr>
					<td>Name:</td>
					<td><input id="name" name="name" type="text" size="22"
						maxlength="20" /></td>
				</tr>
				<tr>
					<td>Nachname:</td>
					<td><input id="vorname" name="vorname" type="text" size="22" /></td>
				</tr>
				<tr>
					<td>E-Mail Adresse:</td>
					<td><input id="email" name="email" type="text" size="22" /></td>
				</tr>
				<tr>
					<td>Ihr Passwort:</td>
					<td><input id="pass" name="passwort" type="password" size="22" /></td>
				</tr>
				<tr>
					<td>Passwort wiederholen:</td>
					<td><input id="pass1" name="passwort2" type="password" size="22" /></td>
				</tr>
			</table>
			<div id="captchaDiv">
        			<?php
						  require_once ('recaptcha-php-1.11/recaptchalib.php');
						  $publickey = "6LcAJtoSAAAAACg-tAG-Pzcyn1ITP5Bympy6cGHB";									
						  echo recaptcha_get_html ( $publickey );
					?>       
        	</div>
			<div id="button_form">
                    <input id="buttons" name="backToLogin" type="button" size="20" onclick="window.location.href='login.php';" value="Zurück zum Login" />
                    <input id="buttons" name="submit" type="submit" size="20" value="Regestrieren" />
			</div>
		</form>
	</div>
    <script type="text/javascript">
        login.init();
    </script>
</body>
</html>
