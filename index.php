<?php

session_start();


require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


function connectToDatabase()
{
    try {
        return new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';port=' . $_ENV["DB_PORT"] . ';dbname=' . $_ENV['DB_DATABASE'] . ';charset=utf8', $_ENV['DB_NAME'], $_ENV['DB_PASSWORD']);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


try {
    $db = connectToDatabase();

    $sql = 'SELECT * FROM img';
    $recipesStatement = $db->prepare($sql); //prepare sql request
    $recipesStatement->execute(); //execute sql request
    $recipes = $recipesStatement->fetchAll(PDO::FETCH_ASSOC); //fetch all data from sql request

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

    $sql5 = 'SELECT * FROM utilisateurs';
    $recipesStatement5 = $db->prepare($sql5);
    $recipesStatement5->execute();
    $recipes5 = $recipesStatement5->fetchAll(PDO::FETCH_ASSOC);


} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage()); //stop the process and show error message
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
        <button class="deconnexion">Deconnexion</button>
    </a>

    <div class="contains">
        <?php
        for ($i = 0; $i < count($recipes); $i++) {
            ?>

            <?php $UserID = $i + 1; ?>

            <div class="money">
                <p class="credit">
                    <?php echo $recipes5[$i]['credits'] ?> crédits
                </p>
                
            </div>
            <div class="box">

                <div class="imgchange">

                    <img class="character-image" src="<?php echo $recipes[$i]['img_perso'] ?>" alt="">
                    <select class="image-selector global-selector" data-character-index="<?= $i - 1 ?>">
                        <?php
                        foreach ($recipes as $image) {
                            echo '<option value="' . $image['img_path'] . '" > ' . $image['img_number'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="skill">
                    <h3 class="perso">
                        <?php echo $recipes4[$i]['name'] ?>
                    </h3>
                    <img class="spell" src="<?php echo $recipes2[$i]['passive_img'] ?>" alt="">
                    <p class="name">
                        <?php echo $recipes3[$i]['passive'] ?>
                    </p>
                    <img class="spell" src="<?php echo $recipes2[$i]['tactical_img'] ?>" alt="">
                    <p class="name">
                        <?php echo $recipes3[$i]['tactical'] ?>
                    </p>
                    <img class="spell" src="<?php echo $recipes2[$i]['ultime_img'] ?>" alt="">
                    <p class="name">
                        <?php echo $recipes3[$i]['ultime'] ?>
                    </p>
                    <div class="titre">
                        <p class="button2" id="<?php echo strval($UserID) ?>">
                            <span>Description</span></p>
                    </div>
                </div>

            </div>

            <?php
        }
        ?>

    </div>
    <form action="shop.php">
        <button type="submit" class="shop">Aller a la boutique</button>
    </form>


    <script src="./js/index.js"></script>

</body>

</html>