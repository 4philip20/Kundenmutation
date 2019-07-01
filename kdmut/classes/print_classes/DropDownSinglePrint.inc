<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 17.12.2018
 * Time: 10:10
 */

class DropDownSinglePrint
{
    public $lv_Name;
    public $lv_Tabelle;
    public $lv_Select;
    public $lv_title;
    public $lv_value;
    private $zaehlen;
    private $CssWidth;
    public $lv_Wert;
    public $ID;

    public function setLabelFeld($value)
    {
        $this->lv_value = $value;
    }

    function setWert($value)
    {
        $this->lv_Name = $value;
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

    function setCssWidth($value)
    {
        $this->CssWidth = $value;
    }

    //wird geraucht beim Daten Ausgaben
    /**
     * @param $ID
     * @return string
     */
    public function getValueFromDB($ID)
    {
        //Select Value Value from TABLE OUTPUT
        //$ID = 0;
        $strSQL = "SELECT `$this->lv_Name` FROM `formular` WHERE `ID` = '$ID' ;";
        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        // SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {
                $this->lv_Wert = $row[$this->lv_Name];
                //var_dump($result);
                // var_dump($this->lv_Wert);
            }
        } else {
            $this->lv_Wert = "NULL";
        }
        sqlConn()->close();
        return $this->lv_Wert;
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
        //init Variable wurde deklariert um div classes anzupassen
        $this->zaehlen += 1;

        $lv_result = "
        <div class='fliesElementPrint$this->zaehlen'>
        <label class='labeldefault'>$this->lv_value</label><br>
       ";
        $strSQL = "SELECT `id`,`$this->lv_Select` FROM `$this->lv_Tabelle` WHERE langu = '$langu';";
        //$strSQL = "SELECT MABWA,ASAM FROM `formular` WHERE `ID` = '$this->form_idkdmut';";
        //$strSQL = "SELECT `marke` FROM `marke`;";

        sqlConn()->query("SET NAMES 'utf8'");
        $result  = sqlConn()->query($strSQL);
        // SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            //$lv_result = $lv_result . "<option></option>";
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {

                $this->ID = $row['id'];
                //Falls in Tabelle nicht angegeben : Regelt Css
                //IF Eingabe in Tabelle kleiner 20 : Regelt CSS
                if ($this->CssWidth < "15" or $this->CssWidth == "NULL") {
                    //Nimm Width von CSS
                    $lv_result = $lv_result . "<div class='floatradio$this->zaehlen'>";
                } //Falls in Tabelle angegeben und grösser 20 : setzt Wert
                else {
                    $lv_result = $lv_result . "<div class='floatradio$this->zaehlen' style='width: $this->CssWidth%'>";
                }

                //array sting convention
                //$value = $row[$this->lv_Select];
                //Abfrage if value = Wert dann checked
                //<input class='labelcheckboxdefault' type=\"radio\"  name=\"$this->lv_Name\" checked value=" . $row[$this->lv_Select] . ">";

                //if ($row[$this->lv_Select] == $this->lv_Wert)
                if ($this->ID == $this->lv_Wert)
                {
                    $lv_result = $lv_result . "<label class='radio' id=\"selected\" style='display: block'>
                                           <input class='labelcheckboxdefault' type=\"radio\"  name=\"$this->lv_Name\" checked value=\"$this->ID\" style='float: left'>";
                } else {

                    $lv_result = $lv_result . "<label class='radio' id=\"unselected\" style='display: block'>
                                            
                                           <input class='labelcheckboxdefault' type=\"radio\"  name=\"$this->lv_Name\" value=\"$this->ID\" style='float: left'>
                                           ";
                }
                $lv_result = $lv_result . "
                                           " . $row[$this->lv_Select] . "</label>
                                           </div> ";
            }
        } else {
            $lv_result = $lv_result . "Bitte in Tabelle Werte ergänzen";
            sqlConn()->close();
        }
        $lv_result = $lv_result . "</select></div> ";
        return $lv_result;
    }

    function insertDropDownSingle()
    {
        echo "<label class='labeldefault'>$this->lv_value</label>
             <select name=\"$this->lv_title\" class=\"test2\" >";
        echo "<option>$this->lv_Name</option>";
        echo "</select> ";
    }
}