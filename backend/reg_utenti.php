<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "weball";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Customers (c_type, email, password_hash, billing_address, registration_date, phone) VALUES ('I', ?, ?, ?, CURDATE(), ?)";
$stm = $conn->prepare($sql);

if (!isset($_POST["nome"])
      || !isset($_POST["cognome"])
      || !isset($_POST["num-tel"])
      || !isset($_POST["email"])
      || !isset($_POST["password"])
      || !isset($_POST["password-conf"])
      || !isset($_POST["indirizzo"])) {

    header("location: ../registrazione/utenti.php");
}

$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$numtel = $_POST["num-tel"];
$email = $_POST["email"];
$password = $_POST["password"];
$password_conf = $_POST["password-conf"];
$indirizzo = $_POST["indirizzo"];

if ($password != $password_conf) {
    header("location: ../registrazione/utenti.php?error=true");
    ob_end_clean();
    exit();
}

$p_hash = hash("sha256", $password);

$stm->bind_param("ssss", $email, $p_hash, $indirizzo, $numtel);
$s = $stm->execute();

if (!$s) {
    header("location: ../registrazione/utenti.php?error=true");
    ob_end_clean();
    exit();
}

$sql = "INSERT INTO Individuals (id_customer, first_name, last_name) VALUES (LAST_INSERT_ID(), ?, ?)";
$stm = $conn->prepare($sql);

$stm->bind_param("ss", $nome, $cognome);
$s = $stm->execute();

if (!$s) {
    header("location: ../registrazione/utenti.php?error=true");
    ob_end_clean();
    exit();
}

session_start();
$_SESSION["email"] = $mail;
$_SESSION["password"] = $password;

header("location: ../area_personale/area_personale.php");
ob_end_clean();