<?php
session_start(); // Démarre la session
include 'db.php'; // Inclure le fichier de connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $club_id = $_POST['club_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];

    // Préparer et exécuter la requête pour insérer l'événement
    $stmt = $conn->prepare("INSERT INTO events (club_id, title, description, event_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $club_id, $title, $description, $event_date);

    if ($stmt->execute()) {
        // Rediriger vers la page des événements avec un message de succès
        header("Location: events.php?success=Événement créé avec succès !");
        exit();
    } else {
        echo "Erreur : " . $stmt->error; // Afficher une erreur si la requête échoue
    }

    $stmt->close(); // Fermer la déclaration
}

$conn->close(); // Fermer la connexion
?>



