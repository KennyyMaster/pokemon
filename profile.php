<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
// Fetch user's Pokémon
$user_pokemon_query = $conn->prepare("SELECT pokemon.name FROM pokemon JOIN trainer_pokemon ON pokemon.id = trainer_pokemon.pokemon_id WHERE trainer_pokemon.trainer_id = ?");
$user_pokemon_query->execute([$user_id]);
$user_pokemon = $user_pokemon_query->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h2>Your Profile</h2>
    <h3>Your Pokémon Team</h3>
    <ul>
        <?php foreach ($user_pokemon as $poke): ?>
            <li><?= $poke['name'] ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
