<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 17.12.2018
 * Time: 09:50
 */

class InputFeld
{
    public $lv_value;
    public $lv_LabelText;
    public $lv_CRLF;
    private $zaehler;
    private $CssWidth;
    public $lv_Wert;
    public $lv_Pflichtfeld = "";

    //wert
    public function setInputFeld($value)
    {
        $this->lv_value = $value;
    }

    public function setLabelFeld($value)
    {
        //Falls Feld Auftraggeber dann muss Feld pflicht sein
        if ($value == "Auftraggeber Email" || $value == "donneur d'ordre email" || $value == "mandante email"){
            $this->lv_Pflichtfeld = "required";
        }elseif ($value == "Name1" || $value == "nom1" || $value == "Cognome1"){
            $this->lv_Pflichtfeld = "required";
        }
        else{
            $this->lv_Pflichtfeld = "";
        }
        $this->lv_LabelText = $value;
    }

    public function setCssWidth($value)
    {
        $this->CssWidth = $value;
    }

    //Do SQL Select to get Value from DB
    //needs ID
    public function getValueFromDB($ID)
    {
        //Select Value Value from TABLE OUTPUT
        //$ID = 0;
        $strSQL = "SELECT `$this->lv_value` FROM `formular` WHERE `ID` = '$ID';";
        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        // SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {
                $this->lv_Wert = $row[$this->lv_value];
            }

        } else {
            $this->lv_Wert = "NULL";
        }
        return $this->lv_Wert;
    }

    public function showInputFeld()
    {
        settype($lv_result, string);
        $this->lv_CRLF = chr(13) . chr(10);

        // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
        if ($this->Debug) {
            $lv_result = '<div class="errorMsg">OK bin in [setInputFeld] </div>';
            echo $lv_result;
        }
        $this->zaehler += 1;
        //NUR für Kundenschema / SPEZIALFALL
        if ($this->lv_value == "1") {
            $lv_result = $lv_result . "<div class='fliesElementspezialfall'>";
            $lv_result = $lv_result . "<label class='labeldefault'>$this->lv_LabelText</label>";
            $lv_result = $lv_result . "</div>" . $this->lv_CRLF;
            return $lv_result;
        } //Normale Ausgabe tritt immer in Fall
        else {
            //Falls in Tabelle nicht angegeben : Regelt Css
            //IF Eingabe in Tabelle kleiner 20 : Regelt CSS
            if ($this->CssWidth < "20" or $this->CssWidth == "NULL") {
                //Nimm Width von CSS
                $lv_result = $lv_result . "<div class='fliesElement'>";
            } //Falls in Tabelle angegeben und grösser 20 : setzt Wert
            else {
                $lv_result = $lv_result . "<div class='fliesElement' style='width: $this->CssWidth%'>";
            }
            //Falls Feld Auftraggeber dann mus Feld pflicht sein

            $lv_result = $lv_result . "<label class='labeldefault'>$this->lv_LabelText</label>";
            $lv_result = $lv_result . "<input id='$this->zaehler' type='text' class='inputfled' name='$this->lv_value' $this->lv_Pflichtfeld >";
            $lv_result = $lv_result . "</div>" . $this->lv_CRLF;

            return $lv_result;
        }
    }

    //Für Formular Ausgabe mit User Wert
    public function insertInputFeld()
    {
        settype($lv_result, string);

        // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
        if ($this->Debug) {
            $lv_result = '<div class="errorMsg">OK bin in [setInputFeld] </div>';
            echo $lv_result;
        }
        //Speziafall
        if ($this->lv_value == "1") {
            $lv_result = $lv_result . "<div class='fliesElementspezialfall'>";
            $lv_result = $lv_result . "<label class='labeldefault'>$this->lv_LabelText</label>";
            $lv_result = $lv_result . "</div>" . $this->lv_CRLF;
            return $lv_result;
        } //Normale Ausgabe tritt immer in Fall
        else {

            $lv_result = $lv_result . "<div class='fliesElement'>";
            $lv_result = $lv_result . "<label class='labeldefault'>$this->lv_LabelText</label>";
            $lv_result = $lv_result . " <input id='$this->zaehler' type='text' class='inputfled' name='$this->lv_value' value='$this->lv_Wert' >";
            $lv_result = $lv_result . "</div>" . $this->lv_CRLF;
        }
        return $lv_result;
    }
}