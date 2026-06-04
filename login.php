<?php
session_start();
$conn = new mysqli("localhost", "Mellistan11", "New_password1", "databas");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $användare = $_POST["användare"];
    $lösenord = $_POST["lösenord"];

    $stmt = $conn->prepare("SELECT lösenord FROM users WHERE användare=?");
    $stmt->bind_param("s", $användare);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($lösenord, $row["lösenord"])) {
            $_SESSION["användare"] = $användare;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Fel lösenord";
        }
    } else {
        $error = "Användare finns inte";
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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