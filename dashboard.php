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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Logga in</h2>
        <form method="POST">
            <input type="text" name="användare" placeholder="Användarnamn" required>
            <input type="password" name="lösenord" placeholder="Lösenord" required>
            <button type="submit">Logga in</button>
        </form>
        <a href="register.php">Skapa konto</a>
    </div>
</body>
</html>