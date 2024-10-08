<?php
$servername = "localhost";
$username = "root"; // Par défaut, l'utilisateur est 'root'
$password = ""; // Par défaut, le mot de passe est vide
$dbname = "club_management";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
?>
