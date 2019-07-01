<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 26.11.2018
 * Time: 15:16
 */
require_once('functions/SqlConn.php');
//name tabelle select dabug
function DropDownSingle($wert, $tabelle, $select, $intDebug)
{
    if ($intDebug) {
        echo "<h1>DEBUG METHODE MARKE</h1>";
        var_dump($wert);
        var_dump($tabelle);
        var_dump($select);
        var_dump($intDebug);
    }
    /***********************************
     * Datenbank verbindung herstellen *
     ***********************************/

    echo "
    <select name=\"$wert\" class=\"test2\" >
       ";
    $strSQL = "SELECT `$select` FROM `$tabelle`;";
    //$strSQL = "SELECT `marke` FROM `marke`;";
    sqlConn()->query("SET NAMES 'utf8'");
    $result = sqlConn()->query($strSQL);
// SQL auswerten und ausgeben
    if ($result->num_rows > 0) {
        echo "<option></option>";
        // output data für jede Zeile
        while ($row = $result->fetch_assoc()) {
            // SELECT TAG OPTIONS AUSGABE
            echo "<option>" . $row["$select"] . "</option>";
        }
    } else {
        echo "Leider wurde nichts gefunden...DB Fehler";
        sqlConn()->close();
    }

// Verbindung wieder schliessen
// SELECT TAG & Form SCHLIESSEN
    if ($intDebug) {
        var_dump($strSQL);
        var_dump($result);
        var_dump(sqlConn());
    }
    echo "</select> ";


}