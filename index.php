<?php

$conn = new mysqli("localhost", "Mellistan11", "New_password1", "databas");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $användare = $_POST["användare"];
    $lösernord = $_POST["lösenord"];
    $sql = "INSERT INTO users (title, description) VALUES ('$användare', '$lösernord')";
    $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST">
    Användare: <input type="text" name="användare" required><br><br>
    Lösernord:<br>
    <input name="lösenord" type="password"></input><br><br>
    <input type="submit" value="Skicka">
</form>
</body>
</html>

