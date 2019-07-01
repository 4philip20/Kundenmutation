<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 06.12.2018
 * Time: 10:38
 * ESA - Projekt
 * Kundenstamm Mutaion Formular
 */

require_once('config.php');
require_once('Email.php');
require_once('functions/SqlConn.php');
require_once('functions/insert_InputFeld.php');
require_once('functions/insert_DropDownSingle.php');
require_once('file.php');
require_once('download.php');

include "classes/InputFeld.inc";
include "classes/Ueberschrift.inc";
include "classes/CheckBox.inc";
include "classes/DropDownSingle.inc";
include "classes/DropDownMultible.inc";
include "classes/LabelFeld.inc";
include "classes/print_classes/DropDownMultiblePrint.inc";
include "classes/print_classes/DropDownSinglePrint.inc";


class Main
{
    /***************
     * Konstruktor *
     ***************/
    public $form_action = "N";      // Leer oder N = NeuKunde (leeres Form), S = Show option E = Edit
    public $form_sprache = "d";     // d,f,i sind möglich, default d für Deutsch (gilt im ganzen Programm.)
    public $form_idkdmut = "";      // Kundennummer -> Wenn leer  $form_action = "N"
    public $Debug = false;          // true oder false
    public $CrLf;                   // Variable für formfeed in HTML
    public $ART;
    public $languForSql = "de";
    public $FormularArt = "esa";
    public $id_form;


    /***************************
     * Default Konstruktor    *
     * Verhalten ist geklährt *
     ***********************/
    function __construct()
    {
        $this->form_action = "N";      // Leer oder N = NeuKunde (leeres Form), S = Show option E = Edit
        $this->form_sprache = "d";     // d,f,i sind möglich, default d für Deutsch
        $this->form_idkdmut = "";      // Kundennummer -> Wenn leer  $form_action = "N"
        $this->FormularArt = "esa";
        //$this->Debug = true;          // true oder false
        $this->CrLf = chr(13) . chr(10);
    }

    /******************************************
     * Speichert Usereinagbe je nach Parameter
     *****************************************/
    public function saveUrlParam()
    {
        //Formular Action DEFAULT
        if (!isset($_GET["action"])) {  // Wenn nicht vorhanden
            $this->form_action = 'N';   // Neue leere Mutation
            $this->form_idkdmut = '';
            $this->form_sprache = 'd';
            $this->languForSql = "DE";
        } else {
            $this->form_action = $_GET["action"]; // N,S,E oder D
            //$this->form_idkdmut = '';
            $this->form_idkdmut = NULL;
            $this->form_sprache = 'd';
        }

        if (!isset($_GET["art"])) {      // Wenn nicht vorhanden
            $this->FormularArt = 'esa';
        } else {
            $this->FormularArt = $_GET["art"];
        }

        if ($this->FormularArt == "esa") {
            $this->id_form = '1';
        } else if ($this->FormularArt == "retail") {
            $this->id_form = '2';
        } else {
            $this->id_form = 'NULL';
        }
        //Sprache
        if (!isset($_GET["sp"])) {      // Wenn nicht vorhanden
            $this->form_sprache = 'd';
        } else {
            $this->form_sprache = $_GET["sp"];
        }
        //KDmut ID
        if (!isset($_GET["kdmut"])) {      // Wenn nicht vorhanden
            $this->form_idkdmut = NULL;
            $this->form_action = $_GET["action"];
        } else {
            $this->form_idkdmut = $_GET["kdmut"]; //event to int und wenn 0 oder leer action = N
            $this->form_action = 'S'; //event to int und wenn 0 oder leer action = N
        }
    }

    /***********************************************
     * Wird für die Ausgabe des Formulars gebraucht
     *************************************************/
    public function getArt()
    {
        $strSQL = "SELECT `ART`  FROM `formular` WHERE `ID` = $this->form_idkdmut;";
        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->ART = $row["ART"];
            }
        } else {
            $this->ART = "ERROR";
        }
        return $this->ART;
    }

// ******************************************************************************************************************
    public function setEmailparam()
    {
        session_start();
        $_SESSION["FormularArt"] = $this->FormularArt;

    }
