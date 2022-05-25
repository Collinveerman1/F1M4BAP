<?php
require 'functions.php';
$connection = dbConnect();

$result = $connection->query('SELECT * FROM `Maaltijden`');

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
    <div class="container">
        <h1>Menu</h1>

        <section class="menu-list">

        <?php foreach($result as $row):?>
            <article class="menu-list_name">
                <h2><?php echo $row['Naam']; ?></h2>
                <figure class="menu-list_photo" style="background-image: url(images/<?php echo $row['Foto']; ?>)"></figure>
                <header>
                    <h3><?php echo $row['Ingrediënten']; ?></h3>
                    <em><?php echo $row['Prijs']; ?></em>
                </header>
                <p><?php echo $row['Beschrijving']; ?></p>
            </article>
            <?php endforeach; ?>
        </section>
    </div>
</body>
</html>