<?php
require 'functions.php';
$connection = dbConnect();

$result = $connection->query('SELECT * FROM `maaltijden`');

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
                <h2><?php echo $row['naam'];?></h2>
                <figure class="menu-list_photo" style="background-image: url(images/<?php echo $row['foto']; ?>)"></figure>
                <header>
                    <h3><?php echo $row['ingredienten'];?></h3>
                    <em>€<?php echo $row['prijs'];?></em>
                </header>
                <p><?php echo $row['beschrijving'];?></p>
                <a href="detail.php?id=<?php echo $row['id'];?>">Meer info</a>
            </article>
            <?php endforeach; ?>
        </section>
        <section>
            <a href="contact.php">Neem contact op!</a>
        </section>
    </div>
</body>
</html>