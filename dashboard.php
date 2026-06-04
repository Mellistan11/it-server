<?php
session_start();

if (!isset($_SESSION["användare"])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "Mellistan11", "New_password1", "databas");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $note = $_POST["note"];
    $user = $_SESSION["användare"];

    $stmt = $conn->prepare("INSERT INTO notes (användare, note) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $note);
    $stmt->execute();
}

$user = $_SESSION["användare"];
$result = $conn->query("SELECT note FROM notes WHERE användare='$user'");
?>

<h2>Welcome <?php echo $user; ?></h2>

<form method="POST">
    <textarea name="note" placeholder="Write a note"></textarea><br>
    <button type="submit">Save</button>
</form>

<h3>Your notes:</h3>

<?php
while ($row = $result->fetch_assoc()) {
    echo "<p>" . htmlspecialchars($row["note"]) . "</p>";
}
?>

<a href="logout.php">Logout</a>