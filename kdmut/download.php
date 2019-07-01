<?php

if (!isset($_POST["id"])) {
    $ID = 'NULL';
} else {
    $ID = $_POST["id"];
};

if ($ID == "NULL"){

}else{
    start_download($ID);
}

function file_Download_Button($ID)
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
    $target_file = getFileName($ID);
    $dateiendung = pathinfo($target_file[0], PATHINFO_EXTENSION);

    $downloadOk = true;


    //Falls File existiert
    if(file_exists(strtolower($target_file[0])) && $downloadOk){
        //Falls Dateiendung docx oder PDF DANN DOWNLOAD NAH WORD ODER PDF
        if(strtolower($dateiendung) == "pdf"){
            // Define headers
            //header('Content-Description: File Transfer');
            //header('Content-Type: application/octet-stream');
            //header('Content-Transfer-Encoding: binary');
            //header("Content-Type: application/force-download");

            header("Content-Type: application/download");
            header("Content-Length: " . filesize($target_file[0]));
            header('Content-Disposition: attachment; filename="'.basename($target_file[0]).'"');

            //wieso weis ich nicht aber funktioniert ;(
            //Leert (sendet) den Ausgabepuffer
            ob_clean();
            //Leert (sendet) den Ausgabepuffer
            //flush();
            //öffet tag für pdf File
            readfile($target_file[0]);
            //header('Location: '.$target_file );
            //exit;

        }
        //Falls Bilder
        else if (strtolower($dateiendung) == "jpg" || strtolower($dateiendung) == "png"){
            // Define headers
            //header('Content-Description: File Transfer');

            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($target_file[0]));

            //header('Content-Transfer-Encoding: binary');
            //header('Expires: 0');
            //header('Cache-Control: public'); //für i.e.
            // header('Pragma: public');
            // Read the file
            ob_clean();
            //flush();
            readfile($target_file[0]);

            //exit;
        }else{
            echo "Datei Typ wurde nicht akzeptiert";
        }
    }else{
        //TODO Fehlermeldung Formular // Nichts Downlaoden.
        echo " DOWNLOAD FILE NOT FOUND";
        var_dump($target_file);
    }
}

function getFileName($ID){
    $files = glob("anhaenge/$ID*",GLOB_NOCHECK);
    //var_dump($files);
    return $files;
}

function start_download($ID)
{
    file_Download_Button($ID);
}
?>
