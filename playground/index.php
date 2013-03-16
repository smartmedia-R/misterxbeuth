<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
<title>registration</title>

<script>
	function linkToLogin(){
			document.location.href='login/login.php';
	}
		
	$(document).ready(function(e) {		        	
		$("#form").submit(function(){
				var formData = new FormData($(this)[0]);		
			$.ajax({
				url: 'registration_script.php',
				type: 'POST',
				data: formData,
				async: false,
				success: function (data) {
					if($.trim(data)==='der Eintrag wurde eingefügt'){
						document.location.href='geheim.php';
					}if($.trim(data)==="The reCAPTCHA wasn't entered correctly. Go back and try it again."){
						alert(data);
						document.location.href='index.php';
						
					}else{
						alert(data);
					}
    			},
				cache: false,
				contentType: false,
				processData: false
			});			
			return false;			 
		});
 	});
</script>
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
				<input id="buttons" name="back" type="button" size="20"
					value="Zurück" onclick="backToIndex()" /> 
                    <input id="buttons" name="submit" type="submit" size="20" value="Absenden" />
			</div>
		</form>
	</div>

</body>
</html>
