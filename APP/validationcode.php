<?php
//Salvo l'email
session_start();
// Includi il file che contiene la definizione della classe UtenteBL
include('BL/UtenteBL.inc.php');
include_once('BL/connessione_db.php');
$email = "";
$code = "";
$codicehtml = "";
if(isset($_GET["email"]) && isset($_GET["code"]))
{
    $_SESSION["email"] = $_GET["email"];
    $email = $_GET["email"];
    $codicehtml = $_GET["code"];
}
else
{
    if(isset($_SESSION["email"]))
    {
        $email = $_SESSION["email"];
        if(isset($_POST["CodVerificaEmail"]))
        {
            $code = $_POST["CodVerificaEmail"];
        }
    }
}


if(!empty($email) && !empty($code))
{
    if(UtenteBL::validaCod($email, $code))
    {
        // Codice di verifica corretto, reindirizza l'utente alla pagina di cambio password
        header("Location: updatepwd.php");
        exit();
    }
    else
    {
        // Codice di verifica errato
        echo "Codice errato";
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
    <div id="verificationForm">
        <form id="codiceVerifica" method="post" action="validationcode.php">
            <label for="CodVerifica">Codice Verifica</label>
            <input type="text" id="CodVerificaEmail" name="CodVerificaEmail" placeholder="Inserisci il codice di verifica" value="<?php echo $codicehtml; ?>" required>
            <button type="submit" id="MostraForm">Verifica Codice</button>
        </form>
    </div>
</body>