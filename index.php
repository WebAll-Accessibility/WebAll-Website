<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WebAll</title>
    <link rel="stylesheet" href="style.css" />
    <script src="http://52.47.171.54:8080/service/init.js"></script>
  </head>
  <body>
    <nav class="navbar">
      <div class="container">
        <a href="#" class="logo"><img src="weball_logo.png" alt="Logo" /></a>
        <div class="nav-links">
          <a href="index.php" disabled>Home</a>
          <a href="documentazione.php">Documentazione</a>
          <a href="siamo.php">Chi siamo</a>
          <a href="accedi.php">Accedi</a>
        </div>
        <button class="join-button" onclick="openPage()">Utilizza anche tu WebAll</button>
      </div>
    </nav>
    <div>
      <div class="text-overlay">
        <h1>WEBALL</h1>
        <p>WebAll, il web per tutti</p>
      </div>
     <div class="gradient-box"></div>
      <div class="gradient-box2"></div>
      <div class="gradient-box3"></div>
      <div class="gradient-box4"></div>
      <img
        src="weball_pc.png"
        alt="Centrata"
        style="
          position: relative;
          top: 50%;
          left: 50%;
          padding-top: 5%;
          transform: translate(-50%, 0%);
        "
      />
    </div>
    <script> //funzione per aprire nuova pagina per la registrazione di un'utente
        function openPage() {
            window.location.href = 'registrazione.php';
        }
    </script>
  </body>
</html>
