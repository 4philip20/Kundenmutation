<?php

require_once('functions/SqlConn.php');

function setDropDownMultible($wert, $tabelle, $select, $intDebug)
{
    if ($intDebug) {
        var_dump($wert);
        var_dump($tabelle);
        var_dump($select);
    }
    /***********************************
     * Datenbank verbindung herstellen *
     ***********************************/
    echo "
    <select name=\"$wert\" class=\"test\" multiple=\"multiple\">
    ";
    $strSQL = "SELECT `$select` FROM `$tabelle`;";
    sqlConn()->query("SET NAMES 'utf8'");
    $result = sqlConn()->query($strSQL);

// SQL auswerten und ausgeben
    if ($result->num_rows > 0) {
        // output data für jede Zeile
        while ($row = $result->fetch_assoc()) {
            // SELECT TAG OPTIONS AUSGABE
            echo "<option>" . $row["$select"] . "</option>";
        }
    } else {
        echo "Leider wurde nichts gefunden...DB Fehler";
    }

// Verbindung wieder schliessen
// SELECT TAG & Form SCHLIESSEN
    echo "</select>  ";
    if ($intDebug) {
        var_dump($strSQL);
        var_dump($result);
    }
    sqlConn()->close();
}