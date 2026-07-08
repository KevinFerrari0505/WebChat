<?php
session_start();
include('BL/UtenteBL.inc.php');
include_once('BL/connessione_db.php');
$messaggio = "";
$email = $_SESSION["email"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $nuovaPassword = $_POST['nuovaPassword'];
    $confermaPassword = $_POST['confermaNuovaPassword'];

    // Chiamata al metodo CambiaPassword() per cambiare la password
    $messaggio = UtenteBL::CambiaPassword($email, $nuovaPassword, $confermaPassword);

    // Verifica se il messaggio indica che il cambiamento della password è andato a buon fine
    if ($messaggio === "Password cambiata con successo") {
        // Reindirizza l'utente alla pagina di login
        Header("Location: login.php");
        exit(); // Assicura che lo script termini dopo il reindirizzamento
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupero Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 50px;
        }

        h2 {
            color: #4CAF50;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin: 10px 0;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div id="passwordForm">
    <form id="updatePasswordForm" method="post" action="updatepwd.php">
        <label for="nuovaPassword">Nuova Password:</label>
        <input type="password" id="nuovaPassword" name="nuovaPassword" placeholder="Inserisci la nuova password" required>
        <div id="NuovapasswordError" style="color: red;"></div>

        <label for="confermaNuovaPassword">Conferma Nuova Password:</label>
        <input type="password" id="confermaNuovaPassword" name="confermaNuovaPassword" placeholder="Conferma la nuova password" required>
        <div id="ConfermapasswordError" style="color: red;"></div>

        <input type="submit" value="Cambia Password"></button>
        <?php echo $messaggio; ?>
    </form>
</div>
</body>