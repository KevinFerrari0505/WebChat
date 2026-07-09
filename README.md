# NEXTALK – WebChat

Applicazione web di messaggistica istantanea (chat) sviluppata in **PHP** con architettura a livelli (Data Model / Business Logic / Presentazione), **MySQL** come database e **JavaScript/jQuery** per gli aggiornamenti lato client.

## 📋 Descrizione

WebChat (nome in-app "NEXTALK") permette a più utenti registrati di:
- creare un account e autenticarsi;
- recuperare la password tramite un codice di verifica inviato via email;
- visualizzare l'elenco degli utenti registrati;
- scambiare messaggi di testo in tempo (quasi) reale con un altro utente, tramite polling AJAX.

## 🏗️ Architettura

Il progetto segue una separazione a tre livelli:

| Livello | Cartella | Responsabilità |
|---|---|---|
| **DMO** (Data Model Object) | `APP/DMO/` | Classi che rappresentano le entità del dominio (`Utente`, `Messaggio`, `File`) con relativi getter/setter |
| **BL** (Business Logic) | `APP/BL/` | Logica applicativa e accesso al database (`UtenteBL`, `MessaggioBL`, `FileBL`, connessione al DB) |
| **Presentazione** | `APP/*.php`, `APP/webchat/`, `APP/tmpl/` | Pagine PHP e template inclusi che compongono l'interfaccia utente |

Risorse statiche in `APP/css/`, `APP/js/`, `APP/img/`.

## 📁 Struttura del progetto

```
WebChat/
├── APP/
│   ├── BL/                        # Business Logic
│   │   ├── UtenteBL.inc.php        # Registrazione, login, recupero password
│   │   ├── MessaggioBL.inc.php     # Invio e recupero messaggi
│   │   ├── FileBL.inc.php          # Gestione allegati (da implementare)
│   │   ├── connessione_db.php      # Connessione MySQL (mysqli)
│   │   ├── config.example.php      # Modello di configurazione DB (da copiare in config.php)
│   │   └── config.php              # Configurazione DB reale (locale, escluso da git)
│   ├── DMO/                        # Data Model Objects
│   │   ├── Utente.inc.php
│   │   ├── Messaggio.inc.php
│   │   └── File.inc.php
│   ├── webchat/
│   │   └── index.php               # Pagina principale della chat
│   ├── tmpl/                       # Template/include riutilizzabili
│   │   ├── header.inc.php
│   │   ├── footer.inc.php
│   │   ├── chat.inc.php            # Finestra di chat + polling AJAX
│   │   ├── elencoutenti.inc.php    # Elenco utenti/contatti
│   │   ├── elencomsgchat.inc.php   # Rendering dei messaggi
│   │   └── inviomessaggio.php      # Endpoint di invio messaggio
│   ├── css/
│   │   └── stile.css
│   ├── js/
│   │   └── chat.js
│   ├── img/
│   │   └── messaggio.png
│   ├── login.php
│   ├── main.php                    # Endpoint di registrazione
│   ├── registrazione.php           # Form di registrazione
│   ├── recovery.php                # Recupero password (invio codice)
│   ├── updatepwd.php                # Aggiornamento password
│   └── validationcode.php          # Verifica codice di recupero
├── sql/
│   └── dbregistrazioni-db_*.sql    # Dump/schema del database MySQL
├── docs/
│   ├── WebChat.dia                 # Diagramma del progetto (Dia)
│   └── WEB CHAT Ferrari.docx       # Relazione/documentazione del progetto
└── README.md
```

## 🗄️ Database

Il database `dbregistrazioni` è composto principalmente dalle tabelle:
- **utenti** — id, username, nome, cognome, email, pwd, codverificaemail
- **messaggi** — id, datainvio, orarioinvio, orarioricevuto, orariovisualizzato, testo, idutenteinviato, idutentericevuto

Lo schema/dump è disponibile nei file `.sql` nella cartella `sql/`.

## ⚙️ Requisiti

- PHP 7.4+ (estensione `mysqli`)
- MySQL / MariaDB
- Server web (Apache/XAMPP/WAMP o server integrato PHP)

## 🚀 Avvio del progetto

1. Importa uno dei file `sql/dbregistrazioni-db_*.sql` nel tuo server MySQL.
2. Copia `APP/BL/config.example.php` in `APP/BL/config.php` e inserisci le tue credenziali del database.
3. Avvia un server PHP puntando alla cartella `APP/`:
   ```bash
   php -S localhost:8000 -t APP
   ```
4. Apri `http://localhost:8000/registrazione.php` per creare un account, poi accedi da `login.php`.

## 🔒 Sicurezza

- Le password sono salvate tramite hashing (`password_hash()` / `password_verify()`), mai in chiaro.
- Le query al database usano prepared statement (`bind_param`) per prevenire SQL injection.
- Le credenziali del database non sono nel codice versionato: vengono lette da `APP/BL/config.php`, escluso da git (vedi `APP/BL/config.example.php` come modello).

## 🚧 Sviluppi futuri

- Invio e gestione di file/allegati nei messaggi (la struttura è già predisposta: DMO `File.inc.php` e classe `FileBL.inc.php`, ancora da implementare).

## ✍️ Autore

Kevin Ferrari
