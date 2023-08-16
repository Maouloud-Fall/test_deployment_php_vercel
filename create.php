
<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=voyage_git', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*echo '<pre>';
var_dump($_FILES);
echo '</pre>';
exit;*/

$ville_d= '';
$ville_a= '';
$heure_d= '';
$date_d= '';
$prix= '';

//$nom= '';
//$telephone= '';

//echo $_SERVER['REQUEST_METHOD']. '<br>';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ville_d = $_POST['ville_d'];
    $ville_a = $_POST['ville_a'];
    $heure_d = date('H:i:s');
    $date_d = date('Y-m-d');
    $prix=  $_POST['prix'];
    


    $errors = [];

    if (!$ville_d) {
        $errors[] = 'Ville de ville de depart is required';
    }

    if (!$date_d) {
        $errors[] = 'date is required';
    }

    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO voyage (ville_d, ville_a, heure_d, date_d, prix )
                VALUES(:ville_d, :ville_a, :heure_d, :date_d, :prix)");
        $statement->bindValue(':ville_d', $ville_d);
        $statement->bindValue(':ville_a',$ville_a);
        $statement->bindValue(':heure_d', date('H:i:s'));
        $statement->bindValue(':date_d', date('Y-m-d'));
        $statement->bindValue(':prix',$prix);
     
        $statement->execute();
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

<h1> Resservation</h1>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif;?>

<form method="post">
    <table class="table">
       <thead>
    <tr>
    <th>
            <div class="mb-3">
    <select class="form-select form-select-lg" name="ville_d" id="ville_d">
        <option selected>Selection une ville de ville$ville_d</option>
        <option >Dakar</option>
        <option  >Thies</option>
        <option  >Mbour</option>
        <option    >Saint-louis</option>
        <option    >fatick</option>
        <option    >Tamba</option>
        <option    >Kolda</option>
        <option    >Ziguinchor</option>
        <option    >Kédougou</option>
        <option    >Dagana</option>
        <option    >Diourbel</option>
        <option    >Louga</option>
        <option    >Kaolack</option>
        <option    >Podor</option>
        <option    >Richard Toll</option>
       
    </select>
</div>
        </th>
        <th>
            <div class="mb-3">
    <select class="form-select form-select-lg" name="ville_a" id="ville_a">
        <option  selected>Selection une ville d'arrivée</option>
        <option   >Dakar</option>
        <option   >Thies</option>
        <option   >Mbour</option>
        <option   >Saint-louis</option>
        <option   >fatick</option>
        <option   >Tamba</option>
        <option   >Kolda</option>
        <option   >Ziguinchor</option>
        <option   >Kédougou</option>
        <option   >Dagana</option>
        <option   >Diourbel</option>
        <option   >Louga</option>
        <option   >Kaolack</option>
        <option   >Podor</option>
        <option   >Richard Toll</option>
       
    </select>
</div>
        </th>
        <th>
            <div class="mb-4">
          <input type="date" id="datepicker" class="form-control" value="Date" name="date_d">
        </div>
 
        </th>
        <th>
          <div class="mb-4">
            <input type="time"
              class="form-control" name="heure_d" id="heure_d"  value="">
          </div>
        </th>
       
        <th>
          <div class="mb-4">
          <input type="number" step=".01" name="prix" class="form-control" value="Prix">
          </div>
        </th>
       
  </tr>
        </thead>

</table>
<button type="submit" class="btn btn-success">Reserver</button>
</form>  

</body>
</html>


