<?php
session_start();
include('../BL/MessaggioBL.inc.php');
include_once('../BL/connessione_db.php');
if(isset($_GET['idDestinatario']))
{
    $_SESSION['idDestinatario'] = $_GET["idDestinatario"];
    $idMittente = $_SESSION['idMittente'];

    $listaDiMessaggi = array();
    //Metodo per avere tutti i messaggi
    $listaDiMessaggi = MessaggioBL::getMessaggi($idMittente, $_SESSION['idDestinatario']);

    if (isset($listaDiMessaggi) && !empty($listaDiMessaggi)) 
    {
        // Ottieni l'array dei messaggi dalla sessione
        $_SESSION['listaDiMessaggi'] = $listaDiMessaggi;
    
    } else 
    {
        // L'array dei messaggi è vuoto o non presente nella sessione
        unset($_SESSION['listaDiMessaggi']);

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXTALK(webchat online)</title>
    <link rel="stylesheet" href="../css/stile.css">
    <!-- Latest compiled and minified CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php include('../tmpl/header.inc.php'); ?>

    <!-- Dividere menu in utenti destinatari e chat -->
    <div id="main-content">
        <?php include('../tmpl/elencoutenti.inc.php'); ?>
        <?php include('../tmpl/chat.inc.php'); ?>
    </div>

    <?php include('../tmpl/footer.inc.php'); ?>

    <!-- Importazione JS -->
    <script src="../js/chat.js"></script>
</body>
</html>