<?php
/**
 * Created by PhpStorm.
 * User: philip.rippstein
 * Date: 10.12.2018
 * Time: 12:06
 */

/*********************************************************
 * ACHTUNG LIEBER TESTER *
 *********************************************************
 *Email versand kann nicht auf Localhost getestet werden
 ********************************************************
 * @param $Item1
 * @param $ID
 */
class Email
{

   public $art;

   public function saveArt($value)
    {
        $this->art = $value;
    }

    public function getArt()
    {
       return $this->art;
    }

    function sendEmailSachbearbeiter($ID,$fileUploadOK,$artForm)
    {
        $email = "Kundendaten@esa.ch";
        $absender = "Kundenmutierung@esa.ch";
        $betreff = "Kunden Mutation Formular";
        $antwortan = "Kundendaten@esa.ch";
        $header = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=utf-8\r\n";
        $header .= "From: $absender\r\n";
        $header .= "Reply-To: $antwortan\r\n";

        $FileText = "Ohne";
        if ($fileUploadOK){
            $FileText = "Mit einem";
        }
        //$artForm = $_COOKIE['FormularArt'];
        // $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
        session_start();
        //$artForm = $_SESSION["FormularArt"];

        $mailtext1 = "<h1>hallo Sachbearbeiter </h1>
    <p>Ein neuer <strong> $artForm - Kunde </strong>wurde erfasst<br>$FileText File</p>
    <a> http://intranet.esa.ch/netprog/kdmut/index.php?art=$artForm&kdmut=$ID</a><br>
	<a> http://intranet.esa.ch/netprog/kdmut/help/</a>";
    //<a> http://testintranet.esa.ch/kdmut/index.php?art=$this->art&kdmut=$ID</a>";
        $header .= "X-Mailer: PHP " . phpversion();
        //mail senden
        mail($email, $betreff, $mailtext1, $header);
    }
	
	function sendEmailPhilip($ID,$fileUploadOK)
    {
        $email = "philip.rippstein@esa.ch";
        $absender = "Kundenmutierung@esa.ch";
        $betreff = "Kunden Mutation Formular";
        $antwortan = "philip.rippstein@esa.ch";
        $header = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=utf-8\r\n";
        $header .= "From: $absender\r\n";
        $header .= "Reply-To: $antwortan\r\n";

        $FileText = "Ohne";
        if ($fileUploadOK){
            $FileText = "Mit einem";
        }
        //$artForm = $_COOKIE['FormularArt'];
        // $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
        session_start();
        $artForm = $_SESSION["FormularArt"];

        $mailtext1 = "<h1>hallo Philip </h1>
    <p>Ein neuer <strong> $artForm - Kunde </strong>wurde erfasst<br>$FileText File</p>
    <a> http://intranet.esa.ch/netprog/kdmut/index.php?art=$artForm&kdmut=$ID</a><br>
	<a> http://intranet.esa.ch/netprog/kdmut/help/</a>";
    //<a> http://testintranet.esa.ch/kdmut/index.php?art=$this->art&kdmut=$ID</a>";
        $header .= "X-Mailer: PHP " . phpversion();
        //mail senden
        mail($email, $betreff, $mailtext1, $header);
    }

    function sendEmailAuftraggeber($ID,$fileUploadOK,$AuftraggeberEmail)
    {
        $email = $AuftraggeberEmail;
        $absender = "Kundenmutierung@esa.ch";
        $betreff = "Kunden Mutation Formular";
        $antwortan = $AuftraggeberEmail;
        $header = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=utf-8\r\n";
        $header .= "From: $absender\r\n";
        $header .= "Reply-To: $antwortan\r\n";

        $FileText = "Ohne";
        if ($fileUploadOK){
            $FileText = "Mit einem";
        }
        //$artForm = $_COOKIE['FormularArt'];
        // $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
        session_start();
        $artForm = $_SESSION["FormularArt"];

        $mailtext1 = "<h1>hallo Auftraggeber </h1>
    <p>Sie haben ein neuer <strong> $artForm - Kunde </strong> erfasst<br>$FileText File</p>
    <a> http://intranet.esa.ch/netprog/kdmut/index.php?art=$artForm&kdmut=$ID</a>";
        //<a> http://testintranet.esa.ch/kdmut/index.php?art=$this->art&kdmut=$ID</a>";
        $header .= "X-Mailer: PHP " . phpversion();
        //mail senden
        mail($email, $betreff, $mailtext1, $header);
    }


}
