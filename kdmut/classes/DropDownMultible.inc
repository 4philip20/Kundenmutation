<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 17.12.2018
 * Time: 10:12
 */

class DropDownMultible
{
    public $lv_Wert;
    public $lv_Tabelle;
    public $lv_Select;
    public $lv_value;
    public $zaehlen;

    public function setLabelFeld($value)
    {
        $this->lv_value = $value;
    }

    function setWert($value)
    {
        $this->lv_Wert = $value;
    }

    function setTabelle($value)
    {
        $this->lv_Tabelle = $value;
    }

    function setSelect($value)
    {
        $this->lv_Select = $value;
    }

    function showDropDownMultible($langu)
    {
        $this->zaehlen += 1;
        settype($lv_result, string);
        // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
        if ($this->Debug) {
            $lv_result = '<div class="errorMsg">OK bin in [setDropDownMultible] </div>';
            echo $lv_result;
        }
        /***********************************
         * Datenbank verbindung herstellen *
         ***********************************/
        $lv_result = "
        <div class='fliesElementmultible$this->zaehlen'>
        <label class='labeldefault'>$this->lv_value</label>
        <select name=\"$this->lv_Wert\" class=\"test\" multiple=\"multiple\">
    ";
        $strSQL = "SELECT `$this->lv_Select` FROM `$this->lv_Tabelle` where `langu` = '$langu';";
        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);

// SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {
                // SELECT TAG OPTIONS AUSGABE
                $lv_result = $lv_result . "<option>" . $row["$this->lv_Select"] . "</option>";
            }
        } else {
            $lv_result = $lv_result . "Leider wurde nichts gefunden...DB Fehler";
        }

// Verbindung wieder schliessen
// SELECT TAG & Form SCHLIESSEN
        $lv_result = $lv_result . "</select></div> ";

        sqlConn()->close();
        return $lv_result;
    }
}