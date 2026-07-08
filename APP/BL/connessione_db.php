<?php
    require_once __DIR__ . '/config.php';
    $conn = null;

// Funzione per la connessione al database
function connectDB()
{
    global $conn;
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }

    return $conn;
}
?>