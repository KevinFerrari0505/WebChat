<?php
include('BL/UtenteBL.inc.php');
include_once('BL/connessione_db.php');

// Verifica se è stato inviato un modulo con il metodo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera l'email dal modulo
    $email = $_POST['email'];

    // Chiama il metodo per inviare il codice di verifica
    $invioCodice = UtenteBL::InviaCodiceDiVerifica($email);

    // Verifica se l'invio del codice di verifica è stato effettuato con successo
    if ($invioCodice) {
        echo "Un'email con le istruzioni è stata inviata all'indirizzo $email";
    } else {
        echo "Si è verificato un errore durante l'invio dell'email di recupero password.";
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
    <h2>Recupero Password</h2>
    <form action="recovery.php" method="post">
        <label for="email">Indirizzo Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <input type="submit" value="Recupera Password">
    </form>
</body>
</html>