// ******************************************************************************************************************

    /****************************
     * Erstellt den HTML Headder
     *****************************/
    public function createHtmlHead()
    {

        //Richtige Sprache ausgabe
        if ($this->form_sprache == "f") {
            $Ausdrucke = "imprimer";
        } elseif ($this->form_sprache == "i") {
            $Ausdrucke = "stampare";
        } else {
            $Ausdrucke = "Ausdrucken";
        }

        $lv_AusdruckenAusgabe = "<a href=\"http://intranet.esa.ch/netprog/kdmut/index.php?art=$this->FormularArt&action=D&sp=$this->form_sprache\" class='invisible'>$Ausdrucke</a>";

        $lv_result = "
        <!DOCTYPE html>
        <html lang=\"de\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width,initial-scale=1.0\"/>
            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
            <meta http-equiv=\"content-type\" content=\"text/html;charset=ISO-8859-1\">
            <link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"picture/esa_logo.png\"/>
            <title>Kundenmutation</title>
	        <link href=\"include/main.css\" rel=\"stylesheet\">
	        <script type=\"text/javascript\" src=\"include/java.js\"></script>
	        <link href=\"include/fSelect.css\" rel=\"stylesheet\">
	        <script type=\"text/javascript\" src=\"include/java.js\"></script>
	        <script src=\"include/import.js\"></script>
            <script src=\"include/fSelect.js\"></script>
    	    <script>
                (function($) {
                    $(function() {
                    $('.test').fSelect();
                    });
                    })(jQuery);
                
            </script>
        </head>
        <body class='mainCss'>
        $lv_AusdruckenAusgabe
        <div class='container0' id = 'center' >";

        return $lv_result;
        //return $this->string_head;
        //<a href="http://localhost/ipa/Klassen/index.php?action=D&sp=d" onClick="myFunction()">Ausdrucken</a>
    }

// ******************************************************************************************************************

    /*******************************************
     * Erstellt den Footer der Web Applikation
     *****************************************/
    public function createHtmlFooder()
    {
        // beliebige Fussnote... evt. Optional
        settype($lv_result, string);

        $lv_result = '<div class="footer" style=\'bottom: 0;  \'>Proudly powered by ESA-Informatik 2019 ©</div>' . $this->CrLf;
        return $lv_result;
    }


// ******************************************************************************************************************

    /***********************************************
     * Erstellt den FTP Button der Web Applikation *
     ***********************************************/
    public function createHtmlFTPButton()
    {
        // beliebige Fussnote... evt. Optional
        settype($lv_result, string);
        //$lv_result = '<button type="button">File anhängen</button>' . $this->CrLf;
        $lv_result = '<form action="file.php" method="post" enctype="multipart/form-data">
                          <input type="file" name="datei"><br>
                          <input type="submit" value="File anhängen" /><br/>
                    </form>';
        return $lv_result;
    }

// ******************************************************************************************************************

    /****************************************
     * Schliesst die End Tags Web Applikation
     ****************************************/
    public function createHtmlEnd()
    {
        settype($lv_result, string);
        $lv_result = '</div><!--class=container0 --></body></html>' . $this->CrLf;
        return $lv_result;
    }
// ******************************************************************************************************************

    /**********************************************************************************
     * Hier wird das Formular gesteuert:
     * Welche Sprache soll ausgegeben werden?
     * Wie soll ausgegeben werden?
     * Mit User Daten oder Ohne ausgeben ?
     * Dies Passiert alles je nach Aufrufparamater welche mit $_GET gespeichert werden
     **********************************************************************************/
    public function createHtmlFormular()
    {
        settype($lv_result, string);
        // If Aufruf Formular N
        // gib Formular leer Desktopversion aus
        if ($this->form_action == 'N') {
            if ($this->Debug) {
                $lv_result = '<div class="errorMsg">OK bin in [createHtmlFormular] Formular Action = N </div>';
            }
            $lv_result = $lv_result . $this->FormularAusgeben();
            //$lv_result = $lv_result . $this->FormularAusgebenWert();
            //$lv_result = $lv_result . $this->FormularAusgebenDruckbar();
            return $lv_result;
            // If Aufruf Formular E
            // Wird nicht realisiert, weils nicht gebraucht wird.
        } /*
        elseif ($this->form_action == 'E') {
            if ($this->Debug) {
                $lv_result = '<div class="errorMsg">OK bin in [createHtmlFormular] Formular Action = E </div>';
            }
            $lv_result = $lv_result . "Sie sind bei Edit aber funktion fehlt noch";
            return $lv_result;
            // If Aufruf Formular S
            // gib Formular ausgefüllt aus Druckbar
        }
        */
        elseif ($this->form_action == 'S') {
            if ($this->Debug) {
                $lv_result = '<div class="errorMsg">OK bin in [createHtmlFormular] Formular Action = S </div>';
            }
            $lv_result = $lv_result . $this->FormularAusgebenWert();
            return $lv_result;
            // If Aufruf Formular D
            // gib Formular ausgefüllt aus Druckbar
        } elseif ($this->form_action == 'D') {
            if ($this->Debug) {
                $lv_result = '<div class="errorMsg">OK bin in [DruckbarFormular] Formular Action = D </div>';
            }
            $lv_result = $lv_result . $this->FormularAusgebenDruckbar();
            return $lv_result;
        } else {
            // Fehlermeldung da dies nicht vorgesehen ist....
            //$lv_result = '<div class="errorMsg">Error in [createHtmlFormular] ungültige Formular Action! </div>';
            $lv_result = $lv_result . $this->FormularAusgeben();
            return $lv_result;
        }
    }
