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
    <h1 class="logo">Facelook</h1>
    <div class="container">
        <h2 class="text">Skapa konto</h2>
        <form method="POST">
            <input class="input" type="text" name="användare" placeholder="Användarnamn" required>
            <input class="input" type="password" name="lösenord" placeholder="Lösenord" required>
            <button class="button" type="submit">Skapa konto</button>
        </form>
        <a class="link" href="login.php">Har du konto? Logga in</a>
        <h3 class="copyright" >© 2026 Facelook</h3>
    </div>
</body>
</html>