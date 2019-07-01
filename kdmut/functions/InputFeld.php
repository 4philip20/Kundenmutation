<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 26.11.2018
 * Time: 15:50
 */


function setInputFeld($Name, $name1)
{
    settype( $lv_result ,string ) ;
    // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
    if ( $this->Debug){
        $lv_result = '<div class="errorMsg">OK bin in [setInputFeld] </div>';
        echo $lv_result;
    }

    $lv_result = $lv_result .  " <td><label class='labelwidth'>$Name</label></td><input type='text' name='$name1' >";
    return $lv_result;
}