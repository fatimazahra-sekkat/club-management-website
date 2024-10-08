<?php
session_start();
include 'db.php';

// Vérifier si l'utilisateur est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Récupérer tous les utilisateurs
$query = "SELECT * FROM users";
$result = $conn->query($query);
$users = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Panneau d'administration</h1>
        <nav>
            <a href="logout.php">Déconnexion</a>
            <aVoici la suite du code pour la page d'administration et d'autres éléments importants pour ton site :

### 6. (suite) Gestion des utilisateurs (admin.php)

#### Suite du code : `admin.php`

```php
            <a href="dashboard.php">Tableau de bord</a>
        </nav>
    </header>
    <main>
        <h2>Liste des utilisateurs</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>">Modifier</a>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
