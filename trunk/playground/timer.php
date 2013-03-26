<?php

/**
 * Created by JetBrains PhpStorm.
 * User: asavuskin
 * Date: 26.03.13
 * Time: 21:24
 * To change this template use File | Settings | File Templates.
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript">
        var secs=5; //Sekunden einstellen
        function docount(remaining){
            if(remaining==0){ document.location.href="playstage.php"; }
            else{
                document.getElementById('countdown')
                    .firstChild.nodeValue="Sie werden in "+remaining+ " Sekunden automatisch zurück zum Spiel weitergeleitet ";
                remain=remaining-1;
                setTimeout("docount(remain);",1000);
            }
        }
        setTimeout("docount(secs);",100);
    </script>
    <title>timer</title>
</head>
<body>
<span id="countdown">...</span>
</body>
</html>