<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 17.12.2018
 * Time: 10:04
 */

class Ueberschrift
{
    public $lv_Wert;
    public $lv_CRLF;
    private $zaehlen;
    //Set definieren
    function setUeberschrift($lv_Ueberschrift)
    {
        settype( $lv_Wert ,string ) ;
        $this->lv_Wert = $lv_Ueberschrift;
    }
    //Überschrift ausgabe
    function showUeberschrift()
    {
        $this->lv_CRLF = chr(13) . chr(10);
        settype( $lv_result ,string ) ;
        // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
        if ( $this->Debug){
            echo '<div class="errorMsg">OK bin in [setUeberschrift] </div>';
        }
        $this->zaehlen += 1;

        //Der 1. Border mit Abstand padding
        if($this->zaehlen == "1"){
            $lv_result =  "<div class='ueberschriftUmbruch$this->zaehlen' id='$this->zaehlen'><h2>$this->lv_Wert</h2></div>" . $this->lv_CRLF;
        }else {
            $lv_result = "<div class='ueberschriftUmbruch' id='$this->zaehlen'><h2>$this->lv_Wert</h2></div>" . $this->lv_CRLF;
        }
        return $lv_result;
    }
}