<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unbenanntes Dokument</title>
</head>
<script type="text/javascript" src="js/required/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/login/main.js"></script>
<body>
<div class="forms" style="width:200px;">
    <form  id="loginform" method="post" action="">
        <p>Login</p>
        <table id="table" border="0">
            <tr>
                <td>Email:</td>
                <td><input id="email" name="email" type="text" size="22"
                           maxlength="20" /></td>
            </tr>
            <tr>
                <td>Passwort:</td>
                <td><input id="passwort" name="passwort" type="password" size="22"
                           maxlength="20" /></td>
            </tr>
        </table>
        <div align="center">
            <a href="index.php">regestrieren</a>
            <input type="submit" name="login" id="login" value="Anmelden" />
        </div>
    </form>
</div>
<script type="text/javascript">
    login.init();
</script>

</body>
</html>