// ******************************************************************************************************************

    /****************************************
     * Hier wird das Formular leer Ausgegeben
     **************************************/
    public function FormularAusgeben()
    {
        settype($lv_result, string);
        // Deklaration
        $Ueberschrift = new Ueberschrift;
        $InputFeld = new InputFeld;
        $CheckBox = new CheckBox;
        $DropDowSingle = new DropDownSingle;
        $DropDowMultible = new DropDownMultible;

        // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
        if ($this->Debug) {
            $lv_result = '<div class="errorMsg">OK bin in [FormularAusgeben] </div>';
            echo $lv_result;
        }

        $lv_result = $this->setFormularHead();

        if ($this->form_sprache == "f") {
            $QueryFeldName = "name_fr";
        } elseif ($this->form_sprache == "i") {
            $QueryFeldName = "name_it";
        } else {
            $QueryFeldName = "name_de";
        }

        //SQL String mit richtiger Sprache drin.
        $strSQL = "SELECT `wert`,`$QueryFeldName`,`art`,`attribut`,`tabelle`,`sort`  FROM `output` WHERE `id_form` = '$this->id_form' ORDER BY `sort`;";
        //$strSQL = "SELECT `wert`,`$QueryFeldName`,`art`,`attribut`,`tabelle`,`sort`  FROM `output` WHERE $this->FormularArt= '1' ORDER BY `sort`;";
        //in sqlConn wurde die Datenbankverbdinung definiert
        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        $lv_result = $lv_result . "<div><form action='result.php' method='post' enctype=\"multipart/form-data\">";
        //TODO: Hässlicher Code kürzen !!!
        //Sprache Speichern
        //Checked
        if ($this->form_sprache == "f") {
            $lv_result = $lv_result . "<div class=\"container\">
	                                    <table><tbody><tr><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Zugang\"><label class='header'>altération</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Aenderung\"><label class='header'>altération</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Sperren\"><label class='header'>barrières</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Entsperren\"><label class='header'>déverrouillage</label></td></tr></tbody></table>
	                                   </div>";
            $this->languForSql = "FR";

        } elseif ($this->form_sprache == "i") {
            $lv_result = $lv_result . "<div class=\"container\">
	                                    <table><tbody><tr><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Zugang\"><label class='header'>ingresso</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Aenderung\"><label class='header'>modificazioni</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Sperren\"><label class='header'>ceppi</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Entsperren\"><label class='header'>unseal</label></td></tr></tbody></table>
	                                </div>";
            $this->languForSql = "IT";
        } else {
            $lv_result = $lv_result . "<div class=\"container\">
	                                    <table><tbody><tr><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Zugang\"><label class='header'>Zugang</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Aenderung\"><label class='header'>Aenderung</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Sperren\"><label class='header'>Sperren</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Entsperren\"><label class='header'>Entsperren</label></td></tr></tbody></table>
	                                </div>";
            $this->languForSql = "DE";
        }

        // SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {
                $wert = $row["wert"];
                $tabelle = $row["tabelle"];
                $select = $row["attribut"];
                switch ($row["art"]) {

                    case '0': //   Überschrift
                        {
                            //Wert speichern
                            $Ueberschrift->setUeberschrift($row[$QueryFeldName]);
                            //Feld ausgaben
                            $lv_result = $lv_result . $Ueberschrift->showUeberschrift();
                            break;
                        }
                    case '1': //Input Felder
                        {
                            //Werte speichern
                            $InputFeld->setLabelFeld($row[$QueryFeldName]);
                            $InputFeld->setInputFeld($row["wert"]);
                            //Feld ausgaben
                            $lv_result = $lv_result . $InputFeld->showInputFeld();
                            break;
                        }
                    case '2': // Checkbox
                        {
                            //Wert speichern
                            $CheckBox->setLabelFeld($row[$QueryFeldName]);
                            $CheckBox->setLangu($this->form_sprache);
                            $CheckBox->setWert($row["wert"]);
                            //Feld ausgaben
                            $lv_result = $lv_result . $CheckBox->setRadioButtonJN();
                            break;
                        }
                    case '3': // Drop Down nur 1 Wert auswählbar *
                        {
                            //Initaslisieren des Elementes
                            $DropDowSingle->setWert($wert);
                            $DropDowSingle->setSelect($select);
                            $DropDowSingle->setTabelle($tabelle);
                            $DropDowSingle->setLabelFeld($row[$QueryFeldName]);
                            // Ausgeben
                            if($wert == "routebez"){
                                //gib nichts aus
                            }else{
                                $lv_result = $lv_result . $DropDowSingle->showDropDownSingle($this->languForSql);
                            }
                            break;
                        }
                    case '4':// Drop Down mehrere Wert auswählbar *
                        {
                            //Wert speichern
                            $DropDowMultible->setLabelFeld($row[$QueryFeldName]);
                            $DropDowMultible->setWert($wert);
                            $DropDowMultible->setSelect($select);
                            $DropDowMultible->setTabelle($tabelle);
                            //Feld ausgaben
                            $lv_result = $lv_result . $DropDowMultible->showDropDownMultible($this->languForSql);
                            break;
                        } //Bedingung zu 100% abgefangen. Falls nicht wird Error Mesage ausgegeben
                    default:
                        {
                            var_dump($row["art"]);
                            echo '<div class="errorMsg">ELSE Fall in [FormularAusgeben()] Es wurde keine ART_ID mitgegeben</div>';
                            break;
                        }

                }
                //Fals Debug True : Debug Variablen Ausgeben
                if ($this->Debug) {
                    echo "<h1>DEBUG:</h1>";
                    echo "Wert: " . $row["wert"] . "<br>  Name_de: " . $row["name_de"] . "<br> Name_fr: " . $row["name_fr"] . "<br>Name_it: " . $row["name_it"] . "<hr />";
                    var_dump($tabelle);
                    var_dump($select);
                }
                //Falls Debug False : Programm lauft ohne Meldung weiter (NORMALFALL)
            }//Fertig While Schleiffe
            //<input type="submit" value="File anhängen" />
            $lv_result = $lv_result . "<br><br><br><input class='invisible' type='submit' style='bottom: 0;  position: fixed'>";
            //TODO: Upload Button
            $lv_result = $lv_result . "<input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" value=\"Upload\" accept=\"application/pdf,image/*\"><br>";
            $lv_result = $lv_result . "</form></div>";
        } else {
            echo "Leider wurde nichts gefunden...DB Fehler";
            $lv_result = $lv_result . "Leider wurde nichts gefunden...DB Fehler";
            sqlConn()->close();
        }
        return $lv_result;
    }
