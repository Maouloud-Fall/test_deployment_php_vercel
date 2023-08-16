<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=voyage_git', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'];

$statement = $pdo->prepare("SELECT * FROM voyage WHERE id = :id");
$statement->bindValue(':id', $id);
$statement->execute();
$voyage = $statement->fetch(PDO::FETCH_ASSOC);


$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupérer les valeurs des champs du formulaire
    $ville_d = $_POST['ville_d'];
    $ville_a = $_POST['ville_a'];
    $date_d = $_POST['date_d'];
    $heure_d = $_POST['heure_d'];
    $prix = $_POST['prix'];

    // Valider les données soumises
    if (empty($ville_d)) {
        $errors[] = 'Ville de départ est obligatoire';
    }
    if (empty($ville_a)) {
        $errors[] = 'Ville d\'arrivée est obligatoire';
    }
    if (empty($date_d)) {
        $errors[] = 'Date est obligatoire';
    }
    if (empty($heure_d)) {
        $errors[] = 'Heure est obligatoire';
    }
    if (empty($prix)) {
        $errors[] = 'Prix est obligatoire';
    }

    // Si aucune erreur, mettre à jour les données en base de données
    if (empty($errors)) {
        $statement = $pdo->prepare("UPDATE voyage SET ville_d = :ville_d, ville_a = :ville_a, heure_d = :heure_d, date_d = :date_d, prix = :prix WHERE id = :id");
        $statement->bindValue(':ville_d', $ville_d);
        $statement->bindValue(':ville_a', $ville_a);
        $statement->bindValue(':heure_d', $heure_d);
        $statement->bindValue(':date_d', $date_d);
        $statement->bindValue(':prix', $prix);
        $statement->bindValue(':id', $id);
        $statement->execute();
        
        // Rediriger vers la page index.php
        header('Location: home.php');
    }     
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Call the minified style sheet of Datepicker extension -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>
<body>
<form method="post">
    <table class="table">
       <thead>
    <tr>
    <th>
            <div class="mb-3">
    <select class="form-select form-select-lg" name="ville_d" id="ville_d">
        <option selected>Selection une ville de départ</option>
        <option <?php if ($voyage['ville_d'] == 'Dakar') echo 'selected'; ?>>Dakar</option>
        <option <?php if ($voyage['ville_d'] == 'Thies') echo 'selected'; ?>>Thies</option>
        <option <?php if ($voyage['ville_d'] == 'Mbour') echo 'selected'; ?>>Mbour</option>
        <option <?php if ($voyage['ville_d'] == 'Saint-louis') echo 'selected'; ?>>Saint-louis</option>
        <option <?php if ($voyage['ville_d'] == 'fatick') echo 'selected'; ?>>fatick</option>
        <option <?php if ($voyage['ville_d'] == 'Tamba') echo 'selected'; ?>>Tamba</option>
        <option <?php if ($voyage['ville_d'] == 'Kolda') echo 'selected'; ?>>Kolda</option>
        <option <?php if ($voyage['ville_d'] == 'Ziguinchor') echo 'selected'; ?>>Ziguinchor</option>
        <option <?php if ($voyage['ville_d'] == 'Kedougou') echo 'selected'; ?>>Kedougou</option>
        <option <?php if ($voyage['ville_d'] == 'Dagana') echo 'selected'; ?>>Dagana</option>
        <option <?php if ($voyage['ville_d'] == 'Diourbel') echo 'selected'; ?>>Diourbel</option>
        <option <?php if ($voyage['ville_d'] == 'Louga') echo 'selected'; ?>>Louga</option>
        <option <?php if ($voyage['ville_d'] == 'Kaolack') echo 'selected'; ?>>Kaolack</option>
        <option <?php if ($voyage['ville_d'] == 'Podor') echo 'selected'; ?>>Podor</option>
        <option <?php if ($voyage['ville_d'] == 'Richard Toll') echo 'selected'; ?>>Richard Toll</option>
    </select>
</div>
        </th>
        <th>
            <div class="mb-3">
    <select class="form-select form-select-lg" name="ville_a" id="ville_a">
        <option  selected>Selection une ville d'arrivée</option>
        <option <?php if ($voyage['ville_a'] == 'Dakar') echo 'selected'; ?>>Dakar</option>
        <option <?php if ($voyage['ville_a'] == 'Thies') echo 'selected'; ?>>Thies</option>
        <option <?php if ($voyage['ville_a'] == 'Mbour') echo 'selected'; ?>>Mbour</option>
        <option <?php if ($voyage['ville_a'] == 'Saint-louis') echo 'selected'; ?>>Saint-louis</option>
        <option <?php if ($voyage['ville_a'] == 'fatick') echo 'selected'; ?>>fatick</option>
        <option <?php if ($voyage['ville_a'] == 'Tamba') echo 'selected'; ?>>Tamba</option>
        <option <?php if ($voyage['ville_a'] == 'Kolda') echo 'selected'; ?>>Kolda</option>
        <option <?php if ($voyage['ville_a'] == 'Ziguinchor') echo 'selected'; ?>>Ziguinchor</option>
        <option <?php if ($voyage['ville_a'] == 'Kedougou') echo 'selected'; ?>>Kedougou</option>
        <option <?php if ($voyage['ville_a'] == 'Dagana') echo 'selected'; ?>>Dagana</option>
        <option <?php if ($voyage['ville_a'] == 'Diourbel') echo 'selected'; ?>>Diourbel</option>
        <option <?php if ($voyage['ville_a'] == 'Louga') echo 'selected'; ?>>Louga</option>
        <option <?php if ($voyage['ville_a'] == 'Kaolack') echo 'selected'; ?>>Kaolack</option>
        <option <?php if ($voyage['ville_a'] == 'Podor') echo 'selected'; ?>>Podor</option>
        <option <?php if ($voyage['ville_a'] == 'Richard Toll') echo 'selected'; ?>>Richard Toll</option>
        
    </select>
</div>
        </th>
        <th>
            <div class="mb-4">
          <input type="date" id="datepicker" class="form-control" value="<?php echo $voyage['date_d']; ?>" name="date_d">
        </div>
        </th>
        <th>
          <div class="mb-4">
            <input type="time"
              class="form-control" name="heure_d" id="heure_d"  value="<?php echo $voyage['heure_d']; ?>">
          </div>
        </th>
        <th>
          <div class="mb-4">
          <input type="number" step=".01" name="prix" class="form-control" value="<?php echo $voyage['prix']; ?>">
          </div>
        </th>
  </tr>
        </thead>
</table>

<!-- Afficher les erreurs s'il y en a -->
<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
    <?php foreach ($errors as $error): ?>
    <li><?php echo $error; ?></li>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<button type="submit" class="btn btn-success">Modifier</button>
</form>  
</body>
</html>

