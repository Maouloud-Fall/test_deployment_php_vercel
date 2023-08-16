<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=voyage_git', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Requête SQL pour récupérer les enregistrements de la table "voyage"
    $query = "SELECT * FROM voyage";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $voyages = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de récupération des données : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>

<h1> Liste des voyages enregistrés :</h1>
<p>
    <a href="create.php" class="btn btn-success"> Create </a>
</p>

<?php if (isset($e)): ?>
    <div class="alert alert-danger">
        <?php echo "Erreur : " . $e->getMessage(); ?>
    </div>
<?php endif; ?>

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Ville de départ</th>
            <th>Ville d'arrivée</th>
            <th>Date du voyage</th>
            <th>Heure de départ</th>
            <th>Prix du voyage</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($voyages as $voyage): ?>
            <tr>
                <td><?php echo $voyage['id']; ?></td>
                <td><?php echo $voyage['ville_d']; ?></td>
                <td><?php echo $voyage['ville_a']; ?></td>
                <td><?php echo $voyage['date_d']; ?></td>
                <td><?php echo $voyage['heure_d']; ?></td>
                <td><?php echo $voyage['prix']; ?></td>
                <td>
                    <a href="update.php?id=<?php echo $voyage['id']; ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
                    <a href="delete.php?id=<?php echo $voyage['id']; ?>" class="btn btn-sm btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
