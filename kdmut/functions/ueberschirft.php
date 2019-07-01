<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 26.11.2018
 * Time: 15:52
 */

function ueberschrift($wert)
{
    settype( $lv_result ,string ) ;
    // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
    if ( $this->Debug){
       echo '<div class="errorMsg">OK bin in [setUeberschrift] </div>';
    }

    $lv_result =  "<b><label>$wert</b><br>";
    return $lv_result;
}