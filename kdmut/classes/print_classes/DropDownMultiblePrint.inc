<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 17.12.2018
 * Time: 10:12
 */

class DropDownMultiblePrint
{
    public $lv_Wert;
    public $lv_Tabelle;
    public $lv_Select;
    public $lv_value;
    private $zaehlen;
    private $CssWidth;

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

    function setCssWidth($value)
    {
        $this->CssWidth = $value;
    }

    //Print Page with Data
    function getValuefromDb($value,$langu)
    {
        //immer gleich
        $select = "text1";
        $where = "main_id";
        $and = "vertretter_id";
        //aus Index Form_ID
        $ID = $value;
        //$ID = "83";

        //SELECT `text1` FROM `formular_vertretter` JOIN `marke` WHERE `main_id` = "29" AND `vertretter_id` = `ID`

        settype($lv_result, string);
        // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
        if ($this->Debug) {
            echo '<div class="errorMsg">OK bin in [getZwischenTabelleValues] </div>';
        }
        $strSQL = "SELECT `$select` FROM `formular_$this->lv_Tabelle` JOIN `$this->lv_Tabelle` WHERE `$where` = $ID AND `$and` = `ID` AND $this->lv_Tabelle.langu ='$langu'; ";

        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        // SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            $this->zaehlen += 1;
            $lv_result = "
                                        <div class='fliesElementPrint$this->zaehlen'>
                                            <label class='labeldefault'>$this->lv_value</label><br>
                                              ";
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {
                $lv_result = $lv_result . " <div class='floatcheckresult$this->zaehlen'>
                                             <label class='radio'>
                                               <input class='labelcheckboxdefault' type=\"checkbox\" checked > " . $row[$select] . "
                                             </label></div>
                                            ";
            }
            $lv_result = $lv_result . "</div>";
        }
        sqlConn()->close();
        return $lv_result;
    }

    function showDropDownMultible($langu)
    {
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
        <div class='fliesElementPrint'>
        <label class='labeldefault'>$this->lv_value</label><br>";

        //$strSQL = "SELECT `$this->lv_Select` FROM `$this->lv_Tabelle`;";
        $strSQL = "SELECT `$this->lv_Select` FROM `$this->lv_Tabelle` where `langu` = '$langu';";
        //var_dump($strSQL);
        //$strSQL = "SELECT `$this->lv_Select` FROM `$this->lv_Tabelle` WHERE `langu` = `DE`;";
        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);

        $this->zaehlen += 1;
        // SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {
                // SELECT TAG OPTIONS AUSGABE
                //$lv_result = $lv_result . "<input class='labelcheckboxdefault' type=\"radio\" name=\"$this->lv_Wert\" value=" . $row[$this->lv_Select] . " ><label class='radio'>" . $row[$this->lv_Select] . "</label>&nbsp;&nbsp; ";
                //Falls in Tabelle nicht angegeben : Regelt Css
                //IF Eingabe in Tabelle kleiner 20 : Regelt CSS
                if ($this->CssWidth < "20" or $this->CssWidth == "NULL") {
                    //Nimm Width von CSS
                    $lv_result = $lv_result . "<div class='floatcheck$this->zaehlen'>";
                } //Falls in Tabelle angegeben und grösser 20 : setzt Wert
                else {
                    $lv_result = $lv_result . "<div class='floatcheck$this->zaehlen' style='width: $this->CssWidth%'>";
                }
                $value = $row[$this->lv_Select];

                $lv_result = $lv_result . "<label class='radio' style='display: block'>
                                           <input class='labelcheckboxdefault' type=\"checkbox\" name=\"$this->lv_Wert\" value=\"$value\" style='float: left'>  
                                           " . $row[$this->lv_Select] . "</label>
                                           </div> ";
            }
        } else {
            $lv_result = $lv_result . "Bitte in Tabelle Werte ergänzen";
        }
        // Verbindung wieder schliessen
        // SELECT TAG & Form SCHLIESSEN
        $lv_result = $lv_result . "</select></div> ";

        sqlConn()->close();
        return $lv_result;


    }
}