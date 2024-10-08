<?php
session_start();
include 'db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Récupérer les messages du chat
$query = "SELECT * FROM messages";
$result = $conn->query($query);
$messages = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Chat des membres</h1>
        <nav>
            <a href="logout.php">Déconnexion</a>
            <a href="dashboard.php">Tableau de bord</a>
        </nav>
    </header>
    <main>
        <div id="chat-box">
            <?php foreach ($messages as $message): ?>
                <p><?php echo htmlspecialchars($message['username']) . ': ' . htmlspecialchars($message['content']); ?></p>
            <?php endforeach; ?>
        </div>
        <form method="POST" action="send_message.php">
            <input type="text" name="content" placeholder="Votre message..." required>
            <button type="submit">Envoyer</button>
        </form>
    </main>
</body>
</html>
