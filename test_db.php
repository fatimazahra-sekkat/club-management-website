<?php
include 'db.php';

if ($conn) {
    echo "Connexion à la base de données réussie.";
} else {
    echo "Échec de la connexion.";
}

$conn->close();
?>
