<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 10.12.2018
 * Time: 10:45
 */


function sqlConn()
{
    $conn = new mysqli(_DBHOST_, _DBUSER_, _DBPASS_, _DBNAME_);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    } else {
        $conn->query("SET NAMES 'utf8'");
        return $conn;

    }
    $conn->query("SET NAMES 'utf8'");
    return $conn;
}

function UpdateFileToRow($target_file,$ID){
    $strSQL = "UPDATE `formular` SET `FILE`= '$target_file' WHERE `ID` = '$ID'";
    //$strSQL = "SELECT `wert`,`$QueryFeldName`,`art`,`attribut`,`tabelle`,`sort`  FROM `output` WHERE $this->FormularArt= '1' ORDER BY `sort`;";
    //in sqlConn wurde die Datenbankverbdinung definiert
    sqlConn()->query("SET NAMES 'utf8'");
    $result = sqlConn()->query($strSQL);
    if($result){
        return true;
    }else{
        return false;
    }
}

function GetFileFromeRow($ID){
    $strSQL = "SELECT `FILE` FROM `formular` WHERE `ID` = '$ID';";
    //$strSQL = "SELECT `wert`,`$QueryFeldName`,`art`,`attribut`,`tabelle`,`sort`  FROM `output` WHERE $this->FormularArt= '1' ORDER BY `sort`;";
    //in sqlConn wurde die Datenbankverbdinung definiert
    sqlConn()->query("SET NAMES 'utf8'");
    $result = sqlConn()->query($strSQL);
    $File = "";
    if($result){
        // SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {
                $File = $row["FILE"];
            }
        }
        return $File;
    }
    //Result == FALSE
    else{
        return false;
    }
}

function hasFileEintragDB($ID){
    $strSQL = "SELECT `FILE` FROM `formular` WHERE `ID` = '$ID';";
    //$strSQL = "SELECT `wert`,`$QueryFeldName`,`art`,`attribut`,`tabelle`,`sort`  FROM `output` WHERE $this->FormularArt= '1' ORDER BY `sort`;";
    //in sqlConn wurde die Datenbankverbdinung definiert
    sqlConn()->query("SET NAMES 'utf8'");
    $result = sqlConn()->query($strSQL);
    $File = "";
    if($result){
        // SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {
                $File = $row["FILE"];
            }
        }
        //return $File;
    }
    //Result == FALSE
    else{
        return false;
    }
    if ($File == ""){
        return false;
    }else{
        return true;
    }
}