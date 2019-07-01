<?php
/*******************************************************************************
 * Von:          ESA - Philip Rippstein
 * Datum / Zeit: 19.11.2018
 * Was:          Kundenmutationen mit Feldern erweitern.
 * Version:      2.0 - 19.11.2018
 *******************************************************************************/

/********************
 * Save Array
 *********************/
require_once('save.php');
require_once('Email.php');
require_once('file.php');

/********************************
 * Take Data from POST Formular *
 ********************************/
//Zahlungsbedingung 4 Multi
if (!isset($_POST["art"])) {
    $art = 'NULL';
} else {
    $art = $_POST["art"];
};

/***********************
 * Alle Werte Ausgeben *
 ***********************/
/***********************
 * Alle ART 1 Speichern *
 ***********************/
if (!isset($_POST["PVDN"])) {
    $art1_1 = 'NULL';
} else {
    $art1_1 = $_POST["PVDN"];
};
//
if (!isset($_POST["dbname"])) {
    $art1_2 = 'NULL';
} else {
    $art1_2 = $_POST["dbname"];
};
//
if (!isset($_POST["dbvorname"])) {
    $art1_3 = 'NULL';
} else {
    $art1_3 = $_POST["dbvorname"];
};
//
if (!isset($_POST["dbadresse"])) {
    $art1_4 = 'NULL';
} else {
    $art1_4 = $_POST["dbadresse"];
};
//
if (!isset($_POST["PVN"])) {
    $art1_5 = 'NULL';
} else {
    $art1_5 = $_POST["PVN"];
};
//
if (!isset($_POST["PVAD"])) {
    $art1_6 = 'NULL';
} else {
    $art1_6 = $_POST["PVAD"];
};
//
if (!isset($_POST["PVO"])) {
    $art1_7 = 'NULL';
} else {
    $art1_7 = $_POST["PVO"];
};
//
if (!isset($_POST["KDN1"])) {
    $art1_8 = 'NULL';
} else {
    $art1_8 = $_POST["KDN1"];
};
//
if (!isset($_POST["KDN2"])) {
    $art1_9 = 'NULL';
} else {
    $art1_9 = $_POST["KDN2"];
};
//
if (!isset($_POST["KDS"])) {
    $art1_10 = 'NULL';
} else {
    $art1_10 = $_POST["KDS"];
};
//
if (!isset($_POST["KDNR"])) {
    $art1_11 = 'NULL';
} else {
    $art1_11 = $_POST["KDNR"];
};
//
if (!isset($_POST["KDPLZ"])) {
    $art1_12 = 'NULL';
} else {
    $art1_12 = $_POST["KDPLZ"];
};
//
if (!isset($_POST["KDORT"])) {
    $art1_13 = 'NULL';
} else {
    $art1_13 = $_POST["KDORT"];
};
//
if (!isset($_POST["KDRE"])) {
    $art1_14 = 'NULL';
} else {
    $art1_14 = $_POST["KDRE"];
};
//
if (!isset($_POST["KDLA"])) {
    $art1_15 = 'NULL';
} else {
    $art1_15 = $_POST["KDLA"];
};
//
if (!isset($_POST["KDPF"])) {
    $art1_16 = 'NULL';
} else {
    $art1_16 = $_POST["KDPF"];
};
//
if (!isset($_POST["KDSP"])) {
    $art1_17 = 'NULL';
} else {
    $art1_17 = $_POST["KDSP"];
};
//
if (!isset($_POST["KDTL"])) {
    $art1_18 = 'NULL';
} else {
    $art1_18 = $_POST["KDTL"];
};
//
if (!isset($_POST["KDMO"])) {
    $art1_19 = 'NULL';
} else {
    $art1_19 = $_POST["KDMO"];
};
//
if (!isset($_POST["KDEM"])) {
    $art1_20 = 'NULL';
} else {
    $art1_20 = $_POST["KDEM"];
};
//
if (!isset($_POST["KDFX"])) {
    $art1_21 = 'NULL';
} else {
    $art1_21 = $_POST["KDFX"];
};
//
if (!isset($_POST["STMWST"])) {
    $art1_22 = 'NULL';
} else {
    $art1_22 = $_POST["STMWST"];
};

