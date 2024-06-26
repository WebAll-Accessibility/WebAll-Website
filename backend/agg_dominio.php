<?php
session_start();

if (session_status() != PHP_SESSION_ACTIVE || !$_SESSION["email"]) {
    header("location: ../accedi.php");
    exit();
}

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

$sql = "SELECT password_hash, c_type, id_customer FROM Customers WHERE email = ?";
$stm = $conn->prepare($sql);
$stm->bind_param("s", $_SESSION["email"]);
$stm->execute();

$customer = $stm->get_result()->fetch_assoc();

if ($customer["password_hash"] !== hash("sha256", $_SESSION["password"])) {
    header("location: ../index.php");
    exit();
}

$sql = "SELECT * FROM Subscriptions WHERE id_subscription = ?";
$stm = $conn->prepare($sql);
$stm->bind_param("i", $_GET["id"]);
$stm->execute();

$r = $stm->get_result();
if (!$r) {
    header("location: ../index.php");
    exit();
}

$r = $r->fetch_assoc();
if ($r["id_customer"] != $customer["id_customer"]) {
    header("location: ../index.php");
    exit();
}

try {
    $sql = "UPDATE Subscriptions SET id_plan = ? WHERE id_subscription = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("ii", $_POST["plan"], $_GET["id"]);

    $r = $stm->execute();

    if (!$r) {
        header("location: ../area_personale/reg_dominio.php?error=true");
    }

    $sql = "UPDATE Subscriptions SET price_ceiling = ? WHERE id_subscription = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("ii", $_POST["price_ceiling"], $_GET["id"]);

    $r = $stm->execute();

    if (!$r) {
        header("location: ../area_personale/reg_dominio.php?error=true");
    }
} catch (Exception $e) {
    header("location: ../area_personale/reg_dominio.php?error=true");
    exit();
}

header("location: ../area_personale/lista_dominii.php?success=true");
