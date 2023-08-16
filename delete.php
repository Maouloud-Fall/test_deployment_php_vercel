<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=voyage_git', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $query = "DELETE FROM voyage WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();

        header('Location: home.php'); // Redirige vers la liste des voyages après la suppression
    } catch (PDOException $e) {
        echo "Erreur de suppression : " . $e->getMessage();
    }
} else {
    echo "ID non spécifié.";
}
?>