if (!isset($_POST["partnername"])) {
    $art1_23 = 'NULL';
} else {
    $art1_23 = $_POST["partnername"];
};
//
//
if (!isset($_POST["dgb"])) {
    $art1_24 = 'NULL';
} else {
    $art1_24 = $_POST["dgb"];
};
//
if (!isset($_POST["ANPN"])) {
    $art1_25 = 'NULL';
} else {
    $art1_25 = $_POST["ANPN"];
};
//
if (!isset($_POST["ANPV"])) {
    $art1_26 = 'NULL';
} else {
    $art1_26 = $_POST["ANPV"];
};
//
if (!isset($_POST["ANPE"])) {
    $art1_27 = 'NULL';
} else {
    $art1_27 = $_POST["ANPE"];
};
//
if (!isset($_POST["ANPT"])) {
    $art1_28 = 'NULL';
} else {
    $art1_28 = $_POST["ANPT"];
};
if (!isset($_POST["MABWA"])) {
    $art1_29 = 'NULL';
} else {
    $art1_29 = $_POST["MABWA"];
};
//
if (!isset($_POST["ASAA"])) {
    $art1_30 = 'NULL';
} else {
    $art1_30 = $_POST["ASAA"];
};
//
if (!isset($_POST["ASAVA"])) {
    $art1_31 = 'NULL';
} else {
    $art1_31 = $_POST["ASAVA"];
};
//
if (!isset($_POST["ASAM"])) {
    $art1_32 = 'NULL';
} else {
    $art1_32 = $_POST["ASAM"];
};
//
if (!isset($_POST["AGVS"])) {
    $art1_33 = 'NULL';
} else {
    $art1_33 = $_POST["AGVS"];
};
//
if (!isset($_POST["bemebung"])) {
    $art1_34 = 'NULL';
} else {
    $art1_34 = $_POST["bemebung"];
};
//
if (!isset($_POST["datum"])) {
    $art1_35 = 'NULL';
} else {
    $art1_35 = $_POST["datum"];
};
//
if (!isset($_POST["auftraggeber"])) {
    $art1_36 = 'NULL';
} else {
    $art1_36 = $_POST["auftraggeber"];
};
//
if (!isset($_POST["buchhaltung"])) {
    $art1_37 = 'NULL';
} else {
    $art1_37 = $_POST["buchhaltung"];
};
//
if (!isset($_POST["vs"])) {
    $art1_38 = 'NULL';
} else {
    $art1_38 = $_POST["vs"];
};
//
if (!isset($_POST["erfasst"])) {
    $art1_39 = 'NULL';
} else {
    $art1_39 = $_POST["erfasst"];
};
//
if (!isset($_POST["ROUTEN"])) {
    $art1_40 = 'NULL';
} else {
    $art1_40 = $_POST["ROUTEN"];
};
//emailadresse
if (!isset($_POST["emailadresse"])) {
    $art1_41 = 'NULL';
} else {
    $art1_41 = $_POST["emailadresse"];
};
//regulierer
if (!isset($_POST["regulierer"])) {
    $art1_42 = 'NULL';
} else {
    $art1_42 = $_POST["regulierer"];
};
//warenempf
if (!isset($_POST["warenempf"])) {
    $art1_43 = 'NULL';
} else {
    $art1_43 = $_POST["warenempf"];
};
//konditionsgebe
if (!isset($_POST["konditionsgeber"])) {
    $art1_44 = 'NULL';
} else {
    $art1_44 = $_POST["konditionsgeber"];
};
//hauptsitz
if (!isset($_POST["hauptsitz"])) {
    $art1_45 = 'NULL';
} else {
    $art1_45 = $_POST["hauptsitz"];
};
//verkaufergruppe
if (!isset($_POST["verkaufergruppe"])) {
    $art1_46 = 'NULL';
} else {
    $art1_46 = $_POST["verkaufergruppe"];
};
/***********************
 * Alle ART 2 Speichern *
 ***********************/
