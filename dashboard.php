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

<h2>Välkommen <?php echo htmlspecialchars($user); ?></h2>

<form method="POST">
    <textarea name="note" placeholder="Skriv en anteckning..." required></textarea><br><br>
    <button type="submit">Spara</button>
</form>

<h3>Dina anteckningar:</h3>

<?php while ($row = $result->fetch_assoc()): ?>
    <p><?php echo htmlspecialchars($row["note"]); ?></p>
<?php endwhile; ?>

<br>
<a href="logout.php">Logga ut</a>

</body>
</html>