<?php
    define('host', 'localhost');
    define('user', 'root');
    define('password', 'root');
    define('nomeDB', 'dbregistrazioni');
    $conn= null;

// Funzione per la connessione al database
function connectDB() 
{
    global $conn;
    $conn = new mysqli(host, user, password, nomeDB);


    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }

    return $conn;
}
?>