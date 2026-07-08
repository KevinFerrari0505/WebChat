<?php 

    class MessaggioBL
    {
        static public function InviaMessaggio($testoMessaggio,$datainvio,$orarioinvio, $idUtenteInviato, $idUtenteRicevuto)
        {
            $conn = connectDB();

            $sql = "INSERT INTO messaggi (datainvio, orarioinvio, orarioricevuto, orariovisualizzato, testo, idutenteinviato, idutentericevuto)
                    VALUES ('$datainvio', '$orarioinvio', null, null, '$testoMessaggio', '$idUtenteInviato', '$idUtenteRicevuto')";
            $result = $conn->query($sql);

            if ($result) {
                // Messaggio inviato con successo
                $id = $conn->insert_id;
                return $id;
            } 
            else 
            {
                // Gestione degli errori
                $error = "Errore durante l'invio: " . $conn->error;

                // Chiudi la connessione al database
                $conn->close();

                return $error; // Ritorna l'errore
            }
        }

        static public function RiceveMessaggio($idUtenteRicevuto)
        {
            $conn = connectDB();

            $sql = "SELECT * FROM messaggi WHERE idutentericevuto = '$idUtenteRicevuto' ORDER BY datainvio, orarioinvio";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output dei messaggi
                while($row = $result->fetch_assoc()) {
                    echo "<div><strong>{$row['datainvio']} {$row['orarioinvio']}</strong> - {$row['testo']}</div>";
                }
            } else {
                // Nessun messaggio ricevuto
                echo "<div>Nessun messaggio ricevuto.</div>";
            }
        }

        static public function VisualizzaMessaggio()
        {
            
        }

        static public function getMessaggi($idMittente, $idDestinatario)
        {
            $conn = connectDB();

            $sql = "SELECT * FROM messaggi WHERE (idutenteinviato = $idMittente AND idutentericevuto = $idDestinatario) OR (idutenteinviato = $idDestinatario AND idutentericevuto = $idMittente)";
            $result = $conn->query($sql);

            $messaggi = array(); // Creazione del vettore per i messaggi

            if($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc()) {
                    $messaggi[] = $row; // Aggiunge la riga corrente al vettore $messaggi
                }
            }
            return $messaggi;
        }
    }
    

?>