<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 26.11.2018
 * Time: 15:52
 */

function setCheckbox($wert, $wert2)
{
    settype( $lv_result ,string ) ;
    // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
    if ( $this->Debug){
        $lv_result = '<div class="errorMsg">OK bin in [setCheckbox] </div>';
        echo $lv_result;
    }

    $lv_result = $lv_result .  "<td><label class='labelwidth'>$wert</label></td><input type=\"radio\" name=\"$wert2\" value=\"1\">";
    return $lv_result;
 }