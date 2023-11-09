<?php

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Récupérez le paramètre d'URL "id"
if (isset($_GET['id'])) {
    $characterId = $_GET['id'];

    $db = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';port=' . $_ENV["DB_PORT"] . ';dbname=' .  $_ENV['DB_DATABASE']  . ';charset=utf8', $_ENV['DB_NAME'], $_ENV['DB_PASSWORD']);
    
    // Exécutez une requête SQL pour récupérer les informations du personnage en fonction de $characterId
    $sql = 'SELECT * FROM personnages WHERE id_user = :characterId';
    $characterStatement = $db->prepare($sql);
    $characterStatement->bindParam(':characterId', $characterId, PDO::PARAM_INT);
    $characterStatement->execute();
    $characterData = $characterStatement->fetch(PDO::FETCH_ASSOC);
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $characterData['name'] ?></h1>
    <img src="<?php echo $characterData['id_img'] ?>"  alt="">
</body>
</html>