<?php
// Include the database configuration file
require_once 'database/config.php';

// Start a new session or resume the existing session
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['id'])) {
    header("Location: authentication/login.php");
    exit;
}

// Retrieve the logged-in user's ID from the session
$id = $_SESSION['id'];

// Prepare and execute the SQL statement to fetch the logged-in user's data
$sqlSelect = "SELECT * FROM tbluser WHERE id = ?";
$stmt = $conn->prepare($sqlSelect);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $id);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}
$resUser = $stmt->get_result();
$dataUser = $resUser->fetch_assoc();

$image = $dataUser['image'];
$fname = $dataUser['fname'];
$role = $dataUser['role'];

if ($role == "User") {
    header("Location: ../dashboard/dashboard.php");
    exit;
}

// Retrieve the total number of products in the cart
$sqlSelectCart = $conn->prepare("SELECT COUNT(*) as total FROM tblcart");
$sqlSelectCart->execute();
$res = $sqlSelectCart->get_result();
$dataCart = $res->fetch_assoc();

$totalProductsInCart = $dataCart['total'];

?>