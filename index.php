<?php

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
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll(PDO::FETCH_ASSOC);

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

} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style3.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Apex Legend</title>
</head>

<body>

    <div class="contains">
        <?php
        for ($i = 0; $i < count($recipes); $i++) {
            ?>
            <div class="box">
                
                <select class="image-selector global-selector" data-character-index="-1">
                    <?php
                    foreach ($recipes as $image) {
                        echo '<option value="' . $image['img_path'] . '" > ' . $image['img_number'] . '</option>';
                    }
                    ?>
                </select>
                <img class="character-image" src="<?php echo $recipes[$i]['img_perso'] ?>" alt="">
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
                        <p><a href="" class="button2"><i class="fas fa-angle-down"></i> <span>Description</span></a></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageRadios = document.querySelectorAll('input[type=radio]');

            imageRadios.forEach((radio) => {
                radio.addEventListener('change', function () {
                    const selectedImage = this.value;
                    const imageIndex = this.name.split('_')[1];
                    const characterImage = document.querySelector('.character-image[data-character-index="' + imageIndex + '"]');

                   
                    characterImage.src = 'chemin_vers_' + selectedImage.toLowerCase().replace(/\s/g, '_') + '.jpg';
                });
            });
        });
    </script>

</body>

</html>