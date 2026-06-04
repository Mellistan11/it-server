<?php
session_start();

if (!isset($_SESSION["användare"])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "Mellistan11", "New_password1", "databas");

$user = $_SESSION["användare"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $note = $_POST["note"];

    $stmt = $conn->prepare("INSERT INTO notes (användare, note) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $note);
    $stmt->execute();
}

$stmt = $conn->prepare("SELECT note FROM notes WHERE användare=?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1 class="logo">Facelook</h1>
    <div class="container">
        <h2 class="text" >Välkommen</h2>
        <form method="POST">
            <textarea class="note" name="note" placeholder="Skriv anteckning"></textarea>
            <button class="button" type="submit">Spara</button>
        </form>
        <a class="link" href="logout.php">Logga ut</a>
        <h3 class="copyright" >© 2026 Facelook</h3>
    </div>
</body>
</html>