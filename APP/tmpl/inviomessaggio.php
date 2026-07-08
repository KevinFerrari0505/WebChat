<?php
include('../BL/MessaggioBL.inc.php');
include_once('../BL/connessione_db.php');
session_start();
// Verifica se i dati del modulo di registrazione sono stati inviati
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati inviati dal modulo
    $testomessaggio = $_POST['testoMessaggio'];
    if(!empty($testomessaggio))
    {     
        $datamessaggio = date("Y-m-d");
        $orariomessaggio = date("H:i:s");
        $idutenteinviato = $_SESSION['idMittente'];
        $idutentericevuto = $_SESSION['idDestinatario'];

        $messaggio_inviato = MessaggioBL::InviaMessaggio($testomessaggio, $datamessaggio, $orariomessaggio, $idutenteinviato, $idutentericevuto);
        // Verifica il risultato della registrazione
        if (is_numeric($messaggio_inviato)) {

            echo "Messaggio inviato";
            Header("Location: ../webchat/index.php?idmittente=$idutenteinviato&idDestinatario=$idutentericevuto");
        } 
        else 
        {

            echo "Errore durante l'invio";
        }
    }
}


?>