//
if (!isset($_POST["PVG"])) {
    $art2_1 = 'N';
} else {
    $art2_1 = $_POST["PVG"];
};
//
if (!isset($_POST["BKDKA"])) {
    $art2_2 = 'N';
} else {
    $art2_2 = $_POST["BKDKA"];
};
//
if (!isset($_POST["MW"])) {
    $art2_3 = 'N';
} else {
    $art2_3 = $_POST["MW"];
};
//
if (!isset($_POST["RGM"])) {
    $art2_4 = 'N';
} else {
    $art2_4 = $_POST["RGM"];
};
//
if (!isset($_POST["MAFPH"])) {
    $art2_5 = 'N';
} else {
    $art2_5 = $_POST["MAFPH"];
};
//
if (!isset($_POST["MAL"])) {
    $art2_6 = 'N';
} else {
    $art2_6 = $_POST["MAL"];
};
//
if (!isset($_POST["MAW"])) {
    $art2_7 = 'N';
} else {
    $art2_7 = $_POST["MAW"];
};
//
if (!isset($_POST["MAB"])) {
    $art2_8 = 'N';
} else {
    $art2_8 = $_POST["MAB"];
};
//
if (!isset($_POST["MAPD"])) {
    $art2_9 = 'N';
} else {
    $art2_9 = $_POST["MAPD"];
};
//
if (!isset($_POST["MANFR"])) {
    $art2_10 = 'N';
} else {
    $art2_10 = $_POST["MANFR"];
};
//
if (!isset($_POST["MATS"])) {
    $art2_11 = 'N';
} else {
    $art2_11 = $_POST["MATS"];
};
//
if (!isset($_POST["MATSS"])) {
    $art2_12 = 'N';
} else {
    $art2_12 = $_POST["MATSS"];
};
//
if (!isset($_POST["MAWA"])) {
    $art2_13 = 'N';
} else {
    $art2_13 = $_POST["MAWA"];
};
//
if (!isset($_POST["KGHZ"])) {
    $art2_14 = 'N';
} else {
    $art2_14 = $_POST["KGHZ"];
};
//
if (!isset($_POST["KGHP"])) {
    $art2_15 = 'N';
} else {
    $art2_15 = $_POST["KGHP"];
};
//
if (!isset($_POST["KRH"])) {
    $art2_16 = 'N';
} else {
    $art2_16 = $_POST["KRH"];
};
//
if (!isset($_POST["KSVT"])) {
    $art2_17 = 'N';
} else {
    $art2_17 = $_POST["KSVT"];
};
//
if (!isset($_POST["KIGH"])) {
    $art2_18 = 'N';
} else {
    $art2_18 = $_POST["KIGH"];
};
//
if (!isset($_POST["KMöGZ"])) {
    $art2_19 = 'N';
} else {
    $art2_19 = $_POST["KMöGZ"];
};
//
if (!isset($_POST["KTSF"])) {
    $art2_20 = 'N';
} else {
    $art2_20 = $_POST["KTSF"];
};
//
if (!isset($_POST["KTSMöGE"])) {
    $art2_21 = 'N';
} else {
    $art2_21 = $_POST["KTSMöGE"];
};
//
if (!isset($_POST["KMöGM"])) {
    $art2_22 = 'N';
} else {
    $art2_22 = $_POST["KMöGM"];
};
//
if (!isset($_POST["KTSMoGP"])) {
    $art2_23 = 'NULL';
} else {
    $art2_23 = $_POST["KTSMoGP"];
};
//
if (!isset($_POST["KZU"])) {
    $art2_24 = 'N';
} else {
    $art2_24 = $_POST["KZU"];
};
//
if (!isset($_POST["KBMZ"])) {
    $art2_25 = 'N';
} else {
    $art2_25 = $_POST["KBMZ"];
};
//
if (!isset($_POST["KBMP"])) {
    $art2_26 = 'N';
} else {
    $art2_26 = $_POST["KBMP"];
};
//
if (!isset($_POST["KSMZ"])) {
    $art2_27 = 'N';
} else {
    $art2_27 = $_POST["KSMZ"];
};
//
if (!isset($_POST["KSMP"])) {
    $art2_28 = 'N';
} else {
    $art2_28 = $_POST["KSMP"];
};
//
if (!isset($_POST["SPL"])) {
    $art2_29 = 'N';
} else {
    $art2_29 = $_POST["SPL"];
};
//
if (!isset($_POST["SPF"])) {
    $art2_30 = 'N';
} else {
    $art2_30 = $_POST["SPF"];
};
//
if (!isset($_POST["SPA"])) {
    $art2_31 = 'N';
} else {
    $art2_31 = $_POST["SPA"];
};
/************************
 * Alle ART 3 Speichern *
 ************************/
