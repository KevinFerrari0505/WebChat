<style>
    .container1 
    {
        background-color: #f0f0f0; /* Cambia il colore dello sfondo */
        padding: 10px; /* Aggiunge spazio intorno al contenuto */
        margin-bottom: 5px; /* Aggiunge spazio sotto ogni riga */
        cursor: pointer; /* Cambia il cursore quando passi sopra */
    }

    .container1:hover 
    {
        background-color: #e0e0e0; /* Cambia il colore dello sfondo al passaggio del mouse */
    }

    .container1 h2 
    {
        margin: 0; /* Rimuove il margine attorno all'elemento h2 */
        font-size: 18px; /* Cambia la dimensione del testo */
        color: #333; /* Cambia il colore del testo */
    }
    .container1 i {
        margin-right: 5px; /* Aggiunge spazio a destra dell'icona */
    } 
    #menu.column {
        overflow-y: auto; /* Aggiunge una scrollbar verticale se necessario */
        max-height: 700px; /* Imposta l'altezza massima del menu */
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div id="menu" class="column">
    <!-- Elenco delle chat -->
    <h1>ELENCO CHAT</h1>
    <?php require_once '../BL/connessione_db.php'; ?>
    <?php

        include('../BL/UtenteBL.inc.php');
        $listaDiUtenti = array();
        //Metodo per avere tutti i messaggi
        $listaDiUtenti = UtenteBL::getUtenti();

        if (isset($listaDiUtenti) && !empty($listaDiUtenti)) {
            // Aggiungi un campo di input per la ricerca
            echo '<input type="text" id="searchUser" placeholder="Cerca utente...">';
            echo '<button onclick="searchUsers()">Cerca</button>';

            // Mostra gli utenti uno sotto l'altro
            foreach ($listaDiUtenti as $row) {
                echo "<a href='index.php?idDestinatario={$row["id"]}'>";
                echo "<div class='container1 user' onclick= Mostrachat(" . $row["id"] . ")>";
                echo "<i class='fas fa-user'></i>"; // Aggiungi l'icona dell'omino
                echo $row["username"];
                echo "</div></a>";
            }
        } else {
            echo "Nessun utente presente nel database.";
        }
    ?>

</div>
<script src="../js/chat.js"></script>