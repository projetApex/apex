<?php

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Récupérez le paramètre d'URL "id"
if (isset($_GET['id'])) {
    $characterId = $_GET['id'];

    $db = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';port=' . $_ENV["DB_PORT"] . ';dbname=' .  $_ENV['DB_DATABASE']  . ';charset=utf8', $_ENV['DB_NAME'], $_ENV['DB_PASSWORD']);
    
    // Exécutez une requête SQL pour récupérer les informations du personnage en fonction de $characterId
    $sql = 'SELECT p.*, i.img_perso, s.passive AS passive_name, s.tactical AS tactical_name, s.ultime AS ultime_name, si.passive_img AS passive_img, si.tactical_img AS tactical_img, si.ultime_img AS ultime_img
                FROM personnages p
                JOIN img i ON p.id_img = i.id_img
                JOIN spell s ON p.id_spell = s.id_spell
                JOIN spell_img si ON p.id_spell_img = si.id_spell_img
                WHERE p.id_user = :characterId';

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
    <img src="<?php echo $characterData['img_perso'] ?>"  alt="">
    <p><?php echo $characterData['story'] ?></p>
    <h2>Spells:</h2>
        <ul>
            <li><strong>Passive:</strong> <?php echo $characterData['passive_name'] ?></li>
            <li><strong>Tactical:</strong> <?php echo $characterData['tactical_name'] ?></li>
            <li><strong>Ultimate:</strong> <?php echo $characterData['ultime_name'] ?></li>
        </ul>
        <h2>Spell Images:</h2>
        <ul>
            <li><strong>Passive:</strong> <img src="<?php echo $characterData['passive_img'] ?>" alt=""></li>
            <li><strong>Tactical:</strong> <img src="<?php echo $characterData['tactical_img'] ?>" alt=""></li>
            <li><strong>Ultimate:</strong> <img src="<?php echo $characterData['ultime_img'] ?>" alt=""></li>
        </ul>
    <?php 
    var_dump($characterData)
    ?>
</body>
</html>