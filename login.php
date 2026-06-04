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
            echo "Fel lösenord";
        }
    } else {
        echo "Användare finns inte";
    }
}
?>