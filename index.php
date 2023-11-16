<?php

session_start();
echo $_SESSION['email'];

if(!isset($_SESSION['email'])) {
    header('Location: connexion.php');
}

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try
{
    $db = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';port=' . $_ENV["DB_PORT"] . ';dbname=' .  $_ENV['DB_DATABASE']  . ';charset=utf8', $_ENV['DB_NAME'], $_ENV['DB_PASSWORD']);

    $sql = 'SELECT * FROM img';
    $recipesStatement = $db->prepare($sql);//prepare sql request
    $recipesStatement->execute();//execute sql request
    $recipes = $recipesStatement->fetchAll(PDO::FETCH_ASSOC);//fetch all data from sql request

    $sql2 = 'SELECT * FROM spell_img';
    $recipesStatement2 = $db->prepare($sql2);
    $recipesStatement2->execute();
    $recipes2 = $recipesStatement2->fetchAll(PDO::FETCH_ASSOC);

    $sql3 = 'SELECT * FROM spell';
    $recipesStatement3 = $db->prepare($sql3);
    $recipesStatement3->execute();
    $recipes3 = $recipesStatement3->fetchAll(PDO::FETCH_ASSOC);

    $sql4 = 'SELECT * FROM personnages';
    $recipesStatement4 = $db->prepare($sql4);
    $recipesStatement4->execute();
    $recipes4 = $recipesStatement4->fetchAll(PDO::FETCH_ASSOC);

    
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());//stop the process and show error message
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/index.css">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Apex Legend</title>
</head>

<body>
<a href="./deconnexion.php">
    <button>Deconnexion</button>
</a>
    <div class="contains">
        <div class="box" id="1">
            <img class="wraith" src="<?php  echo $recipes[0]['img_perso']?>" alt="">
            <div class="skill">
                <h3 class="perso"><?php echo $recipes4[0]['name']?></h3>
                <img class="spell" src="<?php echo $recipes2[0]['passive_img']?>" alt="">
                <p class="name"><?php echo $recipes3[0]['passive']?></p>
                <img class="spell" src="<?php echo $recipes2[0]['tactical_img']?>" alt="">
                <p class="name"><?php echo $recipes3[0]['tactical']?></p>
                <img class="spell" src="<?php echo $recipes2[0]['ultime_img']?>" alt="">
                <p class="name"><?php echo $recipes3[0]['ultime']?></p>
            </div>
        </div>
        <div class="box" id="2">
            <img class="octane" src="<?php echo $recipes[1]['img_perso']?>" alt="">
            <div class="skill">
            <h3 class="perso"><?php echo $recipes4[1]['name']?></h3>
                <img class="spell" src="<?php echo $recipes2[1]['passive_img']?>" alt="">
                <p class="name"><?php echo $recipes3[1]['passive']?></p>
                <img class="spell" src="<?php echo $recipes2[1]['tactical_img']?>" alt="">
                <p class="name"><?php echo $recipes3[1]['tactical']?></p>
                <img class="spell" src="<?php echo $recipes2[1]['ultime_img']?>" alt="">
                <p class="name"><?php echo $recipes3[1]['ultime']?></p>
            </div>
        </div>
        <div class="box" id="3">
            <img class="revenant" src="<?php echo $recipes[2]['img_perso']?>" alt="">
            <div class="skill">
            <h3 class="perso"><?php echo $recipes4[2]['name']?></h3>
                <img class="spell" src="<?php echo $recipes2[2]['passive_img']?>" alt="">
                <p class="name"><?php echo $recipes3[2]['passive']?></p>
                <img class="spell" src="<?php echo $recipes2[2]['tactical_img']?>" alt="">
                <p class="name"><?php echo $recipes3[2]['tactical']?></p>
                <img class="spell" src="<?php echo $recipes2[2]['ultime_img']?>" alt="">
                <p class="name"><?php echo $recipes3[2]['ultime']?></p>
            </div>
        </div>
        <div class="box" id="4">
            <img class="catalyst" src="<?php echo $recipes[3]['img_perso']?>" alt="">
            <div class="skill">
            <h3 class="perso"><?php echo $recipes4[3]['name']?></h3>
                <img class="spell" src="<?php echo $recipes2[3]['passive_img']?>" alt="">
                <p class="name"><?php echo $recipes3[3]['passive']?></p>
                <img class="spell" src="<?php echo $recipes2[3]['tactical_img']?>" alt="">
                <p class="name"><?php echo $recipes3[3]['tactical']?></p>
                <img class="spell" src="<?php echo $recipes2[3]['ultime_img']?>" alt="">
                <p class="name"><?php echo $recipes3[3]['ultime']?></p>
            </div>
        </div>
        
        <!-- <button class="boutique" href="./shop.php">Acceder a la boutique</button>  -->
    </div>
    <form action="shop.php">
            <button type="submit" class="shop">Aller a la boutique</button>
        </form>



    <script src="./js/index.js"></script>
</body>

</html>