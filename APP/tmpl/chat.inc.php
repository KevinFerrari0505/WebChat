<style>
    .message 
    {
        background-color: green;
        border-radius: 10px;
        margin-bottom: 10px;
        padding: 5px 10px;
        max-width: 70%;
    }  
    #messaggio-inviato 
    {
        align-self: flex-end;
        flex: 1;
    }
    #msg-container {
        max-height: 600px; /* Imposta l'altezza massima desiderata per la finestra dei messaggi */
        overflow-y: auto; /* Aggiunge la barra di scorrimento verticale quando necessario */
    }

    /* Aggiungi stile per la barra di scorrimento se necessario */
    #msg-container::-webkit-scrollbar {
        width: 8px;
    }

    #msg-container::-webkit-scrollbar-thumb {
        background-color: #888;
    }
    .messageMittente {
        background-color: #DCF8C6; /* Colore di sfondo per i messaggi inviati */
        margin-bottom: 10px;
        clear: both;
        overflow: hidden;
    }

    .messageMittente .message-content {
        padding: 10px;
        border-radius: 10px;
        max-width: 70%;
        float: right; /* Allinea il contenuto a destra */
    }

    .messageDestinatario {
        background-color: #EEE; /* Colore di sfondo per i messaggi ricevuti */
        margin-bottom: 10px;
        clear: both;
        overflow: hidden;
    }

    .messageDestinatario .message-content {
        padding: 10px;
        border-radius: 10px;
        max-width: 70%;
        float: left; /* Allinea il contenuto a sinistra */
    }

    .message-metadata {
        font-size: 12px;
        color: #666;
    }
    
    
</style>
<script>
    function aggiornaChat() 
    {
        var xhr = new XMLHttpRequest();
        var url = "../tmpl/elencomsgchat.inc.php";
        <?php 
            $parametri = "?idmittente=" . $_SESSION['idMittente'] . "&idDestinatario=" . $_SESSION['idDestinatario']; 
        ?>
        var parametri = "<?php echo $parametri;?>";
        xhr.open('GET', url + parametri);
        // questa funzione verrà chiamata al cambio di stato della chiamata AJAX
        xhr.onreadystatechange = function () {
        var DONE = 4; 
        var OK = 200; 
        
        if (xhr.readyState === DONE) 
        {    
            if (xhr.status === OK) {
                document.getElementById("msg-container").innerHTML = xhr.responseText; // Questo è il corpo della risposta HTTP
            } 
            else 
            {
                console.log('Error: ' + xhr.status); // Lo stato della HTTP response.
            }
        }
        };
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send();

    }
    window.setInterval(aggiornaChat, 500);
</script>
<div id="chat-window" class="column">
    <div class="container mt-4" id="chat">
        <div class="row">
            <div class="col">
                <div id="msg-container" class="message-container">
                    <?php 
                        //include "elencomsgchat.inc.php";?>
                </div>
            </div>
            <form method="POST" action="../tmpl/inviomessaggio.php" id="formInvio" name="formInvio">
                <div class="col" id="messaggio-inviato">
                    <input type="text" id="testoMessaggio" name="testoMessaggio" class="form-control" placeholder="Inserisci il messaggio" required>
                </div>
                <div class="col-auto">
                    <button type="submit" id="invia-messaggio" class="btn btn-primary">Invia</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function Invio() 
    {
        var testoMessaggio = document.formInvio.testoMessaggio.value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                var risposta = xhttp.responseText;
                document.getElementById("message-container").innerHTML +=

                "<div class='messageMittente'>" +
                                    "<div class='message-content'>" +
                                    testoMessaggio + 
                                    "</div>"+
                                    "<div class='message-metadata'>"+
                                        "<span class='message-date'>data</span>"+
                                        "<span class='message-time'>ora</span>"+
                                    "</div>"+
                                "</div>";
            }
            // alert(this.readyState);
        };
        xhttp.open("POST", "../tmpl/inviomessaggio.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send("testoMessaggio=" + testoMessaggio);
    }

    window.setInterval(aggiornaChat, 500);
</script>
