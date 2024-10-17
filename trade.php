<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch users for trading
$users_query = $conn->query("SELECT id, username FROM users WHERE id != $user_id");
$users = $users_query->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Trade Pokémon</title>
</head>
<body>
    <h2>Initiate Trade</h2>
    <form method="POST" action="process_trade.php">
        <label for="receiver">Choose a Trainer:</label>
        <select name="receiver_id">
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Trade">
    </form>
</body>
</html>
