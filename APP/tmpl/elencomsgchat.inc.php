<?php
session_start();
include('../BL/MessaggioBL.inc.php');
include_once('../BL/connessione_db.php');
if(isset($_GET['idDestinatario']) || isset($_GET['idmittente']))
{
    $idDestinatario = $_GET["idDestinatario"];
    $idMittente = $_GET['idmittente'];

    $listaDiMessaggi = array();
    //Metodo per avere tutti i messaggi
    $listaDiMessaggi = MessaggioBL::getMessaggi($idMittente, $idDestinatario);
    if (!empty($listaDiMessaggi)) 
    {                  
        foreach ($listaDiMessaggi as $messaggio) : 
            if($messaggio['idutenteinviato'] == $_SESSION['idMittente']){ ?>
                <div class="messageMittente">
                    <div class="message-content">
                        <?php echo $messaggio['testo']; ?>
                    </div>
                    <div class="message-metadata">
                        <span class="message-date"><?php echo date('d/m/Y', strtotime($messaggio['datainvio'])); ?></span>
                        <span class="message-time"><?php echo date('H:i', strtotime($messaggio['orarioinvio'])); ?></span>
                    </div>
                </div>
            <?php } else { ?>
                <div class="messageDestinatario">
                    <div class="message-content">
                        <?php echo $messaggio['testo']; ?>
                    </div>
                    <div class="message-metadata">
                        <span class="message-date"><?php echo date('d/m/Y', strtotime($messaggio['datainvio'])); ?></span>
                        <span class="message-time"><?php echo date('H:i', strtotime($messaggio['orarioinvio'])); ?></span>
                    </div>
                </div>
            <?php } 
        endforeach;
    }
}
?>