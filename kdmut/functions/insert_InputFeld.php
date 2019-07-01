<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 14.12.2018
 * Time: 09:03
 */
function insert_InputFeld($value)
{
    //echo '<div class="errorMsg">OK bin in [insert_InputFeld] </div>';
    //var_dump($value);
    /***********************************
     *   Ausgabe InputFeld für Email   *
     ***********************************/
    echo "
   <td><label class='labelwidth'>Name</label></td><input type='text' name='$value' value='$value'>
    ";

}