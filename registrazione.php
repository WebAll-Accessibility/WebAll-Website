<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebAll</title>
    <link rel="stylesheet" href="style.css">
    <script src="http://52.47.171.54:8080/service/init.js"></script>
</head>
<body>
    <nav class="navbar">
        <div class="container">
        <a href="#" class="logo"><img src="weball_logo.png" alt="Logo" /></a>
        <div class="nav-links">
          <a href="index.php">Home</a>
          <a href="documentazione.php">Documentazione</a>
          <a href="siamo.php">Chi siamo</a>
          <a href="accedi.php">Accedi</a>
        </div>
        <button class="join-button">Utilizza anche tu WebAll</button>
      </div>
    </nav>
    
    <div class="registration-container">
        <h1 class="registration-title">Inizia ad utilizzare WebAll</h1>
        <p>Seleziona il pulsante qui sotto seguendo le istruzioni</p>
        <button class="join-button2" onclick="openPage()">Sono un'azienda</button>
        <button class="join-button2" onclick="openPage2()">Sono un utente web</button>
    </div>
    <script> //funzione per aprire nuova pagina per la registrazione di un'utente
        function openPage2() {
            window.location.href = 'registrazione/utenti.php';
        }
        function openPage() {
            window.location.href = 'registrazione/aziende.php';
        }
    </script>
</body>
</html>