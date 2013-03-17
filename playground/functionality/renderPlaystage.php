<?php
/**
 * Created by JetBrains PhpStorm.
 * User: asavuskin
 * Date: 17.03.13
 * Time: 15:42
 * To change this template use File | Settings | File Templates.
 */
function renderPlaystage($status){

    $result2 = mysql_query("SELECT * FROM Coord WHERE ".$status."=1");
    while ($row2 = mysql_fetch_array($result2))
    {
        $actualState = $row2['coordID'];
        ?>
        <div class='stand' align='center' id="<?php echo $row2['coordID']?>"
             style="left:<?php echo $row2['xAchse']?>px; top:<?php echo $row2['yAchse'] ?>px;">
            <?php echo $row2['coordID']?>
        </div>

        <?php
        $result3 = mysql_query("SELECT * FROM neighbors WHERE coordID='". $row2['coordID'] ."'");

        while ($row3 = mysql_fetch_array($result3))
        {
            $result3_1 = mysql_query("SELECT * FROM Coord WHERE CoordID=".$row3['CoordID_Neighbor']);
            while ($row3_1 = mysql_fetch_array($result3_1))
            {
                ?>

                <div class='standClickable' align='center' id="<?php echo $row3_1['coordID']?>"
                     style='left:<?php echo $row3_1['xAchse']?>px; top:<?php echo $row3_1['yAchse']?>px;'>
                    <?php echo $row3_1['coordID']?>
                </div>
            <?php
            }

        }
        $resultx= mysql_query("SELECT * FROM Coord WHERE coordID NOT IN
                            (SELECT coordID_Neighbor FROM neighbors WHERE
                            coordID=(SELECT coordID FROM Coord WHERE ".$status."=1))
                            AND coordID NOT LIKE ". $actualState);
        while($rowx=mysql_fetch_array($resultx))
        {
            ?>
            <div class='standNotUseful' align='center' id="<?php echo $rowx['coordID']?>"
                 style="left:<?php echo $rowx['xAchse']?>px; top:<?php echo $rowx['yAchse'] ?>px;">
                <?php echo $rowx['coordID']?>
            </div>
        <?php
        }

    }

}