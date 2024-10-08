<?php
session_start();
include 'db.php';

// Vérifier si l'utilisateur est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['id'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $role, $userId);
    $stmt->execute();

    header("Location: admin.php");
    exit();
}

// Récupérer l'utilisateur
$userId = $_GET['id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Utilisateur</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Modifier l'utilisateur</h1>
    </header>
    <main>
        <form method="POST" action="edit_user.php">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <select name="role">
                <option value="user" <?php if ($user['role'] === 'user') echo 'selected'; ?>>Utilisateur</option>
                <option value="manager" <?php if ($user['role'] === 'manager') echo 'selected'; ?>>Gestionnaire</option>
                <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Administrateur</option>
            </select>
            <button type="submit">Mettre à jour</button>
        </form>
        <a href="admin.php">Retourner à la liste des utilisateurs</a>
    </main>
</body>
</html>
