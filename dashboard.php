<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch Pokémon list (limit to 10)
$pokemon_query = $conn->query("SELECT * FROM pokemon LIMIT 10");
$pokemon_list = $pokemon_query->fetchAll();

// Fetch user details
$user_query = $conn->prepare("SELECT * FROM users WHERE id = ?");
$user_query->execute([$user_id]);
$user = $user_query->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pokedex Dashboard</title>
</head>
<body>
    <nav>
        <h1>Pokedex</h1>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h2>Welcome, <?= $user['username'] ?>!</h2>
    <h3>Your Pokémon:</h3>
    <ul>
        <?php foreach ($pokemon_list as $pokemon): ?>
            <li><?= $pokemon['name'] ?> (Type: <?= $pokemon['type'] ?>)</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
