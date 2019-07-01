<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 17.12.2018
 * Time: 13:49
 */

class LabelFeld
{
    public $lv_value;

    public function setLabelFeld($value){

        $this->lv_value = $value;
    }

    public function showLabelFeld()
    {
        settype($lv_result, string);
        // voraussetzung wird sein, das eine leere Datenstrucktur vorhanden ist.
        if ($this->Debug) {
            $lv_result = '<div class="errorMsg">OK bin in [insertLabelFeld] </div>';
            echo $lv_result;
        }

        $lv_result = $lv_result . "<label class='labeldefault'>$this->lv_value</label>";
        return $lv_result;
    }
}