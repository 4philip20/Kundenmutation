<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 14.12.2018
 * Time: 09:42
 */
function insert_DropDownSingle($titel,$wert)
{
    echo '<div class="errorMsg">OK bin in [insert_DropDownSingle] </div>';
    var_dump($titel);
    var_dump($wert);
    /***********************************
     * Datenbank verbindung herstellen *
     ***********************************/

    echo "<select name=\"$titel\" class=\"test2\" >";
    echo "<option>$wert</option>";
    echo "</select> ";


}