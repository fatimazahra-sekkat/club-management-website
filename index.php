<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Préparer la requête pour récupérer l'utilisateur
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'utilisateur existe
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Vérifier le mot de passe
        if (password_verify($password, $user['password'])) {
            // Initialiser les variables de session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username']; // Assurez-vous que cela est défini
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Nom d'utilisateur introuvable.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Clubs</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Gestion de Clubs</h1>
    </header>
    <main>
    <h1>Connexion</h1>
        <form id="login-form" method="POST" action="index.php">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        
    </main>
        
    </header>
    <main>
    
    <script src="js/script.js"></script>
</body>
</html>