// ******************************************************************************************************************

    /**
     * Hier wird das Formular Leer Druckbar ausgegeben
     */
    public function FormularAusgebenDruckbar()
    {
        settype($lv_result, string);
        $Ueberschrift = new Ueberschrift;
        $InputFeld = new InputFeld;
        $CheckBox = new CheckBox;
        $DropDownSinglePrint = new DropDownSinglePrint();
        $DropDownMultiblePrint = new DropDownMultiblePrint();

        // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
        if ($this->Debug) {
            $lv_result = '<div class="errorMsg">OK bin in [FormularAusgeben] </div>';
            echo $lv_result;
        }
        $lv_result = $this->setFormularHead();
        //3.1.2018
        if ($this->form_sprache == "f") {
            $QueryFeldName = "name_fr";
            $QueryCss = "fr_width";

        } elseif ($this->form_sprache == "i") {
            $QueryFeldName = "name_it";
            $QueryCss = "it_width";
        } else {
            $QueryFeldName = "name_de";
            $QueryCss = "de_width";
        }
        //umbruch in Retail und Esa Formular unterschieden. Weil Formulare unterschiedlich wird der Umbruch nicht an der gleichen Position sein.
        /*
        if ($this->FormularArt == "retail"){
            $umbruch = "Umbruch_$this->FormularArt";
        }else{
            //retail
            $umbruch = "Umbruch_esa";
        }
        */
        //Umbruch in ESA/ Umbruch in Retail
        //SQL String mit richtiger Sprache drin.
        //$strSQL = "SELECT `wert`,`$QueryFeldName`,`art`,`attribut`,`tabelle`,`sort`,`$QueryCss`,`$umbruch`  FROM `output`  WHERE $this->FormularArt= '1' ORDER BY `sort`;";
        $strSQL = "SELECT `wert`,`$QueryFeldName`,`art`,`attribut`,`tabelle`,`sort`,`$QueryCss`,`umbruch`  FROM `output` WHERE `id_form` = '$this->id_form' ORDER BY `sort`;";
        //in sqlConn wurde die Datenbankverbdinung definiert
        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        //TODO: Hässlicher Code kürzen !!!
        //Sprache Speichern
        //Checked
        $lv_result = $lv_result . "<div><form action='result.php' method='post'>";
        if ($this->form_sprache == "f") {
            $lv_result = $lv_result . "<div class=\"container\">
	                                    <table><tbody><tr><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Zugang\"><label class='header'>altération</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Aenderung\"><label class='header'>altération</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Sperren\"><label class='header'>barrières</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Entsperren\"><label class='header'>déverrouillage</label></td></tr></tbody></table>
	                                </div>";
            $this->languForSql = "FR";
        } elseif ($this->form_sprache == "i") {
            $lv_result = $lv_result . "<div class=\"container\">
	                                    <table><tbody><tr><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Zugang\"><label class='header'>ingresso</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Aenderung\"><label class='header'>modificazioni</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Sperren\"><label class='header'>ceppi</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Entsperren\"><label class='header'>unseal</label></td></tr></tbody></table>
	                                </div>";
            $this->languForSql = "IT";
        } else {
            $lv_result = $lv_result . "<div class=\"container\">
	                                    <table><tbody><tr><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Zugang\"><label class='header'>Zugang</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Aenderung\"><label class='header'>Aenderung</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Sperren\"><label class='header'>Sperren</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Entsperren\"><label class='header'>Entsperren</label></td></tr></tbody></table>
	                                </div>";
            $this->languForSql = "DE";
        }
        // SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {
                $wert = $row["wert"];
                $tabelle = $row["tabelle"];
                $select = $row["attribut"];

                switch ($row["art"]) {
                    case '0':  //Überschrift
                        {
                            $Ueberschrift->setUeberschrift($row[$QueryFeldName]);
                            $lv_result = $lv_result . $Ueberschrift->showUeberschrift();
                            if ($row["umbruch"] == 1) {
                                $lv_result = $lv_result . "<div style='page-break-before:always;' class='AbstandUmbruch'></div>";
                            }
                            break;
                        }
                    case '1':  //Input Felder
                        {
                            $InputFeld->setLabelFeld($row[$QueryFeldName]);
                            $InputFeld->setInputFeld($row["wert"]);
                            $InputFeld->setCssWidth($row[$QueryCss]);
                            $lv_result = $lv_result . $InputFeld->showInputFeld();
                            if ($row["umbruch"] == 1) {
                                $lv_result = $lv_result . "<div style='page-break-before:always;' class='AbstandUmbruch'></div>";
                            }
                            break;
                        }
                    case '2':  //Checkbox
                        {
                            $CheckBox->setLabelFeld($row[$QueryFeldName]);
                            $CheckBox->setCssWidth($row[$QueryCss]);
                            $CheckBox->setWert($row["wert"]);
                            $CheckBox->setLangu($this->form_sprache);
                            $lv_result = $lv_result . $CheckBox->setRadioButtonJN($row["wert"]);
                            if ($row["umbruch"] == 1) {
                                $lv_result = $lv_result . "<div style='page-break-before:always;' class='AbstandUmbruch'></div>";
                            }
                            break;
                        }
                    case '3':  //Drop Down nur 1 Wert auswählbar *
                        {
                            $DropDownSinglePrint->setWert($wert);
                            $DropDownSinglePrint->setSelect($select);
                            $DropDownSinglePrint->setTabelle($tabelle);
                            $DropDownSinglePrint->setLabelFeld($row[$QueryFeldName]);
                            $DropDownSinglePrint->setCssWidth($row[$QueryCss]);
                            $lv_result = $lv_result . $DropDownSinglePrint->showDropDownSingle($this->languForSql);
                            if ($row["umbruch"] == 1) {
                                $lv_result = $lv_result . "<div style='page-break-before:always;' class='AbstandUmbruch'></div>";
                            }
                            break;
                        }
                    case '4':   //Drop Down mehrere Wert auswählbar *
                        {
                            $DropDownMultiblePrint->setLabelFeld($row[$QueryFeldName]);
                            $DropDownMultiblePrint->setWert($wert);
                            $DropDownMultiblePrint->setSelect($select);
                            $DropDownMultiblePrint->setTabelle($tabelle);
                            $DropDownMultiblePrint->setCssWidth($row[$QueryCss]);
                            $lv_result = $lv_result . $DropDownMultiblePrint->showDropDownMultible($this->languForSql);
                            if ($row["umbruch"] == 1) {
                                $lv_result = $lv_result . "<div style='page-break-before:always;' class='AbstandUmbruch'></div>";
                            }
                            break;
                        }
                    //Bedingung zu 100% abgefangen. Falls nicht wird Error Mesage ausgegeben
                    default:
                        {
                            echo '<div class="errorMsg">ELSE Fall in [FormularAusgeben()] Es wurde keine ART_ID mitgegeben</div>';
                            break;
                        }
                }

                //Fals Debug True : Debug Variablen Ausgeben
                if ($this->Debug) {
                    echo "<h1>DEBUG:</h1>";
                    echo "Wert: " . $row["wert"] . "<br>  Name_de: " . $row["name_de"] . "<br> Name_fr: " . $row["name_fr"] . "<br>Name_it: " . $row["name_it"] . "<hr />";
                    var_dump($tabelle);
                    var_dump($select);
                }
                //Falls Debug False : Programm lauft ohne Meldung weiter (NORMALFALL)

            if ($result->num_rows > 1){

            }
            }//Fertig While Schleiffe

            $lv_result = $lv_result . "<br><br><br><br><br><br><input class='invisible' type='submit'>";
            $lv_result = $lv_result . "</form></div>";
        } else {
            echo "Leider wurde nichts gefunden...DB Fehler";
            $lv_result = $lv_result . "Leider wurde nichts gefunden...DB Fehler";
            sqlConn()->close();
        }
        return $lv_result;
    }

    /**
     * Erstellt den HTML Formular Header
     */
    public function setFormularHead()
    {
        settype($lv_result, string);
        // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
        if ($this->Debug) {
            echo '<div class="errorMsg">OK bin in [setFormularHead] </div>';
        }

        //Sprache ändern
        $deutsch = "<a href=\"http://intranet.esa.ch/netprog/kdmut/index.php?art=$this->FormularArt&action=N&sp=d\">DE</a>";
        $franz = "<a href=\"http://intranet.esa.ch/netprog/kdmut/index.php?art=$this->FormularArt&action=N&sp=f\">FR</a>";
        $Italie = "<a href=\"http://intranet.esa.ch/netprog/kdmut/index.php?art=$this->FormularArt&action=N&sp=i\">IT</a>";
        $datum = date("d.m.Y");

        //TODO RETAIL BILD Einfügen
        //NEED RETAIL PICTURE
        if ($this->FormularArt == "esa") {
            // $href = "http://localhost/kdmut/index.php?art=retail&action=D&sp=d";
            $href = "http://intranet.esa.ch/netprog/kdmut/index.php?art=retail&action=D&sp=d";
            $path = "picture/esa_logo.png";
        } else {
            // $href = "http://localhost/kdmut/index.php?art=esa&action=D&sp=d";
            $href = "http://intranet.esa.ch/netprog/kdmut/index.php?art=esa&action=D&sp=d";
            $path = "picture/retail_logo.JPG";
        }
        $lv_result = "
    <div class=\"container0\" id=\"center\">
      <table border=\"0\" width=\"100%\">
       <tr>
        <td width=\"30%\" valign=\"top\">
        <a href=\"$href\">
        <img src=\"$path\" alt=\"NEED RETAIL PICTURE\" class='picture'/></a></td><td valign=\"top\">";
        //Titel nach Sprache ausgeben
        if ($this->form_sprache == "d") {
            $lv_result = $lv_result . "<h2 class='kopf'>Kundenmutation Formular</h2>";
        } else if ($this->form_sprache == "f") {
            $lv_result = $lv_result . "<h2 class='kopf'>Formulaire mutation des clients</h2>";
        } else if ($this->form_sprache == "i") {
            $lv_result = $lv_result . "<h2 class='kopf'>Modulo di mutazione del cliente</h2>";
        }

        $lv_result = $lv_result . " 
        </td>
        <td width=\"30%\" align=\"right\" valign=\"top\"><b>$datum<br /><div class='invisible'>$deutsch | $franz | $Italie</b></div>
        <!-- Legende -->
        <div class=\"legend\">";
        //Titel nach Sprache ausgeben
        if ($this->form_sprache == "d") {
            $lv_result = $lv_result . " <input class=\'legende\' type=\"checkbox\">Mehrfach Auswählbar<br>
                                        <input class=\'legende\' type=\"radio\">Einmal Auswählbar";
        } else if ($this->form_sprache == "f") {
            $lv_result = $lv_result . " <input class=\'legende\' type=\"checkbox\">multiple sélectionnable<br>
                                        <input class=\'legende\' type=\"radio\">une fois";
        } else if ($this->form_sprache == "i") {
            $lv_result = $lv_result . " <input class=\'legende\' type=\"checkbox\">Multiple selezionabile<br>
                                        <input class=\'legende\' type=\"radio\">una volta selezionabile";
        }
        $lv_result = $lv_result . " 
        </div>
        </td>
       </tr>
      </table> 
    ";
        return $lv_result;
    }
    //***********************************************************************************************************************************

    /**
     * Hier wird das Formular mit den Benutzer Daten ausgegeben, welche auf der Datenbank mit ID Selectriert werden
     */
    public function FormularAusgebenWert()
    {
        settype($lv_result, string);
        $Ueberschrift = new Ueberschrift;
        $InputFeld = new InputFeld;
        $CheckBox = new CheckBox;
        $DropDownSinglePrint = new DropDownSinglePrint();
        $DropDownMultiblePrint = new DropDownMultiblePrint();


        // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
        if ($this->Debug) {
            $lv_result = '<div class="errorMsg">OK bin in [FormularAusgeben] </div>';
            echo $lv_result;
        }
        //insert Header
        $lv_result = $this->setFormularHead();

        //Je nach Sprache andere Ausgabe
        if ($this->form_sprache == "f") {
            $QueryFeldName = "name_fr";
            $QueryCss = "fr_width";
            $this->languForSql = "FR";
        } elseif ($this->form_sprache == "i") {
            $QueryFeldName = "name_it";
            $QueryCss = "it_width";
            $this->languForSql = "IT";
        } else {
            $QueryFeldName = "name_de";
            $QueryCss = "de_width";
            $this->languForSql = "DE";
        }
        //umbruch in Retail und Esa Formular unterschieden. Weil Formulare unterschiedlich wird der Umbruch nicht an der gleichen Position sein.
        /*
        if ($this->FormularArt == "retail"){
            $umbruch = "Umbruch_$this->FormularArt";
        }else{
            //retail
            $umbruch = "Umbruch_esa";
        }
        */
        //SQL String mit richtiger Sprache drin.
        $strSQL = "SELECT `wert`,`$QueryFeldName`,`art`,`attribut`,`tabelle`,`sort`,`$QueryCss`,`umbruch`  FROM `output` WHERE `id_form` = '$this->id_form' ORDER BY `sort`;";
        //in sqlConn wurde die Datenbankverbdinung definiert
        sqlConn()->query("SET NAMES 'utf8'");
        $result = sqlConn()->query($strSQL);
        $lv_result = $lv_result . "<div><form action='result.php' method='post'>";
        if ($this->form_sprache == "f") {
            $zugang = "altération";
            $aenderung = "altération";
            $sperren = "barrières";
            $entsperren = "déverrouillage";
        } elseif ($this->form_sprache == "i") {
            $zugang = "ingresso";
            $aenderung = "modificazioni";
            $sperren = "ceppi";
            $entsperren = "unseal";

        } else {
            $zugang = "Zugang";
            $aenderung = "Aenderung";
            $sperren = "Sperren";
            $entsperren = "Entsperren";
        }
        $lv_zugang = "Zugang";
        $lv_aenderung = "Aenderung";
        $lv_sperren = "Sperren";
        $lv_entsperren = "Entsperren";
        //zugang

        //TODO: Hässlicher Code kürzen !!!
        //Sprache Speichern
        //Checked
        if ($lv_zugang == $this->getArt()) {
            $lv_result = $lv_result . "<div class=\"container\">
	                                    <table><tbody><tr><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Zugang\" checked><label class='header'>$zugang</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Aenderung\"><label class='header'>$aenderung</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Sperren\"><label class='header'>$sperren</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Entsperren\"><label class='header'>$entsperren</label></td></tr></tbody></table>
	                                </div>";
        } elseif ($lv_aenderung == $this->getArt()) {
            $lv_result = $lv_result . "<div class=\"container\">
	                                    <table><tbody><tr><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Zugang\"><label class='header'>$zugang</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Aenderung\" checked><label class='header'>$aenderung</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Sperren\"><label class='header'>$sperren</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Entsperren\"><label class='header'>$entsperren</label></td></tr></tbody></table>
	                                </div>";
        } elseif ($lv_sperren == $this->getArt()) {
            $lv_result = $lv_result . "<div class=\"container\">
	                                    <table><tbody><tr><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Zugang\"><label class='header'>$zugang</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Aenderung\" ><label class='header'>$aenderung</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Sperren\" checked><label class='header'>$sperren</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Entsperren\"><label class='header'>$entsperren</label></td></tr></tbody></table>
	                                </div>";
        } elseif ($lv_entsperren == $this->getArt()) {
            $lv_result = $lv_result . "<div class=\"container\">
	                                    <table><tbody><tr><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Zugang\"><label class='header'>$zugang</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Aenderung\" ><label class='header'>$aenderung</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Sperren\" ><label class='header'>$sperren</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Entsperren\" checked><label class='header'>$entsperren</label></td></tr></tbody></table>
	                                </div>";
        } else {
            $lv_result = $lv_result . "<div class=\"container\">
	                                    <table><tbody><tr><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Zugang\"><label class='header'>$zugang</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Aenderung\" ><label class='header'>$aenderung</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Sperren\" ><label class='header'>$sperren</label></td><td width=\"160px\"><input type=\"radio\" name=\"art\" value=\"Entsperren\"><label class='header'>$entsperren</label></td></tr></tbody></table>
	                                </div>";
        }
        // SQL auswerten und ausgeben
        if ($result->num_rows > 0) {
            // output data für jede Zeile
            while ($row = $result->fetch_assoc()) {
                $wert = $row["wert"];
                $tabelle = $row["tabelle"];
                $select = $row["attribut"];
                switch ($row["art"]) {
                    case '0':  //Überschrift
                        {
                            $Ueberschrift->setUeberschrift($row[$QueryFeldName]);
                            $lv_result = $lv_result . $Ueberschrift->showUeberschrift();
                            if ($row["umbruch"] == 1) {
                                $lv_result = $lv_result . "<div style='page-break-before:always;' class='AbstandUmbruch'></div>";
                            }
                            break;
                        }
                    case '1':  //Input Felder
                        {
                            $InputFeld->setLabelFeld($row[$QueryFeldName]);
                            $InputFeld->setInputFeld($row["wert"]);
                            $InputFeld->setCssWidth($row[$QueryCss]);
                            $InputFeld->getValueFromDB($this->form_idkdmut);
                            $lv_result = $lv_result . $InputFeld->insertInputFeld();
                            if ($row["umbruch"] == 1) {
                                $lv_result = $lv_result . "<div style='page-break-before:always;' class='AbstandUmbruch'></div>";
                            }
                            break;
                        }
                    case '2':  //Checkbox JA / Nein : 1 / 0
                        {
                            $CheckBox->setLabelFeld($row[$QueryFeldName]);
                            $CheckBox->setCssWidth($row[$QueryCss]);
                            $CheckBox->setWert($row["wert"]);
                            $CheckBox->getValueFromDB($this->form_idkdmut);
                            $CheckBox->setLangu($this->form_sprache);
                            $lv_result = $lv_result . $CheckBox->setRadioButtonJN();
                            if ($row["umbruch"] == 1) {
                                $lv_result = $lv_result . "<div style='page-break-before:always;' class='AbstandUmbruch'></div>";
                            }
                            //$lv_result = $lv_result . $CheckBox->setCheckbox(1);
                            break;
                        }
                    case '3':  //Drop Down nur 1 Wert auswählbar *
                        {
                            $DropDownSinglePrint->setWert($wert);
                            $DropDownSinglePrint->setSelect($select);
                            $DropDownSinglePrint->setTabelle($tabelle);
                            $DropDownSinglePrint->setLabelFeld($row[$QueryFeldName]);
                            $DropDownSinglePrint->setCssWidth($row[$QueryCss]);
                            $DropDownSinglePrint->getValueFromDB($this->form_idkdmut);
							// Ausgeben
                            if($wert == "routebez"){
                                //gib nichts aus
                            }else{
                                $lv_result = $lv_result . $DropDownSinglePrint->showDropDownSingle($this->languForSql);
                            }
							
                            
                            if ($row["umbruch"] == 1) {
                                $lv_result = $lv_result . "<div style='page-break-before:always;' class='AbstandUmbruch'></div>";
                            }
                            break;
                        }
                    case '4':   //Drop Down mehrere Wert auswählbar *
                        {
                            $DropDownMultiblePrint->setLabelFeld($row[$QueryFeldName]);
                            $DropDownMultiblePrint->setWert($wert);
                            $DropDownMultiblePrint->setSelect($select);
                            $DropDownMultiblePrint->setTabelle($tabelle);
                            $DropDownMultiblePrint->setCssWidth($row[$QueryCss]);
                            //NEW OUTPUT
                            //$lv_result = $lv_result . $DropDownMultiblePrint->showDropDownMultible();
                            $lv_result = $lv_result . $DropDownMultiblePrint->getValuefromDb($this->form_idkdmut, $this->languForSql);
                            if ($row["umbruch"] == 1) {
                                $lv_result = $lv_result . "<div style='page-break-before:always;' class='AbstandUmbruch'></div>";
                            }
                            break;
                        }
                    //Bedingung zu 100% abgefangen. Falls nicht wird Error Mesage ausgegeben
                    default:
                        {
                            echo '<div class="errorMsg">ELSE Fall in [FormularAusgeben()] Es wurde keine ART_ID mitgegeben</div>';
                            break;
                        }
                }
                //Fals Debug True : Debug Variablen Ausgeben
                if ($this->Debug) {
                    echo "<h1>DEBUG:</h1>";
                    echo "Wert: " . $row["wert"] . "<br>  Name_de: " . $row["name_de"] . "<br> Name_fr: " . $row["name_fr"] . "<br>Name_it: " . $row["name_it"] . "<hr />";
                    var_dump($tabelle);
                    var_dump($select);
                }
                //Falls Debug False : Programm lauft ohne Meldung weiter (NORMALFALL)
            }//Fertig While Schleiffe
            $lv_result = $lv_result . "<br><br><br><input class='invisible' type='submit'>";
            //$lv_result = $lv_result . "<input type=\"file\" name=\"file\">Download</input><br>";
            $lv_result = $lv_result . "</form></div>";

            //TODO: Download Buttoon Falls Download möglich
            if(hasFileEintragDB($this->form_idkdmut)){
                //IF FILE UPLOAD
                $lv_result = $lv_result . "<form action='download.php' method='post'>
                                             <input type='hidden' name='id' value='$this->form_idkdmut'/>
                                             <input type='submit' name='submit' class='invisible' value='Download File'/>
                                       </form>";
            }
        } else {
            echo "Leider wurde nichts gefunden...DB Fehler";
            $lv_result = $lv_result . "Leider wurde nichts gefunden...DB Fehler";
            sqlConn()->close();
        }
        return $lv_result;
    }
}//   Ende Klass Main
/************************
 *   Ablauf Programm   *
 ***********************/
//Objekt instanzieren
$HtmlSeite = new Main;

echo $HtmlSeite->saveUrlParam();
echo $HtmlSeite->setEmailparam();
echo $HtmlSeite->createHtmlHead();       // von <html ....> bis </head><body .....>
echo $HtmlSeite->createHtmlFormular();   // Steuerung des Formulars mit kompletter Ausgabe.
// Steuerung enthält : Sprache und ausgabeart.
echo $HtmlSeite->createHtmlFooder();     // beliebige Fussnote... evt. Optional
echo $HtmlSeite->createHtmlEnd();        // </body></html>
