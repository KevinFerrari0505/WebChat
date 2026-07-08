<?php
session_start();
// Includi il file che contiene la definizione della classe UtenteBL
include('BL/UtenteBL.inc.php');
include_once('BL/connessione_db.php');
$message = "";
$password = "";
$email = "";
$trovato = false;

if(isset($_COOKIE["utente"]))
{
   $trovato = true;
   $email = $_COOKIE["email"];
}
else
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Recupera i dati dal modulo
        $password = $_POST["password"];
        $email = $_POST["email"];

        // Chiamata al metodo Login della classe UtenteBL per gestire l'accesso dell'utente
        $accesso_risultato = UtenteBL::Login($email, $password);

        if($accesso_risultato)
        {
            $trovato = true;
            $current_time = time();
            $expiration_time = $current_time + 10;
            setcookie("email", $email, $expiration_time);
        }
        else
        {
            $trovato = false;
        }
        
    }
}
if (!$trovato) 
{
    $message = "Accesso Negato, Riprova";
}
else
{
    
    $message = "Bentornato";
    header("Location: WEBCHAT/index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Login</title>
  <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .login{
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .login label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }

        .login input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .login button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class = "login">
    <?php  
        if($message === "")
        {
            echo $message;
        }else
        {
            echo $message;
        }   
    ?>
    <h2>ACCEDI</h2>
    <form id="loginForm" method="POST" action="login.php">
        <!-- Aggiungo i campi del form per la login -->
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" placeholder="Inserisci l'email" >
        <div id="emailError" style="color: red;"></div>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Inserisci la password">
        <div id="passwordError" style="color: red;"></div>
        <button type="submit">Accedi</button>
    </form>
    <p>Non hai un account? <a href="registrazione.php">Registrati</a></p>
    <p><a href="recovery.php">Password dimenticata?</a></p>
</div>
<script>
    document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Impedisce la sottomissione automatica del modulo

    // Chiamare la funzione di validazione
    if (validateRegistration()) 
    {
        // Ora puoi inviare il modulo tramite JavaScript solo se la validazione ha successo
        document.getElementById('loginForm').submit();
    }
});

function validateRegistration() 
{
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    //usato per controllo
    var atIndex = email.indexOf('@');
      
    //Controllo sull'email
    if (isEmpty(email)) 
    {
        document.getElementById('emailError').innerText = 'Inserisci un indirizzo email';
        return;
    } 
    //Controllo se l'email contiene la chiocciola ma non all'inizio
    else if (email.indexOf('@') <= 0) 
    {
        document.getElementById('emailError').innerText = 'Inserisci un indirizzo email valido';
        return;
    }
    //Controllo se dopo la @ c'è un punto
    else if (email.indexOf('.', atIndex) - atIndex <= 1) 
    {
        document.getElementById('emailError').innerText = 'Inserisci un indirizzo email valido';
        return;
    }
    // Controlla se il punto non è alla fine dell'email
    else if (email.endsWith('.')) 
    {
        document.getElementById('emailError').innerText = 'Inserisci un indirizzo email valido';
        return;
    }
    else
    {
        document.getElementById('emailError').innerText = '';
    }

    // Controlli lato client per la password
    if (isEmpty(password)) 
    {
        document.getElementById('passwordError').innerText = 'Password vuota';
        return;
    } 
    else if(password.length < 8)
    {
        document.getElementById('passwordError').innerText = 'Password troppo corta (minimo 8 caratteri).';
        return;
    }
    else
    {
        document.getElementById('passwordError').innerText = '';
    }
    // Restituisci true solo se la validazione ha successo
    return true;
}
function isEmpty(value) 
{
    return value === null || value === undefined || value.trim() === '';
}
</script>
</body>
</html>