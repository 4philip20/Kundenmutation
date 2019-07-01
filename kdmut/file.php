<?php
require_once('config.php');
require_once('functions/SqlConn.php');


function file_Upload($ID)
{

    //Variablen definieren
    $target_dir = "anhaenge/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    $target_file = substr_replace($target_file,$ID."_".basename($_FILES["fileToUpload"]["name"]),9);
    //Nur ID.Dateiname
    //$target_file = substr_replace($target_file,$ID.".".$imageFileType,9);


    //Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, File existiert bereits";
        $uploadOk = 0;
    }

    //Check if DateiTyp ist gültig
    $dateiendung = pathinfo($target_file, PATHINFO_EXTENSION);


    // Check if $uploadOk ist gestezt zu 0 dann error
    if ($uploadOk == 0) {
        echo "Sorry, Ihr File wurde nicht upgeloaded.";
    // if alles ok, try to Upload
    } else {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //TODO SQL UPDATE INTO OUPOUT - FILE PATH
            require_once('config.php');
            require_once('functions/SqlConn.php');
            //Update Row
            UpdateFileToRow($target_file,$ID);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

function file_Download($ID)
{
    $target_dir = "anhaenge/";
    //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    //Dateiendung ermitteln

    /*
    $target_file = $target_dir .$ID;

    if (strpos($target_file, $ID) !== false) {
        echo 'true';
    }
    */
    //TODO PROBLEM BEHEBEN
    $target_file = GetFileFromeRow($ID);
    $dateiendung = pathinfo($target_file, PATHINFO_EXTENSION);

    $downloadOk = true;

    if ($_SESSION["isFromPage"]) {
        $downloadOk = flase;
    }
    //Falls File existiert
    if(file_exists(strtolower($target_file)) && $downloadOk){
        //Falls Dateiendung docx oder PDF DANN DOWNLOAD NAH WORD ODER PDF
        if(strtolower($dateiendung) == "pdf"){
            // Define headers
            //header('Content-Description: File Transfer');
            //header('Content-Type: application/octet-stream');
            //header('Content-Transfer-Encoding: binary');
            //header("Content-Type: application/force-download");

            header("Content-Type: application/download");
            header("Content-Length: " . filesize($target_file));
            header('Content-Disposition: attachment; filename="'.basename($target_file).'"');

            //wieso weis ich nicht aber funktioniert ;(
            //Leert (sendet) den Ausgabepuffer
            ob_clean();
            //Leert (sendet) den Ausgabepuffer
            //flush();
            //öffet tag für pdf File
            readfile($target_file);
            //header('Location: '.$target_file );
            //exit;

        }
        //Falls Bilder
        else if (strtolower($dateiendung) == "jpg" || strtolower($dateiendung) == "png"){
            // Define headers
            //header('Content-Description: File Transfer');

                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($target_file));

            //header('Content-Transfer-Encoding: binary');
            //header('Expires: 0');
            //header('Cache-Control: public'); //für i.e.
           // header('Pragma: public');
            // Read the file
            ob_clean();
            //flush();
            readfile($target_file);

            //exit;
        }else{
            echo "Datei Typ wurde nicht akzeptiert";
        }
    }else{
        //TODO Fehlermeldung Formular // Nichts Downlaoden.
        //echo " DOWNLOAD FILE NOT FOUND";
    }
}
/*
function getFileName($ID){
    $files = glob("anhaenge/$ID*",GLOB_NOCHECK);
    var_dump($files);
    return $files;
}
*/

// MIT FTP FUNKTION
/*
// Verbindungs Variablen
$ftp_server = "newsletter.esa.ch"; // Address of FTP server.
$ftp_user_name = "p246178f1";      // Username
$ftp_user_pass = "EMark1291!";     // Password
$ftp_path = "/kdmut";            // Path auf dem Server wo die Files abgelegt sind
$ftp_filename = "";
$ftp_found = false;

// Verbindung aufbauen
$conn_id = ftp_connect($ftp_server);
// Login mit Benutzername und Passwort
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
//Benutzerdaten prüfen
if ($login_result) {
    //Pfad wechseln
    if (ftp_chdir($conn_id, $ftp_path) == true) {  // Pfad wechsel nach ../kdmut
        // Datei hochladen
        if (ftp_put($conn_id, $ftp_path, $lv_file, FTP_ASCII)) {
            echo "$lv_file erfolgreich hochgeladen\n";
        } else {
            echo "Ein Fehler trat beim Hochladen von $lv_file auf\n";
        }
    } else {
        echo "Kann Pfad nicht wechseln";
    }
} else {
    echo "Falsche Login Daten";
}
// FTP Verbindung schliessen
ftp_close($conn_id);
*/



/*
//Verbindungs Variablen
$ftp_server = "newsletter.esa.ch"; // Address of FTP server.
$ftp_user_name = "p246178f1";      // Username
$ftp_user_pass = "EMark1291!";     // Password
$ftp_path = "/kdmut";            // Path auf dem Server wo die Files abgelegt sind
$ftp_filename = "";
$ftp_found = false;
$conn_id = ftp_connect($ftp_server) or die("Keine Verbindung zu Server möglich, versuchen Sie es später.");

//Anmelden
if (@ftp_login($conn_id, $ftp_user_name, $ftp_user_pass)) {
} else {
    echo "Anmeldung nicht möglich !<br>\n";
}

//Wenn Verbindung OK Directory lesen oder Prüfen ob File auf dem FTP-Server existiert
if (ftp_chdir($conn_id, $ftp_path) == true) {  // Pfad wechsel nach ../gg
    $allFiles = ftp_nlist($conn_id, '.');       // Besorge alle Dateien im aktuellen Verzeichnis & speichere diese unter allFiles
    foreach ($allFiles as $ftp_filename)                 //foreach alle dateien in $ftp_filename
    {
        $ftp_ID = strstr($ftp_filename, '_', true);
        if (strcmp($ftp_ID, $lv_id) == false) {
            $ftp_found = true;
            break;             // Breche die Schleife ab
        } else {
            $ftp_found = false;
        }
    }
} else {
    echo "Pathwechsel nicht gefunden!<br>\n";
    $ftp_found = false;
}
//Falls Break
if ($ftp_found) {
    // File oder Link zum Browser senden
    header("Cache-Control: no-cache, must-revalidate");
    header('Content-Disposition: attachment; filename="' . $ftp_filename . '"');
    // *** Wenn PDF nur im Browser angezeigt werden soll, aber nicht automatisch vom browser Gespeichert wird.
    //*** File fom FTP Server lesen und downloden.
    ob_start();           // Ausgabepufferung aktivieren
    ftp_get($conn_id, 'php://output', $ftp_filename, FTP_BINARY);
    ob_end_flush();
    // FTP Verbindung schliessen
    ftp_close($conn_id);
}
*/
?>