//Geschäftsstelle 3 single
if (!isset($_POST["BKDZB"])) {
    $art3_1 = 'NULL';
} else {
    $art3_1 = $_POST["BKDZB"];
};
//
if (!isset($_POST["BKDGS"])) {
    $art3_2 = 'NULL';
} else {
    $art3_2 = $_POST["BKDGS"];
};
//
if (!isset($_POST["PREISLISTE"])) {
    $art3_3 = 'NULL';
} else {
    $art3_3 = $_POST["PREISLISTE"];
};
//
if (!isset($_POST["LIFPRIO"])) {
    $art3_4 = 'NULL';
} else {
    $art3_4 = $_POST["LIFPRIO"];
};
//
if (!isset($_POST["AWERK"])) {
    $art3_5 = 'NULL';
} else {
    $art3_5 = $_POST["AWERK"];
};
//
if (!isset($_POST["Vbinco"])) {
    $art3_6 = 'NULL';
} else {
    $art3_6 = $_POST["Vbinco"];
};
//
if (!isset($_POST["RGT"])) {
    $art3_7 = 'NULL';
} else {
    $art3_7 = $_POST["RGT"];
};
//
if (!isset($_POST["ANPA"])) {
    $art3_8 = 'NULL';
} else {
    $art3_8 = $_POST["ANPA"];
};
//
if (!isset($_POST["ANPF"])) {
    $art3_9 = 'NULL';
} else {
    $art3_9 = $_POST["ANPF"];
};
//
if (!isset($_POST["MAKA"])) {
    $art3_10 = 'NULL';
} else {
    $art3_10 = $_POST["MAKA"];
};
//
if (!isset($_POST["MAKG"])) {
    $art3_11 = 'NULL';
} else {
    $art3_11 = $_POST["MAKG"];
};
//
if (!isset($_POST["MAGK"])) {
    $art3_12 = 'NULL';
} else {
    $art3_12 = $_POST["MAGK"];
};
//
if (!isset($_POST["MAGM"])) {
    $art3_13 = 'NULL';
} else {
    $art3_13 = $_POST["MAGM"];
};
//
if (!isset($_POST["MAPHK"])) {
    $art3_14 = 'NULL';
} else {
    $art3_14 = $_POST["MAPHK"];
};
//15
if (!isset($_POST["MACK"])) {
    $art3_15 = 'NULL';
} else {
    $art3_15 = $_POST["MACK"];
};
//15
if (!isset($_POST["KBMN"])) {
    $art3_16 = 'NULL';
} else {
    $art3_16 = $_POST["KBMN"];
};
//17
if (!isset($_POST["KSMN"])) {
    $art3_17 = 'NULL';
} else {
    $art3_17 = $_POST["KSMN"];
};
if (!isset($_POST["VKGRP"])) {
    $art3_18 = 'NULL';
} else {
    $art3_18 = $_POST["VKGRP"];
};
/*
/************************
 * Alle ART 4 Speichern *
 ************************/
