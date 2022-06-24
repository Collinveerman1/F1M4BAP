<?php
require 'functions.php';
$connection = dbConnect();

$voornaam = '';
$achternaam = '';
$email = '';
$bericht = '';
$tijdstip = date('Y-m-d H:i:s');

// Fouten Opslag
$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Opslaan
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $bericht = $_POST['bericht'];

    // Fouten Controleren
    if(isEmpty($voornaam)){
        $errors['voornaam'] = 'Vul uw voornaam in a.u.b.';
    }
    if(isEmpty($achternaam)){
        $errors['achternaam'] = 'Vul uw achternaam in a.u.b.';
    }
    if(!isValidEmailAddress($email)){
        $errors['email'] = 'Dit is geen geldig email address.';
    }
    if(!hasMinLength($bericht, 5)){
        $errors['bericht'] = 'Vul minimaal 5 tekens in.';
    }

    if(count($errors) == 0 ){
    $sql = "INSERT INTO `berichten` (`voornaam`, `achternaam`, `email`, `bericht`, `tijdstip`)
            VALUES (:voornaam, :achternaam, :email, :bericht, :tijdstip);";

    $statement = $connection->prepare($sql);
    $params = [
        'voornaam' => $voornaam,
        'achternaam' => $achternaam,
        'email' => $email,
        'bericht' => $bericht,
        'tijdstip' => $tijdstip
    ];
    $statement->execute($params);

    header('Location: index.html');
    exit;
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>contact</title>
</head>
<body>
   <div class="container">
        <h1>HelloFish</h1>

        <section class="contact">
            <header>
                <h2>Neem hier contact op!</h2>
            </header>

        <form class="form" action="contact.php" method="POST" novalidate>

            <div class="form_field">
                <label for="voornaam">Voornaam</label>
                <input type="text" id="voornaam" name="voornaam" placeholder="Vul uw voornaam in" required>
                <?php if(!empty($errors['voornaam'])):?>
                    <p class="form_error"><?php echo $errors['voornaam'] ?></p>
                    <?php endif; ?>
            </div>

            <div>
                <label for="achternaam">Achternaam</label>
                <input type="text" id="achternaam" name="achternaam" placeholder="Vul uw achternaam in" required>
                <?php if(!empty($errors['achternaam'])):?>
                    <p class="form_error"><?php echo $errors['achternaam'] ?></p>
                    <?php endif; ?>
            </div>

            <div>
                <label for="email">E-mail</label>
                <input type="e-mail" id="email" name="email" placeholder="Vul uw e-mailadres in" required>
                <?php if(!empty($errors['email'])):?>
                    <p class="form_error"><?php echo $errors['email'] ?></p>
                    <?php endif; ?>
            </div>

            <div>
                <label for="bericht">Bericht</label>
                <textarea id="bericht" name="bericht" placeholder="Vul uw vraag of bericht in" required> </textarea>
                <?php if(!empty($errors['bericht'])):?>
                    <p class="form_error"><?php echo $errors['bericht'] ?></p>
                    <?php endif; ?>
            </div>

            <button type="submit" class="form_button">Opsturen</button>
        </form>
        </section>
   </div>
</body>
</html>