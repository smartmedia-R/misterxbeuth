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
<script type="text/javascript" src="jquery-1.8.3.js"></script>

<title>Unbenanntes Dokument</title>
</head>
<script>
$(document).ready(function(e) {		        	
		$('#actor').submit(function(){
				var formData = new FormData($(this)[0]);		
			$.ajax({
				url: 'functionality/choose_actor.php',
				type: 'POST',
				data: formData,
				async: false,
				success: function (data) {
					alert(data);					
					if($.trim(data)==='MisterX'){	
						document.location.href='playstage.php';	
					}else if($.trim(data)==='MisterX_Actor ist schon belegt, bitte wählen Sie Detectiv als Actor'){
						alert(data);
						document.location.href='geheim.php';
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
</body>
</html>