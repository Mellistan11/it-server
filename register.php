<?php
session_start();
$conn = new mysqli("localhost", "Mellistan11", "New_password1", "databas");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $användare = $_POST["användare"];
    $lösenord = password_hash($_POST["lösenord"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (användare, lösenord) VALUES (?, ?)");
    $stmt->bind_param("ss", $användare, $lösenord);
    $stmt->execute();

    $_SESSION["användare"] = $användare;
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Skapa konto</h2>

<form method="POST">
    <input type="text" name="användare" placeholder="Användarnamn" required>
    <input type="password" name="lösenord" placeholder="Lösenord" required>
    <button type="submit">Skapa konto</button>
</form>

<a href="login.php">Har du konto? Logga in</a>

</div>

</body>
</html>