//Markenvertrettuing
if (!isset($_POST["MAMV"])) {
    $art4_1 = 'NULL';
} else {
    $art4_1 = $_POST["MAMV"];
};
//Lackmarke
if (!isset($_POST["MALM"])) {
    $art4_2 = 'NULL';
} else {
    $art4_2 = $_POST["MALM"];
};
//Patnerrolle
if (!isset($_POST["partnerr"])) {
    $art4_3 = 'NULL';
} else {
    $art4_3 = $_POST["partnerr"];
};
//Waschanlage
if (!isset($_POST["waschanlage"])) {
    $art4_4 = 'NULL';
} else {
    $art4_4 = $_POST["waschanlage"];
};
//Interessenten
if (!isset($_POST["interessenten"])) {
    $art4_5 = 'NULL';
} else {
    $art4_5 = $_POST["interessenten"];
};
session_start();
$artForm = $_SESSION["FormularArt"];

//var_dump($art1_40);
//var_dump($art3_18);

/*
echo "<h1>ART</h1>";
var_dump($art);
echo "<h1>ART1</h1>";
var_dump($art1_1);
var_dump($art1_2);
var_dump($art1_3);
var_dump($art1_4);
var_dump($art1_5);
var_dump($art1_6);
var_dump($art1_7);
var_dump($art1_8);
var_dump($art1_9);
var_dump($art1_10);
var_dump($art1_11);
var_dump($art1_12);
var_dump($art1_13);
var_dump($art1_14);
var_dump($art1_15);
var_dump($art1_16);
var_dump($art1_17);
var_dump($art1_18);
var_dump($art1_19);
var_dump($art1_20);
var_dump($art1_21);
var_dump($art1_22);
// 23 is not an input feld
var_dump($art1_24);
var_dump($art1_25);
var_dump($art1_26);
var_dump($art1_27);
var_dump($art1_28);
var_dump($art1_29);
var_dump($art1_30);
var_dump($art1_31);
var_dump($art1_32);
var_dump($art1_33);
var_dump($art1_34);
var_dump($art1_35);
var_dump($art1_36);
var_dump($art1_37);
var_dump($art1_38);
var_dump($art1_39);
echo "<h1>ART2</h1>";
var_dump($art2_1);
var_dump($art2_2);
var_dump($art2_3);
var_dump($art2_4);
var_dump($art2_5);
var_dump($art2_6);
var_dump($art2_7);
var_dump($art2_8);
var_dump($art2_9);
var_dump($art2_10);
var_dump($art2_11);
var_dump($art2_12);
var_dump($art2_13);
var_dump($art2_14);
var_dump($art2_15);
var_dump($art2_16);
var_dump($art2_17);
var_dump($art2_18);
var_dump($art2_19);
var_dump($art2_20);
var_dump($art2_21);
var_dump($art2_22);
var_dump($art2_23);
var_dump($art2_24);
var_dump($art2_25);
var_dump($art2_26);
var_dump($art2_27);
var_dump($art2_28);
var_dump($art2_29);
var_dump($art2_30);
var_dump($art2_31);
echo "<h1>ART3</h1>";
var_dump($art3_1);
var_dump($art3_2);
var_dump($art3_3);
var_dump($art3_4);
var_dump($art3_5);
var_dump($art3_6);
var_dump($art3_7);
var_dump($art3_8);
var_dump($art3_9);
var_dump($art3_10);
var_dump($art3_11);
var_dump($art3_12);
var_dump($art3_14);
var_dump($art3_15);
var_dump($art3_16);
var_dump($art3_17);
echo "<h1>ART4</h1>";
var_dump($art4_1);
var_dump($art4_2);
var_dump($art4_3);

*/
/*
 * DEBUG TRUE
$Item1 = "test";
$Item2 = "kunde";
$Item3 = "Noch nicht";
$Item4 = array(
    0 => "Vertretter1",
    1 => "Vertretter2"
);

*/
/********************
 * Print Array
 *********************/
