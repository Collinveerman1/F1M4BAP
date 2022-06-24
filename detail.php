<?php
require 'functions.php';
$connection = dbConnect();

if( !isset( $_GET['id']) ){
    echo "De id is niet gezet";
    exit;
}

$id = $_GET['id'];
$check_int = filter_var($id, FILTER_VALIDATE_INT);
if($check_int == false){
    echo"dit is geen getal";
    exit;
}

$statement = $connection->prepare('SELECT * FROM `maaltijden` WHERE id=?');
$params = [$id];
$statement->execute($params);
$place = $statement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Menu</title>
</head>
<body>
    <div class="container place-details">
        <section>
            <article class="place-info">
                <header>
                    <h2><?php echo $place['naam'];?></h2>
                </header>
                <figure style="background-image: url(images/<?php echo $place['foto'];?>)">
                    <em>€<?php echo $place['prijs'];?></em>
                </figure>
                <p>
                <?php echo $place['ingredienten'];?>
                </p>
                <hr>
                <p>
                <?php echo $place['beschrijving'];?>
                </p>
                <hr>
                <a href="index.php">Terug naar het overzicht</a>
            </article>
            <aside class="places-sidebar">
                <h3>Andere plaatsen</h3>
                <ul>
                    <li>Pantheon</li>
                    <li>De Dam</li>
                    <li>Sagrada Familia</li>
                    <li>Tower Bridge</li>
                </ul>
            </aside>
        </section>
       
    </div>
</body>
</html>