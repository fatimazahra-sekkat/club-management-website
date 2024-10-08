<?php
session_start();
include 'db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer le nom du club depuis le formulaire
    $club_name = $_POST['club_name'];

    // Préparer et exécuter la requête pour insérer le club
    $stmt = $conn->prepare("INSERT INTO clubs (name) VALUES (?)");
    $stmt->bind_param("s", $club_name);

    if ($stmt->execute()) {
        header("Location: manage_clubs.php?success=Club créé avec succès !");
        exit();
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

// Récupérer tous les clubs pour affichage
$sql = "SELECT * FROM clubs";
$result = $conn->query($sql);
$clubs = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Clubs</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Gestion des Clubs</h1>
        <nav>
            <a href="logout.php">Déconnexion</a>
            <a href="dashboard.php">Tableau de bord</a>
        </nav>
    </header>
    <main>
        <h2>Créer un Nouveau Club</h2>
        <form action="manage_clubs.php" method="POST">
            <label for="club_name">Nom du Club :</label>
            <input type="text" name="club_name" required>
            <button type="submit">Créer le Club</button>
        </form>

        <h2>Liste des Clubs Existants</h2>
        <ul>
            <?php foreach ($clubs as $club): ?>
                <li><?php echo htmlspecialchars($club['name']); ?></li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>
</html>
