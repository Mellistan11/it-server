<?php

$conn = new mysqli("localhost", "Mellistan11", "New_password1", "databas");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $användare = $_POST["användare"];
    $lösernord = $_POST["Lösernord"];
    $sql = "INSERT INTO formdata (title, description) VALUES ($användare, $lösernord)";

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
    Titel: <input type="text" name="titel" required><br><br>
    Beskrivning:<br>
    <textarea name="beskrivning" rows="5" cols="40"></textarea><br><br>
    <input type="submit" value="Skicka">
</form>
</body>
</html>

