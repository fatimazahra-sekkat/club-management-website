<?php
session_start();
include 'db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Erreur : utilisateur non connecté.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : null; // Vérifie que le nom d'utilisateur est défini
    $content = isset($_POST['content']) ? trim($_POST['content']) : ''; // Récupérer et nettoyer le message

    // Debugging
    var_dump($_SESSION); // Affiche le contenu de la session
    var_dump($content);   // Affiche le contenu du message

    // Vérifier que le contenu du message n'est pas vide
    if ($username && !empty($content)) {
        // Préparer la requête pour insérer le message
        $stmt = $conn->prepare("INSERT INTO messages (username, content) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $content); // "ss" signifie que les deux sont des chaînes

        if ($stmt->execute()) {
            header("Location: chat.php"); // Rediriger vers la page de chat après l'envoi
            exit();
        } else {
            echo "Erreur lors de l'envoi : " . $stmt->error; // Afficher une erreur si l'envoi échoue
        }

        $stmt->close(); // Fermer la déclaration
    } else {
        echo "Erreur : utilisateur non connecté ou le message ne peut pas être vide.";
    }
}

$conn->close(); // Fermer la connexion
?>

