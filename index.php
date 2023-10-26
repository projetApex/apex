<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php include('header.php'); ?>
    <h1>Apex</h1>

    <?php
    // Connexion à la base de données
    $bdd = new PDO('mysql:host=localhost;dbname=apex;charset=utf8', 'root', '');

    // Requête SQL pour récupérer les images
    $query = $bdd->query("SELECT image_data FROM images");

    // Boucle pour afficher les images
    while ($row = $query->fetch()) {
        // Affichage de l'image
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '" />';
    }

    // Fermeture de la requête
    $query->closeCursor();
    ?>

</body>

</html>
