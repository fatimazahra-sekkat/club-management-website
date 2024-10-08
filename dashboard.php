<?php
session_start();
include 'db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Récupérer les clubs de l'utilisateur
$userId = $_SESSION['user_id'];
$query = "SELECT * FROM clubs WHERE user_id = ?";
$stmt = $conn->prepare("SELECT * FROM clubs WHERE id = ?");

$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$clubs = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Bienvenue au tableau de bord</h1>
        <nav>
            <a href="logout.php">Déconnexion</a>
            <a href="events.php">Événements</a>
            <a href="chat.php">Chat</a>
        </nav>
    </header>
    <main>
    <form method="POST" action="search.php">
    <input type="text" name="search" placeholder="Rechercher un club...">
    <button type="submit">Rechercher</button>
</form>

        <h2>Mes clubs</h2>
        <ul>
            <?php foreach ($clubs as $club): ?>
                <li><?php echo htmlspecialchars($club['name']); ?></li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>
</html>
