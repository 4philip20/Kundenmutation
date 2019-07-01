<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 29.11.2018
 * Time: 10:17
 */
require_once('config.php');
require_once('functions/SqlConn.php');

//75 Parameters
function save($art1_1, $art1_2, $art1_3, $art1_4, $art1_5, $art1_6, $art1_7, $art1_8, $art1_9, $art1_10, $art1_11, $art1_12, $art1_13, $art1_14, $art1_15, $art1_16, $art1_17, $art1_18, $art1_19, $art1_20, $art1_21, $art1_22,$art1_23, $art1_24, $art1_25, $art1_26, $art1_27, $art1_28, $art1_29, $art1_30,$art1_31,$art1_32,$art1_33,$art1_34,$art1_35,$art1_36,$art1_37,$art1_38,$art1_39,$art1_40,$art1_41,$art1_42,$art1_43,$art1_44,$art1_45,$art1_46,
              $art2_1, $art2_2, $art2_3, $art2_4, $art2_5, $art2_6, $art2_7, $art2_8, $art2_9, $art2_10, $art2_11, $art2_12, $art2_13, $art2_14, $art2_15, $art2_16, $art2_17, $art2_18, $art2_19, $art2_20, $art2_21, $art2_22, $art2_23, $art2_24, $art2_25, $art2_26, $art2_27, $art2_28, $art2_29, $art2_30, $art2_31,
              $art3_1, $art3_2, $art3_3, $art3_4, $art3_5, $art3_6, $art3_7, $art3_8, $art3_9, $art3_10, $art3_11, $art3_12, $art3_13, $art3_14, $art3_15, $art3_16, $art3_17,$art3_18,
              $art4_1, $art4_2, $art4_3, $art4_4, $art4_5,
              $art,$artForm
)
{
    global $ID;

    // SQL Abfrage Passwort abfragen und Vergleichen vorbereiten und ausführen
    //$strSQL = "INSERT INTO `formular`(\"$tabellenAttribute\") VALUES (\"$values\");";
    $strSQL = "INSERT INTO `formular`(`ART`,`PVDN`, `dbname`, `dbvorname`, `dbadresse`, `PVN`, `PVAD`, `PVO`, `KDN1`, `KDN2`, `KDS`, `KDNR`, `KDPLZ`, `KDORT`, `KDRE`, `KDLA`, `KDPF`, `KDSP`, `KDTL`, `KDMO`, `KDEM`, `KDFX`, `STMWST`, `dgb`, `ANPN`, `ANPV`, `ANPE`, `ANPT`, `MABWA`, `ASAA`, `ASAVA`, `ASAM`, `AGVS`, `bemebung`, `datum`, `auftraggeber`, `buchhaltung`, `vs`, `erfasst`, `ROUTEN`, `PVG`, `BKDKA`, `MW`, `RGM`, `MAFPH`, `MAL`, `MAW`, `MAB`, `MAPD`, `MANFR`, `MATS`, `MATSS`, `MAWA`, `KGHZ`, `KGHP`, `KRH`, `KSVT`, `KIGH`, `KMöGZ`, `KTSF`, `KTSMöGE`, `KMöGM`, `KTSMoGP`, `KZU`, `KBMZ`, `KBMP`, `KSMZ`, `KSMP`, `SPL`, `SPF`, `SPA`, `BKDZB`, `BKDGS`, `PREISLISTE`, `LIFPRIO`, `AWERK`,`Vbinco`,`RGT`, `ANPA`, `ANPF` , `MAKA`, `MAKG`, `MAGK`, `MAGM`, `MAPHK`, `MACK`, `KBMN`, `KSMN` , `VKGRP` , `partnername` , `emailadresse` , `regulierer` , `warenempf`, `konditionsgeber`, `hauptsitz`, `verkaufergruppe`, `formularart`
              )
               VALUES(\"$art\",\"$art1_1\",\"$art1_2\",\"$art1_3\",\"$art1_4\",\"$art1_5\",\"$art1_6\",\"$art1_7\",\"$art1_8\",\"$art1_9\",\"$art1_10\",\"$art1_11\",\"$art1_12\",\"$art1_13\",\"$art1_14\",\"$art1_15\",\"$art1_16\",\"$art1_17\",\"$art1_18\",\"$art1_19\",\"$art1_20\",\"$art1_21\",\"$art1_22\",\"$art1_24\",\"$art1_25\",\"$art1_26\",\"$art1_27\",\"$art1_28\",\"$art1_29\",\"$art1_30\",\"$art1_31\",\"$art1_32\",\"$art1_33\",\"$art1_34\",\"$art1_35\",\"$art1_36\",\"$art1_37\",\"$art1_38\",\"$art1_39\",\"$art1_40\",
                \"$art2_1\",\"$art2_2\",\"$art2_3\",\"$art2_4\",\"$art2_5\",\"$art2_6\",\"$art2_7\",\"$art2_8\",\"$art2_9\",\"$art2_10\",\"$art2_11\",\"$art2_12\",\"$art2_13\",\"$art2_14\",\"$art2_15\",\"$art2_16\",\"$art2_17\",\"$art2_18\",\"$art2_19\",\"$art2_20\",\"$art2_21\",\"$art2_22\",\"$art2_23\",\"$art2_24\",\"$art2_25\",\"$art2_26\",\"$art2_27\",\"$art2_28\",\"$art2_29\",\"$art2_30\",\"$art2_31\",
                \"$art3_1\",\"$art3_2\",\"$art3_3\",\"$art3_4\",\"$art3_5\",\"$art3_6\",\"$art3_7\",\"$art3_8\",\"$art3_9\",\"$art3_10\",\"$art3_11\",\"$art3_12\",\"$art3_13\",\"$art3_14\",\"$art3_15\",\"$art3_16\",\"$art3_17\",\"$art3_18\",\"$art1_23\",\"$art1_41\",\"$art1_42\",\"$art1_43\",\"$art1_44\",\"$art1_45\",\"$art1_46\",\"$artForm\"
                );";
    //echo "$strSQL<hr>";
    sqlConn()->query("SET NAMES 'utf8'");
    $result = sqlConn()->query($strSQL);
    // SQL auswerten und ausgeben

    /*
    echo"<h1>SQL VARDUMP</h1>";
    var_dump($strSQL);
    echo"<h1>SQL PRINT</h1>";
    print_r($strSQL);
    echo"<h1>SQL Result</h1>";
    var_dump($result);

    if ($result) {
        echo"<h1>SQL TRUE</h1>";
    } else {
        echo"<h1>SQL False</h1>";
                // Verbindung wieder schliessen
    }
    */
    sqlConn()->close();
    //Hier wird in der Zwischentabelle die Werten Gespeichert
    $strSQL = "SELECT max(id) as id FROM `formular` limit 1;";
    //echo "$strSQL<hr>";
    sqlConn()->query("SET NAMES 'utf8'");
    $result = sqlConn()->query($strSQL);
    // SQL auswerten und ausgeben
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //echo "ID = " . $row[id] . "";
            $ID = $row[id];
        }
    } else {

        sqlConn()->close();

    }
    /*
    echo "<hr />";
    echo "<hr />";
    echo "<h1>Array ausgabe</h1>";
    var_dump($art4_1);
    echo "<hr />";
    var_dump($art4_2);
    echo "<hr />";
    var_dump($art4_3);
    echo "<hr />";
    */



    //Array auflösen und variablen den elementen zuweisen
    for ($x = 0; $x < count($art4_1); $x++) {
        $value[$x] = $art4_1[$x];


        //echo "Test =  $art4_1[$x] <hr />";
        //var_dump($value[$x]);
        //echo "<hr />";
        //echo "$value[$x]";
        //echo "<hr />";
        /*********************
         * Array Loop Fehler *
         ********************/

        //SELECT `text1` FROM `formular_vertretter` JOIN `zbed` WHERE `main_id` = "29" AND `vertretter_id` = `ID`
        $strSQL = "insert formular_marke values
                ($ID, (select ID from marke where text1 = \"$value[$x]\" LIMIT 1));";

        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        // SQL auswerten und ausgeben
        if ($result) {

        } else {

            sqlConn()->close();// Verbindung wieder schliessen
        }
    }//for

    //2 Wert einfügen in Tabelle
    for ($x = 0; $x < count($art4_2); $x++){
        $value[$x] = $art4_2[$x];

        //SELECT `text1` FROM `formular_vertretter` JOIN `zbed` WHERE `main_id` = "29" AND `vertretter_id` = `ID`
        $strSQL = "insert formular_lackm values
                ($ID, (select ID from lackm where text1 = \"$value[$x]\" LIMIT 1));";

        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        // SQL auswerten und ausgeben
        if ($result) {

        } else {

            /******************
             * Insert into zwischen Table
             ****************/

            sqlConn()->close();// Verbindung wieder schliessen
        }
    }//for

    //2 Wert einfügen in Tabelle
    for ($x = 0; $x < count($art4_3); $x++){
        $value[$x] = $art4_3[$x];

        //SELECT `text1` FROM `formular_vertretter` JOIN `zbed` WHERE `main_id` = "29" AND `vertretter_id` = `ID`
        $strSQL = "insert formular_partnerr values
                ($ID, (select ID from partnerr where text1 = \"$value[$x]\"));";

        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        // SQL auswerten und ausgeben
        if ($result) {

        } else {

            sqlConn()->close();// Verbindung wieder schliessen
        }
    }//for

    //Waschanlage
    for ($x = 0; $x < count($art4_4); $x++){
        $value[$x] = $art4_4[$x];

        //SELECT `text1` FROM `formular_waschanl` JOIN `zbed` WHERE `main_id` = "29" AND `vertretter_id` = `ID`
        $strSQL = "insert formular_waschanl values
                ($ID, (select ID from waschanl where text1 = \"$value[$x]\" LIMIT 1));";

        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        // SQL auswerten und ausgeben
        if ($result) {
        } else {
            sqlConn()->close();// Verbindung wieder schliessen
        }
    }//for

    //Interessenten
    for ($x = 0; $x < count($art4_5); $x++){
        $value[$x] = $art4_5[$x];

        //SELECT `text1` FROM `formular_waschanl` JOIN `zbed` WHERE `main_id` = "29" AND `vertretter_id` = `ID`
        $strSQL = "insert formular_interessenten values
                ($ID, (select ID from interessenten where text1 = \"$value[$x]\" LIMIT 1));";

        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        // SQL auswerten und ausgeben
        if ($result) {
        } else {
            sqlConn()->close();// Verbindung wieder schliessen
        }
    }//for

    //programm ende
    sqlConn()->close();        // Verbindung wieder schliessen
    return $ID;
}