<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 17.12.2018
 * Time: 10:07
 */
//Pro Klasse 2 Methoden für Ausgabe
//Einmal ohne Wert für Leer Ausgabe
//Einmal mit Wert für Result sichtbar
class CheckBox
{
    public $lv_value;
    public $lv_label;
    public $lv_wert;
    public $test1;
    public $test2;
    public $lv_Wert;
    private $CssWidth;
    public $lv_langu;

    public function setLangu($value)
    {
        $this->lv_langu = $value;
    }

    public function setLabelFeld($value)
    {
        $this->lv_label = $value;
    }

    public function setCssWidth($value)
    {
        $this->CssWidth = $value;
    }
    //Hier wird der Name mitgegen um später automatisiert dem Feld einen namenzuzuweisen.
    //Falls später Checkbox hizukommt das man nicht extra den Wert in Plaint Text hinschreiben muss.
    public function setChekboxWert($value)
    {
        $this->lv_wert = $value;
    }

    public function setWert($value)
    {
        $this->lv_value = $value;
    }

    //Hier wird definiert wie das Checkbox ausgegeben wird entweder 1 oder 0 / Checked oder unchecked
    function setCheckbox()
    {
        if ($this->lv_Wert == "1") {
            $this->test1 = "
            <div class='fliesElement'>
            <label class='labeldefault'>$this->lv_label
            <input class='labelcheckboxdefault' type=\"checkbox\" name=\"checkbox\" value=\"1\" checked>
            </label>
            </div>";
            //chekbox UnChecked MACHT NIX
        } elseif ($this->lv_Wert == "0") {
            $this->test2 = "
            <div class='fliesElement'>
            <label class='labeldefault'>$this->lv_label
            <input class='labelcheckboxdefault' type=\"radio\" name=\"checkbox\" value=\"1\">
            </label>
            </div>";
            //chekbox UnChecked HIER ENTLANG
        } else {
            $this->test2 = "
            <div class='fliesElement'>
            <label class='labeldefault'>$this->lv_label
            <input class='labelcheckboxdefault' type=\"radio\" name=\"checkbox\" value=\"1\">
            </label>
            </div>";
        }
    }

    function setRadioButtonJN()
    {
        settype($lv_result, string);

        //Für Daten Ausgeben *später*
        if ($this->lv_Wert == "1") {
            $lv_isChecked = ' checked';
            $lv_isChecked2 = '';
        } elseif ($this->lv_Wert == "0") {
            $lv_isChecked = '';
            $lv_isChecked2 = ' checked';
        } else {
            $lv_isChecked = '';
            $lv_isChecked2 = '';
        }
        //Für Ja/Nein ausgabe
        if($this->lv_langu == "f"){
            $Ja = "Oui";
            $Nein = "Non";
        }else if ($this->lv_langu == "i"){
            $Ja = "Si";
            $Nein = "No";
        }else{
            $Ja = "Ja";
            $Nein = "Nein";
        }

        //Falls in Tabelle nicht angegeben : Regelt Css
        //IF Eingabe in Tabelle kleiner 20 : Regelt CSS
        if ($this->CssWidth < "20" or $this->CssWidth == "NULL") {
            //Nimm Width von CSS
            $lv_result = $lv_result . "<div class='fliesElement'>";
        } //Falls in Tabelle angegeben und grösser 20 : setzt Wert
        else {
            $lv_result = $lv_result . "<div class='fliesElement' style='width: $this->CssWidth%'>";
        }
        $lv_result = $lv_result . "
            <label class='labeldefault'>$this->lv_label</label>
            <br>
            <label><input class='labelcheckboxdefault' type=\"radio\" name=\"$this->lv_value\" value=\"1\"  $lv_isChecked>$Ja &nbsp;</label> 
            <label><input class='labelcheckboxdefault' type=\"radio\" name=\"$this->lv_value\" value=\"0\" $lv_isChecked2>$Nein&nbsp; </label> 
            </div>";

        return $lv_result;
    }

    //Hier wird das Checkbox ausgegeben je nach bedigung. / Checked oder unchecked
    function showCheckbox()
    {
        settype($lv_result, string);
        // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
        if ($this->Debug) {
            $lv_result = '<div class="errorMsg">OK bin in [setCheckbox] </div>';
            echo $lv_result;
        }
        if ($this->lv_value == "1") {
            $lv_result = $lv_result . $this->test1;
        } elseif ($this->lv_value == "0") {
            $lv_result = $lv_result . $this->test2;
        } else {
            $lv_result = $lv_result . $this->test2;
        }
        return $lv_result;
    }
    //Select Value Value from TABLE OUTPUT

    function getValueFromDB($ID)
    {
        $strSQL = "SELECT `$this->lv_value` FROM `formular` WHERE `ID` = '$ID';";
        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        // SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {
                $this->lv_Wert = $row[$this->lv_value];
                /*
                var_dump($strSQL);
                echo $this->lv_Wert;
                */
            }
        } else {
            $this->lv_Wert = "N";
        }
        sqlConn()->close();
        return $this->lv_Wert;
    }
}