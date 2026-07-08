<?php
/**
 * SCRIPT DI MIGRAZIONE UNA TANTUM
 * -------------------------------
 * Converte le password già salvate in chiaro nella tabella "utenti" in hash
 * sicuri (password_hash / bcrypt), senza modificare le password già hashate.
 *
 * COME USARLO:
 * 1. Esegui questo file UNA SOLA VOLTA (da browser o da riga di comando:
 *    "php migrate_hash_passwords.php") dopo aver aggiornato il codice
 *    dell'applicazione per usare password_hash()/password_verify().
 * 2. Dopo l'esecuzione, ELIMINA questo file: contiene una lettura completa
 *    della tabella utenti e non deve restare accessibile pubblicamente.
 *
 * Lo script riconosce se una password è già un hash bcrypt (inizia con "$2y$")
 * e in quel caso la salta, quindi è sicuro anche se lo lanci più volte.
 */

require_once __DIR__ . '/APP/BL/connessione_db.php';

$conn = connectDB();

$result = $conn->query("SELECT id, email, pwd FROM utenti");

if (!$result) {
    die("Errore nel leggere gli utenti: " . $conn->error);
}

$aggiornati = 0;
$saltati = 0;

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $pwd = $row['pwd'];

    // Se è già un hash bcrypt (formato $2y$...), non toccarlo
    if (strpos($pwd, '$2y$') === 0) {
        $saltati++;
        continue;
    }

    $hash = password_hash($pwd, PASSWORD_DEFAULT);
    $idSafe = (int) $id;
    $update = $conn->query("UPDATE utenti SET pwd = '$hash' WHERE id = $idSafe");

    if ($update) {
        $aggiornati++;
        echo "Utente id={$id} ({$row['email']}): password convertita in hash.\n";
    } else {
        echo "Utente id={$id} ({$row['email']}): ERRORE nell'aggiornamento - " . $conn->error . "\n";
    }
}

echo "\nCompletato. Password aggiornate: {$aggiornati}. Già hashate (saltate): {$saltati}.\n";
echo "Ricordati di ELIMINARE questo file adesso.\n";

$conn->close();
?>
