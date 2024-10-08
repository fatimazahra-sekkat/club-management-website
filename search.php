<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$search = $_POST['search'];
$query = "SELECT * FROM clubs WHERE name LIKE ?";
$stmt = $conn->prepare($query);
$searchTerm = '%' . $search . '%';
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
$clubs = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats de recherche</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Résultats de recherche pour "<?php echo htmlspecialchars($search); ?>"</h1>
    </header>
    <main>
        <ul>
            <?php foreach ($clubs as $club): ?>
                <li><?php echo htmlspecialchars($club['name']); ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="dashboard.php">Retourner au tableau de bord</a>
    </main>
</body>
</html>
