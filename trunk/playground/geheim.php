<?php
session_start();
echo "<div class='id'>".$_SESSION['id']."</div>";
echo "<div class='id_player'>".$_SESSION['id_player']."</div>";
if ($_SESSION['angemeldet'] == false){
	 header( 'location: login.php' );
        exit;
}
$test =$_SESSION['name'];
if(isset( $_POST['logout'])){
	session_destroy();
	$_SESSION['angemeldet'] == false;
	header( 'location: login.php' );		
}		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/required/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/geheim/main.js"></script>
<title>my location</title>
</head>
<body>
    <?php echo  "Hallo ".$test."  " ?>
    <form id="logoutForm"  method="post">
        <input name="logout" value="logout" type="submit" />
    </form>
    <form id="actor"  method="post">
        <label class="required" for="choose_actor">Actor</label>
        <select id="choose_actor" name="choose_actor" style="width: 200px;" >
            <option value="MisterX">MisterX</option>
            <option value="Detektiv">Detektiv</option>
        </select>
        <input type="submit" id="actor" />
    </form>
    <script type="text/javascript">
        choose_actor.init();
    </script>
</body>
</html>