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

if (!isset($_POST["old"])
    || !isset($_POST["new"])
    || !isset($_POST["conf"])) {
    header("location: ../area_personale/agg_password.php?error=true");
    exit();
}

$old = $_POST["old"];
$new = $_POST["new"];
$conf = $_POST["conf"];

if ($new != $conf) {
    header("location: ../area_personale/agg_password.php?error=true");
    exit();
}

if (hash("sha256", $old) != $customer["password_hash"]) {
    header("location: ../area_personale/agg_password.php?error=true");
    exit();
}

$p_hash = hash("sha256", $new);

try {
    $sql = "UPDATE Customers SET password_hash = ? WHERE id_customer = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("si", $p_hash, $customer["id_customer"]);

    $r = $stm->execute();

    if (!$r) {
        header("location: ../area_personale/agg_password.php?error=true");
    }
} catch (Exception $e) {
    header("location: ../area_personale/agg_password.php?error=true");
    exit();
}

$_SESSION["password"] = $new;
header("location: ../area_personale/area_personale.php?success=true");