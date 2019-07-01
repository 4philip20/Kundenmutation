<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 17.12.2018
 * Time: 10:10
 */

class DropDownSingle
{
    public $lv_Wert;
    public $lv_Tabelle;
    public $lv_Select;
    public $lv_title;
    public $lv_value;

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

    function setTitle($value)
    {
        $this->lv_title = $value;
    }

    function showDropDownSingle($langu)
    {

        settype($lv_result, string);
        // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
        if ($this->Debug) {
            $lv_result = '<div class="errorMsg">OK bin in [setDropDownSingle] </div>';
            echo $lv_result;
        }
        /***********************************
         * Datenbank verbindung herstellen *
         ***********************************/

        $lv_result = "
        <div class='fliesElement'>
        <label class='labeldefault'>$this->lv_value</label><br>
        <select name=\"$this->lv_Wert\" class=\"test2\" >
       ";

        $strSQL = "SELECT `id`,`$this->lv_Select` FROM `$this->lv_Tabelle` where `langu` = '$langu';";
        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        // SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            $lv_result = $lv_result . "<option></option>";
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {
                // SELECT TAG OPTIONS AUSGABE

                $lv_result = $lv_result . "<option value=".$row['id'].">" . $row["$this->lv_Select"] . "</option>";
            }
        } else {
            $lv_result = $lv_result . "DB Fehler";
            sqlConn()->close();
        }
        $lv_result = $lv_result . "</select></div> ";
        return $lv_result;
    }

    function insertDropDownSingle()
    {
        echo "<label class='labeldefault'>$this->lv_value</label>
             <select name=\"$this->lv_title\" class=\"test2\" >";
        echo "<option>$this->lv_Wert</option>";
        echo "</select> ";
    }
}