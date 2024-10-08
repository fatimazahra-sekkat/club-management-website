<?php
session_start();
include 'db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Récupérer tous les événements
$query = "SELECT events.*, clubs.name AS club_name FROM events JOIN clubs ON events.club_id = clubs.id";
$result = $conn->query($query);
$events = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Événements</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Événements à venir</h1>
        <nav>
            <a href="logout.php">Déconnexion</a>
            <a href="dashboard.php">Tableau de bord</a>
        </nav>
    </header>
    <main>
        <h2>Liste des événements</h2>
        <ul>
            <?php foreach ($events as $event): ?>
                <li><?php echo htmlspecialchars($event['title']); ?> - <?php echo htmlspecialchars($event['event_date']); ?> - Club: <?php echo htmlspecialchars($event['club_name']); ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="manage_events.php">Créer un nouvel événement</a>
    </main>
</body>
</html>
