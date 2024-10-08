<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hachage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Préparer la requête pour insérer le nouvel utilisateur
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $role = $_POST['role']; // Récupérer le rôle choisi depuis le formulaire

    $stmt->bind_param("sss", $username, $hashedPassword, $role);

    if ($stmt->execute()) {
        echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Lien vers ton fichier CSS si tu en as un -->
</head>
<body>
    <header>
        <h1>Inscription</h1>
    </header>
    <main>
    <h1>Inscription</h1>
    <form id="signup-form" method="POST" action="signup.php">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <select name="role">
        <option value="user">Utilisateur</option>
        <option value="manager">Gestionnaire</option>
        <option value="admin">Administrateur</option>
    </select>
    <button type="submit">S'inscrire</button>
</form>

    </main>
    <script src="js/script.js"></script> <!-- Lien vers ton fichier JS si tu en as un -->
</body>
</html>