/**DEBUG TRUE**/
/*
echo "<h1>Print alle Post</h1>";
print_r($_POST);
echo "<h1>Post Array</h1>";
foreach ($_POST as $key => $value) {
    $i += 1;
    echo "Feld = ".htmlspecialchars($key)." = ".htmlspecialchars($value)."<br> $i";
}
*/
/********************
 * Save Data in Databse
 *********************/
//$ID = save($Item1, $Item2, $art1_18, $Item4);
$ID = save(
    $art1_1,
    $art1_2,
    $art1_3,
    $art1_4,
    $art1_5,
    $art1_6,
    $art1_7,
    $art1_8,
    $art1_9,
    $art1_10,
    $art1_11,
    $art1_12,
    $art1_13,
    $art1_14,
    $art1_15,
    $art1_16,
    $art1_17,
    $art1_18,
    $art1_19,
    $art1_20,
    $art1_21,
    $art1_22,
    $art1_23,

    $art1_24,
    $art1_25,
    $art1_26,
    $art1_27,
    $art1_28,
    $art1_29,
    $art1_30,
    $art1_31,
    $art1_32,
    $art1_33,
    $art1_34,
    $art1_35,
    $art1_36,
    $art1_37,
    $art1_38,
    $art1_39,
    $art1_40,
    $art1_41,
    $art1_42,
    $art1_43,
    $art1_44,
    $art1_45,
    $art1_46,

    $art2_1,
    $art2_2,
    $art2_3,
    $art2_4,
    $art2_5,
    $art2_6,
    $art2_7,
    $art2_8,
    $art2_9,
    $art2_10,
    $art2_11,
    $art2_12,
    $art2_13,
    $art2_14,
    $art2_15,
    $art2_16,
    $art2_17,
    $art2_18,
    $art2_19,
    $art2_20,
    $art2_21,
    $art2_22,
    $art2_23,
    $art2_24,
    $art2_25,
    $art2_26,
    $art2_27,
    $art2_28,
    $art2_29,
    $art2_30,
    $art2_31,

    $art3_1,
    $art3_2,
    $art3_3,
    $art3_4,
    $art3_5,
    $art3_6,
    $art3_7,
    $art3_8,
    $art3_9,
    $art3_10,
    $art3_11,
    $art3_12,
    $art3_13,
    $art3_14,
    $art3_15,
    $art3_16,
    $art3_17,
    $art3_18,

    $art4_1,
    $art4_2,
    $art4_3,
    $art4_4,
    $art4_5,

    $art,
	$artForm

);
//Sesion starten um später abfagen zu können.
session_start();
$artForm = $_SESSION["FormularArt"];
//Falls mit dabei, dann Ausdrucken
$fileUploadOK = false;
if($_FILES["fileToUpload"]["name"] !== ""){
    //IF FILE
    $fileUploadOK = true;
    file_Upload($ID);

}


/******************************
 * //Send Mail with Variables *
 * ****************************/
//UM Return value ID von funktion save() zu bekommen
//Um später Daten auszugeben Folumar E oder Ss
$email = new Email();
$email->sendEmailSachbearbeiter($ID,$fileUploadOK,$artForm);
//$emaill = new Email();
//$emaill->sendEmailPhilip($ID,$fileUploadOK);
//Mail an Auftraggeber (Erfasser senden)
if ($art1_36 !== "NULL"){
    //Sende Email
    $email = new Email();
    $email->sendEmailAuftraggeber($ID,$fileUploadOK,$art1_36);
}else{
    //Sende keine Email
}


$location = "http://intranet.esa.ch/netprog/kdmut/index.php?art=$artForm&action=d&kdmut=$ID";
//$location = "http://localhost/kdmut/index.php?art=$artForm&action=d&kdmut=$ID";
//Aufruf Location
header("Location: $location");

?>