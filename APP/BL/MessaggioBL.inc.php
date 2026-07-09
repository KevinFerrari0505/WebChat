<?php 

    class MessaggioBL
    {
        static public function InviaMessaggio($testoMessaggio,$datainvio,$orarioinvio, $idUtenteInviato, $idUtenteRicevuto)
        {
            $conn = connectDB();

            $stmt = $conn->prepare("INSERT INTO messaggi (datainvio, orarioinvio, orarioricevuto, orariovisualizzato, testo, idutenteinviato, idutentericevuto)
                    VALUES (?, ?, null, null, ?, ?, ?)");
            $stmt->bind_param("sssii", $datainvio, $orarioinvio, $testoMessaggio, $idUtenteInviato, $idUtenteRicevuto);
            $result = $stmt->execute();

            if ($result) {
                // Messaggio inviato con successo
                $id = $conn->insert_id;
                $stmt->close();
                return $id;
            } 
            else 
            {
                // Gestione degli errori
                $error = "Errore durante l'invio: " . $stmt->error;
                $stmt->close();

                // Chiudi la connessione al database
                $conn->close();

                return $error; // Ritorna l'errore
            }
        }

        static public function RiceveMessaggio($idUtenteRicevuto)
        {
            $conn = connectDB();

            $stmt = $conn->prepare("SELECT * FROM messaggi WHERE idutentericevuto = ? ORDER BY datainvio, orarioinvio");
            $stmt->bind_param("i", $idUtenteRicevuto);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Output dei messaggi
                while($row = $result->fetch_assoc()) {
                    echo "<div><strong>{$row['datainvio']} {$row['orarioinvio']}</strong> - {$row['testo']}</div>";
                }
            } else {
                // Nessun messaggio ricevuto
                echo "<div>Nessun messaggio ricevuto.</div>";
            }
            $stmt->close();
        }

        static public function VisualizzaMessaggio()
        {
            
        }

        static public function getMessaggi($idMittente, $idDestinatario)
        {
            $conn = connectDB();

            $stmt = $conn->prepare("SELECT * FROM messaggi WHERE (idutenteinviato = ? AND idutentericevuto = ?) OR (idutenteinviato = ? AND idutentericevuto = ?)");
            $stmt->bind_param("iiii", $idMittente, $idDestinatario, $idDestinatario, $idMittente);
            $stmt->execute();
            $result = $stmt->get_result();

            $messaggi = array(); // Creazione del vettore per i messaggi

            if($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc()) {
                    $messaggi[] = $row; // Aggiunge la riga corrente al vettore $messaggi
                }
            }
            $stmt->close();
            return $messaggi;
        }
    }
    

?>