<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Événements</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Gestion des Événements</h1>
        <nav>
            <a href="logout.php">Déconnexion</a>
            <a href="dashboard.php">Tableau de bord</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Créer un Événement</h2>
            <form action="create_event.php" method="POST">
                <label for="club_id">Choisir le Club :</label>
                <select name="club_id" id="club_id" required>
                    <?php
                    include 'db.php'; // Inclure le fichier de connexion à la base de données
                    $sql = "SELECT * FROM clubs";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>

                <label for="title">Titre :</label>
                <input type="text" name="title" required>

                <label for="description">Description :</label>
                <textarea name="description" required></textarea>

                <label for="event_date">Date de l'Événement :</label>
                <input type="datetime-local" name="event_date" required>

                <button type="submit">Créer l'Événement</button>
            </form>
        </section>
    </main>
</body>
</html>
