
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .registrazione{
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .registrazione label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }

        .registrazione input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .registrazione button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class = "registrazione">
    <h2>REGISTRAZIONE</h2>
    <form id="registrazioneForm" method="post" action="main.php">
        <!-- Aggiungo i campi del form per la registrazione -->
        <div>
            <label>COGNOME:</label><input type="text" name="cognome" id="cognome" placeholder="Inserisci il cognome">
            <div id="cognomeError" style="color: red;"></div>
        </div>
        <div>
            <label>NOME:</label><input type="text" name="nome" id="nome" placeholder="Inserisci il nome">
            <div id="nomeError" style="color: red;"></div>
        </div>
        <label for="username" >Username:</label>
        <input type="text" id="username" placeholder="Inserisci un username">
        <div id="usernameError" style="color: red;"></div>
    
        <label for="email">Email:</label>
        <input type="text" id="email" placeholder="Inserisci l'email" >
        <div id="emailError" style="color: red;"></div>

        <label for="password">Password:</label>
        <input type="password" id="password" placeholder="Inserisci la password">
        <div id="passwordError" style="color: red;"></div>
        <button type="button" onclick="validateRegistration()">Registra</button><br>
        <a href="login.php">Indietro</a>
    </form>
    
</div>
<script>
function validateRegistration() 
{
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var nome = document.getElementById('nome').value;
    var cognome = document.getElementById('cognome').value;
    var atIndex = email.indexOf('@');

    // Controlli lato client per il cognome
    if (isEmpty(cognome)) 
    {
        document.getElementById('cognomeError').innerText = 'Cognome vuoto';
        return;
    } 
    else 
    {
        document.getElementById('cognomeError').innerText = '';
    } 
    // Controlli lato client per il nome
    if (isEmpty(nome)) 
    {
        document.getElementById('nomeError').innerText = 'Nome vuoto';
        return;
    } 
    else 
    {
        document.getElementById('nomeError').innerText = '';
    }   
    // Controlli lato client per l'username
    if (isEmpty(username)) 
    {
        document.getElementById('usernameError').innerText = 'Username vuoto';
        return;
    } 
    else 
    {
        document.getElementById('usernameError').innerText = '';
    }  
    //Controllo sull'email
    if (isEmpty(email)) 
    {
        document.getElementById('emailError').innerText = 'Inserisci un indirizzo email';
        return;
    } 
    //Controllo se l'email contiene la chiocciola ma non all'inizio
    else if (email.indexOf('@') <= 0) 
    {
        document.getElementById('emailError').innerText = 'Inserisci un indirizzo email valido';
        return;
    }
    //Controllo se dopo la @ c'è un punto
    else if (email.indexOf('.', atIndex) - atIndex <= 1) 
    {
        document.getElementById('emailError').innerText = 'Inserisci un indirizzo email valido';
        return;
    }
    // Controlla se il punto non è alla fine dell'email
    else if (email.endsWith('.')) 
    {
        document.getElementById('emailError').innerText = 'Inserisci un indirizzo email valido';
        return;
    }
    else
    {
        document.getElementById('emailError').innerText = '';
    }

    // Controlli lato client per la password
    if (isEmpty(password)) 
    {
        document.getElementById('passwordError').innerText = 'Password vuota';
        return;
    } 
    else if(password.length < 8)
    {
        document.getElementById('passwordError').innerText = 'Password troppo corta (minimo 8 caratteri).';
        return;
    }
    else
    {
        document.getElementById('passwordError').innerText = '';
    }
    alert('Registrazione riuscita!');
    //setcookie("utente", $username, time() + 3600);
    // Creazione di un modulo nascosto e aggiunta dell'username
    var form = document.createElement("form");
    form.method = "post";
    form.action = "main.php";
    
    var inputUsername = document.createElement("input");
    inputUsername.type = "hidden";
    inputUsername.name = "username";
    inputUsername.value = username;
    form.appendChild(inputUsername);

    var inputPassword = document.createElement("input");
    inputPassword.type = "hidden";
    inputPassword.name = "password";
    inputPassword.value = password;
    form.appendChild(inputPassword);

    var inputEmail = document.createElement("input");
    inputEmail.type = "hidden";
    inputEmail.name = "email";
    inputEmail.value = email;
    form.appendChild(inputEmail);

    var inputNome = document.createElement("input");
    inputNome.type = "hidden";
    inputNome.name = "nome";
    inputNome.value = nome;
    form.appendChild(inputNome);

    var inputCognome = document.createElement("input");
    inputCognome.type = "hidden";
    inputCognome.name = "cognome";
    inputCognome.value = cognome;
    form.appendChild(inputCognome);
    document.body.appendChild(form);
        
    // Invio del modulo
    form.submit();
}
function isEmpty(value) 
{
    return value === null || value === undefined || value.trim() === '';
}
</script>
</body>
</html>

