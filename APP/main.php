<?php
// Includi il file che contiene la definizione della classe UtenteBL
include('BL/UtenteBL.inc.php');
include_once('BL/connessione_db.php');

// Verifica se i dati del modulo di registrazione sono stati inviati
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati inviati dal modulo
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];

    // Chiamata al metodo Registrazione della classe UtenteBL per gestire la registrazione dell'utente
    $risultato_registrazione = UtenteBL::Registrazione($username, $email, $password, $nome, $cognome);

    // Verifica il risultato della registrazione
    if (is_numeric($risultato_registrazione)) {
        // Registrazione avvenuta con successo
        echo "Registrazione avvenuta con successo! Il tuo ID è: " . $risultato_registrazione;
        Header("Location: login.php");
    } else {
        // Si è verificato un errore durante la registrazione
        echo "Errore durante la registrazione: " . $risultato_registrazione;
    }
}
?>