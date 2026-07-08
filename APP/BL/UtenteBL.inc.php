<?php

class UtenteBL 
{

    // METODI UTENTE
    // Metodo per la registrazione di un utente
    static public function Registrazione($username, $email, $password, $nome, $cognome)
    {
        $conn = connectDB();

        if ($conn == false) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        // Esegui l'inserimento nel database
        $sql = "INSERT INTO utenti (username, nome, cognome, email, pwd, codverificaemail) VALUES ('$username', '$nome', '$cognome', '$email', '$password', null)";

        if ($conn->query($sql) === TRUE) {
            $id = $conn->insert_id;
            // Chiudi la connessione al database
            $conn->close();

            return $id; // Ritorna l'ID dell'utente appena registrato
        } 
        else 
        {
            // Gestione degli errori
            $error = "Errore durante la registrazione: " . $conn->error;

            // Chiudi la connessione al database
            $conn->close();

            return $error; // Ritorna l'errore
        }
    }
    //Metodo per l'accesso dell'utente
    static public function Login($email, $password)
    {
        $conn = connectDB(); // Connessione al database

        // Verifica se la connessione al database è stata stabilita correttamente
        if ($conn->connect_error) {
            die("Connessione al database fallita: " . $conn->connect_error);
        }

        // Query per cercare l'utente nel database 
        $query = "SELECT * FROM utenti WHERE email='$email' AND pwd='$password'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            // Utente trovato, avvia la sessione
            session_start();
            $_SESSION['email'] = $email;
            //Prendo l'id associato a quell'email
            $sql = "SELECT id FROM utenti WHERE email = '$email'";
            $result2 = $conn->query($sql);
            if($result2->num_rows == 1)
            {
                $risultati = array();
                while ($row = mysqli_fetch_assoc($result2)) {
                    $risultati[] = $row;
                }
                foreach($risultati as $risultato)
                {
                    $id = $risultato['id'];
                }
                $_SESSION['idMittente'] = $id;
            }
            // Chiudi la connessione al database
            $conn->close();
            return true; // Ritorna true se l'accesso è avvenuto con successo
        } else 
        {
            // Utente non trovato o credenziali non valide
            // Chiudi la connessione al database
            $conn->close();
            return false; // Ritorna false se l'accesso non è avvenuto con successo
        }
    }

    // Metodo per inviare il codice di verifica per il recupero della password
    static public function InviaCodiceDiVerifica($email) 
    {
        $conn=connectDB();

        if ($conn->connect_error) {
            die("Connessione al database fallita: " . $conn->connect_error);
        }

        // Verifica se l'email esiste nel database
        $query = "SELECT * FROM utenti WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Funzione per generare un codice alfanumerico casuale
            function generateRandomCode($length = 6) 
            {
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $code = '';
                for ($i = 0; $i < $length; $i++) {
                    $code .= $characters[rand(0, strlen($characters) - 1)];
                }
                return $code;
            }
            // Genera un codice alfanumerico casuale
            $code = generateRandomCode();

            // Aggiorna il codice di verifica nel database
            $updateQuery = "UPDATE utenti SET codverificaemail = '$code' WHERE email = '$email'";
            $updateResult = $conn->query($updateQuery);

            // Invia l'email con il codice di verifica
            if ($updateResult) {
                $subject = 'Recupero Password';
                $message = "Ciao,\n\nHai richiesto il recupero della password. Utilizza il seguente link per ripristinarla:\n\n";
                $message .= "http://example.com/reset_password.php?email=$email&code=$code\n\nGrazie!\n";
                $message .= "Codice di Verifica: $code";
                $headers = "From: your@example.com\r\n";
                $headers .= "Reply-To: your@example.com\r\n";
                $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

                if (mail($email, $subject, $message, $headers)) {
                    return true; // Email inviata con successo
                } else {
                    return false; // Errore nell'invio dell'email
                }
            } else {
                return false; // Errore nell'aggiornamento del codice di verifica nel database
            }
        } else {
            return false; // L'indirizzo email non esiste nel database
        }

        $conn->close();
    }
    //Metodo per controllare il codice di verifica dell'email
    static public function validaCod($email, $code)
    {
        $conn = connectDB();

        if ($conn->connect_error) {
            die("Connessione al database fallita: " . $conn->connect_error);
        }

        // Verifica se il codice è corretto
        $sql = "SELECT * FROM utenti WHERE email = '$email' AND codverificaemail = '$code'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
            return true;
        } 
        else 
        {
            // Codice di verifica errato
            return false;
        }

        $conn->close();
    }
    // Metodo per cambiare la password
    static public function CambiaPassword($email, $nuovaPassword, $confermaNuovaPassword)
    {
        $conn=connectDB();

        if ($conn == false) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        //controlli
        if (empty($nuovaPassword) || empty($confermaNuovaPassword)) 
        {
            return "Errore: Una delle password è vuota";
        } 
        elseif (strlen($nuovaPassword) < 8 || strlen($confermaNuovaPassword) < 8) 
        {
            return "Errore: Una delle password è più corta di 8 caratteri.";
        } 
        else 
        {
            // Controllo se le password coincidono
            if ($nuovaPassword !== $confermaNuovaPassword) 
            {
                return "Le password non coincidono";
            } 
            else 
            {
                // Password valide, effettuo l'aggiornamento nel database
                $sql = "UPDATE utenti SET pwd = '$nuovaPassword' WHERE email = '$email'";
                $result = $conn->query($sql);
                if ($result) 
                {
                    // Password aggiornata con successo
                    return "Password cambiata con successo";
                } 
                else 
                {
                    // Errore nell'aggiornamento
                    return "Errore nell'aggiornamento della password";
                }
            }
        }

        $conn->close();
    }
    static public function getUtenti()
    {
        $conn = connectDB();

        $sql = "SELECT * FROM utenti";
        $result = $conn->query($sql);

        $utenti = array(); // Creazione del vettore per gli utenti

        if($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc()) {
                $utenti[] = $row; // Aggiunge la riga corrente al vettore $utenti
            }
            
        }
        return $utenti;
    }

}
?>